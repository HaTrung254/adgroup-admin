@extends('layouts.master')
@section('content')
    <form class="form-horizontal card-body">
        <div class="form-group row">
            <label for="vn_title" class="col-sm-2 control-label">Title</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="vn_title" name="vn_title" placeholder="Title">
            </div>
        </div>
        <div class="form-group row">
            <label for="en_title" class="col-sm-2 control-label">Title (EN)</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="en_title" name="en_title" placeholder="Title (EN)">
            </div>
        </div>
        <div class="form-group row">
            <label for="vn_vertical_title" class="col-sm-2 control-label">Title dọc</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="vn_vertical_title" name="vn_vertical_title" placeholder="Title dọc">
            </div>
        </div>
        <div class="form-group row">
            <label for="en_vertical_title" class="col-sm-2 control-label">Title dọc (EN)</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="en_vertical_title" name="en_vertical_title" placeholder="Title dọc (EN)">
            </div>
        </div>
        <div class="form-group row">
            <label for="vn_horizontal_title" class="col-sm-2 control-label">Title ngang</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="vn_horizontal_title" name="vn_horizontal_title" placeholder="Title ngang">
            </div>
        </div>
        <div class="form-group row">
            <label for="en_horizontal_title" class="col-sm-2 control-label">Title ngang (EN)</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="en_horizontal_title" name="en_horizontal_title" placeholder="Title ngang (EN)">
            </div>
        </div>
        <div class="form-group row">
            <label for="en_title" class="col-sm-2 control-label">Title (EN)</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="en_title" name="en_title" placeholder="Title (EN)">
            </div>
        </div>
    </form>
@endsection