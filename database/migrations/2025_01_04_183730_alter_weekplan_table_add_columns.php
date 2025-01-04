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
        Schema::table('week_plans', function (Blueprint $table) {
            $table->unsignedBigInteger('sunday_dish_id')->after('name')->nullable();
            $table->unsignedBigInteger('saturday_dish_id')->after('name')->nullable();
            $table->unsignedBigInteger('friday_dish_id')->after('name')->nullable();
            $table->unsignedBigInteger('thursday_dish_id')->after('name')->nullable();
            $table->unsignedBigInteger('wednesday_dish_id')->after('name')->nullable();
            $table->unsignedBigInteger('tuesday_dish_id')->after('name')->nullable();
            $table->unsignedBigInteger('monday_dish_id')->after('name')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('week_plans', function (Blueprint $table) {
            $table->dropColumn('sunday_dish_id');
            $table->dropColumn('saturday_dish_id');
            $table->dropColumn('friday_dish_id');
            $table->dropColumn('thursday_dish_id');
            $table->dropColumn('wednesday_dish_id');
            $table->dropColumn('tuesday_dish_id');
            $table->dropColumn('monday_dish_id');
        });
    }
};
