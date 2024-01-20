<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('product_category', function (Blueprint $table) {
            $table->dropColumn('position');
            $table->dropColumn('birthday');
            $table->dropColumn('address');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_category', function (Blueprint $table) {
            $table->string('position')->after('birthday');
            $table->date('birthday')->after('birthday');
            $table->string('address')->after('created_at');
        });
    }
};
