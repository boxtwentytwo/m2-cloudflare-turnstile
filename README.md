# Cloudflare Turnstile for Magento 2

![Hyvä Compatible](https://img.shields.io/badge/Hyv%C3%A4-Compatible-0A144B?style=for-the-badge&labelColor=0A23B9)

A module for Magento 2 that extends the built-in reCAPTCHA support to add [Cloudflare Turnstile](https://www.cloudflare.com/en-gb/application-services/products/turnstile/ "Cloudflare Turnstile"), an alternative privacy-friendly solution.

The documentation for Cloudflare Turnstile can be found [here](https://developers.cloudflare.com/turnstile/ "here").

## Features

- Supports Luma and Hyvä storefronts
- Configurable widget size, theme (light/dark), and language
- Works in all the places Magento's reCAPTCHA solution does, including:
  - Customer login form
  - Forgotten password form
  - New customer account form
  - Contact us form
  - Product review forms
  - Newsletter subscription form
  - Checkout
  - Admin login form
  - Admin forgotten password form

## Installation

```
composer require boxtwentytwo/module-cloudflare-turnstile
bin/magento module:enable BoxTwentyTwo_CloudflareTurnstile
bin/magento setup:upgrade
```

## Usage

### Configuration

Create a Cloudflare Turnstile site and secret key by following the instructions in the [Cloudflare Turnstile documentation](https://developers.cloudflare.com/turnstile/get-started/ "Cloudflare Turnstile documentation").

Keys can be configured in the Magento admin panel. They are configured in the same places as Magento's reCAPTCHA configuration:

- **Stores > Configuration > Security > Google reCAPTCHA Admin Panel > Cloudflare Turnstile**
- **Stores > Configuration > Security > Google reCAPTCHA Storefront > Cloudflare Turnstile**

### Activation per form

Activate Cloudflare Turnstile on the desired forms in the same places as Magento's reCAPTCHA configuration:

- **Stores > Configuration > Security > Google reCAPTCHA Admin Panel > Storefront**
- **Stores > Configuration > Security > Google reCAPTCHA Storefront > Storefront**

## Testing

Cloudflare Turnstile provides test keys that can be used to test the integration without generating actual traffic. You can find the test keys in the [Cloudflare Turnstile documentation](https://developers.cloudflare.com/turnstile/troubleshooting/testing/#test-sitekeys "Cloudflare Turnstile documentation").

## Troubleshooting

### Hyvä

In some cases, custom themes may override the display of the Turnstile widget. If after activation from the admin panel nothing appears on the forms, please check your theme's templates to see if the widget is being called for.

For the contact form, make sure the following lines are present in the template:

```php
<?php
use Hyva\Theme\ViewModel\ReCaptcha;

// Do not replace this with $viewModels->require(ReCaptcha::class); that would break the dependency
// on the Magento_ReCaptchaContact module
$recaptcha = $block->getData('viewModelRecaptcha');
?>
<?= $recaptcha ? $recaptcha->getInputHtml(ReCaptcha::RECAPTCHA_FORM_ID_CONTACT) : '' ?>
```

Other constants are defined in the viewModel which can be found in https://github.com/hyva-themes/magento2-theme-module/blob/main/src/ViewModel/ReCaptcha.php

## Contributing

Contributions are welcomed and encouraged. Please feel free to submit an issue or pull request if you find a bug or have a feature request.

## Credits

Copyright (C) Sam Cleathero 2025. Licensed under [GPLv3](https://www.gnu.org/licenses/gpl-3.0.en.html "GPLv3").
