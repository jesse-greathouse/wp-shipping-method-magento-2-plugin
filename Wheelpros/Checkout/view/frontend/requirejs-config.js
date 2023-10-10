var config = {
    config: {
        mixins: {
            'Magento_Payment/js/view/payment/method-renderer/free-method': {
                'MageWorx_Checkout/js/view/payment/method-renderer/free-method-mixin': true
            },
            'Magento_OfflinePayments/js/view/payment/method-renderer/purchaseorder-method': {
                'MageWorx_Checkout/js/view/payment/method-renderer/purchaseorder-method-mixin': true
            },
            'Magento_OfflinePayments/js/view/payment/method-renderer/checkmo-method': {
                'MageWorx_Checkout/js/view/payment/method-renderer/checkmo-method-mixin': true
            },
            'Magento_OfflinePayments/js/view/payment/method-renderer/cashondelivery-method': {
                'MageWorx_Checkout/js/view/payment/method-renderer/cashondelivery-method-mixin': true
            },
            'Magento_OfflinePayments/js/view/payment/method-renderer/banktransfer-method': {
                'MageWorx_Checkout/js/view/payment/method-renderer/banktransfer-method-mixin': true
            },
            'Magento_Vault/js/view/payment/method-renderer/vault': {
                'MageWorx_Checkout/js/view/payment/method-renderer/vault-method-mixin': true
            },
            'Magento_Braintree/js/view/payment/method-renderer/vault': {
                'MageWorx_Checkout/js/view/payment/method-renderer/vault-method-mixin': true
            },
            'Magento_Braintree/js/view/payment/method-renderer/paypal-vault': {
                'MageWorx_Checkout/js/view/payment/method-renderer/paypal-vault-method-mixin': true
            },
            'Magento_AuthorizenetAcceptjs/js/view/payment/method-renderer/authorizenet-accept': {
                'MageWorx_Checkout/js/view/payment/method-renderer/authorizenet-accept-method-mixin': true
            },
            'Magento_Braintree/js/view/payment/method-renderer/cc-form': {
                'MageWorx_Checkout/js/view/payment/method-renderer/braintree-cc-form-method-mixin': true
            },
            'Magento_Braintree/js/view/payment/method-renderer/paypal': {
                'MageWorx_Checkout/js/view/payment/method-renderer/braintree-paypal-method-mixin': true
            },
            'PayPal_Braintree/js/view/payment/method-renderer/paypal': {
                'MageWorx_Checkout/js/view/payment/method-renderer/new-braintree-paypal-method-mixin': true
            },
            'PayPal_Braintree/js/view/payment/method-renderer/hosted-fields': {
                'MageWorx_Checkout/js/view/payment/method-renderer/new-braintree-cc-method-mixin': true
            },
            'PayPal_Braintree/js/view/payment/method-renderer/vault': {
                'MageWorx_Checkout/js/view/payment/method-renderer/new-braintree-cc-vault-method-mixin': true
            },
            'Swarming_SubscribePro/js/view/payment/method-renderer/cc-form': {
                'MageWorx_Checkout/js/view/payment/method-renderer/subscribepro-cc-form-method-mixin': true
            },
            'Amazon_Payment/js/view/payment/method-renderer/amazonlogin': {
                'MageWorx_Checkout/js/view/payment/method-renderer/amazonlogin-method-mixin': true
            },
            'Magento_Paypal/js/view/payment/method-renderer/in-context/checkout-express': {
                'MageWorx_Checkout/js/view/payment/method-renderer/paypal-express-in-context-method-mixin': true
            },

            'Magento_Paypal/js/view/payment/method-renderer/paypal-express': {
                'MageWorx_Checkout/js/view/payment/method-renderer/paypal-express-mixin': true
            },
            'Klarna_Kp/js/view/payments/kp': {
                'MageWorx_Checkout/js/view/payment/method-renderer/klarna-method-mixin': true
            },
            'StripeIntegration_Payments/js/view/payment/method-renderer/stripe_payments': {
                'MageWorx_Checkout/js/view/payment/method-renderer/stripe-payment-method-mixin': true
            },
            'CheckoutCom_Magento2/js/view/payment/method-renderer/checkoutcom_apm': {
                'MageWorx_Checkout/js/view/payment/method-renderer/checkoutcom/checkoutcom_apm-method-mixin': true
            },
            'CheckoutCom_Magento2/js/view/payment/method-renderer/checkoutcom_card_payment': {
                'MageWorx_Checkout/js/view/payment/method-renderer/checkoutcom/checkoutcom_card_payment-method-mixin': true
            },
            'CheckoutCom_Magento2/js/view/payment/method-renderer/checkoutcom_vault': {
                'MageWorx_Checkout/js/view/payment/method-renderer/checkoutcom/checkoutcom_vault-method-mixin': true
            },
            'CheckoutCom_Magento2/js/view/payment/method-renderer/checkoutcom_apple_pay': {
                'MageWorx_Checkout/js/view/payment/method-renderer/checkoutcom/checkoutcom_apple_pay-method-mixin': true
            },
            'CheckoutCom_Magento2/js/view/payment/method-renderer/checkoutcom_google_pay': {
                'MageWorx_Checkout/js/view/payment/method-renderer/checkoutcom/checkoutcom_google_pay-method-mixin': true
            },
            // Fix region custom entry additionalClasses property
            'Magento_Ui/js/form/element/region': {
                'MageWorx_Checkout/js/view/form/element/region-mixin': true
            },
            // Fix agreements assigner (fix agreements validation)
            'Magento_CheckoutAgreements/js/model/agreements-assigner': {
                'MageWorx_Checkout/js/model/agreements-assigner-mixin': true
            },
            // Fix customer email validation
            'Magento_Checkout/js/model/customer-email-validator': {
                'MageWorx_Checkout/js/model/customer-email-validation-mixin': true
            },
            // Fix agreements validation
            'Magento_CheckoutAgreements/js/model/agreement-validator': {
                'MageWorx_Checkout/js/model/agreement-validator-mixin': true
            },
            // Fix empty shipping address when it is not set in the customers account
            'Magento_Checkout/js/model/checkout-data-resolver': {
                'MageWorx_Checkout/js/model/checkout-data-resolver-mixin': true
            },
            'Magento_Checkout/js/action/select-payment-method': {
                'MageWorx_Checkout/js/action/select-payment-method-mixin': true
            },
            'Magento_Checkout/js/model/new-customer-address': {
                'MageWorx_Checkout/js/model/new-customer-address-mixin': true
            },
            'Magento_Ui/js/block-loader': {
                'MageWorx_Checkout/js/view/loaders/block-loader-mixin': true
            },
            'Magento_Checkout/js/model/shipping-rates-validation-rules': {
                'MageWorx_Checkout/js/model/shipping-rates-validation-rules-mixin': true
            }
        }
    },
    paths: {
        'popper': 'MageWorx_Checkout/js/bootstrap/popper.min',
        'mage/loader': 'MageWorx_Checkout/js/view/loaders/loader'
    },
    shim: {
        'popper': {
            'deps': ['jquery'],
            'exports': 'Popper'
        }
    },
    map: {
        '*': {
            'Magento_Checkout/js/action/select-billing-address':'MageWorx_Checkout/js/action/select-billing-address'
        }
    }
}
