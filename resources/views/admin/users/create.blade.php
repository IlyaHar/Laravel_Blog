@extends('admin.layouts.main')

@section('title') Add user @endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-10">
                        <h1 class="m-0">Add user</h1>
                    </div>
                    <div class="col-2">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">Users</a></li>
                            <li class="breadcrumb-item active">Create</li>
                        </ol>
                    </div>
                </div>
                <div>
                    <form class="w-75" action="{{ route('admin.users.store') }}" method="POST" novalidate>
                        @csrf
                        <div class="form-group">
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Enter name of user" value="{{ old('name') }}">
                            @error('name')
                            <p class="invalid-feedback">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Enter email of user" value="{{ old('email') }}">
                            @error('email')
                            <p class="invalid-feedback">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="role">Choose role</label>
                            <select name="role" class="custom-select">
                                @foreach($roles as $id => $role)
                                    <option value="{{ $id }}"
                                        {{ $id == old('role') ? 'selected' : '' }}>
                                        {{ $role }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <input type="submit" class="btn btn-success mt-3" value="Create">
                    </form>
                </div>
            </div><!-- /.container-fluid -->
        </div>
    </div>
@endsection
