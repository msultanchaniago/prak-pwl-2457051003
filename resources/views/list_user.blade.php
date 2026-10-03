@extends('layouts.app')
@section('content')

<h1>Daftar Pengguna</h1>

<x-user-table :users="$users" />

@endsection