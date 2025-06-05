<?php
namespace BoxTwentyTwo\CloudflareTurnstile\Helper;

use Magento\Framework\App\Helper\AbstractHelper;

class Admin extends AbstractHelper
{
    public function getTemplate($type)
    {
        if($type == 'cf_turnstile') {
            return 'BoxTwentyTwo_CloudflareTurnstile::recaptcha.phtml';
        }

        return 'Magento_ReCaptchaUser::recaptcha.phtml';
    }

    public function getLoginTemplate()
    {
        return $this->getTemplate($this->scopeConfig->getValue('recaptcha_backend/type_for/user_login'));
    }

    public function getForgotPasswordTemplate()
    {
        return $this->getTemplate($this->scopeConfig->getValue('recaptcha_backend/type_for/user_forgot_password'));
    }
}
