<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('role_id')->nullable(false)->constrained('roles')->cascadeOnUpdate();
            $table->foreignId('benefit_id')->nullable(true)->constrained('benefits')->cascadeOnUpdate();
            $table->foreignId('education_id')->nullable(true)->constrained('educations')->cascadeOnUpdate();
            $table->string('name');
            $table->string('surname');
            $table->string('patronymic')->nullable();
            $table->string('full_name')->nullable();
            $table->string('short_name')->nullable();
            $table->string('surname_name')->nullable();
            $table->date('birthday')->nullable();
            $table->smallInteger('age')->nullable();
            $table->string('phone', 10)->nullable()->unique();
            $table->string('email')->unique();
            $table->string('photo')->nullable();
            $table->string('address')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->boolean('is_notify')->default(false);
            $table->boolean('is_hidden')->default(false);
            $table->smallInteger('experience')->nullable();
            $table->text('note')->nullable();
            $table->string('certificate')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
