@extends('admin.layouts.main')

@section('title') {{ $user->name }}@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-10">
                        <h1 class="m-0">{{ $user->name }}</h1>
                    </div>
                    <div class="col-2">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">Users</a></li>
                            <li class="breadcrumb-item active">{{ $user->name }}</li>
                        </ol>
                    </div>
                    <div class="d-flex mt-3">
                        <a href="{{ route('admin.users.edit', $user->id) }}"><i class="fas fa-edit bg-warning p-2 rounded mx-2"></i></a>
                        <form action="{{ route('admin.users.delete', $user->id) }}" method="POST">
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
                                    <td>{{ $user->id }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Title:</th>
                                    <td>{{ $user->name }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Created At:</th>
                                    <td>{{ $user->created_at }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Updated At:</th>
                                    <td>{{ $user->updated_at->diffForHumans() }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </div>
    </div>
@endsection
