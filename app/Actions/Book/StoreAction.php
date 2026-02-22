<?php

namespace App\Actions\Book;

use App\Models\Book;

class StoreAction
{
	public function execute(array $data): Book
	{
		return Book::create($data);
	}
}
