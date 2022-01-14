@extends('layouts.admin')

@section('title')
    <title>AdminLTE 3 | Starter</title>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('admins/slider/index/index.css') }}">
@endsection

@section('js')
    <script src="{{ asset('vendors/sweetalert2/sweetalert2.js') }}"></script>
    <script src="{{ asset('admins/slider/index/index.js') }}"></script>
@endsection


@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @include('partials.content-header' , ['name' => 'Slider' , 'key' => 'List'])
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <a href="{{ route('slider.create') }}" class="btn btn-success float-right m-2">Add Menu</a>
            </div>
            <div class="col-md-12">
                <table class="table ">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Tên Slider</th>
                        <th scope="col">Description</th>
                        <th scope="col">Hình Ảnh</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach ($sliders as $sliderItem)
                      <tr>
                        <td>{{ $sliderItem->id }}</td>
                        <td>{{ $sliderItem->name }}</td>
                        <td>{{ $sliderItem->description }}</td>
                        <td>
                            <img class='image_slider' src="{{ $sliderItem->image_path }}" alt="">
                        </td>
                        <td>
                            <a href="{{ route('slider.edit', ['id' => $sliderItem->id]) }}" class="btn btn-default">Edit</a>
                            <a href="#" data-url="{{ route('slider.delete' , ['id' => $sliderItem->id]) }}" class="btn btn-danger action_delete">Delete</a>
                        </td>
                      </tr>
                    @endforeach
                    </tbody>
                  </table>
            </div>
            <div class="col-md-12">
                {{-- {{ $menus->links() }} --}}
            </div>
        </div>
      </div>
    </div>
    <!-- /.content -->
  </div>

@endsection
