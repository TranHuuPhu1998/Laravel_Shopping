@extends('layouts.admin')

@section('title')
<title>AdminLTE 3 | Starter</title>
@endsection

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @include('partials.content-header' , ['name' => 'Category' , 'key' => 'Add'])
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <form action="{{ route('categories.store') }}" method="post">
                    @csrf
                    <div class="form-group">
                      <label> Tên Danh Mục</label>
                      <input type="text" name="name" class="form-control" placeholder="Nhập Tên Danh mục">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Chọn danh mục cha</label>
                        <select class="form-control" name='parent_id'>
                          <option value='0'>Chọn danh mục cha</option>
                          {!! $htmlOption !!}
                        </select>
                      </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </form>
            </div>
        </div>
      </div>
    </div>
    <!-- /.content -->
  </div>

@endsection
