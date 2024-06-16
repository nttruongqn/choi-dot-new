@extends('admin.master')
@section('title', 'Tạo bài viết')
@section('main')
<div>
    <div class="breadcrumb-custom">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb custom-ol">
                <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Trang chủ</a></li>
                <li class="breadcrumb-item"><a href="{{ route('category.index') }}">Bài viết</a></li>
                <li class="breadcrumb-item active" aria-current="page">Sửa bài viết</li>
            </ol>
        </nav>
    </div>
    <hr>
    @include('admin.article.form')

    {{-- The whole world belongs to you. --}}
</div>
@endsection()
