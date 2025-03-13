<?php
/*
|--------------------------------------------------------------------------
| ABA PayWay API URL
|--------------------------------------------------------------------------
| API URL that is provided by PayWay must be required in your post form
|
*/
define('ABA_PAYWAY_API_URL', 'https://checkout-sandbox.payway.com.kh/api/payment-gateway/v1/payments/purchase');

/*
|--------------------------------------------------------------------------
| ABA PayWay API KEY
|--------------------------------------------------------------------------
| API KEY that is generated and provided by PayWay must be required in your post form
|
*/
define('ABA_PAYWAY_API_KEY', 'c3c9dda7b9503335447e818a22095e587a75ee2a');

/*
|--------------------------------------------------------------------------
| ABA PayWay Merchant ID
|--------------------------------------------------------------------------
| Merchant ID that is generated and provided by PayWay must be required in your post form
|
*/
define('ABA_PAYWAY_MERCHANT_ID', 'ec449305');


class PayWayApiCheckout {

    /**
     * Returns the getHash
     * For PayWay security, you must follow the way of encryption for hash.
     *
     * @param string $transactionId
     * @param string $amount
     *
     * @return string getHash
     */
    public static function getHash($str) {

      //  echo 'before hash: '.$str.'<br><br>';

        $hash = base64_encode(hash_hmac('sha512', $str, ABA_PAYWAY_API_KEY, true));
        return $hash;
    }

    /**
     * Returns the getApiUrl
     *
     * @return string getApiUrl
     */
    public static function getApiUrl() {
        return ABA_PAYWAY_API_URL;
    }
}
