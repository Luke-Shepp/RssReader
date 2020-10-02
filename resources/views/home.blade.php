@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @foreach($feeds as $feed)
                        <div class="card mb-3">
                            <div class="card-horizontal">
                                @if ($feed->image)
                                    <div class="img-square-wrapper">
                                        <img class="" src="{{ $feed->image->url ?? '' }}" alt="Card image cap">
                                    </div>
                                @endif
                                <div class="card-body">
                                    <h4 class="card-title"><a href="{{ route('feed.show', $feed->id) }}">{{ $feed->title }}</a></h4>
                                    <p class="card-text">{{ $feed->description }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .card-horizontal {
        display: flex;
        flex: 1 1 auto;
    }

    .img-square-wrapper img {
        max-height: 120px;
    }
</style>
@endsection
