@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard (Today: {{ Auth::user()->hoursToday() }})</div>
                <div class="panel-body">
                    @if (Auth::user()->isWorking())
                      <a href="/hour/stop/current" class="btn btn-warning">Stop Working</a>
                    @else
                    <!-- Single button -->
                    <div class="btn-group">
                      <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Start Working <span class="caret"></span>
                      </button>
                      <ul class="dropdown-menu">
                        @foreach(App\Category::all()->sortBy('name') as $category)
                          <li><a href="/hour/start/category/{{ $category->id }}">{{ $category->name }}</a></li>
                        @endforeach
                      </ul>
                    </div>
                    @endif

                    <br /><br class="visible-xs"/>

                    <table class="table table-striped hidden-xs">
                      <thead>
                        <tr>
                          <th>Start Time</th>
                          <th>Stop Time</th>
                          <th>Category</th>
                          <th>Total Time</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach (Auth::user()->hours as $hour)
                      <!--<tbody>-->
                        <tr>
                          <td>{{ $hour->getStart() }}</td>
                          <td>{{ $hour->getStop() }}</td>
                          <td>{{ $hour->category->name }}</td>
                          <td>{{ $hour->hoursTotal() }}</td>
                          <td>
                            <a href="/hour/edit/{{ $hour->id }}" class="btn btn-info">
                              <i class="fa fa-pencil" aria-hidden="true"></i>
                            </a>
                            @if($hour->stop!==null)
                            <a href="/hour/delete/{{ $hour->id }}" class="btn btn-danger">
                              <i class="fa fa-trash" aria-hidden="true"></i>
                            </a>
                            @endif
                          </td>
                        </tr>
                      <!--</tbody>-->
                      @endforeach
                      </tbody>
                    </table>

                    <table class="table table-responsive visible-xs">
                      <thead>
                        <tr>
                          <th>Start</th>
                          <th>Stop</th>
                          <th>Category</th>
                          <!--<th>Total Time</th>-->
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach (Auth::user()->hours as $hour)
                        <tr>
                          <td>{{ $hour->getStart() }}</td>
                          <td>{{ $hour->getStop() }}</td>
                          <td>{{ $hour->category->name }}</td>
                          <!--<td>{{ $hour->hoursTotal() }}</td>-->
                          <td>
                            @if($hour->stop!==null)
                            <a href="/hour/delete/{{ $hour->id }}" class="btn btn-danger">
                              <i class="fa fa-trash" aria-hidden="true"></i>
                            </a>
                            @endif
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
