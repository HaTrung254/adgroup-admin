@extends('layouts.master')
@section('content')
    @if($errors->any())
    <span class="label label-success form-control"><i class="fa fa-check"></i> Cập nhật slider thành công</span>
    @endif
    <table class="table table-hover">
        <thead>
        <tr>
            <th>Title</th>
            <th>Ảnh</th>
            <th>Nội dung</th>
            <th><i class="fa fa-tasks"></i></th>
        </tr>
        </thead>
        <tbody>
        @foreach ($sliders as $item)
            <tr>
                <td>{!! $item->vn_title !!}</td>
                <td><img style="width:200px;height: auto" src="{{ asset($item->image_url) }}" /></td>
                <td>{!! $item->vn_content !!}</td>
                <td>
                    <a href="{{ route('slider_edit', $item->id) }}" class="btn btn-primary">
                        <i class="fa fa-edit"></i> Sửa
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
