@extends('admin.master')
@section('title', 'Thêm sản phẩm')
@section('main')
    <div class="breadcrumb-custom">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Trang chủ</a></li>
                <li class="breadcrumb-item"><a href="{{ route('product.index') }}">Sản phẩm</a></li>
                <li class="breadcrumb-item active" aria-current="page">Thêm sản phẩm</li>
            </ol>
        </nav>
    </div>
    @include('admin.product.form')
@endsection
