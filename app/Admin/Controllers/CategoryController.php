<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
	/**
	 * Danh sách danh mục
	 */
	public function index()
	{
		// Danh sách danh mục
		$categories = Category::with('parent')->withCount('products')->paginate();

		// Tên trang
		$pageName = __('Quản lý danh mục');

		// Breadcrumb
		$breadcrumbs = [
			[
				'link' => route('admin::index'),
				'text' => __('Trang quản trị')
			],
			$pageName
		];

		$view = compact('categories', 'pageName', 'breadcrumbs');

		return view('admin::category.index')->with($view);
	}

	/**
	 * Xem chi tiết danh mục
	 */
	public function show($id)
	{
		// danh mục đang thao tác
		$category = Category::findOrFail($id);

		// Tên trang
		$pageName = __('Xem chi tiết danh mục');

		// Breadcrumb
		$breadcrumbs = [
			[
				'link' => route('admin::index'),
				'text' => __('Trang quản trị')
			],
			[
				'link' => route('admin::category.index'),
				'text' => __('Quản lý danh mục')
			],
			$pageName
		];

		$view = compact('pageName', 'category', 'breadcrumbs');

		return view('admin::category.show')->with($view);
	}

	/**
	 * Giao diện thêm mới
	 */
	public function create()
	{
		$pageName = __('Thêm danh mục');

		// Danh sách danh mục cha
		$categories = Category::getParent()->with('children:id,name,parent_id')->get(['id', 'name']);

		$view = compact('pageName', 'categories');

		return view('admin::category.create')->with($view);
	}

	/**
	 * Thêm danh mục vào database
	 */
	public function store(Request $request)
	{
		//Validation
		$validator = Validator::make($request->all(), [
			'name' => 'required|string|max:255',
			'slug' => 'required|string|max:255|unique:categories,slug',
			'parent_id' => 'nullable|exists:categories,id',
			'meta_title' => 'nullable|required_with:meta_description|string|max:255',
			'meta_description' => 'nullable|required_with:meta_title|string|max:1000',
		]);

		// validation fail
		if ($validator->fails()) {
			return $this->response($validator->errors(), 422, $validator->errors()->first());
		}

		// Cấp1
		$level = 1;

		// Nếu có danh mục cha thì
		if ($parentId = $request->get('parent_id')) {
			$level = 2;
			$parent = Category::findOrFail($parentId);

			// Nếu có danh mục cha
			if ($parent->parent) {
				$level = 3;
			}

		}

		Category::query()->create([
			'name' => $request->get('name'),
			'slug' => $request->get('slug'),
			'level' => $level,
			'parent_id' => $request->get('parent_id') ?? 0,
			'meta_title' => $request->get('meta_title'),
			'meta_description' => $request->get('meta_description'),
		]);

		return $this->response(null, 200, __('Thêm danh mục thành công'));
	}

	/**
	 * Giao diện chỉnh sửa
	 */
	public function edit($id)
	{
		$pageName = __('Chỉnh sửa danh mục');

		$category = Category::findOrFail($id);

		// Danh sách danh mục cha
		$categories = Category::getParent()->with('children:id,name,parent_id')->get(['id', 'name']);

		$view = compact('pageName', 'category','categories');

		return view('admin::category.edit')->with($view);
	}

	/**
	 * Cập nhật danh mục vào database
	 */
	public function update(Request $request,$id)
	{
		$category = Category::findOrFail($id);

		//Validation
		$validator = Validator::make($request->all(), [
			'name' => 'required|string|max:255',
			'slug' => 'required|string|max:255|unique:categories,slug,'.$id,
			'parent_id' => 'nullable|exists:categories,id',
			'meta_title' => 'nullable|required_with:meta_description|string|max:255',
			'meta_description' => 'nullable|required_with:meta_title|string|max:1000',
		]);

		// validation fail
		if ($validator->fails()) {
			return $this->response($validator->errors(), 422, $validator->errors()->first());
		}

		// Cấp1
		$level = 1;

		// Nếu có danh mục cha thì
		if ($parentId = $request->get('parent_id')) {
			$level = 2;
			$parent = Category::findOrFail($parentId);

			// Nếu có danh mục cha
			if ($parent->parent) {
				$level = 3;
			}

		}

		$category->update([
			'name' => $request->get('name'),
			'slug' => $request->get('slug'),
			'level' => $level,
			'parent_id' => $request->get('parent_id') ?? 0,
			'meta_title' => $request->get('meta_title'),
			'meta_description' => $request->get('meta_description'),
		]);

		return $this->response(null, 200, __('Cập nhật danh mục thành công'));
	}

	/**
	 * Xóa danh mục
	 */
	public function destroy($id)
	{
		$category = Category::withTrashed()->findOrFail($id);

		// Xóa các quan hệ sản phẩm
		$category->products()->detach();

		// Xóa vĩnh viễn
		if ($category->deleted_at) {
			$category->forceDelete();
		} else {
			//Xoá mềm - chuyển vào thùng rác
			$category->delete();
		}

		return $this->response(null, 200, __('Đã xoá danh mục thành công'));
	}

	/**
	 * Thùng rác
	 * Các danh mục bị xóa mềm
	 */
	public function trash()
	{
		$pageName = __('Thùng rác');

		// Danh sách danh mục bị xóa
		$categories = Category::onlyTrashed()->paginate();

		$view = compact('pageName', 'categories');

		return view('admin::category.trash')->with($view);
	}

	/**
	 * Khôi phụ danh mục bị xóa
	 */
	public function restore(Request $request, $id)
	{
		$category = Category::onlyTrashed()->findOrFail($id);
		$category->restore();
		return $this->response(null, 200, __('Khôi phục thành công'));
	}
}
