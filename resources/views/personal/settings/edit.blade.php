@extends('personal.layouts.main')

@section('title') Edit comment @endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Settings</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('personal.index') }}">Home</a></li>
                            <li class="breadcrumb-item active">Settings</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div>
                    <form action="{{ route('personal.settings.update', auth()->user()->id) }}" method="POST" enctype="multipart/form-data" class="w-50">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label for="exampleInputFile">Upload avatar</label>
                            <div class="box">
                                <a href="{{filter_var(auth()->user()->avatar, FILTER_VALIDATE_URL) ? auth()->user()->avatar : Storage::url(auth()->user()->avatar) }}"><img class="avatar" src="{{ filter_var(auth()->user()->avatar, FILTER_VALIDATE_URL) ? auth()->user()->avatar : Storage::url(auth()->user()->avatar) }}" alt=""></a>
                            </div>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input @error('avatar') is-invalid @enderror" name="avatar" id="exampleInputFile">
                                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                </div>
                                @error('avatar')
                                <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        @error('message')
                        <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                        <input type="submit" class="btn btn-info mt-3" value="Upload">
                    </form>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
