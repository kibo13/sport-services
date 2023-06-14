<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('places', function (Blueprint $table) {
            $table->id();
            $table->foreignId('group_id')
                ->nullable(false)
                ->constrained('groups')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignId('client_id')
                ->nullable(true)
                ->constrained('users')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->smallInteger('number');
            $table->boolean('is_busy')->default(false);
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
        Schema::dropIfExists('places');
    }
}
