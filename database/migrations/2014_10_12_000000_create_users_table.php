<?php

use App\Domains\Auth\Models\User;
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
            $table->bigIncrements('id');
            $table->enum('type', [User::TYPE_ADMIN, User::TYPE_USER])->default(User::TYPE_USER);
            $table->string('name');
            $table->string('email')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->timestamp('password_changed_at')->nullable();
            $table->unsignedTinyInteger('active')->default(1);
            $table->string('timezone')->nullable();
            $table->timestamp('last_login_at')->nullable();
            $table->string('last_login_ip')->nullable();
            $table->boolean('to_be_logged_out')->default(false);
            $table->string('provider')->nullable();
            $table->string('provider_id')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('customer_details', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('user_id');
            $table->smallInteger('sex')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('addr_number')->nullable();
            $table->string('addr_street')->nullable();
            $table->unsignedInteger('city_id');
            $table->unsignedInteger('district_id');
            $table->unsignedInteger('ward_id');
            $table->timestamp('birth')->nullable();
            $table->timestamp('first_buy_date')->nullable();
            $table->timestamp('last_buy_date')->nullable();
            $table->decimal('buy_times', 10, 0)->default(0);
            $table->decimal('buy_total', 12, 2)->default(0.00);
            $table->string('reset_key')->nullable();
            $table->timestamp('reset_expire')->nullable();
            $table->decimal('point', 12, 0)->default(0);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('city_id')->references('id')->on('cities');
            $table->foreign('district_id')->references('id')->on('districts');
            $table->foreign('ward_id')->references('id')->on('wards');
        });

        Schema::create('customer_addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('user_id');
            $table->string('name');
            $table->unsignedInteger('city_id');
            $table->unsignedInteger('district_id');
            $table->unsignedInteger('ward_id');
            $table->string('addr_number');
            $table->string('addr_street');
            $table->string('company_name')->nullable();
            $table->string('phone_number');
            $table->boolean('deliveryAddressType')->default(0);
            $table->boolean('deliveryAddressDefault')->default(0);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('city_id')->references('id')->on('cities');
            $table->foreign('district_id')->references('id')->on('districts');
            $table->foreign('ward_id')->references('id')->on('wards');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customer_addresses');
        Schema::dropIfExists('customer_details');
        Schema::dropIfExists('users');
    }
}
