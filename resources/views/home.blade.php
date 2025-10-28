@extends('layouts.app')

@section('content')
<div class="text-center mt-5">
    <h1>Welcome to NexFix</h1>
    <p>Your trusted service marketplace platform.</p>


        <a href="{{ route('services.index') }}" class="btn btn-primary">Explore Services</a>
   
</div>
@endsection
