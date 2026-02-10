<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

return new class extends Migration
{
	public function up(): void
	{
		Schema::table('media', function (Blueprint $table) {
			$table->uuid('uuid')->nullable()->unique()->after('id');
			$table->string('original_name')->nullable()->after('file');
			$table->string('mime_type')->nullable()->after('original_name');
			$table->unsignedBigInteger('size')->nullable()->after('mime_type');
		});

		// Backfill UUIDs for existing records
		DB::table('media')->whereNull('uuid')->eachById(function ($record) {
			DB::table('media')->where('id', $record->id)->update(['uuid' => Str::uuid()]);
		});
	}

	public function down(): void
	{
		Schema::table('media', function (Blueprint $table) {
			$table->dropColumn(['uuid', 'original_name', 'mime_type', 'size']);
		});
	}
};
