<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	public function up(): void
	{
		Schema::create('content', function (Blueprint $table) {
			$table->id();
			$table->string('key')->unique();
			$table->string('title');
			$table->text('text')->nullable();
			$table->string('media')->nullable();
			$table->boolean('publish')->default(true);
			$table->boolean('has_media')->default(false);
			$table->timestamps();
		});

		Schema::create('content_images', function (Blueprint $table) {
			$table->id();
			$table->foreignId('content_id')->constrained('content')->cascadeOnDelete();
			$table->string('name')->nullable();
			$table->string('caption')->nullable();
			$table->boolean('publish')->default(true);
			$table->unsignedInteger('order')->default(0);
			$table->timestamps();
		});
	}

	public function down(): void
	{
		Schema::dropIfExists('content_images');
		Schema::dropIfExists('content');
	}
};
