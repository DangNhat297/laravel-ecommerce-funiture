<div>
    <form id="add-product" method="POST" wire:submit.prevent="saveProduct" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-12">
                <div class="card card-custom mb-3">
                    <div class="card-header">
                        <h3 class="card-title">Sửa sản phẩm</h3>
                    </div>
                    <!--begin::Form-->
                    <div class="card-body">
                        <div class="form-group">
                            <label>Tên sản phẩm
                                <span class="text-danger">*</span></label>
                            <input type="text" wire:model.lazy="name" class="form-control" name="title" placeholder="Nhập tiêu đề bài viết">
                            @error('name')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Đường dẫn
                                <span class="text-danger">*</span></label>
                            <div wire:ignore>
                                <input type="text" wire:model="slug" class="form-control" placeholder="Nhập đường dẫn">
                            </div>
                            @error('slug')
                                    <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Mô tả ngắn
                                <span class="text-danger">*</span></label>
                                <div wire:ignore>
                                    <textarea wire:model="short_desc" rows="4" class="form-control" placeholder="Nhập mô tả ngắn"></textarea>
                                </div>
                        </div>
                        <div class="form-group">
                            <label>Giá</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                </div>
                                <input type="number" min="0" wire:model="price" class="form-control" placeholder="Nhập giá">
                            </div>
                            @error('price')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Giá khuyến mãi</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                </div>
                                <input type="number" min="0" wire:model="promotion" class="form-control" placeholder="Nhập giá khuyến mãi">
                            </div>
                            @error('promotion')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Số lượng trong kho</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-info"></i></span>
                                </div>
                                <input type="number" min="0" wire:model="quantity" class="form-control" placeholder="Nhập số lượng hàng trong kho">
                            </div>
                            @error('quantity')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Nội dung
                                <span class="text-danger">*</span></label>
                            <div wire:ignore>
                                <textarea wire:model.lazy="content" wire:key="editor-{{ now() }}" name="content"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Danh mục (<a href="{{route('admin.category.add')}}" target="_blank" class="text-hover-danger"><i class="fas fa-plus text-primary"></i></a>)</label>
                            <div wire:ignore>
                                <select class="form-control select2" wire:model="categories" id="select2" multiple>
                                    {{ selectCategories($dataCat) }}
                                </select>
                            </div>
                            @error('categories')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Trạng thái</label>
                            <div class="radio-inline" wire:ignore>
                                <label class="radio radio-rounded">
                                <input type="radio" value="1" name="published" wire:model="published" checked>
                                <span></span>Hiển thị</label>
                                <label class="radio radio-rounded ml-5">
                                <input type="radio" value="0" name="published" wire:model="published">
                                <span></span>Không hiển thị</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Hình ảnh</label>
                            @foreach ($oldImages as $key => $image)
                            <div class="input-group mb-3">
                                <div class="custom-file {{($image) ? 'disable-click' : '' }}">
                                    <input type="file" class="custom-file-input" id="inputGroupFile{{$key}}">
                                    <label class="custom-file-label" for="inputGroupFile{{$key}}">{{ $image['path'] }}</label>
                                </div>
                                
                                <div class="input-group-append">
                                    <button class="btn btn-danger" wire:click="removeOldImage({{$key}})" type="button"><i class="fas fa-trash"></i></button>
                                </div>
                                
                            </div>
                            <div class="preview-image">
                                <img src='{{ asset($image['path']) }}' style='display:block;margin:10px 0;width: auto;height: 100px;aspect-ratio:1/1;object-fit:cover;border:1px solid #3699ff;border-radius:5px;'>
                            </div>
                            @endforeach
                            @foreach ($images as $key => $image)
                                <div class="input-group mb-3">
                                    <div class="custom-file {{($image) ? 'disable-click' : '' }}">
                                        <input type="file" class="custom-file-input" accept=".png, .jpg, .jpeg, .jfif, .webp" name="images[]" wire:model="images.{{$key}}" id="inputGroupFile0{{$key}}">
                                        <label class="custom-file-label" for="inputGroupFile0{{$key}}">{{ ($image) ? $image->getClientOriginalName() : 'Choose file' }}</label>
                                    </div>
                                    @if(!empty($oldImages) || $key != 0)
                                    <div class="input-group-append">
                                        <button class="btn btn-danger" wire:click="removeImage({{$key}})" type="button"><i class="fas fa-trash"></i></button>
                                    </div>
                                    @endif
                                </div>
                                <div wire:loading.block wire:target="images.{{$key}}">Đang tải tệp lên...</div>
                                @if ($image instanceof \Livewire\TemporaryUploadedFile)
                                <div class="preview-image">
                                    <img src='{{ $image->temporaryUrl() }}' style='display:block;margin:10px 0;width: auto;height: 100px;aspect-ratio:1/1;object-fit:cover;border:1px solid #3699ff;border-radius:5px;'>
                                </div>
                                @endif
                                @error('images.'. $key)
                                    <p class="text-danger">{{$message}}</p>
                                @enderror
                                @if (isset($errors_validation['images.'.$key]))
                                    <p class="text-danger">{{ $errors_validation['images.'.$key][0] }}</p>
                                @endif
                            @endforeach
                            <button type="button" wire:click="addInput" class="btn btn-success mr-2"><i class="far fa-images"></i> Thêm hình ảnh</button>
                        </div>
                        <div class="form-group">
                            <label>Loại sản phẩm</label>
                            <div class="radio-inline" wire:ignore>
                                <label class="radio radio-rounded">
                                <input type="radio" value="0" name="hasAttr" wire:model="hasAttr" wire:click="changeTypeProduct" checked>
                                <span></span>Sản phẩm thường</label>
                                <label class="radio radio-rounded ml-5">
                                <input type="radio" value="1" name="hasAttr" wire:model="hasAttr" wire:click="changeTypeProduct">
                                <span></span>Sản phẩm có biến thể</label>
                            </div>
                        </div>
                        @if ($hasAttr)
                            <div class="form-group">
                                <label>Chọn thuộc tính (<a href="{{route('admin.attribute.list')}}" class="text-hover-danger" target="_blank"><i class="fas fa-plus text-primary"></i></a>)</label>
                                <div wire:ignore>
                                    <select class="form-control select2" wire:model="attributes" id="select-attr" multiple>
                                        @foreach ($dataAttributes as $attr)
                                            <option value="{{ $attr->id }}">{{ $attr->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            @foreach ($attributes as $attr)
                                <div class="form-group row">
                                    <label class="col-2 col-form-label">{{ $this->findAttr($attr)->name }}</label>
                                    <div class="col-10">
                                        @foreach ($attributeValues[$attr] as $key => $value)
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" wire:model="attributeValues.{{$attr}}.{{$key}}" placeholder="Nhập biến thể cho {{ $this->findAttr($attr)->name }}">
                                            @if ($key != 0)
                                            <div class="input-group-append">
                                                <button class="btn btn-danger btn-sm" wire:click="removeAttributeValueKey({{$attr}}, {{$key}})" type="button"><i class="fas fa-trash-alt"></i></button>
                                            </div>
                                            @endif
                                        </div>
                                        @error("attributeValues.{$attr}.{$key}")
                                            <p class="text-danger">{{ $message }}</p> 
                                        @enderror
                                        @endforeach
                                        <button type="button" wire:click="addAttributeValueKey({{$attr}})" class="btn btn-success btn-sm my-2"><i class="fas fa-plus-circle"></i> Thêm biến thể</button>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary mr-2">Cập nhật</button>
                        <a href="{{ route('admin.product.list') }}"><button type="button" class="btn btn-success mr-2">Danh sách sản phẩm</button></a>
                    </div>
                </div>
                @if (session()->has('error'))
                    <div class="alert alert-danger text-center">{{ session()->get('error') }}</div>
                @endif
                @if (session()->has('success'))
                    <div class="alert alert-success text-center">{{ session()->get('success') }}</div>
                @endif
            </div>
        </div>
    </form>
</div>

@push('add-script')
    <script>
        $(document).ready(function(){
            const editor = CKEDITOR.replace('content')

            $('#select2').select2({
                placeholder: 'Chọn danh mục:'
            })

            $('#select2').on('change', function (e) {
                @this.set('categories', $(this).val())
            })

            editor.on('change', function(e){
                @this.set('content', e.editor.getData())
            })

            Livewire.emit('selectAttr')

            window.addEventListener('contentChanged', event => {
                $('#select-attr').select2({
                    placeholder: 'Chọn thuộc tính'
                })
                $('#select-attr').on('change', function (e) {
                    @this.set('attributes', $(this).val().map(value => Number(value)))
                })
            })
        })
    </script>
@endpush

