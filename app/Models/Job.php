<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
	use HasFactory;

	protected $table = 'domain_jobs';

	protected $fillable = [
		'title',
		'lead',
		'info',
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
