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
        Schema::create('participants', function (Blueprint $table) {
            $table->id();

            // Basic Info
            $table->string('name');
            $table->string('email');
            $table->string('phone');

            // Event Info
            $table->string('product'); 
            $table->decimal('amount', 10, 2);
            $table->string('currency');

            // Registration Details
            $table->string('ticket_package');
            $table->string('delegate_category');

            // Location
            $table->string('province');
            $table->string('district');

            // Organisation Info
            $table->string('organisation');
            $table->string('job_title');

            // Marketing
            $table->string('referral')->nullable();

            // Payment tracking (important for DPO)
            $table->string('transaction_token')->nullable();
            $table->string('payment_status')->default('pending'); // pending, paid, failed
            $table->string('product_status')->default('initial'); // registered, attended, cancelled, collected
            $table->string('ticket_code')->nullable(); // Unique code for ticket collection

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations. php artisan migrate --path=/database/migrations/2026_03_31_072151_create_participants_table.php
     */
    public function down(): void
    {
        Schema::dropIfExists('participants');
    }
};
