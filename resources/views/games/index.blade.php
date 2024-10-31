@extends('layout')

@section('title')
    - Listado de Juegos
@endsection

@section('body')
    <div class="row">
        @if (session('success'))
            <div class="col-12">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        @endif

        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Niveles</th>
                            <th>Fecha de Lanzamiento</th>
                            <th>Imagen</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($games as $i => $game)
                            <tr>
                                <td>{{ $i + 1 }}</td>
                                <td>{{ $game->name }}</td>
                                <td>{{ $game->levels }}</td>
                                <td>{{ $game->release }}</td>
                                <td>
                                    <img src="/storage/{{ $game->image }}" alt="{{ $game->name }}" class="img-thumbnail"
                                        style="width: 120px;">
                                </td>
                                <td>
                                    {{-- <a href="{{ route('games.show', $game->id) }}" class="btn btn-info">Ver</a> --}}
                                    <a href="{{ route('games.edit', $game->id) }}" class="btn btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form id="frm_{{ $game->id }}" action="{{ route('games.destroy', $game->id) }}"
                                        method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
