<?php

namespace App\Actions\Book;

use App\Models\Book;
use Illuminate\Support\Facades\Storage;

class DeleteAction
{
	public function execute(Book $book): void
	{
		if ($book->media) {
			Storage::disk('public')->delete($book->media);
		}

		$book->delete();
	}
}
