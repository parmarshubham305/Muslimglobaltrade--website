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
        Schema::create('seller_extra_fields', function (Blueprint $table) {
            $table->id();
            $table->integer('seller_id')->index('seller_id_foreign_idx');
            $table->string('organization_type')->nullable();
            $table->string('business_type')->nullable();
            $table->string('website')->nullable();
            $table->text('documents')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seller_extra_fields');
    }
};
