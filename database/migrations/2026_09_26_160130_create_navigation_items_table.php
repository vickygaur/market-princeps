<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('navigation_items', function (Blueprint $table) {
            $table->id();
            $table->string('location')->default('header');
            $table->foreignId('parent_id')->nullable()->constrained('navigation_items')->nullOnDelete();
            $table->string('label');
            $table->string('url')->nullable();
            $table->string('type')->default('link');
            $table->string('icon')->nullable();
            $table->string('badge_color')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->boolean('open_in_new_tab')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('navigation_items');
    }
};
