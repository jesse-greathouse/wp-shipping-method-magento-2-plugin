
define(['underscore'], function (_) {
    'use strict';

    return function (origComponent) {

        if (window.isWheelprosCheckout) {
            if (typeof origComponent.street === 'undefined') {
                origComponent.street = [];
            }

            return origComponent;
        }

        return origComponent;
    };
});
