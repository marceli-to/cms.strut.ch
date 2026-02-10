<?php

namespace App\Http\Controllers;

class TeamController extends Controller
{
	public function show(string $slug)
	{
		$members = collect([
			[
				'firstname' => 'Anna',
				'name' => 'Müller',
				'title' => 'M. Sc. Arch ETH',
				'since' => '2018',
				'email' => 'anna.mueller@weberbrunner.ch',
				'location' => 'zuerich',
				'image' => 'images/dummy-team-1.jpg',
				'slug' => 'anna-mueller',
				'birthplace' => 'Zürich',
				'cv' => [
					['period' => '2010 – 2015', 'description' => 'Architekturstudium an der ETH Zürich | Austauschsemester an der TU Delft, Niederlande | Wissenschaftliche Mitarbeit und Publikationen am Lehrstuhl für Konstruktion und Entwurf, Prof. Andrea Deplazes'],
					['period' => '2015 – 2018', 'description' => 'Mitarbeit im Büro weberbrunner architekten AG'],
					['period' => 'seit 2018', 'description' => 'Projektleiterin weberbrunner architekten | Architektin BDA | Mitglied im SIA Section Zürich'],
					['period' => '2020 – 2023', 'description' => 'Mitglied Fachkommission Städtebau Zürich'],
					['period' => 'seit 2022', 'description' => 'Dozentin für Entwurf an der ZHAW Winterthur'],
				],
			],
		]);

		$member = $members->firstWhere('slug', $slug);

		if (!$member) {
			abort(404);
		}

		return view('pages.about.team-show', compact('member'));
	}
}
