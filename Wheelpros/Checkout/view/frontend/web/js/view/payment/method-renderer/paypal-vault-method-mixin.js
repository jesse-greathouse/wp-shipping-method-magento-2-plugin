
define(['uiRegistry'], function (registry) {
    'use strict';

    return function (origComponent) {

        if (window.isWheelprosCheckout) {
            return origComponent.extend({
                defaults: {
                    template: 'Wheelpros_Checkout/payment-method/renderer/paypal-vault'
                },

                selectPaymentMethod: function () {
                    registry.get('checkout.sidebar.place-order').setSelectedPaymentMethod(this);

                    return this._super();
                }
            });
        }

        return origComponent;
    };
});
