@extends('admin::layouts.guest')
@section('content')
    <div class="login-box">
        <div class="login-logo">
            <a href="../../index2.html">{{ __('Trang quản trị') }}</a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">

                <form action="{{ route('admin::login') }}" id="form-login" method="post">
                    <div class="input-group mb-3">
                        <input type="text" name="username" class="form-control" placeholder="{{ __('Tài khoản') }}">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control" placeholder="{{ __('Mật khẩu') }}">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="icheck-primary">
                                <input type="checkbox" name="remember">
                                <label for="remember">
                                    {{ __('Nhớ mật khẩu') }}
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-12 mt-3">
                            <button type="submit" class="btn btn-primary btn-block">{{ __('Đăng nhập') }}</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
                <!-- /.social-auth-links -->

                <p class="mt-3">
                    <a href="forgot-password.html">{{ __('Quên mật khẩu') }}</a>
                </p>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
@endsection
@push('js')
    <script>
        $(document).ready(function () {
            let formLogin = $('#form-login');
            // KHi bấm nút đăng nhập
            formLogin.find('button[type=submit]').on('click', function (e) {
                // Hủy sự kiện gửi formdata của html
                e.preventDefault();
                let self = $(this);
                // Đảm bảo ng dùng chỉ click 1 lần
                self.prop('disabled', true);
                let username = formLogin.find('input[name=username]').val();
                let password = formLogin.find('input[name=password]').val();
                let remember = formLogin.find('input[name=remember]').prop('checked');

                // Tìm và xóa class thông báo lỗi
                formLogin.find('.invalid-feedback').remove();
                formLogin.find('.is-invalid').removeClass('is-invalid');

                $.ajax('{{ route('admin::login') }}', {
                    method: 'post',
                    data: {
                        username: username,
                        password: password,
                        remember: remember,
                    }
                }).done(function (res) {
                    self.prop('disabled', false);
                    if (res.status === 422) {
                        $.each(res.data, function (index, value) {
                            formLogin.find('input[name=' + index + ']').addClass('is-invalid')
                                .parent().append('<div class="invalid-feedback"><strong>' + value[0] + '</strong></div>');
                        })
                        return;
                    } else if (res.status != 200) {
                        formLogin.prepend('<div class="invalid-feedback d-block mb-3 text-center"><strong>' + res.message + '</strong></div>')
                        return;
                    }
                    // status 200
                    // data, status,message
                    // Khi gửi dữ liệu thành công
                    // Đăng nhập thành công
                    location.href = '{{ route('admin::index') }}';
                }).fail(function (res) {
                    self.prop('disabled', false);
                    alert(res.message);
                })
            })
        })
    </script>
@endpush
