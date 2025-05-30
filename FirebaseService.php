<?php

namespace App\Services;

use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;
use Illuminate\Support\Facades\Log;

class FirebaseService
{
    protected $messaging;

    public function __construct()
    {
        $factory = (new Factory)->withServiceAccount(storage_path('app/firebase/firebase_file.json'));
        $this->messaging = $factory->createMessaging();
    }

    // public function sendNotification(array $deviceTokens, string $title, string $body,)
    // {
    //     $notification = Notification::create($title, $body);

    //     $message = CloudMessage::new()
    //         ->withNotification($notification);

    //     foreach ($deviceTokens as $token) {
    //         try {
    //             $this->messaging->send($message->withChangedTarget('token', $token));
    //             \Log::info("Notification sent to token: $token");
    //         } catch (\Exception $e) {
    //             // Log error or handle failed token
    //             \Log::error("FCM error for token $token: " . $e->getMessage());
    //         }
    //     }
    // }

    public function sendNotification(array $deviceTokens, string $message, ?string $type = null, $id = null, $activity = null)
    {
        // Prepare custom data payload — this will be read by the mobile app
        $data = [
            'title' => 'Webotix Crm',
            'message' => $message,
            'id' => $id,
            'type' => $type,
            'activity' => $activity,
        ];

        // Create a CloudMessage with ONLY data (no Notification block)
        $messageInstance = CloudMessage::new()->withData($data);

        foreach ($deviceTokens as $token) {
            try {
                $this->messaging->send($messageInstance->withChangedTarget('token', $token));
                Log::info("Notification sent to token: $token");
            } catch (\Exception $e) {
                Log::error("FCM error for token $token: " . $e->getMessage());
            }
        }
    }
}
