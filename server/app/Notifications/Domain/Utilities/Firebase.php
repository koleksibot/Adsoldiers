<?php
/**
 * Created by PhpStorm.
 * User: Hassan Saeed
 * Date: 2/22/2018
 * Time: 4:18 PM
 */

namespace App\Notifications\Domain\Utilities;

class Firebase
{
    // sending push message to single user by firebase reg id
    public function send($to, $message, $pushData)
    {
        $fields = [
            'to' => $to,
            'data' => $message,
            'notification' => $pushData
        ];
        return $this->sendPushNotification($fields);
    }

    // Sending message to a topic by topic name
    public function sendToTopic($to, $data, $pushData)
    {
        $fields = [
            'to' => '/topics/' . $to,
            'data' => $data,
            'notification' => $pushData
        ];
        //return $fields;
        return $this->sendPushNotification($fields);
    }

    // sending push message to multiple users by firebase registration ids
    public function sendMultipleAndroid($registration_ids, $message)
    {
        $fields = [
            'registration_ids' => $registration_ids,
            'data' => $message, // android
            //'notification' => $pushData // ios
        ];

        return $this->sendPushNotification($fields);
    }

    public function sendMultipleIos($registration_ids, $pushData)
    {
        $fields = [
            'registration_ids' => $registration_ids,
            // 'data' => $pushData, // android
            'notification' => $pushData // ios
        ];

        return $this->sendPushNotification($fields);
    }

    // function makes curl request to firebase servers
    private function sendPushNotification($fields)
    {
//        include './config.php';

        // Set POST variables
        $url = 'https://fcm.googleapis.com/fcm/send';

        $headers = [
            'Authorization: key=AAAAJMSKdqk:APA91bEIJ824Y5vxPOrtmRI4iylGTWcnpYbhivvxGIDiAuGo8yjlfK-A6dE6wD_hm6CEk6fllf1KARmW7Eyu8X1NO_elLu4XwW8emBr_KFAKZdKihP5wiqAwP3cPQgd8grW16k8Bpgq3',
            'Content-Type: application/json',
            'Sender: id=157916231337'
        ];
        // Open connection
        $ch = curl_init();

        // Set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);

        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

        // Execute post
        $result = curl_exec($ch);
        if ($result === false) {
            die('Curl failed: ' . curl_error($ch));
        }

        // Close connection
        curl_close($ch);

        return $result;
    }
}
