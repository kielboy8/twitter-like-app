@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-10">
                <div class="row mb-5">
                    <a href="/"><i class="fa fa-arrow-left"></i> Back</a>
                </div>
                <div class="row mb-2">
                    <div class="col">
                        <h1 class="h2">
                            Edit Profile
                        </h1>
                    </div>
                </div>
                <form action="/users/{{ $user->id }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="row border-top pt-3">
                        <div class="col-4">
                            <p class="lead float-right">
                                Username
                            </p>
                        </div>
                        <div class="col">
                            <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ $user->username }}" required autocomplete="username" autofocus>
                            
                            @error('username')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row pt-3">
                        <div class="col-4">
                            <p class="lead float-right">
                                Email
                            </p>
                        </div>
                        <div class="col">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email">
                            
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row pt-3">
                        <div class="col-4">
                            <p class="lead float-right">
                                Short bio
                            </p>
                        </div>
                        <div class="col">
                            <textarea name="about" id="about" rows="2" class="form-control" placeholder="Write your bio here.">{{ $user->about }}</textarea>
                        </div>
                    </div>
                    <div class="row pt-4">
                        <div class="col">
                            <button type="submit" class="btn btn-primary float-right">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection