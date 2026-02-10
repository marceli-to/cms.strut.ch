<?php

namespace App\Actions\Post;

use App\Actions\Media\AttachAction as AttachMediaAction;
use App\Models\Post;
use Illuminate\Support\Str;

class UpdateAction
{
	public function execute(Post $post, array $data): Post
	{
		$media = $data['media'] ?? [];
		unset($data['media']);

		$data['slug'] = Str::slug($data['title']);

		$post->update($data);

		if (!empty($media)) {
			(new AttachMediaAction)->execute($media, $post);
		}

		return $post;
	}
}
