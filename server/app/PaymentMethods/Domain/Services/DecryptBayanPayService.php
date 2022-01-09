<?php

namespace App\PaymentMethods\Domain\Services;

use stdClass;
use App\Ads\Domain\Models\Ad;
use App\App\Domain\Services\Service;
use App\App\Domain\Payloads\GenericPayload;
use App\App\Domain\Payloads\ValidationPayload;
use App\PaymentMethods\Domain\Repositories\PaymentMethodRepository;

class DecryptBayanPayService extends Service
{
    protected $paymentmethods;
    protected $errMsg;
    protected $responseArray;
    protected $finalResponse;

    public function __construct(PaymentMethodRepository $paymentmethods)
    {
        $this->paymentmethods = $paymentmethods;
        $this->finalResponse = new stdClass();
    }

    public function handle($data = [])
    {
        // check if response has key error
        if (isset($data->txnErrMsg)) {
            $this->errMsg = 'Error::' . $data->txnErrMsg;
        }

        // convert response into array
        $this->responseArray = explode('||', $data->responseParameter);

        // if array length < 2 then it's response error
        if (count($this->responseArray) < 2) {
            $this->errMsg = 'Error in response';
        }

        // if there are no errors
        if (!empty($this->errMsg)) {
            return new ValidationPayload($this->errMsg);
        }

        // decode encrypted text
        $enctext = base64_decode($this->responseArray[1]);
        $padtext = openssl_decrypt($enctext, 'AES-256-CBC', base64_decode('ZSvUTz4dyqX9QII4105AhtmmaorA/pDOETbUmcN7XbA='), OPENSSL_RAW_DATA | OPENSSL_ZERO_PADDING, '0123456789abcdef');
        $pad = ord($padtext{strlen($padtext) - 1});

        if ($pad > strlen($padtext)) {
            return new ValidationPayload('error in response');
        }

        if (strspn($padtext, $padtext{strlen($padtext) - 1}, strlen($padtext) - $pad) != $pad) {
            return new ValidationPayload('error in response');
        }

        $response = substr($padtext, 0, -1 * $pad);
        $r_main = explode('||', $response);

        // set the finale response properties
        $this->finalResponse->orderid = '';
        $this->finalResponse->amount = '';
        $this->finalResponse->status = '';
        $this->finalResponse->status_msg = '';

        if (substr($r_main[0], 0, 1) == '1') {
            $r_trans = explode('|', $r_main[1]);
            if (substr($r_trans[0], 2, 1) == '1') {
                $this->finalResponse->amount = $r_trans[3];
                $this->finalResponse->orderid = $r_trans[1];
            }
        }

        if (substr($r_main[0], 2, 1) == '1') {
            $r_trans = explode('|', $r_main[3]);
            if (substr($r_trans[0], 0, 1) == '1') {
                $this->finalResponse->status = $r_trans[1];
                $this->finalResponse->status_msg = $r_trans[3];
                if (!$this->finalResponse->status_msg) {
                    $this->finalResponse->status_msg = 'Payment Cancelled or Declined...';
                }
            }
        }

        // make the ad status pending
        Ad::find(substr($this->finalResponse->orderid, 6))
            ->update(['status' => 1]);

        return new GenericPayload($this->finalResponse);
    }
}
