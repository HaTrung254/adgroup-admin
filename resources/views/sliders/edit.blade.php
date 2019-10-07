@extends('layouts.master')
@section('content')
    @if($errors->any())
        <span class="label label-danger form-control"><i class="fa fa-warning"></i> {{ $errors->first() }}</span>
    @endif
    <form action="{{ empty($slider) ? route('slider_create') : route('slider_edit', $slider->id) }}" method="POST" enctype="multipart/form-data" class="form-horizontal card-body">
        {{ csrf_field() }}
        @if(!empty($slider->image_url))
        <input type="hidden" name="id" value="{{ $slider->id }}">
        <div class="form-group row">
            <label for="image_url" class="col-sm-2 control-label">Ảnh hiện tại</label>
            <div class="col-sm-10">
                <img style="width:200px;height: auto" src="@assetUrl($slider->image_url)">
            </div>
        </div>
        @endif
        <div class="form-group row">
            <label for="order" class="col-sm-2 control-label">Hiển thị trên website</label>
            <div class="col-sm-10">
                <input type="checkbox" id="is_display" name="is_display"
                       @if(!empty($slider->is_display)) checked @endif>
            </div>
        </div>
        <div class="form-group row">
            <label for="vn_title" class="col-sm-2 control-label">Title</label>
            <div class="col-sm-10">
                <input class="form-control" id="vn_title" name="vn_title" placeholder="Title" value="@getIfEmpty($slider->vn_title)">
            </div>
        </div>
        <div class="form-group row">
            <label for="en_title" class="col-sm-2 control-label">Title (EN)</label>
            <div class="col-sm-10">
                <input class="form-control" id="en_title" name="en_title" placeholder="Title (EN)" value="@getIfEmpty($slider->en_title)">
            </div>
        </div>
        <div class="form-group row">
            <label for="vn_sub_title" class="col-sm-2 control-label">Từ khóa</label>
            <div class="col-sm-10">
                <input class="form-control" id="vn_sub_title" name="vn_sub_title" placeholder="Từ khóa"
                       value="@getIfEmpty($slider->vn_sub_title)" required="">
            </div>
        </div>
        <div class="form-group row">
            <label for="en_sub_title" class="col-sm-2 control-label">Từ khóa (EN)</label>
            <div class="col-sm-10">
                <input class="form-control" id="en_sub_title" name="en_sub_title" placeholder="Từ khóa (EN)"
                value="@getIfEmpty($slider->en_sub_title)" required="">
            </div>
        </div>
        <div class="form-group row">
            <label for="vn_vertical_title" class="col-sm-2 control-label">Title dọc</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="vn_vertical_title" name="vn_vertical_title" placeholder="Title dọc" value="@getIfEmpty($slider->vn_vertical_title)">
            </div>
        </div>
        <div class="form-group row">
            <label for="en_vertical_title" class="col-sm-2 control-label">Title dọc (EN)</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="en_vertical_title" name="en_vertical_title" placeholder="Title dọc (EN)" value="@getIfEmpty($slider->en_vertical_title)">
            </div>
        </div>
        <div class="form-group row">
            <label for="vn_horizontal_title" class="col-sm-2 control-label">Title ngang</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="vn_horizontal_title" name="vn_horizontal_title" placeholder="Title ngang" value="@getIfEmpty($slider->vn_horizontal_title)">
            </div>
        </div>
        <div class="form-group row">
            <label for="en_horizontal_title" class="col-sm-2 control-label">Title ngang (EN)</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="en_horizontal_title" name="en_horizontal_title" placeholder="Title ngang (EN)" value="@getIfEmpty($slider->en_horizontal_title)">
            </div>
        </div>
        <div class="form-group row">
            <label for="vn_content" class="col-sm-2 control-label">Nội dung</label>
            <div class="col-sm-10">
                <textarea class="textarea form-control" id="vn_content" name="vn_content" placeholder="Nội dung" required="">@getIfEmpty($slider->vn_content)</textarea>
            </div>
        </div>
        <div class="form-group row">
            <label for="en_content" class="col-sm-2 control-label">Nội dung (EN)</label>
            <div class="col-sm-10">
                <textarea class="textarea form-control" id="en_content" name="en_content" placeholder="Nội dung (EN)" required="">@getIfEmpty($slider->en_content)</textarea>
            </div>
        </div>
        <div class="form-group row">
            <label for="image_url" class="col-sm-2 control-label">Thứ tự hiển thị</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" id="order" name="order" placeholder="Thứ tự hiển thị" required value="@getIfEmpty($slider->order)">
            </div>
        </div>
        <div class="form-group row">
            <label for="image_url" class="col-sm-2 control-label">Ảnh mới</label>
            <div class="col-sm-10">
                <input type="file" class="form-control" id="image_url" name="image_url" placeholder="Ảnh" @if(empty($slider->image_url)) required="" @endif>
            </div>
        </div>
        <div class="form-group row pull-right">
            <button class="btn btn-info" style="margin-right: 10px"><i class="fa fa-save"></i> Lưu</button>
        </div>
    </form>
    
@endsection
@section('javascript')
@endsection