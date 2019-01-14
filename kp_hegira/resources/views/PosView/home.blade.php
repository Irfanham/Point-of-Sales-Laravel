@extends('layout.master')

@section('title','Home')


@section('content')
	<h1>Selamat Datang</h1>
	@foreach($user as $username)
		<li>{{$username->username}}</li>
	@endforeach
@endsection