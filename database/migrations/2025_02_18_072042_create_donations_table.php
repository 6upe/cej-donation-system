<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('donations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('donor_id')->constrained()->onDelete('cascade');
            $table->string('donation_type');
            $table->decimal('donation_amount', 15, 2);
            $table->string('donation_currency');
            $table->string('transaction_token');
            $table->string('transaction_id');
            $table->string('company_ref');
            $table->string('status')->default('Submitted');
            $table->string('ccd_approval')->nullable();
            $table->string('pnr_id')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('donations');
    }
};

