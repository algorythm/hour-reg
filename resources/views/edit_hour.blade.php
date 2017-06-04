@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">

                    <div class="col-md-12">
                      <h4><span class="label label-danger">OBS</span>  Dato SKAL være skrevet korrekt. Der er ingen validering endnu! <span class="label label-danger">OBS</span></h4>

                      <form class="form-horizontal" role="form" method="POST" action="/hour/edit/{{ $hour->id }}">
                        {{ csrf_field() }}
                        <div class="form-group row">
                          <label for="user">User</label>
                          <input type="text" name="username" class="form-control" id="user" value="{{ $hour->user->name }}" readonly />
                        </div>

                        <div class="form-group row">
                          <label for="cat">Category</label>
                          <select name="category" id="cat" class="form-group"class="form-group">
                            <option selected>{{ $hour->category->name }}</option>
                            @foreach(App\Category::all()->sortBy('name') as $cat)
                            @if ($cat!=$hour->category)
                            <option>{{ $cat->name }}</option>
                            @endif
                            @endforeach
                          </select>
                        </div>

                        <div class="form-group row">
                          <label for="start">Start Time</label>
                          <input type="text" name="start" id="start" value="{{ $hour->start }}" />
                        </div>

                        <div class="form-group row">
                          <label for="stop">Stop Time</label>
                          <input type="text" name="stop" value="{{ $hour->stop }}" />
                        </div>

                        <button class="btn btn-primary">
                          Update Record
                        </button>
                      </form>

                      <br/><hr/><p>Ja... Jeg ved godt at layout er lort lige nu; lev med det! Eller lav dit eget ;)</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
