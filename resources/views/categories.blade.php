@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">

                    <div class="col-md-12">
                      <form class="form-horizontal" role="form" method="POST" action="{{ URL::to('/categories/create') }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                          <label for="name">Category Name</label>
                          <input type="formcontrol" name="name" id="name">
                          <button type="submit" class="btn btn-primary">
                              Register
                          </button>
                        </div>
                      </form>
                    </div>

                    <strong>List of categories:</strong>

                    <ul>
                    @foreach ($categories as $category)
                      <li>{{ $category->name }}</li>
                    @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
