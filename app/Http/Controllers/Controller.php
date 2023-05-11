<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use GuzzleHttp\Client;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public static function notificationEvent($fcm_key, $body, $title, $id, $redirect_page){

        $httpClient = new Client([
            'base_uri' => 'https://fcm.googleapis.com',
            'timeout'  => 2.0,
        ]);

        $authorizationKey = 'key=AAAAERy_70c:APA91bHdjLCn1-TZqZK41KrpJFjndT3bdDdiRA_orOqSdib-o5QXaBvWUqlyTs-YxOhxQN1D5t8jAn_CJ1ZcR0QLMMMT7heHIdeSfPIAUwLzmzXeGU5GHZ1vvpkmFTgnZ7zxPBLSErU2';
        $to = $fcm_key;

        $data = [
            'to' => $to,
            'notification' => [
                'title' => $title,
                'body' => $body,
                'sound' => 'default',
            ],
            'data' => [
                'id' => $id,
                'redirect_page' => $redirect_page,
            ],
            'priority' => 'high',
          ];

        try {
            $response = $httpClient->post('/fcm/send', [
                'headers' => [
                    'Authorization' => $authorizationKey,
                    'Content-Type' => 'application/json',
                ],
                'json' => $data,
            ]);
        return true;
        // echo "Notification sent successfully. Status code: " . $response->getStatusCode();
    } catch (\Exception $e) {
        // echo "Error sending notification: " . $e->getMessage();
        return true;

    }


}
}
