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
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('email_verified')->default(0);
            $table->string('email_verify_token')->nullable();
            $table->string('phone_number')->nullable();
            $table->dateTime('birthday')->nullable();
            $table->dateTime('address')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('email_verified'); 
            $table->dropColumn('email_verify_token');
            $table->dropColumn('phone_number');
            $table->dropColumn('birthday');
            $table->dropColumn('address');
        });
    }
};
