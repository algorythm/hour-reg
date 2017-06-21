@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-default hidden-xs">
                <div class="panel-heading">Hours per user per category</div>

                <div class="panel-body">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>Name</th>
                        @foreach(App\Category::all()->sortBy('name') as $cat)
                        <th>{{ $cat->name }}</th>
                        @endforeach
                        <th>Total</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach(App\User::all()->sortBy('name') as $user)
                        <tr>
                          <th>{{ $user->name }}</th>
                          <td>{{ $user->hoursCategory(App\Category::where('id','=','1')->first()) }}</td>
                          <td>{{ $user->hoursCategory(App\Category::where('id','=','5')->first()) }}</td>
                          <td>{{ $user->hoursCategory(App\Category::where('id','=','2')->first()) }}</td>
                          <td>{{ $user->hoursCategory(App\Category::where('id','=','6')->first()) }}</td>
                          <td>{{ $user->hoursCategory(App\Category::where('id','=','8')->first()) }}</td>
                          <td>{{ $user->hoursTotal() }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                  </table>

<!--                    <table class="table table-striped">
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
                    </table>-->
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
