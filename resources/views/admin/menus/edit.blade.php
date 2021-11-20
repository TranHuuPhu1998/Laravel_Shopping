@extends('layouts.admin')

@section('title')
<title>AdminLTE 3 | Starter</title>
@endsection

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @include('partials.content-header' , ['name' => 'Menu' , 'key' => 'Edit'])
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <form action="{{ route('menus.update' , ['id' => $menuItem->id ]) }}" method="post">
                    @csrf
                    <div class="form-group">
                      <label> Tên Menu</label>
                      <input type="text" name="name"  class="form-control" value="{{ $menuItem->name }}" placeholder="Nhập Tên Menu">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Chọn Menu cha</label>
                        <select class="form-control" name='parent_id'>
                          <option value='0'>Chọn menu cha</option>
                          {!! $optionSelect !!}
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
