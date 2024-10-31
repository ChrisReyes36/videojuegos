@extends('games.form')

@section('form-name')
    Editar juego: <b>{{ $game->name }}</b>
@endsection

@section('form-action')
    {{ route('games.update', $game->id) }}
@endsection

@section('form-method')
    @method('PUT')
@endsection
