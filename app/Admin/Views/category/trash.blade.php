@extends('admin::layouts.default')
@section('content')
    <div class="mb-3">
        <a href="{{ \Request::buttonBack('admin::category.index') }}" class="btn btn-info mr-2">
            <i class="fas fa-chevron-left"></i>
            {{ __('Quay lại') }}
        </a>
    </div>
    <div class="table-responsive">
        <table class="table table-hover" id="list-categories">
            <thead>
            <tr>
                <th>{{ __('Tên danh mục') }}</th>
                <th>{{ __('Cấp độ') }}</th>
                <th>{{ __('Danh mục cha') }}</th>
                <th>{{ __('Thao tác') }}</th>
            </tr>
            </thead>
            <tbody>
            @forelse ($categories as $category)
                <tr>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->level }}</td>
                    <td>{{ @$category->parent->name }}</td>
                    <td>
                        <button type="button" data-id="{{ $category->id }}" class="btn btn-info btn-restore">
                            <i class="fas fa-sync"></i>
                        </button>
                        <button type="button" class="btn btn-danger btn-delete" data-id="{{ $category->id }}">
                            <i class="far fa-trash-alt"></i>
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">{{ __('Không có dữ liệu hiển thị') }}</td>
                </tr>
            @endforelse
            </tbody>
        </table>
        {{ $categories->links() }}
    </div>
@endsection
@push('js')
    <script>
        $(document).ready(function () {
            $('.btn-delete').click(function (e) {
                e.preventDefault();
                let self = $(this);
                let cateID = self.attr('data-id');
                Swal.fire({
                    title: "{{ __('Bạn có chắc chắn muốn xóa vĩnh viễn danh mục này không?') }}",
                    showCancelButton: true,
                    cancelButtonText: "{{ __('Huỷ') }}",
                    confirmButtonText: "{{ __('Đồng ý') }}",
                }).then(function (result) {
                    if (result.isConfirmed) {
                        self.prop('disabled', true);
                        $.ajax("{{ route('admin::category.destroy','') }}/" + cateID, {
                            type: 'post',
                            data: {
                                _method: 'delete'
                            }
                        }).done(function (res) {
                            if (res.status !== 200) {
                                alert(res.message);
                                return;
                            }
                            self.parents('tr').remove();
                            checkRecordTable('#list-categories')
                        }).fail(function (res) {
                                self.prop('disabled', false);
                                alert(res.message);
                            }
                        )
                    }
                })
            })
            $('.btn-restore').click(function (e) {
                e.preventDefault();
                let self = $(this);
                let cateID = self.attr('data-id');
                Swal.fire({
                    title: "{{ __('Bạn có chắc chắn muốn khôi phục danh mục này không?') }}",
                    showCancelButton: true,
                    cancelButtonText: "{{ __('Huỷ') }}",
                    confirmButtonText: "{{ __('Đồng ý') }}",
                }).then(function (result) {
                    if (result.isConfirmed) {
                        self.prop('disabled', true);
                        $.ajax("{{ route('admin::category.restore','') }}/" + cateID, {
                            type: 'post',
                            data: {
                                _method: 'put'
                            }
                        }).done(function (res) {
                            if (res.status !== 200) {
                                alert(res.message);
                                return;
                            }
                            self.parents('tr').remove();
                            checkRecordTable('#list-categories')
                        }).fail(function (res) {
                                self.prop('disabled', false);
                                alert(res.message);
                            }
                        )
                    }
                })
            })
        })
    </script>
@endpush
