@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-hover">
              <div class="panel-heading">Hours done today</div>
              <div class="panel-body">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>User</th>
                      <th>Total time</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach(App\User::all()->sortBy('name') as $user)
                    <tr class="clickable-row" data-href="@if ($user==Auth::user()) /home @else /stats/user/{{ $user->id }}@endif">
                      <td>{{ $user->name }}</td>
                      <td>{{ $user->hoursToday() }}</td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>


              </div>
            </div>

            <div class="panel panel-default hidden-xs">
                <div class="panel-heading">All hours</div>

                <div class="panel-body">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>Start Time</th>
                          <th>Stop Time</th>
                          <th>User</th>
                          <th>Category</th>
                          <th>Total Time</th>
                        </tr>
                      </thead>
                      @foreach (App\Hour::all()->sortBy('start') as $hour)
                      <tr>
                        <th>{{ $hour->start }}</th>
                        <th>@if($hour->stop === null) - @else {{ $hour->stop}} @endif</th>
                        @if($hour->user == Auth::user())
                        <th><a href="/home">{{ $hour->user->name }}</a></th>
                        @else
                        <th><a href="/stats/user/{{ $hour->user->id }}">{{ $hour->user->name }}</a></th>
                        @endif
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

<script type="text/javascript">
jQuery(document).ready(function($) {
  $(".clickable-row").click(function() {
      window.location = $(this).data("href");
  }).css('cursor', 'pointer');
});
</script>
@endsection
