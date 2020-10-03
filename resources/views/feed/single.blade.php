@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">{{ $feed->title }}</div>

                    <div class="card-body">
                        @foreach ($feed->items as $item)
                            <div class="card mb-3">
                                <div class="card-header">
                                    {{ $item->title }}
                                </div>
                                <div class="card-body">
                                    <p>{!! $item->description !!}</p>

                                    @if(!empty($item->link))
                                        <a href="{{ $item->link }}">
                                            <button class="btn btn-secondary">
                                                Read more
                                            </button>
                                        </a>
                                    @endif
                                    <footer class="blockquote-footer mt-3">{{ $item->published }}</footer>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
