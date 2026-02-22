<?php

namespace App\Actions\News;

use App\Models\News;

class StoreAction
{
	public function execute(array $data): News
	{
		return News::create($data);
	}
}
