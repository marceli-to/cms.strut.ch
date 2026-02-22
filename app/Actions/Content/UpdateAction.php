<?php

namespace App\Actions\Content;

use App\Models\Content;

class UpdateAction
{
	public function execute(Content $content, array $data): Content
	{
		$content->update($data);

		return $content->fresh();
	}
}
