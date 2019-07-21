@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-8">
                <div class="row mb-5">
                    <a href="/"><i class="fa fa-arrow-left"></i> Back</a>
                </div>
                <div class="row mb-2">
                    <div class="col">
                        <h1 class="h2">
                            Your Notifications
                        </h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="d-flex flex-column pt-3 pb-2 border-top">
                            @if (!$notifications->isEmpty())
                                @foreach (auth()->user()->notifications as $notification)
                                    <div class="d-flex flex-row mb-2 justify-content-between">
                                        <p class="lead">
                                            {{ $notification->data['username'] }} just followed you!
                                        </p>
                                        <small class="text-secondary">{{ $notification->created_at->diffForHumans() }}</small>
                                    </div>
                                @endforeach
                            @else
                                <div class="d-flex flex-row mb-2 justify-content-between">
                                    <p class="lead">
                                        You currently have no notifications.
                                    </p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection