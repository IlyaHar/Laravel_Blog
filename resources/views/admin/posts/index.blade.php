@extends('admin.layouts.main')

@section('title') Posts @endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-10">
                        <h1 class="m-0">Posts</h1>
                    </div>
                    <div class="col-2">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Posts</li>
                        </ol>
                    </div>
                    <div class="mt-3">
                        <a href="{{ route('admin.posts.create') }}" class="btn btn-success mx-2">Add</a>
                    </div>
                </div><!-- /.row -->
                <div class="row">
                    <div class="col-8">
                        <table class="table mt-5">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Title</th>
                                <th scope="col">Created At</th>
                                <th scope="col">Updated At</th>
                                <th scope="col">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($posts as $post)
                                <tr>
                                    <th scope="row">{{ $post->id }}</th>
                                    <td>{{ $post->title }}</td>
                                    <td>{{ $post->created_at }}</td>
                                    <td>{{ $post->updated_at->diffForHumans() }}</td>
                                    <td class="d-flex">
                                        <a href="{{ route('admin.posts.show', $post->id) }}"><i class="fas fa-eye bg-primary p-2 rounded mx-2 "></i></a>
                                        <a href="{{ route('admin.posts.edit', $post->id) }}"><i class="fas fa-edit bg-warning p-2 rounded mx-2"></i></a>
                                        <form action="{{ route('admin.posts.delete', $post->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-transparent border-0"><i class="fas fa-trash-alt bg-danger p-2 rounded mr-2"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </div>
    </div>
@endsection
