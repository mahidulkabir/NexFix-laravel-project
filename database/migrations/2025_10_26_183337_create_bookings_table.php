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
       Schema::create('bookings', function (Blueprint $table) {
    $table->id();
    $table->foreignId('customer_id')->constrained('users')->onDelete('cascade');
    $table->foreignId('vendor_service_id')->constrained('vendor_services')->onDelete('cascade');
    $table->dateTime('booking_date');
    $table->enum('status', ['pending','confirmed','in_progress','completed','cancelled'])->default('pending');
    $table->decimal('total_amount', 10, 2);
    $table->text('address')->nullable();
    $table->enum('payment_status', ['unpaid','paid','refunded'])->default('unpaid');
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
