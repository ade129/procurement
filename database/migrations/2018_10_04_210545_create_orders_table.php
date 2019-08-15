<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('idorders');
            $table->integer('idusers');
            $table->string('code');
            // $table->integer('iditems');
            $table->date('due_date');
            $table->date('date_orders');
            $table->text('description');
            // $table->integer('quantity')->nullable();
            $table->integer('received_by')->nullable();
            $table->integer('accepted_by')->nullable();
            $table->enum('status',['p','w','a','f','h']);//pending ,wait,accepted,failed
            $table->softDeletes();
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
        Schema::dropIfExists('orders');
    }
}
