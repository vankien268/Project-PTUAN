@extends('admin::layouts.default')
@section('content')
    <a href="{{ \Request::buttonBack('admin::category.index') }}" class="btn btn-info">
        <i class="fas fa-chevron-left"></i>
        {{ __('Quay lại') }}
    </a>
    <form action="{{ route('admin::category.store') }}" method="post" class="py-5 container-fluid" id="form-category"
          autocomplete="off">
        <fieldset>
            <legend>{{ __('Thông tin cơ bản') }}</legend>
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label for="">{{ __('Tên danh mục') }}</label>
                        <input type="text" name="name" to-slug="#slug-category" class="form-control">
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label for="">{{ __('Slug') }}</label>
                        <input type="text" name="slug" id="slug-category" class="form-control">
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label for="">{{ __('Danh mục cha') }}</label>
                        <select name="parent_id" class="custom-select">
                            <option value="">--{{ __('Chọn danh mục') }}--</option>
                            @foreach($categories as $category)
                                {{--Danh mục cha--}}
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                {{--Danh mục con--}}
                                @if ($category->children->isNotEmpty())
                                    @foreach($category->children as $children)
                                        <option value="{{ $children->id }}">-- {{ $children->name }}</option>
                                    @endforeach
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </fieldset>
        <fieldset>
            <legend>{{ __('SEO') }}</legend>
            <div class="form-group">
                <label for="">{{ __('Tiêu đề') }}</label>
                <input type="text" name="meta_title" class="form-control">
            </div>
            <div class="form-group">
                <label for="">{{ __('Mô tả') }}</label>
                <textarea name="meta_description" class="form-control" cols="30" rows="3"></textarea>
            </div>
        </fieldset>
        <div class="d-flex justify-content-center">
            <button type="reset" class="btn btn-default mr-2">{{ __('Làm lại') }}</button>
            <button type="submit" class="btn btn-primary" id="btn-save">{{ __('Lưu lại') }}</button>
        </div>
    </form>
@endsection
@push('js')
    <script>
        $(document).ready(function () {
            let form = $('#form-category');
            let btnSave = $('#btn-save');
            btnSave.click(function (e) {
                e.preventDefault();
                let name = form.find('input[name=name]').val();
                let slug = form.find('input[name=slug]').val();
                let parent_id = form.find('select[name=parent_id]').val();
                let meta_title = form.find('input[name=meta_title]').val();
                let meta_description = form.find('textarea[name=meta_description]').val();
                let self = $(this);
                self.prop('disabled', true);
                // Tìm và xóa class thông báo lỗi
                form.find('.invalid-feedback').remove();
                form.find('.is-invalid').removeClass('is-invalid');
                $.ajax('{{ route('admin::category.store') }}', {
                    method: 'post',
                    data: {
                        name: name,
                        slug: slug,
                        parent_id: parent_id,
                        meta_title: meta_title,
                        meta_description: meta_description
                    }
                }).done(function (res) {
                    self.prop('disabled', false);
                    if (res.status === 422) {
                        $.each(res.data, function (index, value) {
                            form.find('input[name=' + index + '],select[name=' + index + '],textarea[name=' + index + ']')
                                .addClass('is-invalid')
                                .parent().append('<div class="invalid-feedback"><strong>' + value[0] + '</strong></div>');
                        })
                        return;
                    } else if (res.status != 200) {
                        // thông báo lỗi
                        alertError(res.message);
                        return;
                    }

                    form[0].reset();

                    alertSuccess(res.message);
                }).fail(function (res) {
                    self.prop('disabled', false);
                    alertError(res.message);
                })
            })


            // autocomplete slug

        })
    </script>
@endpush
