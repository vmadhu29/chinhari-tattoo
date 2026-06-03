<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Portfolio / Gallery items
        Schema::create('portfolios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('artist_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('category_id')->nullable()->constrained('service_categories')->nullOnDelete();
            $table->foreignId('booking_id')->nullable()->constrained()->nullOnDelete();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->enum('media_type', ['image', 'video', 'before_after'])->default('image');
            $table->string('file_path')->nullable();
            $table->string('thumbnail_path')->nullable();
            $table->string('before_image_path')->nullable(); // for before/after
            $table->string('after_image_path')->nullable();
            $table->string('watermarked_path')->nullable();
            $table->boolean('has_watermark')->default(true);
            $table->json('tags')->nullable();
            $table->string('tattoo_style')->nullable(); // realism, tribal, etc.
            $table->string('body_placement')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_published')->default(true);
            $table->integer('likes_count')->default(0);
            $table->integer('views_count')->default(0);
            $table->integer('sort_order')->default(0);
            $table->string('alt_text')->nullable(); // SEO
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['category_id', 'is_published']);
            $table->index(['artist_id', 'is_published']);
            $table->index(['is_featured', 'is_published']);
        });

        // Photo/Video Galleries (Studio photos, events, behind the scenes)
        Schema::create('galleries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('branch_id')->nullable()->constrained()->nullOnDelete();
            $table->string('album_name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('cover_image')->nullable();
            $table->enum('type', ['photo', 'video', 'reel', 'short'])->default('photo');
            $table->string('file_path');
            $table->string('thumbnail_path')->nullable();
            $table->string('video_url')->nullable(); // YouTube/Instagram embed
            $table->boolean('is_published')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        // Blogs
        Schema::create('blog_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->timestamps();
        });

        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('blog_categories')->cascadeOnDelete();
            $table->foreignId('author_id')->constrained('users')->cascadeOnDelete();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('excerpt')->nullable();
            $table->longText('content');
            $table->string('featured_image')->nullable();
            $table->json('tags')->nullable();
            $table->enum('status', ['draft', 'published', 'scheduled'])->default('draft');
            $table->timestamp('published_at')->nullable();
            $table->integer('reading_time_minutes')->nullable();
            $table->integer('views_count')->default(0);
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('og_image')->nullable();
            $table->json('schema_markup')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['status', 'published_at']);
        });

        // Testimonials
        Schema::create('testimonials', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('artist_id')->nullable()->constrained()->nullOnDelete();
            $table->string('customer_name');
            $table->string('customer_avatar')->nullable();
            $table->string('customer_location')->nullable();
            $table->text('content');
            $table->unsignedTinyInteger('rating')->default(5); // 1-5
            $table->string('tattoo_style')->nullable();
            $table->string('photo_path')->nullable(); // photo of the tattoo
            $table->string('video_url')->nullable();
            $table->enum('source', ['manual', 'google', 'instagram', 'facebook'])->default('manual');
            $table->string('source_url')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_approved')->default(false);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        // FAQs
        Schema::create('faqs', function (Blueprint $table) {
            $table->id();
            $table->string('question');
            $table->text('answer');
            $table->string('category')->nullable(); // pricing, aftercare, general, etc.
            $table->boolean('is_published')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('faqs');
        Schema::dropIfExists('testimonials');
        Schema::dropIfExists('blogs');
        Schema::dropIfExists('blog_categories');
        Schema::dropIfExists('galleries');
        Schema::dropIfExists('portfolios');
    }
};
