<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lecture extends Model
{
	use HasFactory;

	protected $fillable = [
		'title',
		'description',
		'year',
		'media',
		'file',
		'url',
		'publish',
	];

	protected $casts = [
		'publish' => 'boolean',
	];

	public function scopePublished($query)
	{
		return $query->where('publish', true);
	}
}
