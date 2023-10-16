/**
 * Copyright © Wheelpros All rights reserved.
 * See COPYING.txt for license details.
 */

/**
 * @api
 */
define([
    'Magento_Checkout/js/model/shipping-save-processor'
], function (shippingSaveProcessor) {
    'use strict';

    return function () {
        return shippingSaveProcessor.saveShippingInformation('wheelpros_checkout');
    };
});
