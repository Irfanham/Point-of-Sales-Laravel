@extends('layout.master')

@section('title','home')


@section('content')
	<h1>Selamat datang {{$var}} <h1>
	<h2>
	@foreach($cats as $cat)
		<p>{{$cat->user_id . ' '.$cat->username}}</p>
	@endforeach
	</h2>
	
@endsection

