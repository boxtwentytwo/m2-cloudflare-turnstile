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
The module is configured in the same places as Magento's reCAPTCHA configuration:
- **Stores > Configuration > Security > Google reCAPTCHA Admin Panel > Cloudflare Turnstile**
- **Stores > Configuration > Security > Google reCAPTCHA Storefront > Cloudflare Turnstile**

## Contributing
Contributions are welcomed and encouraged. Please feel free to submit an issue or pull request if you find a bug or have a feature request.

## Credits

Copyright (C) Sam Cleathero 2025. Licensed under [GPLv3](https://www.gnu.org/licenses/gpl-3.0.en.html "GPLv3").
