<?php

namespace App\Actions\Press;

use App\Models\Press;

class UpdateAction
{
	public function execute(Press $press, array $data): Press
	{
		$press->update($data);

		return $press->fresh();
	}
}
