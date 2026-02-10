<?php

namespace App\Actions\Post;

use App\Models\Post;

class DeleteAction
{
	public function execute(Post $post): void
	{
		$post->delete();
	}
}
