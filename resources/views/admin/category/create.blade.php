@extends('admin.master')
@section('title', 'Tạo danh mục')
@section('main')
<div>
    <div class="breadcrumb-custom">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb custom-ol">
                <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Trang chủ</a></li>
                <li class="breadcrumb-item"><a href="{{ route('category.index') }}">Danh mục</a></li>
                <li class="breadcrumb-item active" aria-current="page">Thêm danh mục</li>
            </ol>
        </nav>
    </div>
    <hr>
    @include('admin.category.form')

    {{-- The whole world belongs to you. --}}
</div>
@endsection()
