@extends('admin.layouts.main')

@section('title') {{ $category->title }}@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-10">
                        <h1 class="m-0">{{ $category->title }}</h1>
                    </div>
                    <div class="col-2">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.categories.index') }}">Categories</a></li>
                            <li class="breadcrumb-item active">{{ $category->title }}</li>
                        </ol>
                    </div>
                    <div class="mt-3 d-flex">
                        <a href="{{ route('admin.categories.edit', $category->id) }}"><i class="fas fa-edit bg-warning p-2 rounded mx-2"></i></a>
                        <form action="{{ route('admin.categories.delete', $category->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-transparent border-0"><i class="fas fa-trash-alt bg-danger p-2 rounded mr-2"></i></button>
                        </form>
                    </div>
                </div><!-- /.row -->
                <div class="row">
                    <div class="col-8">
                        <table class="table mt-5">
                            <tbody>
                                <tr>
                                    <th scope="row">ID:</th>
                                    <td>{{ $category->id }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Title:</th>
                                    <td>{{ $category->title }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Created At:</th>
                                    <td>{{ $category->created_at }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Updated At:</th>
                                    <td>{{ $category->updated_at->diffForHumans() }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </div>
    </div>
@endsection
