@extends('admin::layouts.default')
@section('content')
    <div class="mb-3">
        <a href="{{ route('admin::category.create') }}" class="btn btn-info mr-2">
            <i class="fas fa-folder-plus"></i>
            {{ __('Thêm danh mục') }}
        </a>
        <a href="{{ route('admin::category.trash') }}" class="btn btn-danger">
            <i class="fas fa-trash-alt"></i>
            {{ __('Thùng rác') }}</a>
    </div>
    <div class="table-responsive">
        <table class="table table-hover" id="list-categories">
            <thead>
            <tr>
                <th>{{ __('Tên danh mục') }}</th>
                <th>{{ __('Số sản phẩm') }}</th>
                <th>{{ __('Cấp độ') }}</th>
                <th>{{ __('Danh mục cha') }}</th>
                <th>{{ __('Thao tác') }}</th>
            </tr>
            </thead>
            <tbody>
            @forelse ($categories as $category)
                <tr>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->products_count }}</td>
                    <td>{{ $category->level }}</td>
                    <td>{{ @$category->parent->name }}</td>
                    <td>
                        <a href="{{ route('admin::category.show',$category->id) }}" class="btn btn-info">
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('admin::category.edit',$category->id) }}" class="btn btn-warning">
                            <i class="far fa-edit"></i>
                        </a>
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
                    title: "{{ __('Bạn có chắc chắn muốn xóa danh mục này không?') }}",
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
