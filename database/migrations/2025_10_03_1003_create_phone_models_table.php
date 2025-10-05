<?php

use App\Models\Phone;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('phone_models', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('model');
            $table->string('model_number');
            $table->unsignedBigInteger('brand_id');
            $table->timestamps();

            // $table->foreignIdFor(Phone::class)->constrained()->onDelete('cascade');
            $table->foreign('brand_id')->references('id')->on('phones')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('phone_models');
    }
};
