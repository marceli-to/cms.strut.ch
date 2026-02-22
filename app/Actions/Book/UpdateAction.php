<?php

namespace App\Actions\Book;

use App\Models\Book;

class UpdateAction
{
	public function execute(Book $book, array $data): Book
	{
		$book->update($data);

		return $book->fresh();
	}
}
