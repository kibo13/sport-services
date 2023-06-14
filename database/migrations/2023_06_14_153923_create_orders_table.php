<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('subject');
            $table->foreignId('activity_id')->nullable(true)->constrained('activities')->cascadeOnUpdate();
            $table->foreignId('client_id')->nullable(true)->constrained('users')->cascadeOnUpdate();
            $table->foreignId('trainer_id')->nullable(true)->constrained('users')->cascadeOnUpdate();
            $table->foreignId('executor_id')->nullable(true)->constrained('users')->cascadeOnUpdate();
            $table->foreignId('status_id')->nullable(false)->constrained('order_statuses')->cascadeOnUpdate();
            $table->text('message')->nullable(true);
            $table->text('comment')->nullable(true);
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
