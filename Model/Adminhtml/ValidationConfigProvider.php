<?php
namespace BoxTwentyTwo\CloudflareTurnstile\Model\Adminhtml;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\HTTP\PhpEnvironment\RemoteAddress;
use Magento\ReCaptchaUi\Model\ValidationConfigProviderInterface;
use Magento\ReCaptchaValidationApi\Api\Data\ValidationConfigInterface;
use Magento\ReCaptchaValidationApi\Api\Data\ValidationConfigInterfaceFactory;

class ValidationConfigProvider implements ValidationConfigProviderInterface
{
    private const XML_PATH_PRIVATE_KEY = 'recaptcha_backend/type_cf_turnstile/private_key';
    private const XML_PATH_VALIDATION_FAILURE = 'recaptcha_backend/type_cf_turnstile/validation_failure_message';

    private $scopeConfig;
    private $remoteAddress;
    private $validationConfigFactory;

    public function __construct(
        ScopeConfigInterface $scopeConfig,
        RemoteAddress $remoteAddress,
        ValidationConfigInterfaceFactory $validationConfigFactory
    ) {
        $this->scopeConfig = $scopeConfig;
        $this->remoteAddress = $remoteAddress;
        $this->validationConfigFactory = $validationConfigFactory;
    }

    private function getPrivateKey(): string
    {
        return trim((string)$this->scopeConfig->getValue(self::XML_PATH_PRIVATE_KEY));
    }

    private function getValidationFailureMessage(): string
    {
        return trim(
            (string)$this->scopeConfig->getValue(self::XML_PATH_VALIDATION_FAILURE)
        );
    }

    public function get(): ValidationConfigInterface
    {
        /** @var ValidationConfigInterface $validationConfig */
        $validationConfig = $this->validationConfigFactory->create(
            [
                'privateKey' => $this->getPrivateKey(),
                'remoteIp' => $this->remoteAddress->getRemoteAddress(),
                'validationFailureMessage' => $this->getValidationFailureMessage(),
                'extensionAttributes' => null,
            ]
        );
        return $validationConfig;
    }
}
