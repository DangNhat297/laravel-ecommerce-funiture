<?php

namespace App\Http\Livewire;

use App\Http\Traits\ProductTrait;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Attribute;
use App\Models\ProductImage;
use App\Http\Requests\ProductRequest;
use App\Http\Services\ProductService;
use App\Models\Product;

class UpdateProductComponent extends Component
{
    use WithFileUploads, ProductTrait;

    public $imagesRemove = [];

    public $listeners = [
        'selectAttr'    => 'selectAttr'
    ];

    protected $customRules;

    public function selectAttr()
    {
        if($this->hasAttr){
            $this->dataAttributes = Attribute::all();
            $this->dispatchBrowserEvent('contentChanged');
        }
    }

    public function mount($dataCat, $product)
    {
        $this->productId = $product->id;
        $this->dataCat = $dataCat;
        $this->categories = $product->categories()->pluck('id')->toArray();
        $this->name = $product->name;
        $this->slug = $product->slug;
        $this->short_desc = $product->short_desc;
        $this->price = $product->price;
        $this->quantity = $product->quantity;
        $this->content = $product->content;
        $this->published = $product->published;
        $this->hasAttr = $product->hasAttr();
        $this->attributes = $product->attributes()->groupBy('attributes.id')->pluck('attributes.id')->toArray();
        foreach($product->showAttributes() as $value){
            $this->attributeValues[$value['id']] = $value['value'];
        }
        if($this->hasAttr){
            $this->dataAttributes = Attribute::all();
        }
        $this->oldImages = $product->images->toArray();
        // dd($this->images);
    }

    public function render()
    {
        return view('livewire.update-product-component');
    }

    public function removeOldImage($key){
        $this->imagesRemove[] = $this->oldImages[$key]['id'];
        unset($this->oldImages[$key]);
    }

    public function boot()
    {
        $this->images[] = null;
        $this->customRules = (new ProductRequest())->rules();
    }

    public function saveProduct()
    {
        if(count($this->oldImages) != 0){
            $this->customRules['images.0'] = 'nullable';
        }
        $this->validate(
            $this->customRules, 
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
            'images'        => array_filter($this->images),
            'attributes'    => $this->attributes,
            'attr_values'   => $this->attributeValues,
            'view'          => 0,
            'removeImg'     => $this->imagesRemove
        ];
        // dd($form);
        $result = ProductService::updateProduct($this->productId, $form);
        if(!$result){
            session()->flash('error', 'Có lỗi xảy ra, vui lòng thử lại');
        } else {
            session()->flash('success', 'Cập nhật sản phẩm thành công');
            return redirect()->route('admin.product.list');
        }
    }

}
