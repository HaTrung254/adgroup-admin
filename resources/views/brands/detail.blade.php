@extends('layouts.master')
@section('content')
    @if($errors->any())
        <span class="label label-danger form-control"><i class="fa fa-warning"></i> {{ $errors->first() }}</span>
    @endif
    <form action="{{ empty($brand->id) ? route('brand_create') : route('brand_edit', $brand->id) }}" method="POST" class="form-horizontal card-body">
        {{ csrf_field() }}
        <input type="hidden" name="id" value="@getIfEmpty($brand->id)">
        <div class="form-group row">
            <label for="order" class="col-sm-2 control-label">Hiển thị trên website</label>
            <div class="col-sm-10">
                <input type="checkbox" id="is_display" name="is_display"
                       @if(!empty($brand->is_display)) checked @endif>
            </div>
        </div>
        <div class="form-group row">
            <label for="vn_title" class="col-sm-2 control-label">Title</label>
            <div class="col-sm-10">
                <input class="form-control" id="vn_title" name="vn_title" placeholder="Title" required
                       value="@getIfEmpty($brand->vn_title)">
            </div>
        </div>
        <div class="form-group row">
            <label for="en_title" class="col-sm-2 control-label">Tilte (EN)</label>
            <div class="col-sm-10">
                <input class="form-control" id="en_title" name="en_title" placeholder="Title (EN)" required
                       value="@getIfEmpty($brand->en_title)">
            </div>
        </div>

        <div class="form-group row">
            <label for="vn_content" class="col-sm-2 control-label">Nội dung</label>
            <div class="col-sm-10">
                <textarea class="textarea form-control" id="vn_content" name="vn_content" placeholder="Nội dung">
                    @getIfEmpty($brand->vn_content)
                </textarea>
            </div>
        </div>

        <div class="form-group row">
            <label for="en_content" class="col-sm-2 control-label">Nội dung (EN)</label>
            <div class="col-sm-10">
                <textarea class="textarea form-control" id="en_content" name="en_content" placeholder="Nội dung (EN)">
                    @getIfEmpty($brand->en_content)
                </textarea>
            </div>
        </div>

        <div class="form-group row">
            <label for="order" class="col-sm-2 control-label">Thứ tự hiển thị</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" id="order" name="order" placeholder="Thứ tự hiển thị" required
                       value="@getIfEmpty($brand->order)">
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