<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Content extends Model
{
	use HasFactory;

	protected $table = 'content';

	protected $fillable = [
		'key',
		'title',
		'text',
		'media',
		'publish',
		'has_media',
	];

	protected $casts = [
		'publish' => 'boolean',
		'has_media' => 'boolean',
	];

	public function images(): HasMany
	{
		return $this->hasMany(ContentImage::class)->orderBy('order');
	}

	public function scopePublished($query)
	{
		return $query->where('publish', true);
	}
}
