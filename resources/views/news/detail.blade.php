@extends('layouts.master')
@section('content')
    @if($errors->any())
        <span class="label label-danger form-control"><i class="fa fa-warning"></i> Có lỗi xảy ra, vui lòng thử lại.</span>
    @endif
    <form action="{{ empty($new->id) ? route('new_create') : route('new_edit', $new->id) }}" method="POST" enctype="multipart/form-data" class="form-horizontal card-body">
        {{ csrf_field() }}
        <input type="hidden" name="id" value="@getIfEmpty($new->id)">
        @if(!empty($new->image_url))
            <div class="form-group row">
                <label for="image_url" class="col-sm-2 control-label">Ảnh hiện tại</label>
                <div class="col-sm-10">
                    <img style="width:200px;height: auto" src="@assetUrl($new->image_url)">
                </div>
            </div>
        @endif
		<div class="form-group row">
            <label for="is_display" class="col-sm-2 control-label">Hiển thị tin trên website</label>
            <div class="col-sm-10">
                <input type="checkbox" id="is_display" name="is_display" @if(!empty($new->is_display)) checked @endif>
            </div>
        </div>
        <div class="form-group row">
            <label for="vn_title" class="col-sm-2 control-label">Danh mục</label>
            <div class="col-sm-10">
                <select class="form-control" id="category_id" name="category_id" required>
                    <option value="">Chọn danh mục</option>
                    @foreach($newCates as $cate)
                        <option @if(!empty($new->category_id) && $cate->id == $new->category_id) selected @endif value="{{ $cate->id }}">{{ $cate->vn_title }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="vn_title" class="col-sm-2 control-label">Title</label>
            <div class="col-sm-10">
                <input class="form-control" id="vn_title" name="vn_title" placeholder="Title" required
                       value="@getIfEmpty($new->vn_title)">
            </div>
        </div>
        <div class="form-group row">
            <label for="en_title" class="col-sm-2 control-label">Title (EN)</label>
            <div class="col-sm-10">
                <input class="form-control" id="en_title" name="en_title" placeholder="Title (EN)" required
                       value="@getIfEmpty($new->en_title)">
            </div>
        </div>
        <div class="form-group row">
            <label for="vn_content" class="col-sm-2 control-label">Nội dung</label>
            <div class="col-sm-10">
                <textarea class="textarea form-control" id="vn_content" name="vn_content" placeholder="Nội dung">
                    @getIfEmpty($new->vn_content)
                </textarea>
            </div>
        </div>
        <div class="form-group row">
            <label for="en_content" class="col-sm-2 control-label">Nội dung (EN)</label>
            <div class="col-sm-10">
                <textarea class="textarea form-control" id="en_content" name="en_content" placeholder="Nội dung (EN)">
                    @getIfEmpty($new->en_content)</textarea>
            </div>
        </div>
        <div class="form-group row">
            <label for="release_at" class="col-sm-2 control-label">Ngày phát hành</label>
            <div class="col-sm-10">
                <input class="form-control datepicker" type="text" id="release_at" name="release_at" placeholder="Ngày phát hành"
                       value ="{{ !empty($new->release_at) ? date('d/m/Y', strtotime($new->release_at)) : date('d/m/Y') }}">
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