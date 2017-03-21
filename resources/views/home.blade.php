@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    Hello, {{ Auth::user()->name }}, you are logged in to my goFriends test app
                </div>

                @foreach($posts as $post)
                    <div class="well-sm">
                        <p></p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
