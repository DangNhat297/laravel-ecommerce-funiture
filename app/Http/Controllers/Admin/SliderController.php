<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\UploadService;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
class SliderController extends Controller
{
    
    public function index()
    {
        $sliders = Slider::orderBy('sort', 'ASC')->get();
        return view('screen.admin.slider.list', compact('sliders'));
    }

    public function updateSort(Request $request)
    {
        try{

            foreach($request->sliders as $key => $value){
                $slider = Slider::find($value);
                $slider->sort = $key + 1;
                $slider->save();
            }
            return redirect()
                        ->back()
                        ->with('success', 'Cập nhật thành công');
        }catch(\Exception $e){
            Log::error($e->getMessage());
            return redirect()
                        ->back()
                        ->with('error', 'Có lỗi xảy ra, vui lòng thử lại');
        }
    }

    public function create()
    {
        return view('screen.admin.slider.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120'
        ], [
            'required'  => ':attribute không được để trống',
            'image'     => 'Không phải là ảnh',
            'image.max' => 'File kích thước tối đa 5mb'
        , [
            'image'     => 'Ảnh slider'
        ]]);

        try{
            $image = UploadService::upload($request->file('image'), 'slider');
            $slider = new Slider();
            $slider->fill($request->all());
            $slider->image = $image;
            $slider->sort = (Slider::max('sort') + 1) ?? 1;
            $slider->save();
            return redirect()
                    ->route('admin.slider.list')
                    ->with('success', 'Thêm slider thành công');
        }catch(\Exception $e){
            Log::error($e->getMessage());
            return redirect()
                    ->back()
                    ->with('error', 'Có lỗi xảy ra, vui lòng thử lại');
        }
    }

    public function edit(Slider $slider)
    {
        return view('screen.admin.slider.edit', compact('slider'));
    }

    public function update(Request $request, Slider $slider)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120'
        ], [
            'required'  => ':attribute không được để trống',
            'image'     => 'Không phải là ảnh',
            'image.max' => 'File kích thước tối đa 5mb'
        , [
            'image'     => 'Ảnh slider'
        ]]);

        try{
            $slider->fill($request->all());
            if($request->has('image')){
                $image = UploadService::upload($request->file('image'), 'slider');
                $slider->image = $image;
            }
            $slider->save();
            return redirect()
                    ->route('admin.slider.list')
                    ->with('success', 'Cập nhật slider thành công');
        }catch(\Exception $e){
            Log::error($e->getMessage());
            return redirect()
                    ->back()
                    ->with('error', 'Có lỗi xảy ra, vui lòng thử lại');
        }
    }

    public function destroy(Slider $slider)
    {
        $result = $slider->delete();
        if($result){
            return redirect()
                    ->back()
                    ->with('success', 'Xóa slider thành công');
        }
        return redirect()
                    ->back()
                    ->with('error', 'Có lỗi xảy ra, vui lòng thử lại');
    }

}
