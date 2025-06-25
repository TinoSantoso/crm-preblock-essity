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
        Schema::create('crm_headers', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('SAPID')->unique();
            $table->string('empID', 50)->unique();
            $table->string('PSName');
            $table->boolean('flagActive')->default(true);
            $table->integer('positionID');
            $table->string('positionName');
            $table->integer('managerID');
            $table->string('managerName');
            $table->integer('branchID');
            $table->string('station')->nullable();
            $table->date('joinDate');
            $table->string('email')->unique();
            $table->date('resignDate')->nullable();
            $table->string('branchShortName');
            $table->integer('areaCode');
            $table->string('areaName');
            $table->string('sales_hirearchy'); // Renamed 'Sales Hirearchy' to 'Sales_Hirearchy' for consistency
            $table->string('D365_username')->nullable();
            $table->integer('distID')->nullable();
            $table->string('distName')->nullable();
            $table->timestamps(); // Adds created_at and updated_at columns
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('crm_headers');
    }
};
