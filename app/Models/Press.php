<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Press extends Model
{
	use HasFactory;

	protected $fillable = [
		'project_id',
		'title',
		'description',
		'year',
		'url',
		'media',
		'file',
		'publish',
	];

	protected $casts = [
		'publish' => 'boolean',
	];

	public function project(): BelongsTo
	{
		return $this->belongsTo(Project::class);
	}

	public function scopePublished($query)
	{
		return $query->where('publish', true);
	}
}
