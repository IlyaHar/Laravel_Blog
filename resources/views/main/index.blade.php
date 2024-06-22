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
                        <p class="blog-post-category">{{ $post->category->title }}</p>
                        @foreach($post->tags as $tag)
                            <span class="blog-post-category text-primary">#{{ $tag->title }}</span>
                        @endforeach
                        <a href="#!" class="blog-post-permalink">
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
                        @foreach($randomPosts as $post)
                            <div class="col-md-6 blog-post" data-aos="fade-up">
                                <div class="blog-post-thumbnail-wrapper">
                                    <img src="{{ \Illuminate\Support\Facades\Storage::url($post->preview_image) }}" alt="blog post">
                                </div>
                                <p class="blog-post-category">{{ $post->category->title }}</p>
                                @foreach($post->tags as $tag)
                                    <span class="blog-post-category text-primary">#{{ $tag->title }}</span>
                                @endforeach
                                <a href="#!" class="blog-post-permalink">
                                    <h6 class="blog-post-title">{{ $post->title }}</h6>
                                </a>
                                <p class="blog-post-category mt-3 text-secondary">{{ $post->created_at->diffForHumans() }}</p>
                            </div>
                        @endforeach
                    </div>
                </section>
            </div>
            <div class="col-md-4 sidebar" data-aos="fade-left">
                <div class="widget widget-post-carousel">
                    <h5 class="widget-title">Post Lists</h5>
                    <div class="post-carousel">
                        <div id="carouselId" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#carouselId" data-slide-to="0" class="active"></li>
                                <li data-target="#carouselId" data-slide-to="1"></li>
                                <li data-target="#carouselId" data-slide-to="2"></li>
                            </ol>
                            <div class="carousel-inner" role="listbox">
                                <figure class="carousel-item active">
                                    <img src="{{ asset('assets/images/blog_widget_carousel.jpg') }}" alt="First slide">
                                    <figcaption class="post-title">
                                        <a href="#!">Front becomes an official Instagram Marketing Partner</a>
                                    </figcaption>
                                </figure>


                                <div class="carousel-item">
                                    <img src="{{ asset('assets/images/blog_5.jpg') }}" alt="First slide">
                                    <figcaption class="post-title">
                                        <a href="#!">Front becomes an official Instagram Marketing Partner</a>
                                    </figcaption>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="widget widget-post-list">
                    <h5 class="widget-title">Popular posts</h5>
                    <ul class="post-list">
                        @foreach($popularPosts as $post)
                            <li class="post">
                                <a href="#!" class="post-permalink media">
                                    <img src="{{ \Illuminate\Support\Facades\Storage::url($post->preview_image) }}" alt="blog post">
                                    <div class="media-body">
                                        <h6 class="post-title">{{ $post->title }}</h6>
                                        <small class="blog-post-category text-danger">Likes: {{ $post->liked_users_count }}</small>
                                    </div>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="widget">
                    <h5 class="widget-title">Categories</h5>
                    <img src="{{ asset('assets/images/blog_widget_categories.jpg') }}" alt="categories" class="w-100">
                </div>
            </div>
        </div>
    </div>

</main>
@endsection
