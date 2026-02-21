<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Project extends Model
{
	protected $fillable = [
		'category_id',
		'category_type_id',
		'title',
		'slug',
		'name',
		'location',
		'year',
		'description',
		'info',
		'status',
		'competition',
		'has_detail',
		'publish',
		'sort_order',
	];

	protected $casts = [
		'has_detail' => 'boolean',
		'publish' => 'boolean',
		'year' => 'integer',
		'sort_order' => 'integer',
	];

	public function category(): BelongsTo
	{
		return $this->belongsTo(Category::class);
	}

	public function categoryType(): BelongsTo
	{
		return $this->belongsTo(CategoryType::class);
	}

	public function media(): MorphMany
	{
		return $this->morphMany(Media::class, 'mediable')->orderBy('sort_order');
	}

	public function teaser(): MorphMany
	{
		return $this->morphMany(Media::class, 'mediable')->where('is_teaser', true);
	}
}
