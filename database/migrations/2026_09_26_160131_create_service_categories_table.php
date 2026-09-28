<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('service_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('badge_label')->nullable();
            $table->string('badge_color')->nullable();
            $table->string('icon')->nullable();
            $table->text('description')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->boolean('show_in_nav')->default(true);
            $table->boolean('show_in_footer')->default(true);

            // SEO
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->string('og_title')->nullable();
            $table->text('og_description')->nullable();
            $table->string('og_image')->nullable();
            $table->string('canonical_url')->nullable();
            $table->string('robots')->default('index, follow');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('service_categories');
    }
};
