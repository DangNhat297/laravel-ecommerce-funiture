<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\UploadService;
use App\Models\PostCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class PostCategoryController extends Controller
{
    
    public function index()
    {
        $categories = PostCategory::all();
        return view('screen.admin.post-category.list', compact('categories'));
    }

    public function create()
    {
        $categories = PostCategory::all();
        return view('screen.admin.post-category.create', compact('categories'));
    }

    public function store(Request $request)
    {

        $data = $request->all();

        $validator = Validator::make($request->all(), [
            'name'      => 'required',
            'slug'      => 'required',
            'image'     => 'nullable|image|mimes:jpeg,png,jpg'
        ],[
            'required'  => 'Vui lòng nhập :attribute',
            'unique'    => ':attribute đã tồn tại trên hệ thống',
            'image'     => 'Vui lòng chọn đúng định dạng ảnh'
        ],[
            'name'      => 'tên danh mục',
            'slug'      => 'đường dẫn',
            'image'     => 'Ảnh đại diện'
        ]);

        if($validator->fails()){
            return redirect()
                    ->back()
                    ->withInput()
                    ->withErrors($validator);
        }

        if($request->hasFile('image')){
            $fileName = UploadService::upload($request->file('image'), 'post-category');
            $data['thumbnail'] = $fileName;
        } else {
            $data['thumbnail'] = 'default.jpg';
        }

        PostCategory::create($data);

        return redirect()->route('admin.post-category.list')->with('success', 'Thêm danh mục thành công !');
    }
    
    public function edit($id)
    {
        $cat = PostCategory::find($id);
        $categories = PostCategory::get();
        return view('screen.admin.post-category.edit', [
            'cat' => $cat,
            'categories' => $categories
        ]);
    }

    public function update(Request $request, $id)
    {
        $cat = PostCategory::find($id);
        $data = $request->all();

        $validator = Validator::make($request->all(), [
            'name'      => 'required',
            'slug'      => 'required',
            'image'     => 'nullable|image|mimes:jpeg,png,jpg'
        ],[
            'required'  => 'Vui lòng nhập :attribute',
            'unique'    => ':attribute đã tồn tại trên hệ thống',
            'image'     => 'Vui lòng chọn đúng định dạng ảnh'
        ],[
            'name'      => 'Tên danh mục',
            'slug'      => 'Đường dẫn',
            'image'     => 'Ảnh đại diện'
        ]);

        if($validator->fails()){
            return redirect()
                    ->back()
                    ->withInput()
                    ->withErrors($validator);
        }

        if($request->hasFile('image')){
            $fileName = UploadService::upload($request->file('image'), 'post-category');
            $data['thumbnail'] = $fileName;
        }

        $cat->update($data);

        return redirect()->route('admin.post-category.list')->with('success', 'Cập nhật danh mục thành công !');
    }

    public function destroy($id){
        $cat = PostCategory::find($id);
        $cat->delete();
        return redirect()->back()->with('success', 'Xóa danh mục thành công !');
    }
}
