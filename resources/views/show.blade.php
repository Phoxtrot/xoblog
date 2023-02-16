@extends('layouts.blog')
@section('content')
     <!-- News With Sidebar Start -->
     <div class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <!-- News Detail Start -->
                    <div class="position-relative mb-3">
                        <img class="img-fluid w-100" src="{{ asset('public/image/'.$article->image) }}" style="object-fit: cover;">
                        <div class="bg-white border border-top-0 p-4">
                            <div class="mb-3">
                                <a class="badge badge-primary text-uppercase font-weight-semi-bold p-2 mr-2"
                                    href="">{{ $article->category->title }}</a>
                                <a class="text-body" href="">{{ \Carbon\Carbon::parse( $article->created_at )->toDayDateTimeString() }}</a>
                            </div>
                            <h1 class="mb-3 text-secondary text-uppercase font-weight-bold">{{ $article->title }}</h1>
                            <p>{!! $article->body !!}</p>
                        </div>
                        <div class="d-flex justify-content-between bg-white border border-top-0 p-4">
                            <div class="d-flex align-items-center">
                                <img class="rounded-circle mr-2" src="img/user.jpg" width="25" height="25" alt="">
                                <span>{{ $article->user->name }}</span>
                            </div>
                            <div class="d-flex align-items-center">
                                <span class="ml-3"><i class="far fa-eye mr-2"></i>{{ $article->views }}</span>
                                <span class="ml-3"><i class="far fa-comment mr-2"></i>{{ $article->comment->count() }}</span>
                            </div>
                        </div>
                    </div>
                    <!-- News Detail End -->

                    <!-- Comment List Start -->
                    <div class="mb-3">
                        <div class="section-title mb-0">
                            <h4 class="m-0 text-uppercase font-weight-bold">{{ $article->comment->count() }} Comments</h4>
                        </div>
                        <div class="bg-white border border-top-0 p-4 comment">
                        @foreach ($article->comment as $comment)
                             <div class="media mb-4">

                                <div class="media-body">
                                    <h6><a class="text-secondary font-weight-bold" href="">{{ $comment->name }}</a> <small><i>{{ \Carbon\Carbon::parse( $comment->created_at )->diffForHumans() }}</i></small></h6>
                                    <p>{{ $comment->message }}</p>
                                    <button class="btn btn-sm btn-outline-secondary">Reply</button>
                                </div>
                            </div>
                                @endforeach


                        </div>
                    </div>
                    <!-- Comment List End -->

                    <!-- Comment Form Start -->
                    <div class="mb-3">
                        <div class="section-title mb-0">
                            <h4 class="m-0 text-uppercase font-weight-bold">Leave a comment</h4>
                        </div>
                        <div class="bg-white border border-top-0 p-4">
                            <form>
                                @csrf
                                <div class="form-row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="name">Name *</label>
                                            <input type="text" name="name" class="form-control" id="name">
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="email">Email *</label>
                                            <input type="email" name="email" class="form-control" id="email">
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="website">Website</label>
                                    <input type="url" name="website" class="form-control" id="website">
                                </div>

                                <div class="form-group">
                                    <label for="message">Message *</label>
                                    <textarea id="message" name="message" cols="30" rows="5" class="form-control"></textarea>
                                    @error('message')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                </div>
                                <input type="text" name="article" value="{{$article->id}}" hidden>
                                <div class="form-group mb-0">
                                    <input type="submit" value="Leave a comment"
                                        class="btn btn-primary font-weight-semi-bold py-2 px-3">
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- Comment Form End -->
                </div>
            </div>
        </div>
     </div>
@endsection
@section('js')
<script src="{{asset('assets/js/comment.js')}}"></script>
@endsection
