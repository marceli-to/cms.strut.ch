<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	public function up(): void
	{
		Schema::create('news', function (Blueprint $table) {
			$table->id();
			$table->string('date')->nullable();
			$table->string('subtitle')->nullable();
			$table->string('title');
			$table->text('text')->nullable();
			$table->string('link')->nullable();
			$table->string('link_text')->nullable();
			$table->string('media')->nullable();
			$table->timestamps();
		});
	}

	public function down(): void
	{
		Schema::dropIfExists('news');
	}
};
