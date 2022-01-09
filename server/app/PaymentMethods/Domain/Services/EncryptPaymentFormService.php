<?php

namespace App\PaymentMethods\Domain\Services;

use stdClass;
use App\App\Domain\Services\Service;
use App\App\Domain\Payloads\GenericPayload;
use App\PaymentMethods\Domain\Repositories\PaymentMethodRepository;

class EncryptPaymentFormService extends Service
{
    protected $paymentmethods;
    protected $mkey;
    protected $mid;
    protected $colab;
    protected $gurl;

    public function __construct(PaymentMethodRepository $paymentmethods)
    {
        $this->paymentmethods = $paymentmethods;
        $this->mkey = env('BAYANPAY_Encryption_Key', 'ZSvUTz4dyqX9QII4105AhtmmaorA/pDOETbUmcN7XbA=');
        $this->mid = env('BAYANPAY_MERCHANT_ID');
        $this->colab = env('COLLABORATOR_ID_STAGING');
        $this->gurl = env('BAYANPAY_TEST_URL');
    }

    public function handle($data = [])
    {
        if ($data['addr2'] == '') {
            $data['addr2'] = substr($data['addr1'], (strlen($data['addr1']) / 2) - 1, strlen($data['addr1']) / 2);
        }

        $formFinalText = '11100||11111011|' . $data['txnid'] . '|' . $data['amount'] . '|' . $data['surl'] . '|' . $data['surl'] . '|INTERNET|01|' . $data['currency'] . '||1111111111|' . $data['fname'] .
        '|' . $data['lname'] . '|' . $data['addr1'] . '|' . $data['addr2'] . '|' . $data['city'] . '|' . $data['state'] . '|' . $data['postcode'] . '|' . $data['country'] . '|' . $data['email'] . '|' . $data['mobile'] .
        '||111111110001|' . $data['fname'] . '|' . $data['lname'] . '|' . $data['addr1'] . '|' . $data['addr2'] . '|' . $data['city'] . '|' . $data['state'] . '|' . $data['postcode'] . '|' . $data['country'] .
        '|' . $data['mobile'];

        $iv = '0123456789abcdef';

        $size = openssl_cipher_iv_length('AES-256-CBC');
        $pad = $size - (strlen($formFinalText) % $size);
        $padtext = $formFinalText . str_repeat(chr($pad), $pad);
        $crypt = base64_encode(openssl_encrypt($padtext, 'AES-256-CBC', base64_decode($this->mkey), OPENSSL_RAW_DATA | OPENSSL_ZERO_PADDING, $iv));

        $obj = new stdClass;
        $obj->action = $this->gurl;
        $obj->request_parameter = $crypt;
        $obj->collaborator_id = $this->colab;
        $obj->merchant_id = $this->mid;

        return new GenericPayload($obj);
    }
}
