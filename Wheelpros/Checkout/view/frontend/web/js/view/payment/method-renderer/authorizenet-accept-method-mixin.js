/**
 * Copyright © MageWorx. All rights reserved.
 * See LICENSE.txt for license details.
 */
define(['uiRegistry'], function (registry) {
    'use strict';

    return function (origComponent) {

        if (window.isMageWorxCheckout) {
            return origComponent.extend({
                defaults: {
                    template: 'MageWorx_Checkout/payment-method/renderer/authorizenet-accept',
                    ccForm: 'MageWorx_Checkout/payment-method/renderer/cc-form'
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