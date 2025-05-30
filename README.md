# FirebaseNotificationInLaravel
Push notification through firebase in laravel

# Enter below command to terminal for install the firebase dependencies

```bash
composer require kreait/firebase-php
```
## 🔧Step 1: Download the CA Certificate
 - Go to:
    ```bash
    👉 https://curl.se/ca/cacert.pem
    ```
 - Save the file to:
 - C:\wamp64\bin\php\cacert.pem

## 🛠️ Step 2: Update php.ini (CLI & Apache)
 - You need to update both php.ini files:

 - ✏️ A. Apache’s PHP php.ini
 - File path (depending on PHP version):

    ```bash
        C:\wamp64\bin\apache\apache2.x.x\bin\php.ini
    ```  

## 🧩 Step 3: Add these lines (or update if they already exist)
 - In both php.ini files, add:
```bash
curl.cainfo = "C:\wamp64\bin\php\cacert.pem"
openssl.cafile = "C:\wamp64\bin\php\cacert.pem"
```
 - Make sure these lines are NOT commented out (no ; in front).

## Step 4: Restart WAMP
 - Go to the WAMP tray icon.
 - Click “Restart All Services”.

## Step 5 : Steps to Create Firebase Project JSON File for Push Notifications
 - ✅ Step 1: Go to Firebase Console
    - Visit: https://console.firebase.google.com
    - Sign in with your Google account.

 - ✅ Step 2: Create a Firebase Project
    - Click "Add project".
    - Enter a project name, and click Continue.
    - Disable or enable Google Analytics as needed.
    - Click Create Project.

 - ✅ Step 3: Enable Firebase Cloud Messaging (FCM)
    - After creating the project, go to the Project Overview.
    - In the left menu, click Build > Cloud Messaging.
    - Make sure Cloud Messaging is enabled.

 - ✅ Step 4: Create a Service Account Key (JSON File)
    - In the left menu, go to Project Settings (click the gear icon).
    - Click the "Service Accounts" tab.
    - Click "Generate new private key".
    - Confirm the prompt — the .json file will be downloaded.
    - This file contains your Firebase credentials — store it securely and do not commit it to source control (like GitHub).
 - ✅ Step 5: Locate this json file in following path of your project
    - storage/app/firebase/firebase_file.json

## Step 6: Create Services Folder in following path of your laravel project.

    ```bash
        App/Services
    ```
 - Copy the FirebaseService.php file into this folder
 - your post notification function use into the controller like this 

 ```bash
    use App\Services\FirebaseService;
    use Illuminate\Http\Request;

    public function store(Request $request, FirebaseService $firebaseService)
    {
        $request->validate([
            'notification' => 'required|string',
        ]);

        $deviceTokens = User::where('status', 1)
            ->where('user_type', 1)
            ->whereNotNull('device_token')
            ->pluck('device_token')
            ->toArray();

        if (empty($deviceTokens)) {
            return back()->with('error', 'No valid device tokens found.');
        }

        // Define other parameters
        $message = $request->notification;
        $type = 'text'; // or 'image' if you want to support that
        $id = auth()->id(); // Or null or another reference ID
        $activity = 'dashboard';

        $firebaseService->sendNotification(
            $deviceTokens,
            $message,
            $type,
            $id,
            $activity
        );

    }

 ```

## Step 7: Check the notification to the device of device token is provided.
    
