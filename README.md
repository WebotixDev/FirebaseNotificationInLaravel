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