@extends('layouts.admin')

@section('title')
<title>AdminLTE 3 | Starter</title>
@endsection

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @include('partials.content-header' , ['name' => 'Slider' , 'key' => 'Add'])
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <form action="{{ route('slider.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                      <label>Tên Silder</label>
                      <input
                      type="text"
                      name="name"
                      class="form-control @error('name') is-invalid @enderror"
                      placeholder="Nhập Tên Slider"
                      value="{{ old('name') }}"
                      >
                        @error('name')
                          <div class="alert alert-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Mô tả Slider</label>
                        <textarea
                            type="text"
                            name="description"
                            rows="4"
                            class="form-control @error('description') is-invalid @enderror"
                        >
                        {{ old('description') }}
                        </textarea>
                        @error('description')
                          <div class="alert alert-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Mô tả Slider</label>
                        <input type="file" name="image_path" class="form-control-file @error('image_path') is-invalid @enderror">
                        @error('image_path')
                          <div class="alert alert-danger mt-1">{{ $message }}</div>
                        @enderror
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
