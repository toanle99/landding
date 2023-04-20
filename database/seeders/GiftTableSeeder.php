<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Helpers\Qs;
use Illuminate\Support\Str;

class GiftTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    // 
 
    public function run()
    {
         
        $d = [  
            ['brand'  =>  'AEON VN',            'count' => '360',   'type' => 'voucher',    'date_start' => '2023-04-15', 'date_end' => '2024-01-15', 'content' => 'Voucher AVN 100k' ], 
            ['brand'  =>  'AEON VN',            'count' => '280',   'type' => 'voucher',    'date_start' => '2023-04-15', 'date_end' => '2024-01-15', 'content' => 'Voucher AVN 50k' ], 
            ['brand'  =>  'AEON VN',            'count' => '300',   'type' => 'voucher',    'date_start' => '2023-04-15', 'date_end' => '2024-01-15', 'content' => 'Voucher AVN 50k' ], 
            ['brand'  =>  'KFC',                'count' => '200',   'type' => 'e-voucher',  'date_start' => '2023-04-15', 'date_end' => '2024-01-15', 'content' => 'code Kem (HSD < 3 tuần)' ], 
            ['brand'  =>  'CHARLES & KEITH',    'count' => '6',     'type' => 'voucherin',  'date_start' => '2023-04-15', 'date_end' => '2024-01-15', 'content' => 'Voucher 1 triệu C&K' ], 
            ['brand'  =>  'KOHNAN',             'count' => '200',   'type' => 'vật phẩm',   'date_start' => '2023-04-15', 'date_end' => '2024-01-15', 'content' => 'Tô sứ Kohnan' ], 
            ['brand'  =>  'KOHNAN',             'count' => '200',   'type' => 'vật phẩm',   'date_start' => '2023-04-15', 'date_end' => '2024-01-15', 'content' => 'Bộ thìa gỗ Kohnan' ], 
            ['brand'  =>  'INOCHI',             'count' => '200',   'type' => 'vật phẩm',   'date_start' => '2023-04-15', 'date_end' => '2024-01-15', 'content' => 'Hộp thực phẩm chữ nhật Hokkaido 1000ml' ], 
            ['brand'  =>  'INOCHI',             'count' => '200',   'type' => 'vật phẩm',   'date_start' => '2023-04-15', 'date_end' => '2024-01-15', 'content' => 'khay đá sáng tạo' ], 
            ['brand'  =>  'PEPPER LUNCH',       'count' => '195',   'type' => 'e-voucher',  'date_start' => '2023-04-15', 'date_end' => '2024-01-15', 'content' => 'Voucher 100k của Pepper Lunch' ], 
            ['brand'  =>  'HOKKAIDO',           'count' => '200',   'type' => 'voucher',    'date_start' => '2023-04-15', 'date_end' => '2024-01-15', 'content' => 'Voucher 30k của Hokkaido' ], 
            ['brand'  =>  'KATINAT',            'count' => '100',   'type' => 'voucher',    'date_start' => '2023-04-15', 'date_end' => '2024-01-15', 'content' => 'Buy 1 get 1' ], 
            ['brand'  =>  'QUICHES',            'count' => '200',   'type' => 'voucher',    'date_start' => '2023-04-15', 'date_end' => '2024-01-15', 'content' => 'Voucher Quiches 39k' ], 
            ['brand'  =>  'LANGFARM',           'count' => '200',   'type' => 'voucher',    'date_start' => '2023-04-15', 'date_end' => '2024-01-15', 'content' => 'voucher langfarm 30k' ], 
            ['brand'  =>  'MOLLY FANTASY',      'count' => '200',   'type' => 'voucher',    'date_start' => '2023-04-15', 'date_end' => '2024-01-15', 'content' => 'voucher vào cổng miễn phí' ], 
            ['brand'  =>  'DREAMGAMES',         'count' => '200',   'type' => 'voucher',    'date_start' => '2023-04-15', 'date_end' => '2024-01-15', 'content' => 'voucher free 10 xu' ],                         
        ]; 

        DB::table('gifts')->insert($d);
    }

}
