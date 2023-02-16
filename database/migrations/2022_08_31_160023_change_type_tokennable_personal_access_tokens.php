<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeTypeTokennablePersonalAccessTokens extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('personal_access_tokens', function (Blueprint $table) {
            $table->dropcolumn('tokenable_type');
            $table->dropcolumn('tokenable_id');
        });

        Schema::table('personal_access_tokens', function (Blueprint $table) {
            $table->string('tokenable_type')->after('id');
            $table->string('tokenable_id', 36)->after('tokenable_type');
            $table->index(['tokenable_type', 'tokenable_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('personal_access_tokens', function (Blueprint $table) {
            $table->dropcolumn('tokenable_type');
            $table->dropcolumn('tokenable_id');
        });

        Schema::table('personal_access_tokens', function (Blueprint $table) {
            $table->string('tokenable_type')->after('id');
            $table->unsignedBigInteger('tokenable_id')->after('tokenable_type');
            $table->index(['tokenable_type', 'tokenable_id']);
        });
    }
}
