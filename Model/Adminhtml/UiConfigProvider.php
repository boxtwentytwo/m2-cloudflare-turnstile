<?php
namespace BoxTwentyTwo\CloudflareTurnstile\Model\Adminhtml;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\ReCaptchaUi\Model\UiConfigProviderInterface;

class UiConfigProvider implements UiConfigProviderInterface
{
    private const XML_PATH_PUBLIC_KEY = 'recaptcha_backend/type_cf_turnstile/public_key';
    private const XML_PATH_SIZE = 'recaptcha_backend/type_cf_turnstile/size';
    private const XML_PATH_THEME = 'recaptcha_backend/type_cf_turnstile/theme';
    private const XML_PATH_LANGUAGE_CODE = 'recaptcha_backend/type_cf_turnstile/lang';

    private $scopeConfig;

    public function __construct(
        ScopeConfigInterface $scopeConfig
    ) {
        $this->scopeConfig = $scopeConfig;
    }

    private function getPublicKey(): string
    {
        return trim((string)$this->scopeConfig->getValue(self::XML_PATH_PUBLIC_KEY));
    }

    private function getSize(): string
    {
        return (string)$this->scopeConfig->getValue(
            self::XML_PATH_SIZE
        );
    }

    private function getTheme(): string
    {
        return (string)$this->scopeConfig->getValue(
            self::XML_PATH_THEME
        );
    }

    private function getLanguageCode(): string
    {
        return (string)$this->scopeConfig->getValue(
            self::XML_PATH_LANGUAGE_CODE
        );
    }

    public function get(): array
    {
        $config = [
            'rendering' => [
                'sitekey' => $this->getPublicKey(),
                'size' => $this->getSize(),
                'theme' => $this->getTheme(),
                'language' => $this->getLanguageCode(),
            ],
            'invisible' => false,
            'turnstile' => true
        ];
        return $config;
    }
}
