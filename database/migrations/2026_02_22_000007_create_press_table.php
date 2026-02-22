<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	public function up(): void
	{
		Schema::create('press', function (Blueprint $table) {
			$table->id();
			$table->foreignId('project_id')->nullable()->constrained()->nullOnDelete();
			$table->string('title');
			$table->text('description')->nullable();
			$table->string('year');
			$table->string('url')->nullable();
			$table->string('media')->nullable();
			$table->string('file')->nullable();
			$table->boolean('publish')->default(true);
			$table->timestamps();
		});
	}

	public function down(): void
	{
		Schema::dropIfExists('press');
	}
};
