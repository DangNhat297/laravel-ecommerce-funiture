@extends('layouts.admin.master')

@if (isset($product))
@section('title', 'Sửa sản phẩm')

@section('title-heading', 'Sửa sản phẩm')
@else
@section('title', 'Thêm sản phẩm')

@section('title-heading', 'Thêm sản phẩm')
@endif

@section('content')
    @if (isset($product))
        @livewire('update-product-component', ['dataCat' => $categories, 'product' => $product])
    @else
        @livewire('add-product-component', ['dataCat' => $categories])
    @endif
@endsection

@section('custom-js-tag')
<script src="https://cdn.ckeditor.com/4.19.0/standard/ckeditor.js"></script>
@endsection