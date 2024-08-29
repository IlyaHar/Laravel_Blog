@extends('layouts.main')

@section('title') Home @endsection

@section('content')
    <main class="blog">
        <div class="container">
            <h1 class="edica-page-title" data-aos="fade-up">Blog</h1>
            <section class="featured-posts-section">
                <div class="row">
                    @forelse($posts as $post)
                        <div class="col-md-4 fetured-post blog-post" data-aos="fade-right">
                            <div class="blog-post-thumbnail-wrapper">
                                <img src="{{ filter_var($post->preview_image, FILTER_VALIDATE_URL) ? $post->preview_image : \Illuminate\Support\Facades\Storage::url($post->preview_image) }}" alt="blog post">
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
                    @empty
                        <div class="col-md-4 fetured-post blog-post d-flex" data-aos="fade-right">
                            <h3>No posts with this category</h3>
                        </div>
                    @endforelse
                </div>
            </section>
            <div class="row">
                <div class="col-12" style="margin-top: -100px">{{ $posts->links() }}</div>
            </div>
        </div>
    </main>
@endsection
