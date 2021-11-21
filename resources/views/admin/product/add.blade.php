@extends('layouts.admin')

@section('title')
    <title>Add Product</title>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('vendors/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admins/product/add/add.css') }}">
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @include('partials.content-header' , ['name' => 'Product' , 'key' => 'Add'])
        <!-- /.content-header -->

        <!-- Main content -->
        <form action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            @csrf
                            <div class="form-group">
                                <label>Tên Sản Phẩm</label>
                                <input type="text" name="name" class="form-control" placeholder="Nhập tên sản phẩm">
                            </div>
                            <div class="form-group">
                                <label>Tên Giá Sản phẩm</label>
                                <input type="text" name="price" class="form-control" placeholder="Nhập Giá sản phẩm">
                            </div>
                            <div class="form-group">
                                <label>Ảnh đại diện</label>
                                <input type="file" name="feature_image_path" class="form-control-file border">
                            </div>
                            <div class="form-group">
                                <label>Ảnh chi tiết</label>
                                <input type="file" multiple name="image_path[]" class="form-control-file border">
                            </div>
                            <div class="form-group">
                                <label>Chọn danh mục</label>
                                <select class="form-control select2_init" name="category_id">
                                    <option value='0'>Chọn danh mục</option>
                                    {!! $htmlOption !!}
                                </select>
                            </div>
                            <div class=" form-group">
                                <label>Nhập tag cho sản phẩm</label>
                                <select name="tags[]" class="form-control tags_select_choose" multiple="multiple">
                                </select>
                            </div>

                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Nhập nội dung</label>
                                <textarea name="contents" class="form-control timymce_init" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!-- /.content -->
    </div>

@endsection


@section('js')
    <script src="{{ asset('vendors/select2/select2.min.js') }}"></script>
    <script src="https://cdn.tiny.cloud/1/62vfvm5uds8h274jjk8ibfew5h67hchlwrdaap42yn3s8tbe/tinymce/4/tinymce.min.js"
        referrerpolicy="origin"></script>
    <script src="{{ asset('admins/product/add/add.js') }}"></script>
@endsection
