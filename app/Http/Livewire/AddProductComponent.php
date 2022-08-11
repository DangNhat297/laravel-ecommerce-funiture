<?php

namespace App\Http\Livewire;

use App\Http\Requests\ProductRequest;
use App\Http\Services\ProductService;
use App\Http\Traits\ProductTrait;
use App\Models\Attribute;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
class AddProductComponent extends Component
{
    use WithFileUploads, ProductTrait;

    public function mount($dataCat)
    {
        $this->dataCat = $dataCat;
    }

    public function render()
    {
        return view('livewire.add-product-component');
    }

    public function saveProduct()
    {
        $this->validate(
            (new ProductRequest())->rules(), 
            (new ProductRequest())->messages(), 
            (new ProductRequest())->attributes()
        );
        $form = [
            'name'          => $this->name,
            'slug'          => $this->slug,
            'short_desc'    => $this->short_desc,
            'price'         => $this->price,
            'promotion'     => $this->promotion,
            'quantity'      => $this->quantity,
            'content'       => $this->content,
            'categories'    => $this->categories,
            'published'     => $this->published,
            'images'        => $this->images,
            'attributes'    => $this->attributes,
            'attr_values'   => $this->attributeValues,
            'view'          => 0
        ];
        $result = ProductService::insertProduct($form);
        if(!$result){
            session()->flash('error', 'Có lỗi xảy ra, vui lòng thử lại');
        } 

        return redirect()
                ->route('admin.product.list')
                ->with('success', 'Thêm sản phẩm thành công');
    }

    public function boot()
    {
        $this->images[] = null;
    }

}
