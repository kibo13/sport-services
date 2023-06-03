<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->integer('activity_id');
            $table->foreignId('service_id')->nullable(false)->constrained('services')->cascadeOnUpdate();
            $table->foreignId('client_id')->nullable(true)->constrained('users')->cascadeOnUpdate();
            $table->double('amount');
            $table->boolean('is_paid')->default(true);
            $table->date('paid_at')->nullable();
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
        Schema::dropIfExists('payments');
    }
}
