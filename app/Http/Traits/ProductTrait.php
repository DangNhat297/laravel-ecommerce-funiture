<?php

namespace App\Http\Traits;
use App\Http\Requests\ProductRequest;
use App\Http\Services\ProductService;
use App\Models\Attribute;
use App\Models\ProductImage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Livewire\TemporaryUploadedFile;
use stdClass;

trait ProductTrait{
    public $dataCat;

    public $categories = [];

    public $images = [];

    public $data = [];

    public $attributes = [];

    public $attributeValues = [];

    public $name, $price, $promotion, $quantity, $slug, $published = 1, $content, $short_desc, $hasAttr = 0, $dataAttributes;
    
    protected $rules = [
        'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
    ];

    protected $messages = [
        'image' => 'Vui lòng chọn tệp hình ảnh',
        'images.*.max'   => 'Tệp hình ảnh không quá 5mb'
    ];

    public function findAttr($id){
        return $this->dataAttributes->find($id);
    }

    public function addAttributeValueKey($attr)
    {
        $this->key = $attr;
        $this->attributeValues[$this->key][] = '';
    }

    public function removeAttributeValueKey($attr, $key)
    {
        array_splice($this->attributeValues[$attr], $key, 1);
    }


    public function updatedAttributes($value, $key)
    {
        $attrRemove = array_diff(array_keys($this->attributeValues), $this->attributes);
        foreach($attrRemove as $value){
            unset($this->attributeValues[$value]);
        }
        foreach($this->attributes as $key){
            if(!array_key_exists($key, $this->attributeValues)) $this->attributeValues[$key][0] = '';
        }
        // dd('array attributes: ', $this->attributes,'key value: ',array_keys($this->attributeValues),'remove: ', $attrRemove, ' array values: ', $this->attributeValues);
        // dd($this->attributes, array_keys($this->attributeValues));
    }

    public function changeTypeProduct(){
        if($this->hasAttr){
            $this->dataAttributes = Attribute::all();
            $this->dispatchBrowserEvent('contentChanged');
        } else {
            $this->attributes = [];
            $this->attributeValues = [];
        }
    }

    public function updatedImages($value, $key)
    {
        $this->errors_validation = [];
        $this->data['images'] = $this->images;
        $validator = Validator::make($this->data, $this->rules, $this->messages);
        if($validator->fails()){
            $this->images[$key] = null;
            return $this->errors_validation = $validator->errors()->toArray();
        }
    }

    public function updatedName($value){
        $this->slug = Str::slug($value);
    }

    public function addInput()
    {
        array_push($this->images, null);
    }

    public function removeImage($key)
    {
        unset($this->images[$key]);
    }
}