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
        Schema::create('repairs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ticket_number')->unique();
            $table->foreignId('customer_id')->constrained()->onDelete('cascade');
            $table->string('phone_number');
            $table->foreignId('device_brand_id')->constrained('phones')->onDelete('cascade');
            $table->foreignId('device_model_id')->constrained('phone_models')->onDelete('cascade');
            $table->text('issue_description');
            // $table->enum('status', ['pending', 'in_progress', 'completed', 'ready_pickup', 'picked_up']);
            $table->foreignId('status_id')->constrained('statuses')->onDelete('cascade');
            // $table->enum('priority', ['low', 'medium', 'high', 'urgent'])->default('medium');
            $table->foreignId('priority_id')->constrained('priorities')->onDelete('cascade');
            $table->decimal('estimated_cost', 10, 2)->nullable();
            $table->decimal('final_cost', 10, 2)->nullable();
            $table->date('repair_date')->nullable();
            $table->date('completion_date')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('repairs');
    }
};
