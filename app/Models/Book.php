<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
	use HasFactory;

	protected $fillable = [
		'title',
		'description',
		'info',
		'url',
		'media',
		'order',
		'publish',
	];

	protected $casts = [
		'order' => 'integer',
		'publish' => 'boolean',
	];

	public function scopePublished($query)
	{
		return $query->where('publish', true);
	}
}
