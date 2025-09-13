<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders',function(BluePrint $table){
            $table->enum('payment_status',['paid', 'not paid'])->after('grand_total')->default('not paid');
            $table->enum('status',['pending', 'delivered','shipped'])->after('payment_status')->default('pending');

     });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders',function(BluePrint $table){
            $table->dropColumn('payment_status');
            $table->dropColumn('status'); 
     });
    }
};
