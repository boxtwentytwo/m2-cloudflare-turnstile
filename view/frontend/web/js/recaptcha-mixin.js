define([
    'jquery',
    'underscore',
    'Magento_ReCaptchaFrontendUi/js/registry',
    'BoxTwentyTwo_CloudflareTurnstile/js/script-loader'
], function ($, _, registry, scriptLoader) {
    'use strict';

    return function (reCaptcha) {
        return reCaptcha.extend({
            _loadApi: function() {
                if(this.settings && this.settings.turnstile) {
                    if (this._isApiRegistered !== undefined) {
                        if (this._isApiRegistered === true) {
                            $(window).trigger('recaptchaapiready');
                        }

                        return;
                    }
                    this._isApiRegistered = false;

                    // global function
                    window.globalOnRecaptchaOnLoadCallback = function () {
                        this._isApiRegistered = true;
                        $(window).trigger('recaptchaapiready');
                    }.bind(this);

                    scriptLoader.addTurnstileScriptTag();
                } else {
                    this._super();
                }
            },

            initCaptcha: function() {
                if(this.settings && this.settings.turnstile) {
                    var $parentForm,
                    $wrapper,
                    $reCaptcha,
                    widgetId,
                    parameters;

                    if (this.captchaInitialized || this.settings ===

                        void 0) {
                        return;
                    }

                    this.captchaInitialized = true;

                    $wrapper = $('#' + this.getReCaptchaId() + '-wrapper');
                    $reCaptcha = $wrapper.find('.g-recaptcha');
                    $reCaptcha.attr('id', this.getReCaptchaId());

                    $parentForm = $wrapper.parents('form');

                    if (this.settings === undefined) {
                        return;
                    }

                    parameters = _.extend(
                        {
                            'callback': function (token) { // jscs:ignore jsDoc
                                this.reCaptchaCallback(token);
                                this.validateReCaptcha(true);
                            }.bind(this),
                            'expired-callback': function () {
                                this.validateReCaptcha(false);
                            }.bind(this)
                        },
                        this.settings.rendering
                    );

                    // eslint-disable-next-line no-undef
                    widgetId = grecaptcha.render('#' + this.getReCaptchaId(), parameters);
                    this.initParentForm($parentForm, widgetId);

                    registry.ids.push(this.getReCaptchaId());
                    registry.captchaList.push(widgetId);
                    registry.tokenFields.push(this.tokenField);
                } else {
                    this._super();
                }
            }
        });
    }
});
