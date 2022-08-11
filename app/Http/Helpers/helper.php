<?php

if(!function_exists('showCategories')){
    function showCategories($categories, $parent_id = 0, $char = ''){
        foreach ($categories as $key => $item){
            // Nếu là chuyên mục con thì hiển thị
            if ($item->parent_id == $parent_id)
            {
                echo '<tr class="datatable-row">
                                <td class="datatable-cell" style="flex-grow:1"><span class="text-dark-75 font-weight-bolder d-block font-size-lg">'.$char.$item->name.'</span></td>
                                <td class="datatable-cell" style="width: 20%"><span><span class="label font-weight-bold label-lg label-rounded '.(($item->status == 1) ? 'label-success' : 'label-warning').' label-inline">'.(($item->status == 1) ? 'Đã đăng' : 'Đang ẩn').'</span></span></td>
                                <td class="datatable-cell text-right" style="width: 20%">
                                    <a href="'.route('admin.category.edit', $item->id).'" class="btn btn-icon btn-success btn-sm mr-2"><i class="fas fa-edit"></i></a>
                                    <form method="POST" class="d-inline" action="'.route('admin.category.delete', $item->id).'">
                                        '.method_field("DELETE").'
                                        '.csrf_field().'
                                        <button type="submit" class="btn btn-icon btn-danger btn-sm mr-2 delete-item"><i class="far fa-trash-alt"></i></button>
                                    </form>
                                </td>
                            </tr>';
                unset($categories[$key]);
                
                // Tiếp tục đệ quy để tìm chuyên mục con của chuyên mục đang lặp
                showCategories($categories, $item->id, $char.'|---');
            }
        }
    }
}

if(!function_exists('selectCategories')){
    function selectCategories($categories, $parent_id = 0, $char = ''){
        foreach ($categories as $key => $item)
        {
            // Nếu là chuyên mục con thì hiển thị
            if ($item->parent_id == $parent_id)
            {
                echo '<option value="'.$item->id.'" '.(is_array(old('categories')) && in_array($item->id, old('categories')) ? 'selected' : '').'>';
                    echo $char . $item->name;
                echo '</option>';
                
                // Xóa chuyên mục đã lặp
                unset($categories[$key]);
                
                // Tiếp tục đệ quy để tìm chuyên mục con của chuyên mục đang lặp
                selectCategories($categories, $item->id, $char.'|---');
            }
        }
    }
}

if(!function_exists('getPathImage')){
    function getPathImage($path){
        if(preg_match('#http|https#', $path)){
            return $path;
        } else {
            return asset($path);
        }
    }
}

if(!function_exists('productPrice')){
    function productPrice($price){
        $symbol = 'đ';
        $symbol_thousand = '.';
        $decimal_place = 0;
        $price = number_format($price, $decimal_place, '', $symbol_thousand);
        return $price.$symbol;
    }
}

if(!function_exists('checkboxCategories')){
    function checkboxCategories($categories, $parent_id = 0, $char = ''){
        foreach ($categories as $key => $item)
        {
            // Nếu là chuyên mục con thì hiển thị
            if ($item->parent_id == $parent_id)
            {
                echo '<label class="checkbox">
                            <input type="checkbox" value="'.$item->id.'" name="categories[]" '.(is_array(old('categories')) && in_array($item->id, old('categories')) ? 'checked' : '').'>
                            <span></span>'.$char.' '.$item->name.'
                        </label>';
                
                // Xóa chuyên mục đã lặp
                unset($categories[$key]);
                
                // Tiếp tục đệ quy để tìm chuyên mục con của chuyên mục đang lặp
                checkboxCategories($categories, $item->id, $char.'--');
            }
        }
    }
}

if(!function_exists('roundNumber')){
    function roundNumber($float){
        return round($float, 1, PHP_ROUND_HALF_UP);
    }
}