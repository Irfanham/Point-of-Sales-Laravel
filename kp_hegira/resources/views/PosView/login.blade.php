@extends('layout.master')

@section('title','Login')

@section('content')
	<h2>Silahkan Login</h2>
	<form action="/dashboard" method="post">
		<table>
			<tr>
				<td>Username</td>
			</tr>
			<tr>
				<td><input type="text" name="username"></td>
			</tr>
			<tr>
				<td>Password</td>
			</tr>
			<tr>
				<td><input type="password" name="password"></td>
			</tr>
			<tr>
				<td><input type="submit" name="" value="Login"></td>
			</tr>
		</table>
	</form>

@endsection