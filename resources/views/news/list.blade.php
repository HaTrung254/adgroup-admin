@extends('layouts.master')
@section('content')
    @if($errors->any())
        <span class="label label-success form-control"><i class="fa fa-check"></i> Cập nhật sản phẩm thành công</span>
    @endif
    <table class="table table-hover">
        <thead>
        <tr>
            <th>Title</th>
            <th>Ảnh</th>
            <th>Nội dung</th>
            <th>Giá</th>
            <th><i class="fa fa-tasks" style=""></i></th>
        </tr>
        </thead>
        <tbody>
        @foreach ($products as $item)
            <tr>
                <td>{!! $item->vn_title !!}</td>
                <td><img style="width:200px;height: auto" src="{{ asset($item->image_url) }}" /></td>
                <td>{!! $item->vn_content !!}</td>
                <td>{{ number_format($item->price) }}</td>
                <td>
                    <a href="{{ route('product_edit', $item->id) }}" class="btn btn-primary">
                        <i class="fa fa-edit"></i> Sửa
                    </a>
                    <a class="btn btn-danger btnDelete" href="{{ route('product_delete', $item->id) }}">
                        <i class="fa fa-remove"></i> Xóa
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="pull-right" style="padding:10px">
        {{ $products->links() }}
    </div>

@endsection