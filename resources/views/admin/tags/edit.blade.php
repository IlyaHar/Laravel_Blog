@extends('admin.layouts.main')

@section('title') Edit tag @endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-10">
                        <h1 class="m-0">Edit tag</h1>
                    </div>
                    <div class="col-2">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.tags.index') }}">Users</a></li>
                            <li class="breadcrumb-item active">Edit</li>
                        </ol>
                    </div>
                </div>
                <div>
                    <form action="{{ route('admin.tags.update', $tag->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" placeholder="Enter title of tag" value="{{ old('title', $tag->title) }}">
                        @error('title')
                        <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                        <input type="submit" class="btn btn-primary mt-3" value="Edit">
                    </form>
                </div>
            </div><!-- /.container-fluid -->
        </div>
    </div>
@endsection
