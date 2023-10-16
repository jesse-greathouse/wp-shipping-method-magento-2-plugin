/**
 * Copyright © Wheelpros All rights reserved.
 * See COPYING.txt for license details.
 */

define([
    'uiComponent',
    'Magento_Checkout/js/action/place-order',
    'Magento_Checkout/js/model/quote',
    'Magento_Checkout/js/action/redirect-on-success',
    'Magento_Checkout/js/model/payment/additional-validators',
    'Wheelpros_Checkout/js/model/shipping-save-processor/general',
    'uiRegistry',
    'Magento_Checkout/js/model/address-converter',
    'Wheelpros_Checkout/js/action/select-shipping-address',
    'Wheelpros_Checkout/js/action/select-billing-address',
    'Magento_Customer/js/model/customer',
    'Wheelpros_Checkout/js/view/billing-address',
    'jquery',
    'mage/translate'
], function (
    Component,
    placeOrderAction,
    quote,
    redirectOnSuccessAction,
    additionalValidators,
    shippingSaveProcessorGeneral,
    uiRegistry,
    addressConverter,
    selectShippingAddress,
    selectBillingAddressAction,
    customer,
    billingAddressView,
    jQuery,
    $t
) {
    'use strict';

    return Component.extend({
        defaults: {
            template: 'Wheelpros_Checkout/summary/place-order',
            selectedPaymentMethod: null,
            label: $t('Agree & Place Order'),
            visible: true
        },

        observableProperties: [
            'label',
            'visible'
        ],

        initObservable: function () {
            this._super();
            this.observe(this.observableProperties);

            if (window.checkoutConfig.labels.place_order_button) {
                this.label(window.checkoutConfig.labels.place_order_button);
            }

            return this;
        },

        setSelectedPaymentMethod: function (methodInstance) {
            this.selectedPaymentMethod = methodInstance;
            if (methodInstance
                && methodInstance.component === 'Magento_Paypal/js/view/payment/method-renderer/in-context/checkout-express'
            ) {
                this.visible(false);
            } else {
                this.visible(true);
            }
        },

        getSelectedPaymentMethod: function () {
            return this.selectedPaymentMethod;
        },

        /**
         * Place order action
         */
        placeOrder: function () {
            var self = this;
            window.checkoutConfig.isPlacingOrder = true;

            if (this.getSelectedPaymentMethod()) {
                function placeOrderThroughPaymentMethod() {
                    if (typeof self.getSelectedPaymentMethod().beforePlaceOrder == 'function') {
                        self.getSelectedPaymentMethod().beforePlaceOrder();
                    } else if (self.getSelectedPaymentMethod().component == 'Magento_Braintree/js/view/payment/method-renderer/cc-form') {
                        self.getSelectedPaymentMethod().placeOrderClick();
                    } else if (self.getSelectedPaymentMethod().component == 'PayPal_Braintree/js/view/payment/method-renderer/hosted-fields') {
                        self.getSelectedPaymentMethod().isProcessing = false;
                        self.getSelectedPaymentMethod().placeOrderClick();
                    } else if (self.getSelectedPaymentMethod().component == 'Magento_Paypal/js/view/payment/method-renderer/paypal-express') {
                        self.getSelectedPaymentMethod().continueToPayPal();
                    } else if (self.getSelectedPaymentMethod().component == 'Swarming_SubscribePro/js/view/payment/method-renderer/cc-form') {
                        self.getSelectedPaymentMethod().startPlaceOrder();
                    } else if (self.getSelectedPaymentMethod().component == 'Klarna_Kp/js/view/payments/kp') {
                        self.getSelectedPaymentMethod().authorize();
                    } else if (typeof self.getSelectedPaymentMethod().placeOrder == 'function') {
                        self.getSelectedPaymentMethod().placeOrder();
                    } else {
                        placeOrderAction(this.getCleanPaymentMethodData()).success(
                            function (response) {
                                redirectOnSuccessAction.execute();
                            }
                        )
                    }
                }

                if (additionalValidators.validate()) {
                    if (quote.isVirtual()) {
                        placeOrderThroughPaymentMethod();
                    } else {
                        if (!customer.isLoggedIn() && quote.shippingMethod() && quote.shippingMethod().method_code !== 'wheelprospickup') {
                            //save all shipping address fields from form before place order
                            var addressFlat = uiRegistry.get('checkoutProvider').shippingAddress;
                            var address = addressConverter.formAddressDataToQuoteAddress(addressFlat);
                            selectShippingAddress(address);
                            //save all billing address fields from form before place order
                            if (jQuery('#billing-address-different-share').is(":checked")) {
                                addressFlat = uiRegistry.get('checkoutProvider').billingAddress;
                                address = addressConverter.formAddressDataToQuoteAddress(addressFlat);
                                selectBillingAddressAction(address);
                            }
                        }

                        jQuery('body').trigger('processStart');
                        shippingSaveProcessorGeneral.saveShippingInformation().done(function (response) {
                            jQuery('body').trigger('processStop');
                            placeOrderThroughPaymentMethod();
                        }).fail(function (response) {
                            additionalValidators.validate();
                            jQuery('body').trigger('processStop');
                        });
                    }
                }
            } else {
                additionalValidators.validate();
            }

            window.checkoutConfig.isPlacingOrder = false;
        },

        /**
         * Get clean payment method data, without properties without accessors in Payment interface on backend
         * @returns {*}
         */
        getCleanPaymentMethodData: function () {
            var paymentMethodData = quote.getPaymentMethod()();
            delete paymentMethodData.__disableTmpl;
            delete paymentMethodData.title;

            return paymentMethodData;
        }
    });
});
