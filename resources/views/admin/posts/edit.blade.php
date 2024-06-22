@extends('admin.layouts.main')

@section('title') Edit post @endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-10">
                        <h1 class="m-0">Edit post</h1>
                    </div>
                    <div class="col-2">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.posts.index') }}">Posts</a></li>
                            <li class="breadcrumb-item active">Edit</li>
                        </ol>
                    </div>
                </div>
                <div>
                    <form action="{{ route('admin.posts.update', $post->id) }}" method="POST" class="w-75" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror " placeholder="Enter title of post" value="{{ old('title', $post->title) }}">
                            @error('title')
                            <p class="invalid-feedback">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <textarea id="summernote" name="content" class="@error('content') is-invalid @enderror">{{ old('content', $post->content) }}</textarea>
                            @error('content')
                            <p class="invalid-feedback">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Add preview</label>
                            <div class="w-25">
                                <img src="{{ asset(Storage::url($post->preview_image)) }}" alt="preview_image"  class="w-25 pb-3">
                            </div>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input @error('preview_image') is-invalid @enderror" name="preview_image" id="exampleInputFile">
                                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                </div>
                                <div class="input-group-append">
                                    <span class="input-group-text">Upload</span>
                                </div>
                            </div>
                            @error('preview_image')
                            <p class="invalid-feedback">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Add main image</label>
                            <div>
                                <img src="{{ asset(Storage::url($post->main_image)) }}" alt="main_image" class="w-25 pb-3">
                            </div>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" name="main_image" class="custom-file-input @error('main_image') is-invalid @enderror">
                                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                </div>
                                <div class="input-group-append">
                                    <span class="input-group-text">Upload</span>
                                </div>
                            </div>
                            @error('main_image')
                            <p class="invalid-feedback">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="category_id">Choose category</label>
                            <select name="category_id" class="custom-select">
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ $category->id == old('category_id', $post->category_id) ? 'selected' : '' }}>
                                        {{ $category->title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Choose tags</label>
                            <select class="select2" name="tags_ids[]" multiple="multiple" data-placeholder="Choose tags" style="width: 100%;">
                                @foreach($tags as $tag)
                                    <option {{ is_array(old('tags_ids', $post->tags->pluck('id')->toArray())) && in_array($tag->id, old('tags_ids', $post->tags->pluck('id')->toArray())) ? 'selected' : '' }}
                                            value="{{ $tag->id }}">{{ $tag->title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <input type="submit" class="btn btn-primary mt-3" value="Edit">
                    </form>
                </div>
            </div><!-- /.container-fluid -->
        </div>
    </div>
@endsection
