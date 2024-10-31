@extends('games.form')

@section('form-name')
    Crear juego
@endsection

@section('form-action')
    {{ route('games.store') }}
@endsection
