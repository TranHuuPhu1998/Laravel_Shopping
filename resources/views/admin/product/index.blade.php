@extends('layouts.admin')

@section('title')
<title>Add Product</title>
@endsection

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @include('partials.content-header' , ['name' => 'Product' , 'key' => 'List'])
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <a href="{{ route('product.create') }}" class="btn btn-success float-right m-2">Add Prouduct</a>
            </div>
            <div class="col-md-12">
                <table class="table ">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Tên Sảm Phẩm</th>
                        <th scope="col">Giá</th>
                        <th scope="col">Hình Ảnh</th>
                        <th scope="col">Danh mục</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    {{-- @foreach ($categories as $category)
                      <tr>
                        <th scope="row">{{ $category->id }}</th>
                        <td>{{ $category->name }}</td>
                        <td>
                            <a href="#" class="btn btn-default">Edit</a>
                            <a href="#" class="btn btn-danger">Delete</a>
                        </td>
                      </tr>
                    @endforeach --}}
                    </tbody>
                  </table>
            </div>
            <div class="col-md-12">
                {{-- {{ $categories->links() }} --}}
            </div>
        </div>
      </div>
    </div>
    <!-- /.content -->
  </div>

@endsection
