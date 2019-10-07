@extends('layouts.master')
@section('content')
    @if($errors->any())
        <span class="label label-success form-control"><i class="fa fa-check"></i> {{ $errors->first() }}</span>
    @endif
    <table class="table table-hover">
        <thead>
        <tr>
            <th>Title</th>
            <th>Ảnh</th>
            <th>Hiển thị</th>
            <th>Thứ tự</th>
            <th><i class="fa fa-tasks"></i></th>
        </tr>
        </thead>
        <tbody>
        @foreach ($sliders as $item)
            <tr>
                <td>{!! $item->vn_title !!}</td>
                <td><img style="width:200px;height: auto" src="{{ asset($item->image_url) }}" /></td>
                <td>@isDisplay($item->is_display)</td>
                <td>{{ $item->order }}</td>
                <td>
                    <a href="{{ route('slider_edit', $item->id) }}" class="btn btn-primary">
                        <i class="fa fa-edit"></i> Sửa
                    </a>
                    <a class="btn btn-danger btnDelete" href="{{ route('slider_delete', $item->id) }}">
                        <i class="fa fa-remove"></i> Xóa
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
