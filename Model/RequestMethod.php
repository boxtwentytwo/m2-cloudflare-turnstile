<?php
namespace BoxTwentyTwo\CloudflareTurnstile\Model;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;
use ReCaptcha\RequestMethod\Post;
use ReCaptcha\RequestParameters;

/**
 * Sends the verification to Cloudflare when the token was issued by Turnstile,
 * and to Google otherwise.
 *
 * The captcha type cannot be told from the request: form submits carry the
 * Turnstile token in the cf-turnstile-response field, but the web API / AJAX
 * flows (checkout place order, GraphQL, ...) carry it in the X-ReCaptcha header,
 * so a request-based check verified those tokens against Google and they always
 * failed. The reliable signal is the secret that reCAPTCHA is verifying with:
 * when it is the configured Turnstile secret, the token must go to Cloudflare.
 * This also leaves a store that mixes Google reCAPTCHA and Turnstile working -
 * Google secrets keep going to Google.
 */
class RequestMethod extends Post
{
    private const TURNSTILE_SITE_VERIFY_URL = 'https://challenges.cloudflare.com/turnstile/v0/siteverify';

    /**
     * Config paths the Turnstile secret is stored under (frontend + admin).
     */
    private const SECRET_CONFIG_PATHS = [
        'recaptcha_frontend/type_cf_turnstile/private_key',
        'recaptcha_backend/type_cf_turnstile/private_key',
    ];

    public function __construct(
        private ScopeConfigInterface $scopeConfig,
        ?string $siteVerifyUrl = null
    ) {
        parent::__construct($siteVerifyUrl);
    }

    /**
     * @inheritDoc
     */
    public function submit(RequestParameters $params): string
    {
        if ($this->isTurnstileSecret((string)($params->toArray()['secret'] ?? ''))) {
            // Reuse the parent transport, just pointed at Cloudflare's endpoint.
            return (new Post(self::TURNSTILE_SITE_VERIFY_URL))->submit($params);
        }

        return parent::submit($params);
    }

    /**
     * Whether the secret in use matches a configured Cloudflare Turnstile secret.
     *
     * @param string $secret
     * @return bool
     */
    private function isTurnstileSecret(string $secret): bool
    {
        if ($secret === '') {
            return false;
        }

        foreach (self::SECRET_CONFIG_PATHS as $path) {
            $configured = (string)$this->scopeConfig->getValue($path, ScopeInterface::SCOPE_WEBSITE);
            if ($configured !== '' && hash_equals($configured, $secret)) {
                return true;
            }
        }

        return false;
    }
}
