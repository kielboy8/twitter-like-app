@extends('layouts.app')

@section('content')
<div class="container" id="app">
    @if (session('success'))
        <div class="row justify-content-center mb-2">
            <div class="col-md-8">
                <div class="card border-success bg-light">
                    <div class="card-body text-success">
                        {{ session('success') }}
                    </div>
                </div>
            </div>
        </div>
    @endif
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="row justify-content-center mb-2">
                <div class="col-md-8">
                    <div class="card border-danger bg-light">
                        <div class="card-body text-danger">
                            {{ $error }}
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
    <div class="row justify-content-center pb-4">
        <div class="col-md-8 col">
            <div class="card">
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @guest
                        <a href="/login">You must be logged in to see and make posts.</a>
                    @endguest
                    @auth
                        <form method="POST" action="/posts">
                            @csrf
                            <div class="form-group">
                                <label for="description">What's on your mind?</label>
                                <textarea name="description" id="description" rows="2" class="form-control" :maxlength="max" v-model="text" placeholder="Write your post here." required></textarea>
                            </div>
                            <div class="float-left" v-text="(max - text.length) + ' character/s left.'"></div>
                            <button type="submit" class="btn btn-primary float-right">Post</button>
                        </form>
                    @endauth
                </div>
            </div>
        </div>
    </div>
    @auth
        <div class="row justify-content-center mb-2">
            <div class="col-md-8">
                <h1 class="h4">Feed</h1>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="d-flex flex-column">
                    @if ($posts)
                        @foreach ($posts->reverse() as $post)
                        <div class="d-flex flex-column pt-3 pb-2 border-top">
                            <div class="d-flex flex-row mb-2 justify-content-between">
                                <a href="/users/{{ $post->user_id }}" class="font-weight-bold">{{ $post->user->username }}</a>
                                <small class="text-secondary">{{ $post->created_at->diffForHumans() }} </small>
                            </div>
                            <div>
                                <p class="lead">
                                    {{ $post->description }}
                                </p>
                            </div>
                            <div class="d-flex flex-row mb-1">
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
                        <div class="d-flex flex-column pt-3 pb-2 border-top">
                            <p>It's empty! Why don't you post something or follow people first to see their posts here?</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @endauth
</div>
@endsection
