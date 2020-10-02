@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Add new RSS Feed</div>

                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST">
                            @csrf
                            <div class="form-group">
                                <input type="text" class="form-control" id="feedUrl" aria-describedby="feedTip" placeholder="Enter Feed URL" name="feed_url">
                                <p id="feedTip" class="form-text text-muted">RSS Feed URL's commonly end with <code>.xml</code></p>
                            </div>

                            <input type="submit" class="btn btn-primary" />
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
