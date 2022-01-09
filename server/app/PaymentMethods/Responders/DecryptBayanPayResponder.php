<?php

namespace App\PaymentMethods\Responders;

use App\App\Responders\Responder;
use Illuminate\Support\Facades\View;
use App\App\Responders\ResponderInterface;
use App\Ads\Domain\Resources\DecryptBayanPayResource;

class DecryptBayanPayResponder extends Responder implements ResponderInterface
{
    public function respond()
    {
        $this->response['BAYANPAY_POST_RESPONSE_REDIRECTION_URL'] = 'http://www.vi.hit/advertiser/dashboard/payment';

        if ($this->response['status'] == 200) {
            $this->response['BAYANPAY_POST_RESPONSE_REDIRECTION_URL'] = 'http://www.vi.hit/advertiser/dashboard/ads';
            $this->response['data'] = new DecryptBayanPayResource($this->response['data']);
        }

        return view('bayanpayResponse')->with($this->response);
    }
}
