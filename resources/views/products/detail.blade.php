@extends('layouts.master')
@section('content')
    @if($errors->any())
        <span class="label label-danger form-control"><i class="fa fa-warning"></i> Có lỗi xảy ra, vui lòng thử lại.</span>
    @endif
    <form action="{{ empty($product->id) ? route('product_create') : route('product_edit', $product->id) }}" method="POST" enctype="multipart/form-data" class="form-horizontal card-body">
        {{ csrf_field() }}
        <input type="hidden" name="id" value="@getIfEmpty($product->id)">
        @if(!empty($product->image_url))
            <div class="form-group row">
                <label for="image_url" class="col-sm-2 control-label">Ảnh hiện tại</label>
                <div class="col-sm-10">
                    <img style="width:200px;height: auto" src="@assetUrl($product->image_url)">
                </div>
            </div>
        @endif
        <div class="form-group row">
            <label for="order" class="col-sm-2 control-label">Hiển thị trên website</label>
            <div class="col-sm-10">
                <input type="checkbox" id="is_display" name="is_display"
                       @if(!empty($product->is_display)) checked @endif>
            </div>
        </div>
        <div class="form-group row">
            <label for="vn_title" class="col-sm-2 control-label">Danh mục</label>
            <div class="col-sm-10">
                <select class="form-control" id="category_id" name="category_id" required>
                    <option value="">Chọn danh mục</option>
                    @foreach($productCates as $cate)
                        <option @if(!empty($product->category_id) && $cate->id == $product->category_id) selected @endif value="{{ $cate->id }}">{{ $cate->vn_title }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="vn_title" class="col-sm-2 control-label">Loại sản phẩm</label>
            <div class="col-sm-10">
                <select class="form-control" id="type" name="type" required>
                    <option value="">Loại sản phẩm</option>
                    @foreach($productTypes as $key => $type)
                        <option @if(!empty($product->type) && $product->type == $key) selected @endif value="{{ $key }}">{{ $type }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="vn_title" class="col-sm-2 control-label">Title</label>
            <div class="col-sm-10">
                <input class="form-control" id="vn_title" name="vn_title" placeholder="Title" required
                       value="@getIfEmpty($product->vn_title)">
            </div>
        </div>
        <div class="form-group row">
            <label for="en_title" class="col-sm-2 control-label">Title (EN)</label>
            <div class="col-sm-10">
                <input class="form-control" id="en_title" name="en_title" placeholder="Title (EN)" required
                       value="@getIfEmpty($product->en_title)">
            </div>
        </div>
        <div class="form-group row">
            <label for="vn_content" class="col-sm-2 control-label">Nội dung</label>
            <div class="col-sm-10">
                <textarea class="textarea form-control" id="vn_content" name="vn_content" placeholder="Nội dung">
                    @getIfEmpty($product->vn_content)
                </textarea>
            </div>
        </div>
        <div class="form-group row">
            <label for="en_content" class="col-sm-2 control-label">Nội dung (EN)</label>
            <div class="col-sm-10">
                <textarea class="textarea form-control" id="en_content" name="en_content" placeholder="Nội dung (EN)">
                    @getIfEmpty($product->en_content)</textarea>
            </div>
        </div>
        <div class="form-group row">
            <label for="en_content" class="col-sm-2 control-label">Giá tiền</label>
            <div class="col-sm-10">
                <input class="form-control" type="number" id="price" name="price" placeholder="Giá tiền"
                       value ="@getIfEmpty($product->price)">
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