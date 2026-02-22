<?php

namespace App\Actions\Lecture;

use App\Models\Lecture;

class StoreAction
{
	public function execute(array $data): Lecture
	{
		return Lecture::create($data);
	}
}
