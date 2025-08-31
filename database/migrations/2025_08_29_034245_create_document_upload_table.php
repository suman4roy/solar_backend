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
        Schema::create('document_uploads', function (Blueprint $table) {
            $table->id();
            $table->string('aadhar_card_front')->nullable();
            $table->string('aadhar_card_back')->nullable();
            $table->string('aadhar_card_no')->nullable();
            $table->string('electricity_bill')->nullable();
            $table->string('pan_card_front')->nullable();
            $table->string('pan_card_back')->nullable();
            $table->string('pan_card_no')->nullable();
            $table->string('bank_cancelled_cheque')->nullable();
            $table->string('consumer_no')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('document_uploads');
    }
};
