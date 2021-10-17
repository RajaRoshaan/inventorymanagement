<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDamagedItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('damaged_items', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('inventory_id')->unsigned();
            $table->foreign('inventory_id')->references('id')->on('inventories')->onDelete('cascade');
            $table->string('description');
            $table->string('status');
            $table->boolean('repaired')->default(0)->nullable();
            $table->bigInteger('allocation_id')->unsigned()->nullable();
            $table->foreign('allocation_id')->references('id')->on('allocations')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('damaged_items');
    }
}
