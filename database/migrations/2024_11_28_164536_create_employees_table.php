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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('firstLastName');
            $table->string('secondLastName');
            $table->string('firstName');
            $table->string('middleName');
            $table->string('country');
            $table->string('typeId');
            $table->string('doc');
            $table->string('email');
            $table->date('startDate');
            $table->string('area');
            $table->string('state')->default('Active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
