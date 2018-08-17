# quick-sms
A laravel package to add smslive and other sms provider quick messages

Installation `composer require prosperoking/laravel-quick-sms` 

publish configuration `php artisan vendor:publish --provider="Prosperoking\LaravalSMS\QuickSMSServiceProvider" --tag=config`

Currently only smslive247 is supported more options will be added soon

Usage:
```php
    <?php
        $numbers = ['123456789']; // an array of phone numbers to send message to;
        $message = "Your message";
        $sender = "Sender"; // optional: sender
        
        \Quicksms::sendSms($numbers,$message,$sender);
        
    ?>
```