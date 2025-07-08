<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Setting;

class CheckWhatsAppToken extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'whatsapp:check-token';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check and validate WhatsApp token configuration';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info("=== WhatsApp Token Configuration Check ===\n");

        // Check settings
        $setting = Setting::first();
        if (!$setting) {
            $this->error('❌ Setting tidak ditemukan!');
            $this->info('Silakan jalankan: php artisan db:seed --class=SettingSeeder');
            return 1;
        }

        $this->info("✅ Setting ditemukan (ID: {$setting->id})");

        // Check token
        if (empty($setting->whatsapp_token)) {
            $this->error('❌ WhatsApp token belum dikonfigurasi!');
            $this->info('Silakan atur token di menu Setting > Token Whatsapp');
            return 1;
        }

        $token = $setting->whatsapp_token;
        $this->info("✅ Token ditemukan");
        $this->info("   - Panjang token: " . strlen($token));
        $this->info("   - Preview: " . substr($token, 0, 10) . "...");
        
        // Check token format
        if (strlen($token) < 10) {
            $this->warn('⚠️  Token terlalu pendek, mungkin tidak valid');
        }

        // Check other required settings
        $this->info("\n=== Required Settings Check ===");
        
        if (empty($setting->app_name)) {
            $this->error('❌ App name belum dikonfigurasi');
        } else {
            $this->info("✅ App name: {$setting->app_name}");
        }

        if (empty($setting->app_url)) {
            $this->error('❌ App URL belum dikonfigurasi');
        } else {
            $this->info("✅ App URL: {$setting->app_url}");
        }

        if (empty($setting->whatsapp_number)) {
            $this->error('❌ WhatsApp number belum dikonfigurasi');
        } else {
            $this->info("✅ WhatsApp number: {$setting->whatsapp_number}");
        }

        // Test API connectivity
        $this->info("\n=== API Connectivity Test ===");
        
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => 'https://api.fonnte.com/send',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 10,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => http_build_query([
                'target' => '6281234567890', // dummy number
                'message' => 'test'
            ]),
            CURLOPT_HTTPHEADER => array(
                'Authorization: '.$token.''
            ),
        ]);

        $response = curl_exec($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        $error = curl_error($curl);
        curl_close($curl);

        if ($error) {
            $this->error("❌ cURL Error: {$error}");
        } else {
            $this->info("✅ API dapat diakses");
            $this->info("   - HTTP Code: {$httpCode}");
            
            if ($response) {
                $responseData = json_decode($response, true);
                if (isset($responseData['reason'])) {
                    $this->warn("   - API Response: {$responseData['reason']}");
                    
                    if ($responseData['reason'] === 'invalid token') {
                        $this->error("❌ Token tidak valid!");
                        $this->info("   Kemungkinan penyebab:");
                        $this->info("   1. Token salah atau typo");
                        $this->info("   2. Token sudah expired");
                        $this->info("   3. Token tidak terdaftar di Fonnte");
                        $this->info("   4. Device WhatsApp tidak online");
                    }
                }
            }
        }

        // Recommendations
        $this->info("\n=== Recommendations ===");
        $this->info("1. Pastikan token dari Fonnte valid dan tidak expired");
        $this->info("2. Pastikan device WhatsApp terhubung dan online");
        $this->info("3. Cek quota pengiriman di dashboard Fonnte");
        $this->info("4. Test dengan command: php artisan whatsapp:test 6281234567890");

        return 0;
    }
} 