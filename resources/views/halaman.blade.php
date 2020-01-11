{{-- resources/views/welcome.blade.php --}}
@extends('layouts.app')

@section('content')

    <div class="container">
    <div class="jumbotron" id="jumbotron_index">
  <div class="text-center" >
<h1>Musab Alfarizi</h1>
<p>CRUD Application Laravel dan Vue.JS</p>

</div>
 <router-view></router-view>



</div>
</div>
@endsection