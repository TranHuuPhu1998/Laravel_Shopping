@extends('layouts.admin')

@section('title')
<title>Settings</title>
@endsection

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @include('partials.content-header' , ['name' => 'Setting' , 'key' => 'Edit'])
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <form action="{{ route('settings.update', ['id' => $setting->id]) }}" method="post">
                    @csrf

                    <div class="form-group">
                      <label>Conflig key</label>
                        <input
                            type="text"
                            name="config_key"
                            class="form-control @error('config_key') is-invalid @enderror"
                            placeholder="Enter conflig key"
                            value="{{ old('config_key', $setting->config_key) }}"
                        >

                        @error('config_key')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                    </div>
                    @if (request()->type === 'Text')
                        <div class="form-group">
                            <label>Conflig value</label>
                            <input
                                type="text"
                                name="config_value"
                                class="form-control @error('config_value') is-invalid @enderror"
                                placeholder="Enter conflig value"
                                value="{{ old('config_value', $setting->config_value) }}"
                            >
                            @error('config_value')
                                <div class="alert alert-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    @elseif (request()->type === 'Textarea')
                            <div class="form-group">
                                <label>Conflig value</label>
                                <textarea
                                    rows="4"
                                    name="config_value"
                                    class="form-control @error('config_value') is-invalid @enderror"
                                    placeholder="Enter conflig value">
                                {{ old('config_value',$setting->config_value) }}
                                </textarea>
                                @error('config_value')
                                    <div class="alert alert-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                    @endif


                    <button type="submit" class="btn btn-primary">Submit</button>
                  </form>
            </div>
        </div>
      </div>
    </div>
    <!-- /.content -->
  </div>

@endsection
