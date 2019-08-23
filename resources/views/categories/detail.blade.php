@extends('layouts.master')
@section('content')
    @if($errors->any())
        <span class="label label-danger form-control"><i class="fa fa-warning"></i> Có lỗi xảy ra, vui lòng thử lại.</span>
    @endif
    <form action="{{ empty($category->id) ? route('category_create') : route('category_edit', $category->id) }}" method="POST" class="form-horizontal card-body">
        {{ csrf_field() }}
        <input type="hidden" name="id" value="@getIfEmpty($category->id)">
        <div class="form-group row">
            <label for="vn_title" class="col-sm-2 control-label">Title</label>
            <div class="col-sm-10">
                <input class="form-control" id="vn_title" name="vn_title" placeholder="Title" required
                       value="@getIfEmpty($category->vn_title)">
            </div>
        </div>
        <div class="form-group row">
            <label for="en_title" class="col-sm-2 control-label">Tilte (EN)</label>
            <div class="col-sm-10">
                <input class="form-control" id="en_title" name="en_title" placeholder="Title (EN)" required
                       value="@getIfEmpty($category->en_title)">
            </div>
        </div>
        <div class="form-group row">
            <label for="order" class="col-sm-2 control-label">Thứ tự</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" id="order" name="order" placeholder="Thứ tự" required
                       value="@getIfEmpty($category->order)">
            </div>
        </div>
        <div class="form-group row pull-right">
            <button class="btn btn-info" style="margin-right: 10px"><i class="fa fa-save"></i> Lưu</button>
        </div>
    </form>
@endsection