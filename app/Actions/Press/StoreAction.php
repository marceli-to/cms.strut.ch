<?php

namespace App\Actions\Press;

use App\Models\Press;

class StoreAction
{
	public function execute(array $data): Press
	{
		return Press::create($data);
	}
}
