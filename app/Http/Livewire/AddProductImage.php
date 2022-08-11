<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithFileUploads;

class AddProductImage extends Component
{
    use WithFileUploads;

    public $images = [];

    public $data = [];

    protected $rules = [
        'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif',
    ];

    protected $messages = [
        'image' => 'Vui lòng chọn tệp hình ảnh'
    ];

    public function boot()
    {
        $this->images[] = null;
    }

    public function render()
    {
        return view('livewire.add-product-image');
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

    public function addInput()
    {
        $this->images[] = null;
    }

    public function removeImage($key)
    {
        unset($this->images[$key]);
    }

}
