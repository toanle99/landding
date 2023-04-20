<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGiftsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gifts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('brand')->nullable();
            $table->integer('count');
            $table->string('type')->nullable();
            $table->string('content')->nullable();
            $table->string('image')->nullable();
            $table->string('date_start')->nullable();
            $table->string('date_end')->nullable();
            $table->string('shows')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gifts');
    }
}
 

// insert into gifts(brand, count, created_at, type, content, image) values( "AEON VN",	         360,    NOW(),	    "voucher",	    "Voucher AVN 100k");
// insert into gifts(brand, count, created_at, type, content, image) values( "AEON VN",	         280,    NOW(),	    "voucher",	    "Voucher AVN 50k");
// insert into gifts(brand, count, created_at, type, content, image) values( "AEON VN",	         300,    NOW(),	    "voucher",	    "Voucher AVN 50k");
// insert into gifts(brand, count, created_at, type, content, image) values( "KFC",	             200,    NOW(),	    "e-voucher",	"code Kem (HSD < 3 tuần)");
// insert into gifts(brand, count, created_at, type, content, image) values( "CHARLES & KEITH",	 6,	     NOW(),     "voucher",	    "Voucher 1 triệu C&K");
// insert into gifts(brand, count, created_at, type, content, image) values( "KOHNAN",	         200,    NOW(),	    "vật phẩm",	    "Tô sứ Kohnan");
// insert into gifts(brand, count, created_at, type, content, image) values( "KOHNAN",	         200,    NOW(),	    "vật phẩm",	    "Bộ thìa gỗ Kohnan");
// insert into gifts(brand, count, created_at, type, content, image) values( "INOCHI",	         200,    NOW(),	    "vật phẩm",	    "Hộp thực phẩm chữ nhật Hokkaido 1000ml");
// insert into gifts(brand, count, created_at, type, content, image) values( "INOCHI",	         200,    NOW(),	    "vật phẩm",	    "khay đá sáng tạo");
// insert into gifts(brand, count, created_at, type, content, image) values( "PEPPER LUNCH",	 195,    NOW(),	    "e-voucher",	"Voucher 100k của Pepper Lunch");
// insert into gifts(brand, count, created_at, type, content, image) values( "HOKKAIDO",	     200,    NOW(),	    "voucher",	    "Voucher 30k của Hokkaido");
// insert into gifts(brand, count, created_at, type, content, image) values( "KATINAT",	         100,    NOW(),	    "voucher",	    "Buy 1 get 1");
// insert into gifts(brand, count, created_at, type, content, image) values( "QUICHES",	         200,    NOW(),	    "voucher",	    "Voucher Quiches 39k");
// insert into gifts(brand, count, created_at, type, content, image) values( "LANGFARM",	     200,    NOW(),	    "voucher",	    "voucher langfarm 30k");
// insert into gifts(brand, count, created_at, type, content, image) values( "MOLLY FANTASY",	 200,    NOW(),	    "voucher",	    "voucher vào cổng miễn phí");
// insert into gifts(brand, count, created_at, type, content, image) values( "DREAMGAMES",	     200,    NOW(),	    "voucher",	    "voucher free 10 xu");
