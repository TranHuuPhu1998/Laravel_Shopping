@extends('layouts.admin')

@section('title')
<title>Settings</title>
@endsection

@section('js')
    <script src="{{ asset('vendors/sweetalert2/sweetalert2.js') }}"></script>
    <script src="{{ asset('admins/main.js') }}"></script>
@endsection


@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @include('partials.content-header' , ['name' => 'settings' , 'key' => 'List'])
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 d-flex mb-4">
                <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Add Setting
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="{{ route('settings.create') . '?type=Text' }}">Text</a>
                    <a class="dropdown-item" href="{{ route('settings.create') . '?type=Textarea' }}">Textarea</a>
                </div>
                </div>
            </div>
            <div class="col-md-12">
                <table class="table ">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Config key</th>
                        <th scope="col">Config vakue</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach ($settings as $setting)
                      <tr>
                        <th scope="row">{{ $setting->id }}</th>
                        <td>{{ $setting->config_key }}</td>
                        <td>{{ $setting->config_value }}</td>
                        <td>
                            <a href="{{ route('settings.edit' , ['id' => $setting->id]) . '?type=' . $setting->type }}" class="btn btn-default">Edit</a>
                            <a data-url='{{ route('settings.delete' , ['id' => $setting->id]) }}' class="btn btn-danger action_delete">Delete</a>
                        </td>
                      </tr>
                    @endforeach

                    </tbody>
                  </table>
            </div>
            <div class="col-md-12">
                {{ $settings->links() }}
            </div>
        </div>
      </div>
    </div>
    <!-- /.content -->
  </div>

@endsection
