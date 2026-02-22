<?php

namespace App\Actions\Content;

use App\Models\Content;

class StoreAction
{
	public function execute(array $data): Content
	{
		return Content::create($data);
	}
}
