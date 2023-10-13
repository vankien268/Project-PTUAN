@extends('admin::layouts.default')
@section('content')
    <a href="{{ \Request::buttonBack('admin::category.index') }}" class="btn btn-info">
        <i class="fas fa-chevron-left"></i>
        {{ __('Quay lại') }}
    </a>
    <div class="container mt-5">
        <div class="row">
            <div class="col-12">
                <h4>{{ __('Thông tin cơ bản') }}</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-6 col-lg-3">
                {{ __('Tên danh mục') }} :
            </div>
            <div class="col-12 col-md-6 col-lg-9">
                {{ $category->name }}
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-6 col-lg-3">
                Slug :
            </div>
            <div class="col-12 col-md-6 col-lg-9">
                {{ $category->slug }}
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-6 col-lg-3">
                {{ __('Danh mục cha') }} :
            </div>
            <div class="col-12 col-md-6 col-lg-9">
                {{ $category->parent->name??'-' }}
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-6 col-lg-3">
                {{ __('Danh mục cha') }} :
            </div>
            <div class="col-12 col-md-6 col-lg-9">
                {{ $category->parent->name??'-' }}
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-6 col-lg-3">
                {{ __('Cấp danh mục') }} :
            </div>
            <div class="col-12 col-md-6 col-lg-9">
                {{ $category->level }}
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-12">
                <h4>SEO</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-6 col-lg-3">
                Meta title :
            </div>
            <div class="col-12 col-md-6 col-lg-9">
                {{ $category->meta_title??'-' }}
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-6 col-lg-3">
                Meta description :
            </div>
            <div class="col-12 col-md-6 col-lg-9">
                {{ $category->meta_description??'-' }}
            </div>
        </div>
    </div>
@endsection
