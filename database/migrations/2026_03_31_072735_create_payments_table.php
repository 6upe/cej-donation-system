<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();

            // Relationship
            $table->foreignId('participant_id')->constrained()->onDelete('cascade');

            // Payment Details
            $table->string('transaction_token')->nullable();
            $table->string('transaction_ref')->nullable(); // from DPO if available

            $table->decimal('amount', 10, 2);
            $table->string('currency');

            $table->string('payment_method'); // card, airtel, mtn
            $table->string('mno')->nullable(); // airtel, mtn
            $table->string('mno_country')->nullable();

            // Status tracking
            $table->string('status')->default('pending'); 
            // pending, success, failed

            $table->text('response_message')->nullable(); // DPO message
            $table->json('raw_response')->nullable(); // full DPO response

            // Payment timestamps
            $table->timestamp('paid_at')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
