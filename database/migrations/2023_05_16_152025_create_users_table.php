<?php

use App\Models\Benefit;
use App\Models\Role;
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
            $table->foreignIdFor(Role::class)->nullable(false)->constrained()->cascadeOnUpdate();
            $table->foreignIdFor(Benefit::class)->nullable(true)->constrained()->cascadeOnUpdate();
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
