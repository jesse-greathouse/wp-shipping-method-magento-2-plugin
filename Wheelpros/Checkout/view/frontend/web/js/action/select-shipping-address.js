
define([
    'Magento_Checkout/js/action/select-shipping-address',
    'Wheelpros_Checkout/js/model/update-totals-processor'
], function (originalSelectShippingAddressAction, updateTotalsProcessor) {
    'use strict';

    return function (shippingAddress) {
        var result;

        updateTotalsProcessor.before(shippingAddress);
        result = originalSelectShippingAddressAction(shippingAddress);
        updateTotalsProcessor.after(shippingAddress, result);

        return result;
    };
});
