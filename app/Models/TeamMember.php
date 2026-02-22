<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
	use HasFactory;

	protected $table = 'team';

	protected $fillable = [
		'name',
		'firstname',
		'role',
		'position',
		'phone',
		'email',
		'cv',
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
