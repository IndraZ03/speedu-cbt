<?php

use Carbon\Carbon;
use App\Models\Setting;
use Illuminate\Support\Facades\Log;

function formatCode($fitureCode, $sequence) {
    //tanggal
    $year = Carbon::now()->format('y');
    $month = Carbon::now()->format('m');
    $date = Carbon::now()->format('d');
    $dateFormat = $year.$month.$date;

    $sequence = str_pad($sequence, 4, '0', STR_PAD_LEFT);

    return $fitureCode.$dateFormat.$sequence;
}

function numberFormat($angka) {
    return number_format($angka, 0, ',' ,'.' );
}

if (!function_exists('dateFormat')) {
    /**
     * @param string $timestamp
     * @param string $date_format
     * @param string $suffix
     * @return string
     */
    function dateFormat($timestamp = '', $date_format = 'j F Y', $suffix = '') {
        if (trim ($timestamp) == '') {
            $timestamp = time ();
        } elseif (!ctype_digit ($timestamp)) {
            $timestamp = strtotime ($timestamp);
        }
        # remove S (st,nd,rd,th) there are no such things in indonesia :p
        $date_format = preg_replace ("/S/", "", $date_format);
        $pattern = array (
            '/Mon[^day]/','/Tue[^sday]/','/Wed[^nesday]/','/Thu[^rsday]/',
            '/Fri[^day]/','/Sat[^urday]/','/Sun[^day]/','/Monday/','/Tuesday/',
            '/Wednesday/','/Thursday/','/Friday/','/Saturday/','/Sunday/',
            '/Jan[^uary]/','/Feb[^ruary]/','/Mar[^ch]/','/Apr[^il]/','/May/',
            '/Jun[^e]/','/Jul[^y]/','/Aug[^ust]/','/Sep[^tember]/','/Oct[^ober]/',
            '/Nov[^ember]/','/Dec[^ember]/','/January/','/February/','/March/',
            '/April/','/June/','/July/','/August/','/September/','/October/',
            '/November/','/December/',
        );
        $replace = array ( 'Mon','Tue','Wed','Thu','Fri','Sat','Sun',
            'Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu',
            'Jan','Feb','Mar','Apr','Mei','Jun','Jul','Aug','Sep','Okt','Nov','Des',
            'Januari','Februari','Maret','April','Juni','Juli','Agustus','September',
            'Oktober','November','Desember',
        );
        $date = date ($date_format, $timestamp);
        $date = preg_replace ($pattern, $replace, $date);
        $date = "{$date} {$suffix}";
        return trim($date);
    }
}

if(!function_exists('formatRupiah')) {
    /**
     * @param $angka
     * @return string
     */
    function formatRupiah($angka)
    {
        return "Rp. ". number_format($angka, 0, ',' ,'.' );
    }
}

if(!function_exists('sendWhatsappNotification')) {
    function sendWhatsappNotification($number, $message)
    {
        try {
            // Get setting
            $setting = Setting::first();
            if (!$setting) {
                Log::error('WhatsApp Notification Error: Setting not found');
                return false;
            }

            $token = $setting->whatsapp_token ?? 'noset';
            if ($token === 'noset' || empty($token)) {
                Log::error('WhatsApp Notification Error: Token not configured', [
                    'number' => $number,
                    'message' => $message
                ]);
                return false;
            }

            // Validate phone number
            if (empty($number)) {
                Log::error('WhatsApp Notification Error: Phone number is empty');
                return false;
            }

            // Format phone number (remove + if exists and ensure it starts with country code)
            $number = preg_replace('/[^0-9]/', '', $number);
            if (strlen($number) < 10) {
                Log::error('WhatsApp Notification Error: Invalid phone number format', ['number' => $number]);
                return false;
            }

            // If number doesn't start with country code, assume Indonesia (62)
            if (!preg_match('/^62/', $number)) {
                $number = '62' . ltrim($number, '0');
            }

            $curl = curl_init();

            $data = [
                'target' => $number,
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

            // Log the response for debugging
            Log::info('WhatsApp Notification Response', [
                'number' => $number,
                'http_code' => $httpCode,
                'response' => $response,
                'error' => $error
            ]);

            if ($error) {
                Log::error('WhatsApp Notification cURL Error', [
                    'error' => $error,
                    'number' => $number
                ]);
                return false;
            }

            if ($httpCode !== 200) {
                Log::error('WhatsApp Notification HTTP Error', [
                    'http_code' => $httpCode,
                    'response' => $response,
                    'number' => $number
                ]);
                return false;
            }

            $responseData = json_decode($response, true);
            
            if (isset($responseData['status']) && $responseData['status'] === true) {
                Log::info('WhatsApp Notification Sent Successfully', [
                    'number' => $number,
                    'response' => $responseData
                ]);
                return true;
            } else {
                Log::error('WhatsApp Notification API Error', [
                    'response' => $responseData,
                    'number' => $number
                ]);
                return false;
            }

        } catch (\Exception $e) {
            Log::error('WhatsApp Notification Exception', [
                'error' => $e->getMessage(),
                'number' => $number ?? 'unknown',
                'trace' => $e->getTraceAsString()
            ]);
            return false;
        }
    }
}




