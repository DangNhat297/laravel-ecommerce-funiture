<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\UploadService;
use App\Models\Post;
use App\Models\PostCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    
    public function index(){
        $posts = Post::with('author')->get();
        return view('screen.admin.post.list', compact('posts'));
    }

    public function create(){
        $categories = PostCategory::get();
        return view('screen.admin.post.create', [
            'categories' => $categories
        ]);
    }

    public function store(Request $request){

        $data = $request->all();

        $validator = Validator::make($request->all(), [
            'title'         => 'required',
            'slug'          => 'required',
            'content'       => 'required',
            'categories'    => 'required',
            'thumbnail'     => 'required|mimes:jpeg,png,jpg'
        ],[
            'required'      => ':attribute bắt buộc phải có',
            'mimes'         => 'Sai định dạng hình ảnh cho phép',
            'image'         => ':attribute bắt buộc phải là ảnh'
        ],[
            'title'         => 'Tiêu đề',
            'slug'          => 'Đường dẫn',
            'content'       => 'Nội dung',
            'categories'    => 'Danh mục',
            'thumbnail'     => 'Ảnh đại diện'
        ]);

        if($validator->fails()){
            return redirect()
                    ->back()
                    ->withInput()
                    ->withErrors($validator);
        }

        $fileName = UploadService::upload($request->file('thumbnail'), 'post');
        $data['thumbnail'] = $fileName;
        $data['user_id'] = Auth::id();
        $data['view'] = 0;
        $post = Post::create($data);
        $post->categories()->attach($request->categories);
        return redirect()
                ->route('admin.post.list')
                ->with('success', 'Thêm bài viết thành công');
    }

    public function edit($id){
        $post = Post::with('categories:id')->where('id', $id)->first();
        $categories = PostCategory::get();
        return view('screen.admin.post.edit', compact('post', 'categories'));
    }

    public function update(Request $request, $id){
        $data = $request->all();

        // dd($request->categories);

        $validator = Validator::make($request->all(), [
            'title'         => 'required',
            'slug'          => 'required',
            'content'       => 'required',
            'categories'    => 'required',
            'thumbnail'     => 'mimes:jpeg,png,jpg'
        ],[
            'required'      => ':attribute bắt buộc phải có',
            'mimes'         => 'Sai định dạng hình ảnh cho phép',
            'image'         => ':attribute bắt buộc phải là ảnh'
        ],[
            'title'         => 'Tiêu đề',
            'slug'          => 'Đường dẫn',
            'content'       => 'Nội dung',
            'categories'    => 'Danh mục',
            'thumbnail'     => 'Ảnh đại diện'
        ]);

        if($validator->fails()){
            return redirect()
                    ->back()
                    ->withInput()
                    ->withErrors($validator);
        }

        if($request->hasFile('thumbnail')){
            $fileName = UploadService::upload($request->file('thumbnail'), 'post');
            $data['thumbnail'] = $fileName;
        } else {
            unset($data['thumbnail']);
        }
        $data['user_id'] = Auth::id();
        $data['view'] = 0;
        $post = Post::find($id);
        $post->update($data);
        $post->categories()->sync($request->categories);
        return redirect()
                ->route('admin.post.list')
                ->with('success', 'Cập nhật viết thành công');
    }

    public function destroy($id){
        $post = Post::find($id);
        $post->categories()->detach();
        $post->delete();
        return redirect()
                    ->route('admin.post.list')
                    ->with('success', 'Xóa bài viết thành công');
    }

}
