<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\View\View;

class LandingController extends Controller
{
	public function __invoke(): View
	{
		$projects = Project::query()
			->with(['media' => fn ($q) => $q->where('is_teaser', true)])
			->latest()
			->get()
			->map(function (Project $project) {
				$media = $project->media->first();
				return [
					'title' => $project->title,
					'slug' => $project->slug,
					'image' => $media?->file ?? 'images/dummy-teaser-1.jpg',
					'orientation' => $media?->orientation ?? 'unknown',
				];
			});

		return view('pages.landing', [
			'columns' => $this->splitIntoColumns($projects, 3),
		]);
	}

	protected function splitIntoColumns($items, int $count): array
	{
		$columns = array_fill(0, $count, []);

		foreach ($items->values() as $index => $item) {
			$columns[$index % $count][] = $item;
		}

		return $columns;
	}
}
