<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //  name, dob, gender, phone, thanhpho, quan, pttt, bietct, pttttm, cuahang, gthd
        Schema::create('members', function (Blueprint $table) {
            $table->increments('id'); 
            $table->string('name');
            $table->string('dob')->nullable();
            $table->string('gender')->nullable(); 
            $table->string('phone')->nullable();
            $table->string('thanhpho')->nullable();
            $table->string('quan')->nullable();
            $table->string('pttt')->nullable();
            $table->string('bietct')->nullable();
            $table->string('pttttm')->nullable();
            // $table->string('cuahang')->nullable();
            $table->string('sum_gthd')->nullable(); 
            $table->string('signature')->nullable();
            $table->string('gift_id')->nullable(); 

            
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
        Schema::dropIfExists('members');
    }
}
 