<?php


namespace Wheelpros\Checkout\Api;

/**
 * Interface CheckoutConfigInterface.
 *
 * Describes all available checkout settings, usually managed from the admin side.
 *
 * @test
 */
interface CheckoutConfigInterface
{
    const XML_PATH_ENABLED                    = 'wheelpros_checkout/main/enabled';
    const XML_PATH_CHECKOUT_PAGE_TITLE        = 'wheelpros_checkout/main/checkout_page_title';
    const XML_PATH_EMAIL_SUBSCRIPTION_ENABLED = 'wheelpros_checkout/main/email_subscription_enabled';
    const XML_PATH_EMAIL_SUBSCRIPTION_TITLE   = 'wheelpros_checkout/main/email_subscription_title';
    const XML_PATH_MERGE_JS_CSS               = 'wheelpros_checkout/main/merge_js_css';

    const XML_PATH_CREATE_ACCOUNT_ENABLED = 'wheelpros_checkout/main/create_account_enabled';
    const XML_PATH_CREATE_ACCOUNT_FORCED  = 'wheelpros_checkout/main/create_account_forced';
    const XML_PATH_CREATE_ACCOUNT_TITLE   = 'wheelpros_checkout/main/create_account_title';
    const XML_PATH_CREATE_ACCOUNT_CHECKED = 'wheelpros_checkout/main/create_account_checked';

    const XML_PATH_COUPON_CODE_VISIBLE = 'wheelpros_checkout/coupon_code/visible';
    const XML_PATH_COUPON_CODE_TOOLTIP = 'wheelpros_checkout/coupon_code/tooltip';

    const XML_PATH_DEFAULT_SHIPPING_METHOD = 'wheelpros_checkout/experience/default_shipping_method';
    const XML_PATH_DEFAULT_PAYMENT_METHOD  = 'wheelpros_checkout/experience/default_payment_method';

    const XML_PATH_ORDER_COMMENTS_ENABLED = 'wheelpros_checkout/main/order_comment_enabled';
    const XML_PATH_ORDER_COMMENTS_LABEL   = 'wheelpros_checkout/main/order_comment_title';

    const XML_PATH_DISPLAY_PAYMENT_METHOD_IMAGES = 'wheelpros_checkout/payment_methods/add_icons';
    const XML_PATH_PAYMENT_METHOD_IMAGES         = 'wheelpros_checkout/payment_methods/configuration';

    const XML_PATH_LABELS = 'wheelpros_checkout/labels';

    const XML_PATH_CHECKOUT_AGREEMENTS_MESSAGE = 'wheelpros_checkout/checkout_agreements/message';

    /**
     * Is module enabled
     *
     * @param int|null $storeId
     * @return bool
     */
    public function isEnabled(int $storeId = null): bool;

    /**
     * Get checkout page main title
     *
     * @param int|null $storeId
     * @return string
     */
    public function getCheckoutPageTitle(int $storeId = null): ?string;

    /**
     * Is coupon code block (input) visible
     *
     * @param int|null $storeId
     * @return bool
     */
    public function isCouponCodeBlockVisible(int $storeId = null): bool;

    /**
     * Tooltip message for coupon code input
     *
     * @param int|null $storeId
     * @return string
     */
    public function getCouponCodeTooltip(int $storeId = null): ?string;

    /**
     * Get selected by default shipping method code (like `carriercode_methodcode`)
     *
     * @param int|null $storeId
     * @return string|null
     */
    public function getDefaultShippingMethod(int $storeId = null): ?string;

    /**
     * Get selected by default payment method code (like `checkmo`)
     *
     * @param int|null $storeId
     * @return string|null
     */
    public function getDefaultPaymentMethod(int $storeId = null): ?string;

    /**
     * Get store labels configuration
     *
     * @param int|null $storeId
     * @return array|null
     */
    public function getLabels(int $storeId = null): ?array;

    /**
     * Order comments visibility
     *
     * @param int|null $storeId
     * @return bool
     */
    public function isOrderCommentsEnabled(int $storeId = null): bool;

    /**
     * @param int|null $storeId
     * @return string
     */
    public function getOrderCommentsLabel(int $storeId = null): ?string;

    /**
     * Is need to display images of payment methods
     *
     * @param int|null $storeId
     * @return bool
     */
    public function isDisplayPaymentMethodImage(int $storeId = null): bool;

    /**
     * Return images by payment method configuration
     *
     * @param int|null $storeId
     * @return array
     */
    public function getPaymentMethodsImages(int $storeId = null): array;

    /**
     * Email subscription visibility
     *
     * @param int|null $storeId
     * @return bool
     */
    public function isEmailSubscriptionEnabled(int $storeId = null): bool;

    /**
     * @param int|null $storeId
     * @return string
     */
    public function getEmailSubscriptionTitle(int $storeId = null): ?string;

    /**
     * Create account visibility
     *
     * @param int|null $storeId
     * @return bool
     */
    public function isCreateAccountEnabled(int $storeId = null): bool;

    /**
     * Is forced registration enabled;
     * Will be useful in case with guest checkout and virtual quote combination;
     *
     * @param int|null $storeId
     * @return bool
     */
    public function isForcedCreateAccountEnabled(int $storeId = null): bool;

    /**
     * @param int|null $storeId
     * @return string
     */
    public function getCreateAccountTitle(int $storeId = null): ?string;

    /**
     * Create account checked by default
     *
     * @param int|null $storeId
     * @return bool
     */
    public function isCreateAccountCheckedByDefault(int $storeId = null): bool;

    /**
     * Checkout agreements message, visible below the place order button
     *
     * @param int|null $storeId
     * @return string|null
     */
    public function getCheckoutAgreementsMessage(int $storeId = null): ?string;

    /**
     * Is need to merge JS and CSS files on the checkout page
     *
     * @param int|null $storeId
     * @return bool
     */
    public function isMergeJsCssEnabled(int $storeId = null): bool;

    /**
     * Minimum length for the create new account password field
     *
     * @return int
     */
    public function getMinPasswordLength(): int;

    /**
     * Get number of password required character classes
     *
     * @return int
     */
    public function getRequiredCharacterClassesNumber(): int;
}
