<?php

namespace App\Actions\Lecture;

use App\Models\Lecture;

class UpdateAction
{
	public function execute(Lecture $lecture, array $data): Lecture
	{
		$lecture->update($data);

		return $lecture->fresh();
	}
}
