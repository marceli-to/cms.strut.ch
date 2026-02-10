<?php

namespace App\Actions\Post;

use App\Actions\Media\AttachAction as AttachMediaAction;
use App\Models\Post;
use Illuminate\Support\Str;

class StoreAction
{
	public function execute(array $data): Post
	{
		$media = $data['media'] ?? [];
		unset($data['media']);

		$data['slug'] = Str::slug($data['title']);

		$post = Post::create($data);

		if (!empty($media)) {
			(new AttachMediaAction)->execute($media, $post);
		}

		return $post;
	}
}
