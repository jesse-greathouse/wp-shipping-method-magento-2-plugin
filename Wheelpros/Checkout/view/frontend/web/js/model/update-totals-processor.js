
define([
    'jquery',
    'Wheelpros_Checkout/js/action/update-totals'
], function ($, updateTotalsAction) {
    'use strict';

    return {
        deferredUpdateResult: $.Deferred(),

        before: function (shippingAddress) {
            // @TODO: Check design
        },

        after: function (shippingAddress, result) {
            updateTotalsAction(this.deferredUpdateResult);
            this.deferredUpdateResult.done(function () {
                // Totals updated
            });
        }
    };
});
