@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10 col-10">
            <div class="row">
                <a href="/"><i class="fa fa-arrow-left"></i> Back</a>
            </div>
            <div class="row mb-2">
                <div class="col-md-4 col-12 text-md-left text-center mb-4 mt-5">
                    <div class="row mb-3">
                        <div class="col text-md-left text-center">
                            <h1 class="h4">{{ $user->username }}</h1>
                        </div>
                    </div>
                    @if ($user->about)
                    <div class="row mb-3">
                        <div class="col text-md-left text-center">
                            <p>{{ $user->about }}</p>
                        </div>
                    </div>
                    @endif
                    <div class="row mb-4">
                        <div class="col text-md-left text-center">
                            <div class="d-flex flex-row justify-content-between justify-content-md-start">
                                <div class="flex-md-fill">
                                    <small>Posts</small>
                                    <p>{{ $user->posts->count() }}</p>
                                </div>
                                <div class="flex-md-fill">
                                    <small>Following</small>
                                    <p>{{ $user->following->count() }}</p>
                                </div>
                                <div class="flex-md-fill">
                                    <small>Followers</small>
                                    <p>{{ $user->followers->count() }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if (!Auth::check())
                        <div class="row">
                            <a href="/login">You must be logged in to follow this user.</a>
                        </div>
                    @endif
                    @if ($user->id != auth()->id())
                        @if ($user->followers->contains(auth()->id()))
                            <div class="row">
                                <div class="col text-md-left text-center">
                                    <form action="/users/unfollow/{{ $user->id }}" method="POST">
                                        @csrf
                                        <button class="btn btn-primary" type="submit">Unfollow User</button>
                                    </form>
                                </div>
                            </div>
                        @else
                            <div class="row">
                                <div class="col text-md-left text-center">
                                    <form action="/users/follow/{{ $user->id }}" method="POST">
                                        @csrf
                                        <button class="btn btn-outline-primary" type="submit">Follow User</button>
                                    </form>
                                </div>
                            </div>
                        @endif
                    @else
                        <div class="row">
                            <div class="col text-md-left text-center">
                                <a href="/users/{{ $user->id }}/edit" class="btn btn-primary">Edit Profile</a>
                            </div>
                        </div>
                    @endif
                </div>
                
                <div class="col-md-8 col-12">
                    @if (session('success'))
                    <div class="row justify-content-center mb-4">
                        <div class="col pr-0 pl-0">
                            <div class="card border-success bg-light">
                                <div class="card-body text-success">
                                    {{ session('success') }}
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    <div class="row">
                        <h2 class="h2">
                            @if (auth()->id() == $user->id)
                                Your
                            @endif
                            Feed
                        </h2>
                    </div>
                    <div class="row">
                        <div class="col pr-0 pl-0">
                            <div class="d-flex flex-column">
                                @if (!$user->posts->isEmpty())
                                    @foreach ($user->posts->reverse() as $post)
                                    <div class="d-flex flex-column pt-3 pb-2 border-top">
                                        <div class="d-flex flex-row justify-content-between">
                                            <p class="font-weight-bold">{{ $user->username }}</p>
                                            <small class="text-secondary">{{ $post->created_at->diffForHumans() }} </small>
                                        </div>
                                        <div>
                                            <p class="lead">
                                                {{ $post->description }}
                                            </p>
                                        </div>
                                        <div class="d-flex flex-row mb-1">
                                            <div>
                                                <button class="btn btn-lg btn-transparent p-0 mr-5 text-secondary"><i class="fa fa-comment-o"></i></button>
                                            </div>
                                            <div>
                                                @can('delete', $post)
                                                <form method="POST" action="/posts/{{ $post->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-lg btn-transparent p-0 mr-5 text-secondary" type="submit"><i
                                                            class="fa fa-trash-o"></i></button>
                                                </form>
                                                @endcan
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                @else
                                    @if ($user->id != auth()->id())
                                        <div class="d-flex flex-column pt-3 pb-2 border-top">
                                            <p>This person hasn't posted anything yet.</p>
                                        </div>
                                    @else
                                        <div class="d-flex flex-column pt-3 pb-2 border-top">
                                            <p>It's empty! Why don't you <a href="/">post something?</a></p>
                                        </div>
                                    @endif
                                @endif
                            </div>
                        </div>  
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection