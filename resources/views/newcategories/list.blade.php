@extends('layouts.master')
@section('content')
    @if($errors->any())
        <span class="label label-success form-control"><i class="fa fa-check"></i> {{ $errors->first() }}</span>
    @endif
    <table class="table table-hover">
        <thead>
        <tr>
            <th>Title</th>
            <th>Title (EN)</th>
            <th>Hiển thị trên website</th>
            <th>Thứ tự hiển thị</th>
            <th><i class="fa fa-tasks" style=""></i></th>
        </tr>
        </thead>
        <tbody>
        @foreach ($cates as $item)
            <tr>
                <td>{!! $item->vn_title !!}</td>
                <td>{!! $item->en_title !!}</td>
                <td>@isDisplay($item->is_display)</td>
                <td>{!! $item->order !!}</td>
                <td>
                    <a href="{{ route('new_category_edit', $item->id) }}" class="btn btn-primary">
                        <i class="fa fa-edit"></i> Sửa
                    </a>
                    <a class="btn btn-danger btnDelete" href="{{ route('new_category_delete', $item->id) }}">
                        <i class="fa fa-remove"></i> Xóa
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="pull-right" style="padding:10px">
        {{ $cates->links() }}
    </div>
@endsection
