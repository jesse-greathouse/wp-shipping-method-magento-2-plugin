

define([
    'ko',
    'jquery',
    'Magento_Checkout/js/model/quote',
    'Magento_Checkout/js/model/resource-url-manager',
    'mage/storage',
    'Magento_Checkout/js/model/payment-service',
    'Magento_Checkout/js/model/payment/method-converter',
    'Magento_Checkout/js/model/error-processor',
    'Wheelpros_Checkout/js/action/select-billing-address',
    'Magento_Checkout/js/model/shipping-save-processor/payload-extender',
    'Wheelpros_Checkout/js/model/default-shipping-method'
], function (
    ko,
    $,
    quote,
    resourceUrlManager,
    storage,
    paymentService,
    methodConverter,
    errorProcessor,
    selectBillingAddressAction,
    payloadExtender,
    defaultShippingMethod
) {
    'use strict';

    return {
        /**
         * @return {jQuery.Deferred}
         */
        saveShippingInformation: function () {
            var payload,
                methodCode,
                carrierCode;

            if (!quote.billingAddress() && quote.shippingAddress().canUseForBilling()) {
                selectBillingAddressAction(quote.shippingAddress());
            }

            payload = {
                addressInformation: {
                    'shipping_address': quote.shippingAddress(),
                    'billing_address': quote.billingAddress()
                }
            };

            methodCode = quote.shippingMethod() ? quote.shippingMethod()['method_code'] : defaultShippingMethod.getMethodCode();
            carrierCode = quote.shippingMethod() ? quote.shippingMethod()['carrier_code'] : defaultShippingMethod.getCarrierCode();
            if (methodCode && carrierCode) {
                payload.addressInformation.shipping_method_code = methodCode;
                payload.addressInformation.shipping_carrier_code = carrierCode;
            } else {
                return $.Deferred();
            }

            payloadExtender(payload);

            return storage.post(
                resourceUrlManager.getUrlForSetShippingInformation(quote),
                JSON.stringify(payload)
            ).done(
                function (response) {
                    quote.setTotals(response.totals);
                    paymentService.setPaymentMethods(methodConverter(response['payment_methods']));
                }
            ).fail(
                function (response) {
                    errorProcessor.process(response);
                }
            );
        }
    };
});
