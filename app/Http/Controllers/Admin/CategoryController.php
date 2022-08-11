<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Services\UploadService;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{

    public function __construct()
    {
        $this->listCategory = Category::all();
    }
    
    public function index()
    {
        return view('screen.admin.category.list', ['categories' => $this->listCategory]);
    }

    public function create()
    {
        return view('screen.admin.category.create', ['categories' => $this->listCategory]);
    }

    public function store(CategoryRequest $request)
    {

        try{
            $category = new Category();
            $category->fill($request->all());
            if($request->hasFile('image')){
                $category->image = UploadService::upload($request->file('image'), 'category');
            } else {
                $category->image = 'images/category/default.png';
            }
            $category->save();
            return redirect()
                    ->route('admin.category.list')
                    ->with('success', 'Thêm danh mục thành công');
        }catch(\Exception $e){
            Log::error($e->getMessage());
            return redirect()
                    ->back()
                    ->withInput()
                    ->with('error', 'Có lỗi xảy ra vui lòng thử lại');
        }

    }

    public function edit(Category $category){
        return view('screen.admin.category.edit', [
            'category'      => $category,
            'categories'    => $this->listCategory->except($category->id)
        ]);
    }


    public function update(CategoryUpdateRequest $request, Category $category){

        try{
            $category->fill($request->all());
            if($request->hasFile('image')){
                $category->image = $this->uploadService->upload($request->file('image'), 'category');
            }
            $category->save();
            return redirect()
                    ->route('admin.category.list')
                    ->with('success', 'Cập nhật danh mục thành công');
        }catch(\Exception $e){
            Log::error($e->getMessage());
            return redirect()
                    ->back()
                    ->withInput()
                    ->with('error', 'Có lỗi xảy ra vui lòng thử lại');
        }

    }

    public function destroy(Category $category){
        $result = $category->delete();
        if($result){
            return redirect()
                    ->back()
                    ->with('success', 'Xóa danh mục thành công');
        }
        return redirect()
                    ->back()
                    ->with('error', 'Có lỗi xảy ra, vui lòng thử lại');
    }

}
