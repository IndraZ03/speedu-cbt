<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Transaction\Voucher;
use Carbon\Carbon;

class VoucherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Voucher::insert([
            [
                "id" => "65b942d2-5a0a-4edc-aa1a-281e31ca7974",
                "created_at" => "2023-01-20 06:07:08",
                "updated_at" => "2023-01-31 08:51:29",
                
                "category_id" => "0f4348b6-10ed-4d98-ac73-bc9970dc8b73",
                "code" => "CPNS-VC22001",
                "name" => "Paket Basic Member (Free)",
                
                "active_period" => 3,
                "access_type" => "basic_member",
                "type" => "month",
                "price_before_discount" => 50000,
                "price_after_discount" => 0,
                "description" => "<ul>\n<li class=\"pricing-list-item\"><span class=\"text-dark\"> Kategori Basic - <strong><span style=\"color: #169179;\">Yes</span></strong></span></li>\n<li><span class=\"text-dark\">Mengikuti Try Out Akbar - <strong><span style=\"color: #169179;\">Yes</span></strong></span></li>\n<li class=\"pricing-list-item\"><span class=\"text-dark\">Pembahasan untuk Tiap-tiap Soal - <span style=\"font-size: 10pt;\"><strong><span style=\"color: #e03e2d;\">No</span></strong></span></span></li>\n<li class=\"pricing-list-item\"><span class=\"text-dark\">Pembahasan Materi Sesuai Mata Pelajaran - <span style=\"font-size: 10pt;\"><strong><span style=\"color: #e03e2d;\">No</span></strong></span></span></li>\n<li class=\"pricing-list-item\"><span class=\"text-dark\">Group Telegram / Whatsapp Khusus - <span style=\"font-size: 10pt;\"><strong><span style=\"color: #e03e2d;\">No</span></strong></span></span></li>\n<li class=\"pricing-list-item\"><span class=\"text-dark\">Affiliate Program - <span style=\"font-size: 10pt;\"><strong><span style=\"color: #e03e2d;\">No</span></strong></span></span></li>\n</ul>",
                "is_active" => 1
            ],
            [
                "id" => "60bcdd79-f27b-4df1-afe1-9007b72d06c8",
                "created_at" => "2023-01-20 06:08:08",
                "updated_at" => "2023-03-06 07:30:15",
                
                "category_id" => "0f4348b6-10ed-4d98-ac73-bc9970dc8b73",
                "code" => "CPNS-VC22002",
                "name" => "Paket Standard Member",
                
                "active_period" => 3,
                "access_type" => "standard_member",
                "type" => "month",
                "price_before_discount" => 150000,
                "price_after_discount" => 75000,
                "description" => "<ul>\n<li class=\"pricing-list-item\"><span class=\"text-dark\"> Kategori Basic &amp; Standard - <strong><span style=\"color: #169179;\">Yes</span></strong></span></li>\n<li><span class=\"text-dark\">Mengikuti Try Out Akbar - <strong><span style=\"color: #169179;\">Yes</span></strong></span></li>\n<li class=\"pricing-list-item\"><span class=\"text-dark\">Pembahasan untuk Tiap-tiap Soal - <span style=\"font-size: 10pt;\"><strong><span style=\"color: #e03e2d;\">No</span></strong></span></span></li>\n<li class=\"pricing-list-item\"><span class=\"text-dark\">Pembahasan Materi Sesuai Mata Pelajaran - <span style=\"font-size: 10pt;\"><strong><span style=\"color: #e03e2d;\">No</span></strong></span></span></li>\n<li class=\"pricing-list-item\"><span class=\"text-dark\">Group Telegram / Whatsapp Khusus - <span style=\"font-size: 10pt;\"><strong><span style=\"color: #e03e2d;\">No</span></strong></span></span></li>\n<li class=\"pricing-list-item\"><span class=\"text-dark\">Affiliate Program - <span style=\"font-size: 10pt;\"><strong><span style=\"color: #e03e2d;\">No</span></strong></span></span></li>\n<li class=\"pricing-list-item\">&nbsp;</li>\n</ul>",
                "is_active" => 1
            ],
            [
                "id" => "b9131697-e150-4861-8282-1a85903563d5",
                "created_at" => "2023-01-20 06:09:08",
                "updated_at" => "2023-03-06 07:30:26",
                
                "category_id" => "0f4348b6-10ed-4d98-ac73-bc9970dc8b73",
                "code" => "CPNS-VC22003",
                "name" => "Paket Standard Member",
                
                "active_period" => 6,
                "access_type" => "standard_member",
                "type" => "month",
                "price_before_discount" => 300000,
                "price_after_discount" => 125000,
                "description" => "<ul>\n<li class=\"pricing-list-item\"><span class=\"text-dark\"> Kategori Basic &amp; Standard - <strong><span style=\"color: #169179;\">Yes</span></strong></span></li>\n<li><span class=\"text-dark\">Mengikuti Try Out Akbar - <strong><span style=\"color: #169179;\">Yes</span></strong></span></li>\n<li class=\"pricing-list-item\"><span class=\"text-dark\">Pembahasan untuk Tiap-tiap Soal - <span style=\"font-size: 10pt;\"><strong><span style=\"color: #e03e2d;\">No</span></strong></span></span></li>\n<li class=\"pricing-list-item\"><span class=\"text-dark\">Pembahasan Materi Sesuai Mata Pelajaran - <span style=\"font-size: 10pt;\"><strong><span style=\"color: #e03e2d;\">No</span></strong></span></span></li>\n<li class=\"pricing-list-item\"><span class=\"text-dark\">Group Telegram / Whatsapp Khusus - <span style=\"font-size: 10pt;\"><strong><span style=\"color: #e03e2d;\">No</span></strong></span></span></li>\n<li class=\"pricing-list-item\"><span class=\"text-dark\">Affiliate Program - <span style=\"font-size: 10pt;\"><strong><span style=\"color: #e03e2d;\">No</span></strong></span></span></li>\n</ul>",
                "is_active" => 1
            ],
            [
                "id" => "e5ecba9a-c14e-4941-b5b0-1263ffe082eb",
                "created_at" => "2023-01-20 06:10:08",
                "updated_at" => "2023-03-06 07:30:34",
                
                "category_id" => "0f4348b6-10ed-4d98-ac73-bc9970dc8b73",
                "code" => "CPNS-VC22004",
                "name" => "Paket Standard Member",
                
                "active_period" => 12,
                "access_type" => "standard_member",
                "type" => "month",
                "price_before_discount" => 600000,
                "price_after_discount" => 200000,
                "description" => "<ul>\n<li class=\"pricing-list-item\"><span class=\"text-dark\"> Kategori Basic &amp; Standard - <strong><span style=\"color: #169179;\">Yes</span></strong></span></li>\n<li><span class=\"text-dark\">Mengikuti Try Out Akbar - <strong><span style=\"color: #169179;\">Yes</span></strong></span></li>\n<li class=\"pricing-list-item\"><span class=\"text-dark\">Pembahasan untuk Tiap-tiap Soal - <span style=\"font-size: 10pt;\"><strong><span style=\"color: #e03e2d;\">No</span></strong></span></span></li>\n<li class=\"pricing-list-item\"><span class=\"text-dark\">Pembahasan Materi Sesuai Mata Pelajaran - <span style=\"font-size: 10pt;\"><strong><span style=\"color: #e03e2d;\">No</span></strong></span></span></li>\n<li class=\"pricing-list-item\"><span class=\"text-dark\">Group Telegram / Whatsapp Khusus - <span style=\"font-size: 10pt;\"><strong><span style=\"color: #e03e2d;\">No</span></strong></span></span></li>\n<li class=\"pricing-list-item\"><span class=\"text-dark\">Affiliate Program - <span style=\"font-size: 10pt;\"><strong><span style=\"color: #e03e2d;\">No</span></strong></span></span></li>\n</ul>",
                "is_active" => 1
            ],
            [
                "id" => "992c187f-bded-4e83-ab2a-f9671694a7f6",
                "created_at" => "2023-01-20 06:11:08",
                "updated_at" => "2023-01-31 08:49:55",
                
                "category_id" => "0f4348b6-10ed-4d98-ac73-bc9970dc8b73",
                "code" => "CPNS-VC22005",
                "name" => "Paket Premium Member",
                
                "active_period" => 3,
                "access_type" => "premium_member",
                "type" => "month",
                "price_before_discount" => 400000,
                "price_after_discount" => 130000,
                "description" => "<ul>\n<li class=\"pricing-list-item\"><span class=\"text-dark\"> Seluruh Kategori - <strong><span style=\"color: #169179;\">Yes</span></strong></span></li>\n<li class=\"pricing-list-item\"><span class=\"text-dark\">Pembahasan untuk Tiap-tiap Soal - <strong><span style=\"color: #169179;\">Yes</span></strong></span></li>\n<li class=\"pricing-list-item\"><span class=\"text-dark\">Mengikuti Try Out - <strong><span style=\"color: #169179;\">Yes</span></strong></span></li>\n<li class=\"pricing-list-item\"><span class=\"text-dark\">Pembahasan Materi Sesuai Mata Pelajaran - <strong><span style=\"color: #169179;\">Yes</span></strong></span></li>\n<li class=\"pricing-list-item\"><span class=\"text-dark\">Group Telegram / Whatsapp Khusus - <strong><span style=\"color: #169179;\">Yes</span></strong></span></li>\n<li class=\"pricing-list-item\"><span class=\"text-dark\">Affiliate Program - <strong><span style=\"color: #169179;\">Yes</span></strong></span></li>\n</ul>",
                "is_active" => 0
            ],
            [
                "id" => "c20c1a41-2b1b-4913-beb2-b6e98123f1a2",
                "created_at" => "2023-01-20 06:12:08",
                "updated_at" => "2023-01-31 08:49:51",
                
                "category_id" => "0f4348b6-10ed-4d98-ac73-bc9970dc8b73",
                "code" => "CPNS-VC22006",
                "name" => "Paket Premium Member",
                
                "active_period" => 6,
                "access_type" => "premium_member",
                "type" => "month",
                "price_before_discount" => 800000,
                "price_after_discount" => 250000,
                "description" => "<ul>\n<li class=\"pricing-list-item\"><span class=\"text-dark\"> Seluruh Kategori - <strong><span style=\"color: #169179;\">Yes</span></strong></span></li>\n<li class=\"pricing-list-item\"><span class=\"text-dark\">Pembahasan untuk Tiap-tiap Soal - <strong><span style=\"color: #169179;\">Yes</span></strong></span></li>\n<li class=\"pricing-list-item\"><span class=\"text-dark\">Mengikuti Try Out - <strong><span style=\"color: #169179;\">Yes</span></strong></span></li>\n<li class=\"pricing-list-item\"><span class=\"text-dark\">Pembahasan Materi Sesuai Mata Pelajaran - <strong><span style=\"color: #169179;\">Yes</span></strong></span></li>\n<li class=\"pricing-list-item\"><span class=\"text-dark\">Group Telegram / Whatsapp Khusus - <strong><span style=\"color: #169179;\">Yes</span></strong></span></li>\n<li class=\"pricing-list-item\"><span class=\"text-dark\">Affiliate Program - <strong><span style=\"color: #169179;\">Yes</span></strong></span></li>\n</ul>",
                "is_active" => 0
            ],
            [
                "id" => "148a6236-4dd1-42f3-af45-0e56c7376225",
                "created_at" => "2023-01-20 06:13:08",
                "updated_at" => "2023-01-31 08:49:46",
                
                "category_id" => "0f4348b6-10ed-4d98-ac73-bc9970dc8b73",
                "code" => "CPNS-VC22007",
                "name" => "Paket Premium Member",
                
                "active_period" => 12,
                "access_type" => "premium_member",
                "type" => "month",
                "price_before_discount" => 1500000,
                "price_after_discount" => 400000,
                "description" => "<ul>\n<li class=\"pricing-list-item\"><span class=\"text-dark\"> Seluruh Kategori - <strong><span style=\"color: #169179;\">Yes</span></strong></span></li>\n<li class=\"pricing-list-item\"><span class=\"text-dark\">Pembahasan untuk Tiap-tiap Soal - <strong><span style=\"color: #169179;\">Yes</span></strong></span></li>\n<li class=\"pricing-list-item\"><span class=\"text-dark\">Mengikuti Try Out - <strong><span style=\"color: #169179;\">Yes</span></strong></span></li>\n<li class=\"pricing-list-item\"><span class=\"text-dark\">Pembahasan Materi Sesuai Mata Pelajaran - <strong><span style=\"color: #169179;\">Yes</span></strong></span></li>\n<li class=\"pricing-list-item\"><span class=\"text-dark\">Group Telegram / Whatsapp Khusus - <strong><span style=\"color: #169179;\">Yes</span></strong></span></li>\n<li class=\"pricing-list-item\"><span class=\"text-dark\">Affiliate Program - <strong><span style=\"color: #169179;\">Yes</span></strong></span></li>\n</ul>",
                "is_active" => 0
            ],
            [
                "id" => "6fad3881-f679-42f0-96e2-2fb6da9d46b0",
                "created_at" => "2023-01-20 06:14:08",
                "updated_at" => "2023-01-31 08:52:55",
                
                "category_id" => "1350c742-67be-4841-9cf7-a92a9ce6278a",
                "code" => "KEDINASAN-VC22001",
                "name" => "Paket Basic Member (Free)",
                
                "active_period" => 3,
                "access_type" => "basic_member",
                "type" => "month",
                "price_before_discount" => 50000,
                "price_after_discount" => 0,
                "description" => "<ul>\n<li class=\"pricing-list-item\"><span class=\"text-dark\"> Kategori Basic - <strong><span style=\"color: #169179;\">Yes</span></strong></span></li>\n<li><span class=\"text-dark\">Mengikuti Try Out Akbar - <strong><span style=\"color: #169179;\">Yes</span></strong></span></li>\n<li class=\"pricing-list-item\"><span class=\"text-dark\">Pembahasan untuk Tiap-tiap Soal - <span style=\"font-size: 10pt;\"><strong><span style=\"color: #e03e2d;\">No</span></strong></span></span></li>\n<li class=\"pricing-list-item\"><span class=\"text-dark\">Pembahasan Materi Sesuai Mata Pelajaran - <span style=\"font-size: 10pt;\"><strong><span style=\"color: #e03e2d;\">No</span></strong></span></span></li>\n<li class=\"pricing-list-item\"><span class=\"text-dark\">Group Telegram / Whatsapp Khusus - <span style=\"font-size: 10pt;\"><strong><span style=\"color: #e03e2d;\">No</span></strong></span></span></li>\n<li class=\"pricing-list-item\"><span class=\"text-dark\">Affiliate Program - <span style=\"font-size: 10pt;\"><strong><span style=\"color: #e03e2d;\">No</span></strong></span></span></li>\n</ul>",
                "is_active" => 1
            ],
            [
                "id" => "7985696c-fa5a-4f43-9833-d072f7c91de4",
                "created_at" => "2023-01-20 06:15:08",
                "updated_at" => "2023-03-06 07:31:14",
                
                "category_id" => "1350c742-67be-4841-9cf7-a92a9ce6278a",
                "code" => "KEDINASAN-VC22002",
                "name" => "Paket Standard Member",
                
                "active_period" => 3,
                "access_type" => "standard_member",
                "type" => "month",
                "price_before_discount" => 150000,
                "price_after_discount" => 75000,
                "description" => "<ul>\n<li class=\"pricing-list-item\"><span class=\"text-dark\"> Kategori Basic &amp; Standard - <strong><span style=\"color: #169179;\">Yes</span></strong></span></li>\n<li><span class=\"text-dark\">Mengikuti Try Out Akbar - <strong><span style=\"color: #169179;\">Yes</span></strong></span></li>\n<li class=\"pricing-list-item\"><span class=\"text-dark\">Pembahasan untuk Tiap-tiap Soal - <span style=\"font-size: 10pt;\"><strong><span style=\"color: #e03e2d;\">No</span></strong></span></span></li>\n<li class=\"pricing-list-item\"><span class=\"text-dark\">Pembahasan Materi Sesuai Mata Pelajaran - <span style=\"font-size: 10pt;\"><strong><span style=\"color: #e03e2d;\">No</span></strong></span></span></li>\n<li class=\"pricing-list-item\"><span class=\"text-dark\">Group Telegram / Whatsapp Khusus - <span style=\"font-size: 10pt;\"><strong><span style=\"color: #e03e2d;\">No</span></strong></span></span></li>\n<li class=\"pricing-list-item\"><span class=\"text-dark\">Affiliate Program - <span style=\"font-size: 10pt;\"><strong><span style=\"color: #e03e2d;\">No</span></strong></span></span></li>\n</ul>",
                "is_active" => 1
            ],
            [
                "id" => "a225aaa2-506b-4289-8375-a03f37a7fd01",
                "created_at" => "2023-01-20 06:16:08",
                "updated_at" => "2023-03-06 07:31:22",
                
                "category_id" => "1350c742-67be-4841-9cf7-a92a9ce6278a",
                "code" => "KEDINASAN-VC22003",
                "name" => "Paket Standard Member",
                
                "active_period" => 6,
                "access_type" => "standard_member",
                "type" => "month",
                "price_before_discount" => 300000,
                "price_after_discount" => 125000,
                "description" => "<ul>\n<li class=\"pricing-list-item\"><span class=\"text-dark\"> Kategori Basic &amp; Standard - <strong><span style=\"color: #169179;\">Yes</span></strong></span></li>\n<li><span class=\"text-dark\">Mengikuti Try Out Akbar - <strong><span style=\"color: #169179;\">Yes</span></strong></span></li>\n<li class=\"pricing-list-item\"><span class=\"text-dark\">Pembahasan untuk Tiap-tiap Soal - <span style=\"font-size: 10pt;\"><strong><span style=\"color: #e03e2d;\">No</span></strong></span></span></li>\n<li class=\"pricing-list-item\"><span class=\"text-dark\">Pembahasan Materi Sesuai Mata Pelajaran - <span style=\"font-size: 10pt;\"><strong><span style=\"color: #e03e2d;\">No</span></strong></span></span></li>\n<li class=\"pricing-list-item\"><span class=\"text-dark\">Group Telegram / Whatsapp Khusus - <span style=\"font-size: 10pt;\"><strong><span style=\"color: #e03e2d;\">No</span></strong></span></span></li>\n<li class=\"pricing-list-item\"><span class=\"text-dark\">Affiliate Program - <span style=\"font-size: 10pt;\"><strong><span style=\"color: #e03e2d;\">No</span></strong></span></span></li>\n</ul>",
                "is_active" => 1
            ],
            [
                "id" => "4de51173-11d9-4225-bf2a-f49f59400f21",
                "created_at" => "2023-01-20 06:17:08",
                "updated_at" => "2023-03-06 07:31:28",
                
                "category_id" => "1350c742-67be-4841-9cf7-a92a9ce6278a",
                "code" => "KEDINASAN-VC22004",
                "name" => "Paket Standard Member",
                
                "active_period" => 12,
                "access_type" => "standard_member",
                "type" => "month",
                "price_before_discount" => 600000,
                "price_after_discount" => 200000,
                "description" => "<ul>\n<li class=\"pricing-list-item\"><span class=\"text-dark\"> Kategori Basic &amp; Standard - <strong><span style=\"color: #169179;\">Yes</span></strong></span></li>\n<li><span class=\"text-dark\">Mengikuti Try Out Akbar - <strong><span style=\"color: #169179;\">Yes</span></strong></span></li>\n<li class=\"pricing-list-item\"><span class=\"text-dark\">Pembahasan untuk Tiap-tiap Soal - <span style=\"font-size: 10pt;\"><strong><span style=\"color: #e03e2d;\">No</span></strong></span></span></li>\n<li class=\"pricing-list-item\"><span class=\"text-dark\">Pembahasan Materi Sesuai Mata Pelajaran - <span style=\"font-size: 10pt;\"><strong><span style=\"color: #e03e2d;\">No</span></strong></span></span></li>\n<li class=\"pricing-list-item\"><span class=\"text-dark\">Group Telegram / Whatsapp Khusus - <span style=\"font-size: 10pt;\"><strong><span style=\"color: #e03e2d;\">No</span></strong></span></span></li>\n<li class=\"pricing-list-item\"><span class=\"text-dark\">Affiliate Program - <span style=\"font-size: 10pt;\"><strong><span style=\"color: #e03e2d;\">No</span></strong></span></span></li>\n</ul>",
                "is_active" => 1
            ],
            [
                "id" => "36f98a16-60f3-4573-ad39-039998c5d653",
                "created_at" => "2023-01-20 06:18:08",
                "updated_at" => "2023-01-31 08:50:09",
                
                "category_id" => "1350c742-67be-4841-9cf7-a92a9ce6278a",
                "code" => "KEDINASAN-VC22005",
                "name" => "Paket Premium Member",
                
                "active_period" => 3,
                "access_type" => "premium_member",
                "type" => "month",
                "price_before_discount" => 400000,
                "price_after_discount" => 130000,
                "description" => "<ul>\n<li class=\"pricing-list-item\"><span class=\"text-dark\"> Kategori Standard - <strong><span style=\"color: #169179;\">Yes</span></strong></span></li>\n<li class=\"pricing-list-item\"><span class=\"text-dark\">Pembahasan untuk Tiap-tiap Soal - <strong><span style=\"color: #169179;\">Yes</span></strong></span></li>\n<li class=\"pricing-list-item\"><span class=\"text-dark\">Mengikuti Try Out - <strong><span style=\"color: #169179;\">Yes</span></strong></span></li>\n<li class=\"pricing-list-item\"><span class=\"text-dark\">Pembahasan Materi Sesuai Mata Pelajaran - <strong><span style=\"color: #169179;\">Yes</span></strong></span></li>\n<li class=\"pricing-list-item\"><span class=\"text-dark\">Group Telegram / Whatsapp Khusus - <strong><span style=\"color: #169179;\">Yes</span></strong></span></li>\n<li class=\"pricing-list-item\"><span class=\"text-dark\">Affiliate Program - <strong><span style=\"color: #169179;\">Yes</span></strong></span></li>\n</ul>",
                "is_active" => 0
            ],
            [
                "id" => "0e5d723b-ed74-40f8-8395-acb3be8c7da2",
                "created_at" => "2023-01-20 06:19:08",
                "updated_at" => "2023-01-31 08:50:04",
                
                "category_id" => "1350c742-67be-4841-9cf7-a92a9ce6278a",
                "code" => "KEDINASAN-VC22006",
                "name" => "Paket Premium Member",
                
                "active_period" => 6,
                "access_type" => "premium_member",
                "type" => "month",
                "price_before_discount" => 800000,
                "price_after_discount" => 250000,
                "description" => "<ul>\n<li class=\"pricing-list-item\"><span class=\"text-dark\"> Kategori Standard - <strong><span style=\"color: #169179;\">Yes</span></strong></span></li>\n<li class=\"pricing-list-item\"><span class=\"text-dark\">Pembahasan untuk Tiap-tiap Soal - <strong><span style=\"color: #169179;\">Yes</span></strong></span></li>\n<li class=\"pricing-list-item\"><span class=\"text-dark\">Mengikuti Try Out - <strong><span style=\"color: #169179;\">Yes</span></strong></span></li>\n<li class=\"pricing-list-item\"><span class=\"text-dark\">Pembahasan Materi Sesuai Mata Pelajaran - <strong><span style=\"color: #169179;\">Yes</span></strong></span></li>\n<li class=\"pricing-list-item\"><span class=\"text-dark\">Group Telegram / Whatsapp Khusus - <strong><span style=\"color: #169179;\">Yes</span></strong></span></li>\n<li class=\"pricing-list-item\"><span class=\"text-dark\">Affiliate Program - <strong><span style=\"color: #169179;\">Yes</span></strong></span></li>\n</ul>",
                "is_active" => 0
            ],
            [
                "id" => "0bd11ac6-ab37-4da6-8553-a8df9c06c993",
                "created_at" => "2023-01-20 06:20:08",
                "updated_at" => "2023-01-31 08:49:59",
                
                "category_id" => "1350c742-67be-4841-9cf7-a92a9ce6278a",
                "code" => "KEDINASAN-VC22007",
                "name" => "Paket Premium Member",
                
                "active_period" => 12,
                "access_type" => "premium_member",
                "type" => "month",
                "price_before_discount" => 1500000,
                "price_after_discount" => 400000,
                "description" => "<ul>\n<li class=\"pricing-list-item\"><span class=\"text-dark\"> Kategori Standard - <strong><span style=\"color: #169179;\">Yes</span></strong></span></li>\n<li class=\"pricing-list-item\"><span class=\"text-dark\">Pembahasan untuk Tiap-tiap Soal - <strong><span style=\"color: #169179;\">Yes</span></strong></span></li>\n<li class=\"pricing-list-item\"><span class=\"text-dark\">Mengikuti Try Out - <strong><span style=\"color: #169179;\">Yes</span></strong></span></li>\n<li class=\"pricing-list-item\"><span class=\"text-dark\">Pembahasan Materi Sesuai Mata Pelajaran - <strong><span style=\"color: #169179;\">Yes</span></strong></span></li>\n<li class=\"pricing-list-item\"><span class=\"text-dark\">Group Telegram / Whatsapp Khusus - <strong><span style=\"color: #169179;\">Yes</span></strong></span></li>\n<li class=\"pricing-list-item\"><span class=\"text-dark\">Affiliate Program - <strong><span style=\"color: #169179;\">Yes</span></strong></span></li>\n</ul>",
                "is_active" => 0
            ],
            [
                "id" => "e1cfecd4-2886-41d9-ab49-1253cd5930de",
                "created_at" => "2023-01-20 06:21:08",
                "updated_at" => "2023-01-31 08:52:25",
                
                "category_id" => "f968e7a3-74ed-4090-b9bc-99e7c36f2a69",
                "code" => "POLRI-VC22001",
                "name" => "Paket Basic Member (Free)",
                
                "active_period" => 3,
                "access_type" => "basic_member",
                "type" => "month",
                "price_before_discount" => 50000,
                "price_after_discount" => 0,
                "description" => "<ul>\n<li class=\"pricing-list-item\"><span class=\"text-dark\"> Kategori Basic - <strong><span style=\"color: #169179;\">Yes</span></strong></span></li>\n<li><span class=\"text-dark\">Mengikuti Try Out Akbar - <strong><span style=\"color: #169179;\">Yes</span></strong></span></li>\n<li class=\"pricing-list-item\"><span class=\"text-dark\">Pembahasan untuk Tiap-tiap Soal - <span style=\"font-size: 10pt;\"><strong><span style=\"color: #e03e2d;\">No</span></strong></span></span></li>\n<li class=\"pricing-list-item\"><span class=\"text-dark\">Pembahasan Materi Sesuai Mata Pelajaran - <span style=\"font-size: 10pt;\"><strong><span style=\"color: #e03e2d;\">No</span></strong></span></span></li>\n<li class=\"pricing-list-item\"><span class=\"text-dark\">Group Telegram / Whatsapp Khusus - <span style=\"font-size: 10pt;\"><strong><span style=\"color: #e03e2d;\">No</span></strong></span></span></li>\n<li class=\"pricing-list-item\"><span class=\"text-dark\">Affiliate Program - <span style=\"font-size: 10pt;\"><strong><span style=\"color: #e03e2d;\">No</span></strong></span></span></li>\n</ul>",
                "is_active" => 1
            ],
            [
                "id" => "21d951eb-d358-483e-a1ee-50f068a7d462",
                "created_at" => "2023-01-20 06:22:08",
                "updated_at" => "2023-03-14 13:39:16",
                
                "category_id" => "f968e7a3-74ed-4090-b9bc-99e7c36f2a69",
                "code" => "POLRI-VC22002",
                "name" => "Paket Standard Member",
                
                "active_period" => 3,
                "access_type" => "standard_member",
                "type" => "month",
                "price_before_discount" => 150000,
                "price_after_discount" => 75000,
                "description" => "<ul>\n<li class=\"pricing-list-item\"><span class=\"text-dark\"> Kategori Basic &amp; Standard - <strong><span style=\"color: #169179;\">Yes</span></strong></span></li>\n<li><span class=\"text-dark\">Mengikuti Try Out Akbar - <strong><span style=\"color: #169179;\">Yes</span></strong></span></li>\n<li class=\"pricing-list-item\"><span class=\"text-dark\">Pembahasan untuk Tiap-tiap Soal - <span style=\"font-size: 10pt;\"><strong><span style=\"color: #e03e2d;\">No</span></strong></span></span></li>\n<li class=\"pricing-list-item\"><span class=\"text-dark\">Pembahasan Materi Sesuai Mata Pelajaran - <span style=\"font-size: 10pt;\"><strong><span style=\"color: #e03e2d;\">No</span></strong></span></span></li>\n<li class=\"pricing-list-item\"><span class=\"text-dark\">Group Telegram / Whatsapp Khusus - <span style=\"font-size: 10pt;\"><strong><span style=\"color: #e03e2d;\">No</span></strong></span></span></li>\n<li class=\"pricing-list-item\"><span class=\"text-dark\">Affiliate Program - <span style=\"font-size: 10pt;\"><strong><span style=\"color: #e03e2d;\">No</span></strong></span></span></li>\n</ul>",
                "is_active" => 1
            ],
            [
                "id" => "fd56fd2e-6ec1-4e6b-ae1d-8a9bee69f1b9",
                "created_at" => "2023-01-20 06:23:08",
                "updated_at" => "2023-03-06 07:32:03",
                
                "category_id" => "f968e7a3-74ed-4090-b9bc-99e7c36f2a69",
                "code" => "POLRI-VC22003",
                "name" => "Paket Standard Member",
                
                "active_period" => 6,
                "access_type" => "standard_member",
                "type" => "month",
                "price_before_discount" => 300000,
                "price_after_discount" => 125000,
                "description" => "<ul>\n<li class=\"pricing-list-item\"><span class=\"text-dark\"> Kategori Basic &amp; Standard - <strong><span style=\"color: #169179;\">Yes</span></strong></span></li>\n<li><span class=\"text-dark\">Mengikuti Try Out Akbar - <strong><span style=\"color: #169179;\">Yes</span></strong></span></li>\n<li class=\"pricing-list-item\"><span class=\"text-dark\">Pembahasan untuk Tiap-tiap Soal - <span style=\"font-size: 10pt;\"><strong><span style=\"color: #e03e2d;\">No</span></strong></span></span></li>\n<li class=\"pricing-list-item\"><span class=\"text-dark\">Pembahasan Materi Sesuai Mata Pelajaran - <span style=\"font-size: 10pt;\"><strong><span style=\"color: #e03e2d;\">No</span></strong></span></span></li>\n<li class=\"pricing-list-item\"><span class=\"text-dark\">Group Telegram / Whatsapp Khusus - <span style=\"font-size: 10pt;\"><strong><span style=\"color: #e03e2d;\">No</span></strong></span></span></li>\n<li class=\"pricing-list-item\"><span class=\"text-dark\">Affiliate Program - <span style=\"font-size: 10pt;\"><strong><span style=\"color: #e03e2d;\">No</span></strong></span></span></li>\n</ul>",
                "is_active" => 1
            ],
            [
                "id" => "1ea855df-4f14-44d4-a54f-f1ed26c9a76a",
                "created_at" => "2023-01-20 06:24:08",
                "updated_at" => "2023-03-06 07:32:09",
                
                "category_id" => "f968e7a3-74ed-4090-b9bc-99e7c36f2a69",
                "code" => "POLRI-VC22004",
                "name" => "Paket Standard Member",
                
                "active_period" => 12,
                "access_type" => "standard_member",
                "type" => "month",
                "price_before_discount" => 600000,
                "price_after_discount" => 200000,
                "description" => "<ul>\n<li class=\"pricing-list-item\"><span class=\"text-dark\"> Kategori Basic &amp; Standard - <strong><span style=\"color: #169179;\">Yes</span></strong></span></li>\n<li><span class=\"text-dark\">Mengikuti Try Out Akbar - <strong><span style=\"color: #169179;\">Yes</span></strong></span></li>\n<li class=\"pricing-list-item\"><span class=\"text-dark\">Pembahasan untuk Tiap-tiap Soal - <span style=\"font-size: 10pt;\"><strong><span style=\"color: #e03e2d;\">No</span></strong></span></span></li>\n<li class=\"pricing-list-item\"><span class=\"text-dark\">Pembahasan Materi Sesuai Mata Pelajaran - <span style=\"font-size: 10pt;\"><strong><span style=\"color: #e03e2d;\">No</span></strong></span></span></li>\n<li class=\"pricing-list-item\"><span class=\"text-dark\">Group Telegram / Whatsapp Khusus - <span style=\"font-size: 10pt;\"><strong><span style=\"color: #e03e2d;\">No</span></strong></span></span></li>\n<li class=\"pricing-list-item\"><span class=\"text-dark\">Affiliate Program - <span style=\"font-size: 10pt;\"><strong><span style=\"color: #e03e2d;\">No</span></strong></span></span></li>\n</ul>",
                "is_active" => 1
            ],
            [
                "id" => "ae3cb57e-e9ea-4678-94d4-d5ac2e1e8110",
                "created_at" => "2023-01-20 06:25:08",
                "updated_at" => "2023-01-31 08:51:54",
                
                "category_id" => "f968e7a3-74ed-4090-b9bc-99e7c36f2a69",
                "code" => "POLRI-VC22005",
                "name" => "Paket Premium Member",
                
                "active_period" => 3,
                "access_type" => "premium_member",
                "type" => "month",
                "price_before_discount" => 400000,
                "price_after_discount" => 130000,
                "description" => "<ul>\n<li class=\"pricing-list-item\"><span class=\"text-dark\"> Seluruh Kategori- <strong><span style=\"color: #169179;\">Yes</span></strong></span></li>\n<li class=\"pricing-list-item\"><span class=\"text-dark\">Pembahasan untuk Tiap-tiap Soal - <strong><span style=\"color: #169179;\">Yes</span></strong></span></li>\n<li class=\"pricing-list-item\"><span class=\"text-dark\">Mengikuti Try Out - <strong><span style=\"color: #169179;\">Yes</span></strong></span></li>\n<li class=\"pricing-list-item\"><span class=\"text-dark\">Pembahasan Materi Sesuai Mata Pelajaran - <strong><span style=\"color: #169179;\">Yes</span></strong></span></li>\n<li class=\"pricing-list-item\"><span class=\"text-dark\">Group Telegram / Whatsapp Khusus - <strong><span style=\"color: #169179;\">Yes</span></strong></span></li>\n<li class=\"pricing-list-item\"><span class=\"text-dark\">Affiliate Program - <strong><span style=\"color: #169179;\">Yes</span></strong></span></li>\n</ul>",
                "is_active" => 0
            ],
            [
                "id" => "1c1d1fb4-deaf-4f4a-82cf-3ef517a70a8d",
                "created_at" => "2023-01-20 06:26:08",
                "updated_at" => "2023-01-31 08:51:58",
                
                "category_id" => "f968e7a3-74ed-4090-b9bc-99e7c36f2a69",
                "code" => "POLRI-VC22006",
                "name" => "Paket Premium Member",
                
                "active_period" => 6,
                "access_type" => "premium_member",
                "type" => "month",
                "price_before_discount" => 800000,
                "price_after_discount" => 250000,
                "description" => "<ul>\n<li class=\"pricing-list-item\"><span class=\"text-dark\"> Seluruh Kategori- <strong><span style=\"color: #169179;\">Yes</span></strong></span></li>\n<li class=\"pricing-list-item\"><span class=\"text-dark\">Pembahasan untuk Tiap-tiap Soal - <strong><span style=\"color: #169179;\">Yes</span></strong></span></li>\n<li class=\"pricing-list-item\"><span class=\"text-dark\">Mengikuti Try Out - <strong><span style=\"color: #169179;\">Yes</span></strong></span></li>\n<li class=\"pricing-list-item\"><span class=\"text-dark\">Pembahasan Materi Sesuai Mata Pelajaran - <strong><span style=\"color: #169179;\">Yes</span></strong></span></li>\n<li class=\"pricing-list-item\"><span class=\"text-dark\">Group Telegram / Whatsapp Khusus - <strong><span style=\"color: #169179;\">Yes</span></strong></span></li>\n<li class=\"pricing-list-item\"><span class=\"text-dark\">Affiliate Program - <strong><span style=\"color: #169179;\">Yes</span></strong></span></li>\n</ul>",
                "is_active" => 0
            ],
            [
                "id" => "d1799044-c21c-43fb-a4b9-16f307948206",
                "created_at" => "2023-01-20 06:27:08",
                "updated_at" => "2023-01-31 08:52:01",
                
                "category_id" => "f968e7a3-74ed-4090-b9bc-99e7c36f2a69",
                "code" => "POLRI-VC22007",
                "name" => "Paket Premium Member",
                
                "active_period" => 12,
                "access_type" => "premium_member",
                "type" => "month",
                "price_before_discount" => 1500000,
                "price_after_discount" => 400000,
                "description" => "<ul>\n<li class=\"pricing-list-item\"><span class=\"text-dark\"> Seluruh Kategori- <strong><span style=\"color: #169179;\">Yes</span></strong></span></li>\n<li class=\"pricing-list-item\"><span class=\"text-dark\">Pembahasan untuk Tiap-tiap Soal - <strong><span style=\"color: #169179;\">Yes</span></strong></span></li>\n<li class=\"pricing-list-item\"><span class=\"text-dark\">Mengikuti Try Out - <strong><span style=\"color: #169179;\">Yes</span></strong></span></li>\n<li class=\"pricing-list-item\"><span class=\"text-dark\">Pembahasan Materi Sesuai Mata Pelajaran - <strong><span style=\"color: #169179;\">Yes</span></strong></span></li>\n<li class=\"pricing-list-item\"><span class=\"text-dark\">Group Telegram / Whatsapp Khusus - <strong><span style=\"color: #169179;\">Yes</span></strong></span></li>\n<li class=\"pricing-list-item\"><span class=\"text-dark\">Affiliate Program - <strong><span style=\"color: #169179;\">Yes</span></strong></span></li>\n</ul>",
                "is_active" => 0
            ],
            [
                "id" => "9f5827a3-496d-4907-84d2-db5ab4e73aca",
                "created_at" => "2023-01-20 06:28:08",
                "updated_at" => "2023-01-29 06:05:04",
                
                "category_id" => "ab1e771a-0037-40a4-be89-527224a6d4cc",
                "code" => "TNI-VC22001",
                "name" => "Paket Basic Member (Free)",
                
                "active_period" => 3,
                "access_type" => "basic_member",
                "type" => "month",
                "price_before_discount" => 50000,
                "price_after_discount" => 0,
                "description" => "<ul>\n<li class=\"pricing-list-item\"><span class=\"text-dark\"> Kategori Basic - <strong><span style=\"color: #169179;\">Yes</span></strong></span></li>\n<li class=\"pricing-list-item\"><span class=\"text-dark\">Mengikuti Try Out Akbar - <strong><span style=\"color: #169179;\">Yes</span></strong></span></li>\n<li><span class=\"text-dark\">Pembahasan untuk Tiap-tiap Soal - <span style=\"font-size: 10pt;\"><strong><span style=\"color: #e03e2d;\">No</span></strong></span></span></li>\n<li class=\"pricing-list-item\"><span class=\"text-dark\">Pembahasan Materi Sesuai Mata Pelajaran - <span style=\"font-size: 10pt;\"><strong><span style=\"color: #e03e2d;\">No</span></strong></span></span></li>\n<li class=\"pricing-list-item\"><span class=\"text-dark\">Group Telegram / Whatsapp Khusus - <span style=\"font-size: 10pt;\"><strong><span style=\"color: #e03e2d;\">No</span></strong></span></span></li>\n<li class=\"pricing-list-item\"><span class=\"text-dark\">Affiliate Program - <span style=\"font-size: 10pt;\"><strong><span style=\"color: #e03e2d;\">No</span></strong></span></span></li>\n</ul>",
                "is_active" => 0
            ],
            [
                "id" => "76e423b2-bda3-4ed2-9d5b-dd2ba6f4b660",
                "created_at" => "2023-01-20 06:29:08",
                "updated_at" => "2023-01-20 06:13:02",
                
                "category_id" => "ab1e771a-0037-40a4-be89-527224a6d4cc",
                "code" => "TNI-VC22002",
                "name" => "Paket Standard Member",
                
                "active_period" => 3,
                "access_type" => "standard_member",
                "type" => "month",
                "price_before_discount" => 149000,
                "price_after_discount" => 49000,
                "description" => "<ul>\n<li class=\"pricing-list-item\"><span class=\"text-dark\"> Kategori Standard - <strong><span style=\"color: #169179;\">Yes</span></strong></span></li>\n<li class=\"pricing-list-item\"><span class=\"text-dark\">Pembahasan untuk Tiap-tiap Soal - <strong><span style=\"color: #169179;\">Yes</span></strong></span></li>\n<li class=\"pricing-list-item\"><span class=\"text-dark\">Mengikuti Try Out - <strong><span style=\"color: #169179;\">Yes</span></strong></span></li>\n<li class=\"pricing-list-item\"><span class=\"text-dark\">Pembahasan Materi Sesuai Mata Pelajaran - <span style=\"font-size: 10pt;\"><strong><span style=\"color: #e03e2d;\">No</span></strong></span></span></li>\n<li class=\"pricing-list-item\"><span class=\"text-dark\">Group Telegram / Whatsapp Khusus - <span style=\"font-size: 10pt;\"><strong><span style=\"color: #e03e2d;\">No</span></strong></span></span></li>\n<li class=\"pricing-list-item\"><span class=\"text-dark\">Affiliate Program - <span style=\"font-size: 10pt;\"><strong><span style=\"color: #e03e2d;\">No</span></strong></span></span></li>\n</ul>",
                "is_active" => 0
            ],
            [
                "id" => "8bb8fffc-e303-4a10-a85a-e91f0b6d0b97",
                "created_at" => "2023-01-20 06:30:08",
                "updated_at" => "2023-01-20 06:13:06",
                
                "category_id" => "ab1e771a-0037-40a4-be89-527224a6d4cc",
                "code" => "TNI-VC22003",
                "name" => "Paket Standard Member",
                
                "active_period" => 6,
                "access_type" => "standard_member",
                "type" => "month",
                "price_before_discount" => 299000,
                "price_after_discount" => 79000,
                "description" => "<ul>\n<li class=\"pricing-list-item\"><span class=\"text-dark\"> Kategori Standard - <strong><span style=\"color: #169179;\">Yes</span></strong></span></li>\n<li class=\"pricing-list-item\"><span class=\"text-dark\">Pembahasan untuk Tiap-tiap Soal - <strong><span style=\"color: #169179;\">Yes</span></strong></span></li>\n<li class=\"pricing-list-item\"><span class=\"text-dark\">Mengikuti Try Out - <strong><span style=\"color: #169179;\">Yes</span></strong></span></li>\n<li class=\"pricing-list-item\"><span class=\"text-dark\">Pembahasan Materi Sesuai Mata Pelajaran - <span style=\"font-size: 10pt;\"><strong><span style=\"color: #e03e2d;\">No</span></strong></span></span></li>\n<li class=\"pricing-list-item\"><span class=\"text-dark\">Group Telegram / Whatsapp Khusus - <span style=\"font-size: 10pt;\"><strong><span style=\"color: #e03e2d;\">No</span></strong></span></span></li>\n<li class=\"pricing-list-item\"><span class=\"text-dark\">Affiliate Program - <span style=\"font-size: 10pt;\"><strong><span style=\"color: #e03e2d;\">No</span></strong></span></span></li>\n</ul>",
                "is_active" => 0
            ],
            [
                "id" => "8df7facf-713a-43df-936e-7ace97c5c91a",
                "created_at" => "2023-01-20 06:31:08",
                "updated_at" => "2023-01-20 06:13:11",
                
                "category_id" => "ab1e771a-0037-40a4-be89-527224a6d4cc",
                "code" => "TNI-VC22004",
                "name" => "Paket Standard Member",
                
                "active_period" => 12,
                "access_type" => "standard_member",
                "type" => "month",
                "price_before_discount" => 599000,
                "price_after_discount" => 149000,
                "description" => "<ul>\n<li class=\"pricing-list-item\"><span class=\"text-dark\"> Kategori Standard - <strong><span style=\"color: #169179;\">Yes</span></strong></span></li>\n<li class=\"pricing-list-item\"><span class=\"text-dark\">Pembahasan untuk Tiap-tiap Soal - <strong><span style=\"color: #169179;\">Yes</span></strong></span></li>\n<li class=\"pricing-list-item\"><span class=\"text-dark\">Mengikuti Try Out - <strong><span style=\"color: #169179;\">Yes</span></strong></span></li>\n<li class=\"pricing-list-item\"><span class=\"text-dark\">Pembahasan Materi Sesuai Mata Pelajaran - <span style=\"font-size: 10pt;\"><strong><span style=\"color: #e03e2d;\">No</span></strong></span></span></li>\n<li class=\"pricing-list-item\"><span class=\"text-dark\">Group Telegram / Whatsapp Khusus - <span style=\"font-size: 10pt;\"><strong><span style=\"color: #e03e2d;\">No</span></strong></span></span></li>\n<li class=\"pricing-list-item\"><span class=\"text-dark\">Affiliate Program - <span style=\"font-size: 10pt;\"><strong><span style=\"color: #e03e2d;\">No</span></strong></span></span></li>\n</ul>",
                "is_active" => 0
            ],
            [
                "id" => "55f74386-ff55-443a-8d46-d85a0f8b67e4",
                "created_at" => "2023-01-20 06:32:08",
                "updated_at" => "2023-01-20 06:13:14",
                
                "category_id" => "ab1e771a-0037-40a4-be89-527224a6d4cc",
                "code" => "TNI-VC22005",
                "name" => "Paket Premium Member",
                
                "active_period" => 3,
                "access_type" => "premium_member",
                "type" => "month",
                "price_before_discount" => 399000,
                "price_after_discount" => 129000,
                "description" => "<ul>\n<li class=\"pricing-list-item\"><span class=\"text-dark\"> Kategori Standard - <strong><span style=\"color: #169179;\">Yes</span></strong></span></li>\n<li class=\"pricing-list-item\"><span class=\"text-dark\">Pembahasan untuk Tiap-tiap Soal - <strong><span style=\"color: #169179;\">Yes</span></strong></span></li>\n<li class=\"pricing-list-item\"><span class=\"text-dark\">Mengikuti Try Out - <strong><span style=\"color: #169179;\">Yes</span></strong></span></li>\n<li class=\"pricing-list-item\"><span class=\"text-dark\">Pembahasan Materi Sesuai Mata Pelajaran - <strong><span style=\"color: #169179;\">Yes</span></strong></span></li>\n<li class=\"pricing-list-item\"><span class=\"text-dark\">Group Telegram / Whatsapp Khusus - <strong><span style=\"color: #169179;\">Yes</span></strong></span></li>\n<li class=\"pricing-list-item\"><span class=\"text-dark\">Affiliate Program - <strong><span style=\"color: #169179;\">Yes</span></strong></span></li>\n</ul>",
                "is_active" => 0
            ],
            [
                "id" => "967670a1-4686-4f89-8803-8dea89a4f890",
                "created_at" => "2023-01-20 06:33:08",
                "updated_at" => "2023-01-20 06:13:19",
                
                "category_id" => "ab1e771a-0037-40a4-be89-527224a6d4cc",
                "code" => "TNI-VC22006",
                "name" => "Paket Premium Member",
                
                "active_period" => 6,
                "access_type" => "premium_member",
                "type" => "month",
                "price_before_discount" => 799000,
                "price_after_discount" => 249000,
                "description" => "<ul>\n<li class=\"pricing-list-item\"><span class=\"text-dark\"> Kategori Standard - <strong><span style=\"color: #169179;\">Yes</span></strong></span></li>\n<li class=\"pricing-list-item\"><span class=\"text-dark\">Pembahasan untuk Tiap-tiap Soal - <strong><span style=\"color: #169179;\">Yes</span></strong></span></li>\n<li class=\"pricing-list-item\"><span class=\"text-dark\">Mengikuti Try Out - <strong><span style=\"color: #169179;\">Yes</span></strong></span></li>\n<li class=\"pricing-list-item\"><span class=\"text-dark\">Pembahasan Materi Sesuai Mata Pelajaran - <strong><span style=\"color: #169179;\">Yes</span></strong></span></li>\n<li class=\"pricing-list-item\"><span class=\"text-dark\">Group Telegram / Whatsapp Khusus - <strong><span style=\"color: #169179;\">Yes</span></strong></span></li>\n<li class=\"pricing-list-item\"><span class=\"text-dark\">Affiliate Program - <strong><span style=\"color: #169179;\">Yes</span></strong></span></li>\n</ul>",
                "is_active" => 0
            ],
            [
                "id" => "d8be46f9-813a-48a7-8316-e688a22b19d4",
                "created_at" => "2023-01-20 06:34:08",
                "updated_at" => "2023-01-20 06:13:23",
                
                "category_id" => "ab1e771a-0037-40a4-be89-527224a6d4cc",
                "code" => "TNI-VC22007",
                "name" => "Paket Premium Member",
                
                "active_period" => 12,
                "access_type" => "premium_member",
                "type" => "month",
                "price_before_discount" => 1499000,
                "price_after_discount" => 399000,
                "description" => "<ul>\n<li class=\"pricing-list-item\"><span class=\"text-dark\"> Kategori Standard - <strong><span style=\"color: #169179;\">Yes</span></strong></span></li>\n<li class=\"pricing-list-item\"><span class=\"text-dark\">Pembahasan untuk Tiap-tiap Soal - <strong><span style=\"color: #169179;\">Yes</span></strong></span></li>\n<li class=\"pricing-list-item\"><span class=\"text-dark\">Mengikuti Try Out - <strong><span style=\"color: #169179;\">Yes</span></strong></span></li>\n<li class=\"pricing-list-item\"><span class=\"text-dark\">Pembahasan Materi Sesuai Mata Pelajaran - <strong><span style=\"color: #169179;\">Yes</span></strong></span></li>\n<li class=\"pricing-list-item\"><span class=\"text-dark\">Group Telegram / Whatsapp Khusus - <strong><span style=\"color: #169179;\">Yes</span></strong></span></li>\n<li class=\"pricing-list-item\"><span class=\"text-dark\">Affiliate Program - <strong><span style=\"color: #169179;\">Yes</span></strong></span></li>\n</ul>",
                "is_active" => 0
            ]
        ]);
    }
}
