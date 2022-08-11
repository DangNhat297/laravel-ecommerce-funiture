<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AttributeRequest;
use App\Http\Requests\AttributeUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Attribute;
class AttributeController extends Controller
{
    
    public function __construct(Attribute $attr)
    {
        $this->attributes = $attr::all();
    }

    public function index()
    {
        return view('screen.admin.attribute.list', [
            'attributes' => $this->attributes
        ]);
    }

    public function store(AttributeRequest $request)
    {
        try{
            Attribute::create($request->except('_token'));
            return redirect()
                    ->back()
                    ->with('success', 'Thêm thuộc tính thành công');
        }catch(\Exception $e){
            Log::error($e->getMessage());
            return redirect()
                    ->back()
                    ->withInput()
                    ->with('error', 'Có lỗi xảy ra, vui lòng thử lại');
        }
    }

    public function edit(Attribute $attr)
    {
        // dd($attr);
        return view('screen.admin.attribute.list',[
            'attributes' => $this->attributes,
            'currentAttr'=> $attr
        ]);
    }

    public function update(AttributeUpdateRequest $request, Attribute $attr)
    {
        try{
            $attr->fill($request->all());
            $attr->save();
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

    public function destroy(Attribute $attr)
    {
        $result = $attr->delete();
        if($result){
            return redirect()
                    ->back()
                    ->with('success', 'Xóa thuộc tính thành công');
        }
        return redirect()
                    ->back()
                    ->with('error', 'Có lỗi xảy ra, vui lòng thử lại');
    }

}
