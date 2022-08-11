<?php

namespace App\Http\Services;

use App\Models\AttributeValue;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Services\UploadService;
use Attribute;

class ProductService {

    public static function insertProduct($data)
    {
        DB::beginTransaction();
        try{
            $product = new Product();
            $product->fill($data);
            $product->save();
            // $product = Product::create($data);

            $product->categories()->sync($data['categories']);

            /* $data['attr_values']
            [
                'attribute_1' => ['value_1', 'value_2']
                'attribute_2' => ['value_1', 'value_2', 'value_3']
            ]
            */
            foreach($data['attr_values'] as $attr => $value){
                foreach($value as $v){
                    AttributeValue::create([
                        'attribute_id'  => $attr,
                        'product_id'    => $product->id,
                        'value'         => $v
                    ]);
                }
            }

            foreach($data['images'] as $img){
                $path = UploadService::upload($img, 'product');
                ProductImage::create([
                    'path'      => $path,
                    'product_id'=> $product->id
                ]);
            }
            // $product->attributes()->sync([1 => $data['attr_values'][1]]);

            // foreach($data['attr_values'] as $attr => $value){
            //     foreach($value as $v){
            //         $product->attributes()->sync($attr, ['value' => $v]);
            //     }
            // }

            // dd($product);
            DB::commit();
            return true;
        }catch(\Exception $e){
            DB::rollBack();
            Log::error($e->getMessage());
            return false;
        }
    }

    public static function updateProduct($productId, $data){
        DB::beginTransaction();
        try{
            $product = Product::find($productId);
            $product->fill($data);
            $product->save();
            // $product = Product::create($data);

            $product->categories()->sync($data['categories']);

            /* $data['attr_values']
            [
                'attribute_1' => ['value_1', 'value_2']
                'attribute_2' => ['value_1', 'value_2', 'value_3']
            ]
            */
            AttributeValue::where('product_id', $product->id)->delete();
            foreach($data['attr_values'] as $attr => $value){
                foreach($value as $v){
                    AttributeValue::create([
                        'attribute_id'  => $attr,
                        'product_id'    => $product->id,
                        'value'         => $v
                    ]);
                }
            }
            ProductImage::whereIn('id', $data['removeImg'])->delete();

            foreach($data['images'] as $img){
                $path = UploadService::upload($img, 'product');
                ProductImage::create([
                    'path'      => $path,
                    'product_id'=> $product->id
                ]);
            }
            // $product->attributes()->sync([1 => $data['attr_values'][1]]);

            // foreach($data['attr_values'] as $attr => $value){
            //     foreach($value as $v){
            //         $product->attributes()->sync($attr, ['value' => $v]);
            //     }
            // }

            // dd($product);
            DB::commit();
            return true;
        }catch(\Exception $e){
            DB::rollBack();
            Log::error($e->getMessage());
            return false;
        }
    }

}