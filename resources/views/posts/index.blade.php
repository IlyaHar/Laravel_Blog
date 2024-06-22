@extends('layouts.main')

@section('title') Home @endsection

@section('content')
<main class="blog">
    <div class="container">
        <h1 class="edica-page-title" data-aos="fade-up">Blog</h1>
        <section class="featured-posts-section">
            <div class="row">
                @foreach($posts as $post)
                    <div class="col-md-4 fetured-post blog-post" data-aos="fade-right">
                        <div class="blog-post-thumbnail-wrapper">
                            <img src="{{ \Illuminate\Support\Facades\Storage::url($post->preview_image) }}" alt="blog post">
                        </div>
                        <div class="d-flex justify-content-between">
                            <p class="blog-post-category">{{ $post->category->title }}</p>
                           @auth()
                                <form action="{{ route('posts.likes.store', $post->id) }}" method="POST">
                                    @csrf
                                    <span>{{ $post->liked_users_count }}</span>
                                    <button type="submit" class="border-0 bg-transparent">
                                        <i class="fa{{ auth()->user()->likedPosts->contains($post->id) ? 's' : 'r'}} fa-heart"></i>
                                    </button>
                                </form>
                            @endauth
                            @guest()
                                <div>
                                    <span>{{ $post->liked_users_count }}</span>
                                    <i class="far fa-heart"></i>
                                </div>
                            @endguest
                        </div>
                        @foreach($post->tags as $tag)
                            <span class="blog-post-category text-primary">#{{ $tag->title }}</span>
                        @endforeach
                        <a href="{{ route('posts.show', $post->id) }}" class="blog-post-permalink">
                            <h6 class="blog-post-title">{{ $post->title }}</h6>
                        </a>
                        <p class="blog-post-category mt-3 text-secondary">{{ $post->created_at->diffForHumans() }}</p>
                    </div>
                @endforeach
            </div>
        </section>
        <div class="row">
            <div class="col-12" style="margin-top: -100px">{{ $posts->links() }}</div>
        </div>
        <div class="row mt-5 ">
            <div class="col-md-8">
                <section>
                    <div class="row blog-post-row">
                        @foreach($randomPosts as $randomPost)
                            <div class="col-md-6 blog-post" data-aos="fade-up">
                                <div class="blog-post-thumbnail-wrapper">
                                    <img src="{{ \Illuminate\Support\Facades\Storage::url($randomPost->preview_image) }}" alt="blog post">
                                </div>
                                <div class="d-flex justify-content-between">
                                    <p class="blog-post-category">{{ $randomPost->category->title }}</p>
                                    @auth()
                                        <form action="{{ route('posts.likes.store', $randomPost->id) }}" method="POST">
                                            @csrf
                                            <span>{{ $randomPost->liked_users_count }}</span>
                                            <button type="submit" class="border-0 bg-transparent">
                                                <i class="fa{{ auth()->user()->likedPosts->contains($randomPost->id) ? 's' : 'r'}} fa-heart"></i>
                                            </button>
                                        </form>
                                    @endauth
                                    @guest()
                                        <div>
                                            <span>{{ $randomPost->liked_users_count }}</span>
                                            <i class="far fa-heart"></i>
                                        </div>
                                    @endguest
                                </div>
                                @foreach($randomPost->tags as $tag)
                                    <span class="blog-post-category text-primary">#{{ $tag->title }}</span>
                                @endforeach
                                <a href="{{ route('posts.show', $randomPost->id) }}" class="blog-post-permalink">
                                    <h6 class="blog-post-title">{{ $randomPost->title }}</h6>
                                </a>
                                <p class="blog-post-category mt-3 text-secondary">{{ $randomPost->created_at->diffForHumans() }}</p>
                            </div>
                        @endforeach
                    </div>
                </section>
            </div>
            <div class="col-md-4 sidebar" data-aos="fade-left">
                <div class="widget widget-post-carousel">
                    <h5 class="widget-title">New posts</h5>
                    <div class="post-carousel">
                        <div id="carouselId" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#carouselId" data-slide-to="0" class="active"></li>
                                <li data-target="#carouselId" data-slide-to="1"></li>
                                <li data-target="#carouselId" data-slide-to="2"></li>
                            </ol>
                            <div class="carousel-inner" role="listbox">
                                <figure class="carousel-item active">
                                    <img src="{{ \Illuminate\Support\Facades\Storage::url($newPosts->first()->preview_image) }}" alt="First slide">
                                    <figcaption class="post-title">
                                        <div class="d-flex justify-content-between mx-2">
                                            <a href="{{ route('posts.show',  $newPosts->first()->id) }}">{{ $newPosts->first()->title }}</a>
                                            @auth()
                                                <form action="{{ route('posts.likes.store', $newPosts->first()->id) }}" method="POST">
                                                    @csrf
                                                    <span>{{  $newPosts->first()->liked_users_count }}</span>
                                                    <button type="submit" class="border-0 bg-transparent">
                                                        <i class="fa{{ auth()->user()->likedPosts->contains( $newPosts->first()->id) ? 's' : 'r'}} fa-heart"></i>
                                                    </button>
                                                </form>
                                            @endauth
                                            @guest()
                                                <div>
                                                    <span>{{  $newPosts->first()->liked_users_count  }}</span>
                                                    <i class="far fa-heart"></i>
                                                </div>
                                            @endguest
                                        </div>
                                    </figcaption>
                                </figure>
                                @php
                                    $isFirst = true;
                                @endphp
                                @foreach($newPosts as $newPost)
                                            @if($isFirst)
                                                @php
                                                    $isFirst = false;
                                                    continue;
                                                @endphp
                                            @endif
                                    <div class="carousel-item">
                                        <img src="{{ \Illuminate\Support\Facades\Storage::url($newPost->preview_image) }}" alt="First slide">
                                        <figcaption class="post-title">
                                            <div class="d-flex justify-content-between mx-2">
                                                <a href="{{ route('posts.show', $newPost->id) }}">{{ $newPost->title }}</a>
                                                @auth()
                                                    <form action="{{ route('posts.likes.store', $newPost->id) }}" method="POST">
                                                        @csrf
                                                        <span>{{ $newPost->liked_users_count }}</span>
                                                        <button type="submit" class="border-0 bg-transparent">
                                                            <i class="fa{{ auth()->user()->likedPosts->contains($newPost->id) ? 's' : 'r'}} fa-heart"></i>
                                                        </button>
                                                    </form>
                                                @endauth
                                                @guest()
                                                    <div>
                                                        <span>{{ $newPost->liked_users_count }}</span>
                                                        <i class="far fa-heart"></i>
                                                    </div>
                                                @endguest
                                            </div>
                                        </figcaption>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>
                <div class="widget widget-post-list ">
                    <h5 class="widget-title">Popular posts</h5>
                    <ul class="post-list">
                        @foreach($popularPosts as $popularPost)
                            <li class="post">
                                <a href="{{ route('posts.show', $popularPost->id) }}" class="post-permalink media">
                                    <img src="{{ \Illuminate\Support\Facades\Storage::url($popularPost->preview_image) }}" alt="blog post">
                                    <div class="media-body">
                                        <h6 class="post-title">{{ $popularPost->title }}</h6>
                                        <small class="blog-post-category text-danger">Likes: {{ $popularPost->liked_users_count }}</small>
                                    </div>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="widget">
                    <h5 class="widget-title">Categories</h5>
                    @foreach($categories as $category)
                        <a href="{{ route('categories.posts.index', $category->id) }}" class="btn btn-secondary mt-2"><p><strong>{{ $category->title }}</strong></p></a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

</main>
@endsection
