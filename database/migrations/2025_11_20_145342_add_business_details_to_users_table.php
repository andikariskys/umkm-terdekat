<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Kolom tambahan sesuai form edit profile
            $table->string('business_email')->nullable()->after('business_category');
            $table->text('business_description')->nullable()->after('business_email');
            $table->text('business_map')->nullable()->after('business_description');
            $table->string('business_instagram')->nullable()->after('business_map');
            $table->string('business_photo')->nullable()->after('business_instagram'); // Path foto
            $table->string('business_hours')->nullable()->after('business_photo');
            $table->boolean('show_stock')->default(true)->after('business_hours');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'business_email',
                'business_description',
                'business_map',
                'business_instagram',
                'business_photo',
                'business_hours',
                'show_stock'
            ]);
        });
    }
};
