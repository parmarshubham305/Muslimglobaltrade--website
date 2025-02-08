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
        Schema::table('shops', function (Blueprint $table) {
            $table->string('organization_type')->after('vendor_id')->nullable();
            $table->string('business_type')->after('organization_type')->nullable();
            $table->text('personal_document')->after('business_type')->nullable();
            $table->text('organization_document')->after('personal_document')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('shops', function (Blueprint $table) {
            $table->dropColumn(['organization_type', 'business_type', 'personal_document', 'organization_document']);
        });
    }
};
