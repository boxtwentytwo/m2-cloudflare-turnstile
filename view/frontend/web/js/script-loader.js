define([], function () {
    'use strict';

    var scriptTagAdded = false;

    return {
        addTurnstileScriptTag: function () {
            var element, scriptTag;

            if (!scriptTagAdded) {
                element = document.createElement('script');
                scriptTag = document.getElementsByTagName('script')[0];

                element.async = true;
                element.src = 'https://challenges.cloudflare.com/turnstile/v0/api.js' +
                    '?compat=recaptcha&onload=globalOnRecaptchaOnLoadCallback&render=explicit';

                scriptTag.parentNode.insertBefore(element, scriptTag);
                scriptTagAdded = true;
            }
        }
    };
});
