@extends('admin::layouts.default')
@section('content')
    <div class="container">
        <form autocomplete="off" action="#" class="card card-primary mx-auto" id="form-profile">
            <div class="card-body box-profile">
                <div class="text-center">
                    <label for="auth-avatar">
                        <img class="profile-user-img img-fluid img-circle avatar-100" id="preview-avatar"
                             src="{{ asset($auth->avatar) }}"
                             alt="User profile picture">
                    </label>
                    <input type="file" hidden name="avatar_path" accept="image/*" data-target="#preview-avatar"
                           preview-avatar
                           id="auth-avatar">
                </div>

                <div class="row mt-5">
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="">{{ __('Tên') }}</label>
                            <input type="text" name="name" value="{{ $auth->name }}" class="form-control">
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="">{{ __('Tài khoản') }}</label>
                            <input type="text" name="username" value="{{ $auth->username }}" class="form-control">
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="">{{ __('Email') }}</label>
                            <input type="email" name="email" value="{{ $auth->email }}" class="form-control">
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="">{{ __('SĐT') }}</label>
                            <input type="tel" name="mobile" value="{{ $auth->mobile }}" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                    <button type="reset" class="btn btn-default mr-2">{{ __('Làm lại') }}</button>
                    <button type="submit" id="btn-save" class="btn btn-primary">{{ __('Lưu lại') }}</button>
                </div>
            </div>
            <!-- /.card-body -->
        </form>
    </div>
@endsection
@push('js')
    <script>
        $(document).ready(function () {
            let form = $('#form-profile');
            let btnSave = $('#btn-save');
            btnSave.click(function (e) {
                e.preventDefault();
                let formData = new FormData;
                let avatar_path = form.find('input[name=avatar_path]').prop('files')[0];
                let name = form.find('input[name=name]').val();
                let username = form.find('input[name=username]').val();
                let email = form.find('input[name=email]').val();
                let mobile = form.find('input[name=mobile]').val();

                if (avatar_path) {
                    formData.append('avatar_path', avatar_path);
                }

                formData.append('name', name);
                formData.append('username', username);
                formData.append('email', email);
                formData.append('mobile', mobile);
                formData.append('_method', 'put');
                // Tìm và xóa class thông báo lỗi
                form.find('.invalid-feedback').remove();
                form.find('.is-invalid').removeClass('is-invalid');
                let self = $(this);
                self.prop('disabled', true);
                $.ajax('{{ route('admin::auth.profile') }}', {
                    method: 'post',
                    enctype: 'multipart/form-data',
                    data: formData,
                    contentType: false,
                    processData: false
                }).done(function (res) {
                    self.prop('disabled', false);
                    if (res.status === 422) {
                        $.each(res.data, function (index, value) {
                            form.find('input[name=' + index + ']')
                                .addClass('is-invalid')
                                .parent().append('<div class="invalid-feedback"><strong>' + value[0] + '</strong></div>');
                        })
                        return;
                    } else if (res.status != 200) {
                        // thông báo lỗi
                        alertError(res.message);
                        return;
                    }
                    alertSuccess(res.message);
                }).fail(function (res) {
                    self.prop('disabled', false);
                    alertError(res.message);
                })
            })
        })
    </script>
@endpush
