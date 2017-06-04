@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">

                    <h1>Stats for user: {{ $user->name }}</h1>
                    Go back to <a href="/stats/all">all stats</a>.

                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>Start Time</th>
                          <th>Stop Time</th>
                          <th>Category</th>
                          <th>Total Time</th>
                        </tr>
                      </thead>
                      @foreach (Auth::user()->hours as $hour)
                      <tr>
                        <th>{{ $hour->start }}</th>
                        <th>@if($hour->stop === null) - @else {{ $hour->stop}} @endif</th>
                        <th>{{ $hour->category->name }}</th>
                        <th>{{ $hour->hoursTotal() }}</th>
                      </tr>
                      @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
