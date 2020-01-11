{{-- resources/views/welcome.blade.php --}}
@extends('layouts.app')

@section('content')
    <div class="container">
          <div class="row justify-content-center">
        	<div class="col-md-8">
                <leaderboard :current="{{ auth()->user() ? auth()->user()->id : 0 }}"></leaderboard>
            	</div>
            </div>
        </div>
    </div>
@endsection