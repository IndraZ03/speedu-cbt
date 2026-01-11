<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Setting;

class TestWhatsAppNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'whatsapp:test {phone} {message?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test WhatsApp notification functionality';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $phone = $this->argument('phone');
        $message = $this->argument('message') ?? 'Test message dari aplikasi ' . date('Y-m-d H:i:s');

        $this->info("Testing WhatsApp notification to: {$phone}");
        $this->info("Message: {$message}");

        // Check settings
        $setting = Setting::first();
        if (!$setting) {
            $this->error('Setting tidak ditemukan!');
            return 1;
        }

        if (empty($setting->whatsapp_token)) {
            $this->error('WhatsApp token belum dikonfigurasi!');
            $this->info('Silakan atur token di menu Setting > Token Whatsapp');
            return 1;
        }

        $this->info("Using token: " . substr($setting->whatsapp_token, 0, 10) . "...");
        $this->info("Full token length: " . strlen($setting->whatsapp_token));
        $this->info("App name: " . ($setting->app_name ?? 'Not set'));
        $this->info("App URL: " . ($setting->app_url ?? 'Not set'));

        // Test direct API call for debugging
        $this->info("\n=== Testing Direct API Call ===");
        
        // Format phone number
        $formattedPhone = preg_replace('/[^0-9]/', '', $phone);
        if (!preg_match('/^62/', $formattedPhone)) {
            $formattedPhone = '62' . ltrim($formattedPhone, '0');
        }
        
        $this->info("Formatted phone: {$formattedPhone}");
        
        // Make direct API call
        $token = $setting->whatsapp_token;
        $curl = curl_init();

        $data = [
            'target' => $formattedPhone,
            'message' => $message
        ];

        curl_setopt_array($curl, [
            CURLOPT_URL => 'https://api.fonnte.com/send',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => http_build_query($data),
            CURLOPT_HTTPHEADER => array(
                'Authorization: '.$token.''
            ),
        ]);

        $response = curl_exec($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        $error = curl_error($curl);

        curl_close($curl);

        $this->info("HTTP Code: {$httpCode}");
        $this->info("cURL Error: " . ($error ?: 'None'));
        $this->info("Raw Response: {$response}");
        
        if ($response) {
            $responseData = json_decode($response, true);
            $this->info("Decoded Response: " . json_encode($responseData, JSON_PRETTY_PRINT));
        }

        // Send test message using helper function
        $this->info("\n=== Testing Helper Function ===");
        $result = sendWhatsappNotification($phone, $message);

        if ($result) {
            $this->info('✅ WhatsApp notification sent successfully!');
        } else {
            $this->error('❌ Failed to send WhatsApp notification');
            $this->info('Check logs for more details: storage/logs/laravel.log');
        }

        return 0;
    }
} 