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
        // Add Arabic columns to categories table
        Schema::table('categories', function (Blueprint $table) {
            $table->string('name_ar')->nullable()->after('name');
            $table->text('description_ar')->nullable()->after('description');
        });

        // Add Arabic columns to products table
        Schema::table('products', function (Blueprint $table) {
            $table->string('name_ar')->nullable()->after('name');
            $table->text('short_description_ar')->nullable()->after('short_description');
            $table->text('description_ar')->nullable()->after('description');
            $table->string('unit_of_measure_ar')->nullable()->after('unit_of_measure');
        });

        // Add Arabic columns to pages table
        Schema::table('pages', function (Blueprint $table) {
            $table->string('title_ar')->nullable()->after('title');
            $table->longText('content_ar')->nullable()->after('content');
            $table->string('meta_title_ar')->nullable()->after('meta_title');
            $table->string('meta_description_ar')->nullable()->after('meta_description');
        });

        // Add Arabic columns to posts table
        Schema::table('posts', function (Blueprint $table) {
            $table->string('title_ar')->nullable()->after('title');
            $table->text('excerpt_ar')->nullable()->after('excerpt');
            $table->longText('content_ar')->nullable()->after('content');
            $table->string('meta_title_ar')->nullable()->after('meta_title');
            $table->string('meta_description_ar')->nullable()->after('meta_description');
        });

        // Add Arabic columns to banners table
        Schema::table('banners', function (Blueprint $table) {
            $table->string('title_ar')->nullable()->after('title');
            $table->string('subtitle_ar')->nullable()->after('subtitle');
            $table->text('description_ar')->nullable()->after('description');
            $table->string('link_text_ar')->nullable()->after('link_text');
        });

        // Add Arabic columns to faqs table
        Schema::table('faqs', function (Blueprint $table) {
            $table->string('question_ar')->nullable()->after('question');
            $table->text('answer_ar')->nullable()->after('answer');
        });

        // Add Arabic columns to testimonials table
        Schema::table('testimonials', function (Blueprint $table) {
            $table->string('name_ar')->nullable()->after('name');
            $table->string('role_ar')->nullable()->after('role');
            $table->text('content_ar')->nullable()->after('content');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Remove Arabic columns from categories table
        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn(['name_ar', 'description_ar']);
        });

        // Remove Arabic columns from products table
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['name_ar', 'short_description_ar', 'description_ar', 'unit_of_measure_ar']);
        });

        // Remove Arabic columns from pages table
        Schema::table('pages', function (Blueprint $table) {
            $table->dropColumn(['title_ar', 'content_ar', 'meta_title_ar', 'meta_description_ar']);
        });

        // Remove Arabic columns from posts table
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn(['title_ar', 'excerpt_ar', 'content_ar', 'meta_title_ar', 'meta_description_ar']);
        });

        // Remove Arabic columns from banners table
        Schema::table('banners', function (Blueprint $table) {
            $table->dropColumn(['title_ar', 'subtitle_ar', 'description_ar', 'link_text_ar']);
        });

        // Remove Arabic columns from faqs table
        Schema::table('faqs', function (Blueprint $table) {
            $table->dropColumn(['question_ar', 'answer_ar']);
        });

        // Remove Arabic columns from testimonials table
        Schema::table('testimonials', function (Blueprint $table) {
            $table->dropColumn(['name_ar', 'role_ar', 'content_ar']);
        });
    }
};
