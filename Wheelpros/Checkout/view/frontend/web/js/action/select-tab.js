
define([
    'jquery',
    'underscore'
], function (
    $,
    _
) {
    'use strict';

    return function (tab, previousTab) {
        if (previousTab) {
            previousTab.process(false);
        }
        tab.process(true);
    };
});
