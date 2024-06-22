@extends('layouts.main')

@section('title')
    {{ $post->title }}

@endsection
@section('content')
<main class="blog-post">
    <div class="container">
        <h1 class="edica-page-title" data-aos="fade-up">{{ $post->title }}</h1>
        <p class="edica-blog-post-meta" data-aos="fade-up" data-aos-delay="200">{{ $date->format('F') }} {{ $date->day}}
            , {{ $date->year}} • {{ $date->format('h:i A') }} • Featured • {{ $post->comments->count() }} Comments</p>
        <section class="blog-post-featured-img" data-aos="fade-up" data-aos-delay="300">
            <img src="{{ filter_var($post->main_image, FILTER_VALIDATE_URL) ? $post->main_image : \Illuminate\Support\Facades\Storage::url($post->main_image) }}" alt="featured image"
                 class="w-100">
        </section>
        @auth()
            <section>
                <form action="{{ route('posts.likes.store', $post->id) }}" method="POST">
                    @csrf
                    <span>{{ $post->liked_users_count }}</span>
                    <button type="submit" class="border-0 bg-transparent">
                        <i class="fa{{ auth()->user()->likedPosts->contains($post->id) ? 's' : 'r'}} fa-heart"></i>
                    </button>
                </form>
            </section>
        @endauth
        @guest()
            <div>
                <span>{{ $post->liked_users_count }}</span>
                <i class="far fa-heart"></i>
            </div>
        @endguest
        <section class="post-content mt-3 mb-5">
            <div class="row col-12">
                {!! $post->content !!}
            </div>
        </section>
        <div class="row">
            <div class="col-lg-9 mx-auto">
                @if($relatedPosts->count() > 0)
                <section class="related-posts">
                    <h2 class="section-title mb-4" data-aos="fade-up">Related Posts</h2>
                    <div class="row">
                        @forelse($relatedPosts as $relatedPost)
                            <div class="col-md-4" data-aos="fade-left" data-aos-delay="100">
                                <img src="{{ filter_var($relatedPost->preview_image, FILTER_VALIDATE_URL) ? $relatedPost->preview_image : \Illuminate\Support\Facades\Storage::url( $relatedPost->preview_image) }}"
                                     alt="related post" class="post-thumbnail">
                                <p class="post-category">{{ $relatedPost->category->title }}</p>
                                <a href="{{ route('posts.show', $relatedPost->id) }}"><h5 class="post-title">{{ $relatedPost->title }}</h5></a>
                            </div>
                        @empty
                            <div class="col-md-4" data-aos="fade-left" data-aos-delay="100">
                                <strong><p>No related posts</p></strong>
                            </div>
                        @endforelse
                    </div>
                </section>
                @endif
                <h2 class="pb-4">Comments ({{ $comments->count() }})</h2>
                @foreach($comments as $comment)
                    <div class="card-comment d-flex ">
                        <!-- User image -->
                        <div class="image mt-2 mx-2">
                            <a href="{{ filter_var($comment->user->avatar, FILTER_VALIDATE_URL) ? $comment->user->avatar : Storage::url($comment->user->avatar) }}"><img class="avatar mx-3" src="{{ filter_var($comment->user->avatar, FILTER_VALIDATE_URL) ? $comment->user->avatar : Storage::url($comment->user->avatar) }}"  alt="User Image"></a>
                        </div>

                        <div class="comment-text">
                    <span class="username">
                      <div class="mt-4 "><strong>{{ $comment->user->name }}</strong></div>

                    </span><!-- /.username -->
                            {{ $comment->message }}<br><br>
                            <span class="text-muted ">{{ $comment->dateAsCarbon->diffForHumans() }}</span>
                        </div>
                        <!-- /.comment-text -->
                    </div>
                    <hr>
                @endforeach
                <section class="comment-section">
                    @auth()
                    <h2 class="section-title mb-5" data-aos="fade-up">Leave a Reply</h2>
                    <form action="{{ route('posts.comments.store', $post->id) }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="form-group col-12" data-aos="fade-up">
                                <label for="message" class="sr-only">Comment</label>
                                <textarea name="message" id="message" class="form-control @error('message') is-invalid @enderror" placeholder="message"
                                          rows="10">Comment</textarea>
                                @error('message')
                                <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12" data-aos="fade-up">
                                <input type="submit" value="Send Message" class="btn btn-warning">
                            </div>
                        </div>
                    </form>
                    @endauth
                    @guest()
                        <p><strong><a href="/login">Sign In</a> or <a href="/register">Sign Up</a> to create a comment</strong></p>
                    @endguest
                </section>
            </div>
        </div>
    </div>
</main>
@endsection
