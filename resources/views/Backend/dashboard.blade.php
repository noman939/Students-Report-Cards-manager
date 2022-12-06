@extends('backend.layouts.layout')

@section('content')
    @if(Session::has('status'))
        <div class="alert alert-success">
            <h4>{{Session::get('status')}}</h4>
        </div>
    @endif
  <div class="card">
    <div class="card-body">
      <h1>{{ config('app.name') }}</h1>
    </div>
  </div>
@endsection
