<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('quotes', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('user_id')->index('inquiry_user_id_foreign_idx');
            $table->bigInteger('product_id')->index('inquiry_product_id_foreign_idx');
            $table->bigInteger('quantity');
            $table->string('unit')->nullable();
            $table->bigInteger('preferred_unit_price')->nullable();
            $table->string('details')->nullable();
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quotes');
    }
};
