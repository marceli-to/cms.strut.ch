<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\CategoryTypeResource;
use App\Models\Category;
use App\Models\CategoryType;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
	public function index()
	{
		$categories = Category::with('types')->orderBy('sort_order')->get();

		return CategoryResource::collection($categories);
	}

	public function store(Request $request)
	{
		$data = $request->validate([
			'name' => 'required|string|max:255',
			'publish' => 'boolean',
		]);

		$data['sort_order'] = Category::max('sort_order') + 1;

		$category = Category::create($data);

		return new CategoryResource($category->load('types'));
	}

	public function update(Request $request, Category $category)
	{
		$data = $request->validate([
			'name' => 'required|string|max:255',
			'publish' => 'boolean',
		]);

		$category->update($data);

		return new CategoryResource($category->load('types'));
	}

	public function togglePublish(Category $category)
	{
		$category->update(['publish' => !$category->publish]);

		return new CategoryResource($category->load('types'));
	}

	public function destroy(Category $category)
	{
		$category->delete();

		return response()->json(null, 204);
	}

	public function storeType(Request $request, Category $category)
	{
		$data = $request->validate([
			'name' => 'required|string|max:255',
			'name_singular' => 'nullable|string|max:255',
			'publish' => 'boolean',
		]);

		$data['category_id'] = $category->id;
		$data['sort_order'] = $category->types()->max('sort_order') + 1;

		$type = CategoryType::create($data);

		return new CategoryTypeResource($type);
	}

	public function updateType(Request $request, Category $category, CategoryType $type)
	{
		$data = $request->validate([
			'name' => 'required|string|max:255',
			'name_singular' => 'nullable|string|max:255',
			'publish' => 'boolean',
		]);

		$type->update($data);

		return new CategoryTypeResource($type);
	}

	public function destroyType(Category $category, CategoryType $type)
	{
		$type->delete();

		return response()->json(null, 204);
	}

	public function reorderTypes(Request $request, Category $category)
	{
		$data = $request->validate([
			'items' => 'required|array',
			'items.*.id' => 'required|integer',
			'items.*.sort_order' => 'required|integer',
		]);

		foreach ($data['items'] as $item) {
			$category->types()->where('id', $item['id'])->update(['sort_order' => $item['sort_order']]);
		}

		return response()->json(null, 204);
	}
}
