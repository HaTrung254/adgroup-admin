@extends('layouts.master')
@section('content')
    <table class="table table-hover">
        <thead>
        <tr>
            <th>Title</th>
            <th>Nội dung</th>
            <th>Ảnh</th>
            <th><i class="fa fa-tasks"></i></th>
        </tr>
        </thead>
        <tbody>
        @foreach ($sliders as $item)
            <tr>
                <td>{{ $item->vn_title }}</td>
                <td>{{ $item->vn_content }}</td>
                <td><img src="{{ $item->image_url }}" /></td>
                <td>
                    <a href="{{ route('slider_edit', $item->id) }}" class="btn btn-primary">
                        <i class="fa fa-edit"></i> Sửa
                    </a>
                    {{--<a class="btn btn-danger" href="#"><i class="fa fa-remove"></i> Xóa</a>--}}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
