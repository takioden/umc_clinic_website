@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Role Not Allowed</h1>
    <p>The role "{{ $role }}" is not allowed to access this page.</p>
    <a href="{{ url('/') }}" class="btn btn-primary">Go Back to Home</a>
</div>
@endsection
