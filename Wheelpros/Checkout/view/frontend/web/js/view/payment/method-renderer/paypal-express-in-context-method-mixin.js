
define(
    [
        'uiRegistry',
        'Magento_Checkout/js/model/payment/additional-validators'
    ],
    function (
        registry,
        additionalValidators
    ) {
        'use strict';

        return function (origComponent) {

            if (window.isWheelprosCheckout) {
                return origComponent.extend({
                    defaults: {
                        template: 'Wheelpros_Checkout/payment-method/renderer/paypal-express-in-context',
                        initialValidationPass: false
                    },

                    selectPaymentMethod: function () {
                        registry.get('checkout.sidebar.place-order').setSelectedPaymentMethod(this);

                        this.validate();
                        return this._super();
                    },

                    validate: function (actions) {
                        this.actions = actions || this.actions;

                        if (this.initialValidationPass) {
                            if (this.actions) {
                                additionalValidators.validate(false) ? this.actions.enable() : this.actions.disable();
                            }
                        } else {
                            this.initialValidationPass = true;
                        }
                    }
                });
            }

            return origComponent;
        };
    });
