<?php

namespace App\Notifications\Domain\Utilities;

class FirebaseNotification
{
    protected $push;
    protected $firebase;

    public function __construct(Firebase $firebase, Push $push)
    {
        $this->firebase = $firebase;
        $this->push = $push;
    }

    /**
     * @param $message -> message will be sent in notification body.
     * @param $users -> users will receive notification
     * @param $current -> current user for prevent notification created for this user.
     * @param array $additional -> additional data will be send with notification
     * @param bool  $single     -> check for sending group or send single.
     *
     */
    public function sendPushNotification($regIdsAndroid = null, $regIdsIos = null, $title = null, $body = null, $data = [])
    {
        //Type error: Too few arguments to function App\Libraries\PushNotification::__construct(), 0 passed in E:\Saned Projects\_Shaqrady\routes\api.php on line 22 and exactly 2 expected

        // optional payload
        $dataLoad = [];

        $dataLoad['href'] = isset($data['href']) ? $data['href'] : '';

        $dataLoad['order'] = isset($data['order']) ? $data['order'] : null;

        $dataLoad['type'] = isset($data['type']) ? $data['type'] : null;

        $dataLoad['convId'] = isset($data['convId']) ? $data['convId'] : null;

        $dataLoad['messageId'] = isset($data['messageId']) ? $data['messageId'] : null;

        $dataLoad['userId'] = isset($data['user_id']) ? $data['user_id'] : null;

        $dataLoad['image'] = isset($data['image']) ? $data['image'] : null;

        // notification title
        $this->push->setTitle($title);

        // notification message
        //$message = ($message != null) ? $message->message : $data['textMessage'];
        $message = $body;

        $push_type = isset($push_type) ? $push_type : 'multi';
//        $push_type = isset($_GET['push_type']) ? $_GET['push_type'] : 'topic';

        // whether to include to image or not
        //$include_image = isset($_GET['include_image']) ? TRUE : FALSE;
        $include_image = isset($data['image']) ? true : false;

        $this->push->setMessage($body);

        if ($include_image) {
            $this->push->setImage($data['image']);
        } else {
            $this->push->setImage('');
        }

        //$push->setImage('https://api.androidhive.info/images/minion.jpg');
        $this->push->setIsBackground(true);
        $this->push->setData($dataLoad);

        $responseIos = '';
        $responseAndroid = '';

        // if ($push_type == 'global') {
        //     $json = $this->push->getPushData();
        //     $response = $this->firebase->sendToTopic('global', $json, $push);
        // } else if ($push_type == 'individual') {
        //     $json = $this->push->getPushData();
        //     $response = $this->firebase->send($json, $push);

        // } elseif ($push_type == 'users') {
        //     $json = $this->push->getPushData();
        //     $push = $this->push->getPushNotification();
        //     $response = $this->firebase->sendToTopic('users', $json, $push);

        // } elseif ($push_type == 'companies') {
        //     $json = $this->push->getPushData();
        //     $response = $this->firebase->sendToTopic('companies', $json, $push);
        // } elseif ($push_type == 'multi') {
        //     $json = $this->push->getPushData();
        //     $push = $this->push->getPushNotification();
        //     $response = $this->firebase->sendMultipleAndroid($regIdsAndroid, $json, $push);

        // } elseif ($push_type == 'topic') {
        //     $json = $this->push->getPushData();
        //     $push = $this->push->getPushNotification();
        //     $response = $this->firebase->sendToTopic('topic' . $data['companyId'], $json, $push);
        // }

        $responseIos = '';
        $responseAndroid = '';
        if ($regIdsAndroid != '' && count($regIdsAndroid) > 0) {
            $json = $this->push->getPushData();
            // $push = $this->push->getPushNotification();
            $responseAndroid = $this->firebase->sendMultipleAndroid($regIdsAndroid, $json);
        }

        if ($regIdsIos != '' && count($regIdsIos) > 0) {
            // $json = $this->push->getPushData();
            $push = $this->push->getPushNotification();
            $responseIos = $this->firebase->sendMultipleIos($regIdsIos, $push);
        }

        return [$responseAndroid, $responseIos];
    }
}
