@extends('layouts.master')
@section('content')
    @if($errors->any())
    <span class="label label-danger form-control"><i class="fa fa-warning"></i> Có lỗi xảy ra, vui lòng thử lại.</span>
    @endif
    <form action="{{ route('slider_edit', $slider->id) }}" method="POST" enctype="multipart/form-data" class="form-horizontal card-body">
        {{ csrf_field() }}
        <input type="hidden" name="id" value="{{ $slider->id }}">
        <div class="form-group row">
            <label for="image_url" class="col-sm-2 control-label">Ảnh hiện tại</label>
            <div class="col-sm-10">
                <img style="width:200px;height: auto" src="@assetUrl($slider->image_url)">
            </div>
        </div>
        <div class="form-group row">
            <label for="vn_title" class="col-sm-2 control-label">Title</label>
            <div class="col-sm-10">
                <textarea class="textarea form-control" id="vn_title" name="vn_title" placeholder="Title">{!! $slider->vn_title !!}</textarea>
            </div>
        </div>
        <div class="form-group row">
            <label for="en_title" class="col-sm-2 control-label">Title (EN)</label>
            <div class="col-sm-10">
                <textarea class="textarea form-control" id="en_title" name="en_title" placeholder="Title (EN)">{!! $slider->en_title !!}</textarea>
            </div>
        </div>
        <div class="form-group row">
            <label for="vn_vertical_title" class="col-sm-2 control-label">Title dọc</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="vn_vertical_title" name="vn_vertical_title" placeholder="Title dọc" value="{{ $slider->vn_vertical_title }}">
            </div>
        </div>
        <div class="form-group row">
            <label for="en_vertical_title" class="col-sm-2 control-label">Title dọc (EN)</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="en_vertical_title" name="en_vertical_title" placeholder="Title dọc (EN)" value="{{ $slider->en_vertical_title }}">
            </div>
        </div>
        <div class="form-group row">
            <label for="vn_horizontal_title" class="col-sm-2 control-label">Title ngang</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="vn_horizontal_title" name="vn_horizontal_title" placeholder="Title ngang" value="{{ $slider->vn_horizontal_title }}">
            </div>
        </div>
        <div class="form-group row">
            <label for="en_horizontal_title" class="col-sm-2 control-label">Title ngang (EN)</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="en_horizontal_title" name="en_horizontal_title" placeholder="Title ngang (EN)" value="{{ $slider->en_horizontal_title }}">
            </div>
        </div>
        <div class="form-group row">
            <label for="vn_content" class="col-sm-2 control-label">Nội dung</label>
            <div class="col-sm-10">
                <textarea class="textarea form-control" id="vn_content" name="vn_content" placeholder="Nội dung">{!! $slider->vn_content !!}</textarea>
            </div>
        </div>
        <div class="form-group row">
            <label for="en_content" class="col-sm-2 control-label">Nội dung (EN)</label>
            <div class="col-sm-10">
                <textarea class="textarea form-control" id="en_content" name="en_content" placeholder="Nội dung (EN)">{!! $slider->en_content !!}</textarea>
            </div>
        </div>
        <div class="form-group row">
            <label for="image_url" class="col-sm-2 control-label">Ảnh mới</label>
            <div class="col-sm-10">
                <input type="file" class="form-control" id="image_url" name="image_url" placeholder="Ảnh">
            </div>
        </div>
        <div class="form-group row pull-right">
            <button class="btn btn-info" style="margin-right: 10px"><i class="fa fa-save"></i> Lưu</button>
        </div>
    </form>
    
@endsection
@section('javascript')
@endsection