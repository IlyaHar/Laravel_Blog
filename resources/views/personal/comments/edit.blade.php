@extends('personal.layouts.main')

@section('title') Edit comment @endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Edit comment</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('personal.index') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('personal.comments.index') }}">Comments</a></li>
                            <li class="breadcrumb-item active">Edit</li>
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
                    <form action="{{ route('personal.comments.update', $comment->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <textarea name="message" class="form-control @error('message') is-invalid @enderror w-50" placeholder="Enter message" >{{ old('message', $comment->message) }}</textarea>
                        @error('message')
                        <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                        <input type="submit" class="btn btn-primary mt-3" value="Edit">
                    </form>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
