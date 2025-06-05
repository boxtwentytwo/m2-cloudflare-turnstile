<?php
namespace BoxTwentyTwo\CloudflareTurnstile\Model;

use Magento\Framework\App\RequestInterface;
use ReCaptcha\RequestMethod\Post;

class RequestMethod extends Post
{
    public function __construct(
        RequestInterface $request,
        ?string $siteVerifyUrl = null
    ) {
        if($request->getParam('cf-turnstile-response')) {
            parent::__construct('https://challenges.cloudflare.com/turnstile/v0/siteverify');
        } else {
            parent::__construct($siteVerifyUrl);
        }
    }
}
