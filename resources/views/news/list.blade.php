@extends('layouts.master')
@section('content')
    @if($errors->any())
        <span class="label label-success form-control"><i class="fa fa-check"></i> {{ $errors->first() }}</span>
    @endif
    <table class="table table-hover text-center">
        <thead>
        <tr>
            <th>Title</th>
            <th>Ảnh</th>
            <th>Ngày phát hành</th>
            <th>Hiển thị trên website</th>
            <th><i class="fa fa-tasks" style=""></i></th>
        </tr>
        </thead>
        <tbody>
        @foreach ($news as $item)
            <tr>
                <td>{!! $item->vn_title !!}</td>
                <td><img style="width:200px;height: auto" src="{{ asset($item->image_url) }}" /></td>
                <td>@dateFormat($item->release_at)</td>
                <td>@isDisplay($item->is_display)</td>
                <td>
                    <a href="{{ route('new_edit', $item->id) }}" class="btn btn-primary">
                        <i class="fa fa-edit"></i> Sửa
                    </a>
                    <a class="btn btn-danger btnDelete" href="{{ route('new_delete', $item->id) }}">
                        <i class="fa fa-remove"></i> Xóa
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="pull-right" style="padding:10px">
        {{ $news->links() }}
    </div>

@endsection