<?php

namespace App\Http\Controllers\Admin;

use App\Models\Transaction\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Models\Setting;
use App\Models\UserMemberCategory;

class NotificationHandler extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        try {
            $message = '';

            $payload = $request->getContent();

            $notification = json_decode($payload);

            $signatureKey = hash("sha512", $notification->order_id. $notification->status_code. $notification->gross_amount. config('services.midtrans.serverKey'));

            if ($notification->signature_key != $signatureKey) {
                return response(['message' => 'Invalid signature'], 403);
            }

            $transaction  = $notification->transaction_status;
            $type = $notification->payment_type;
            $orderId = $notification->order_id;

            $dataTransaction = Transaction::where('code', $orderId)->first();
            $setting = Setting::first();

            if ($transaction == 'capture') {
                if ($type == 'credit_card') {

                }

            } elseif ($transaction == 'settlement') {
                $dataTransaction->update([
                    'transaction_status' => 'done',
                    'expired_date' => $dataTransaction->period_type == 'day' ? Carbon::now()->addDays($dataTransaction->active_period) : Carbon::now()->addMonths($dataTransaction->active_period)
                ]);

                $message= "*[TRANSAKSI SUKSES ".$setting->app_name."]*\n\nKode Transaksi: ".$transaction->code."\nTotal Pembayaran: Rp".number_format($transaction->total_payment, 2, ",", ".")."\nketerangan: ".$transaction->description."\n\n*TRANSAKSI BERHASIL DAN SUDAH AKTIF*\n\n*CARA MENGAKSES TRY OUT:*\n1. Masuk ke halaman dashboard\n2. Pilih kotak merah paling atas bertuliskan try out sekdin\n3. Pilih TRY OUT yang sudah dibeli (Misalkan SKD) klik selengkapnya\n4. Pilih Try Out yang sudah dibeli dan klik Kerjakan\n5. Di halaman kerjakan, klik Mulai Kerjakan\n\n*CARA MENGAKSES PEMBAHASAN*\n1. Masuk ke halaman dashboard\n2. Pilih kotak merah paling atas bertuliskan try out sekdin\n3. Pilih TRY OUT yang sudah dibeli (Misalkan SKD) klik selengkapnya\n4. Pilih Try Out yang sudah dibeli dan klik Kerjakan\n5. Klik \"Pembahasan\" pada setiap subtes. Untuk melihat hasil, klik \"Hasil\".\n\nterimakasih.";

                UserMemberCategory::create([
                    'transaction_id' => $dataTransaction->id,
                    'user_id' => $dataTransaction->user_id,
                    'category_id' => $dataTransaction->category_id,
                    'description' => $dataTransaction->description,
                    'member_categories' => $dataTransaction->member_categories,
                    'expired_date' => $dataTransaction->expired_date,
                ]);

                UserMemberCategory::where('expired_date', '<', Carbon::now())->delete();

            } elseif($transaction == 'pending'){
                $dataTransaction->update([
                    'transaction_status' => 'pending'
                ]);

                $message = "*[TRANSAKSI ".$setting->app_name."]*\n\nKode Transaksi: ".$dataTransaction->code."\ntotal Pembayaran: Rp".number_format($dataTransaction->total_payment, 2, ",", ".")."\nketerangan: ".$dataTransaction->description."\n\n*STATUS: SILAKAN UNTUK MELAKUKAN PEMBAYARAN*\n\nterimakasih.";

            } elseif ($transaction == 'deny') {
                $dataTransaction->update([
                    'transaction_status' => 'failed'
                ]);

                $message = "*[TRANSAKSI ".$setting->app_name."]*\n\nKode Transaksi: ".$dataTransaction->code."\nTotal Pembayaran: Rp".number_format($dataTransaction->total_payment, 2, ",", ".")."\nketerangan: ".$dataTransaction->description."\n\n*STATUS: DIBATALKAN, SILAKAN LAKUKAN TRANSAKSI ULANG*\n\nterimakasih.";

            } elseif ($transaction == 'expire') {
                $dataTransaction->update([
                    'transaction_status' => 'expired'
                ]);

                $message = "*[TRANSAKSI ".$setting->app_name."]*\n\nKode Transaksi: ".$dataTransaction->code."\nTotal Pembayaran: Rp".number_format($dataTransaction->total_payment, 2, ",", ".")."\nketerangan: ".$dataTransaction->description."\n\n*STATUS: EXPIRED, SILAKAN LAKUKAN TRANSAKSI ULANG*\n\nterimakasih.";
            
            }elseif ($transaction == 'cancel') {
                $dataTransaction->update([
                    'transaction_status' => 'failed'
                ]);
                
                $message = "*[TRANSAKSI ".$setting->app_name."]*\n\nKode Transaksi: ".$dataTransaction->code."\nTotal Pembayaran: Rp".number_format($dataTransaction->total_payment, 2, ",", ".")."\nketerangan: ".$dataTransaction->description."\n\n*STATUS: DIBATALKAN, SILAKAN LAKUKAN TRANSAKSI ULANG*\n\nterimakasih.";

            }

            if($dataTransaction->user && $dataTransaction->user->student && $dataTransaction->user->student) {
                sendWhatsappNotification($dataTransaction->user->student->phone_number, $message);
            }
        } catch (\Exception $e) {
            \Log::info($e);
        }
    }
}
