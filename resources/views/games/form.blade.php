@extends('layout')

@section('title')
    - @yield('form-name')
@endsection

@section('body')
    <div class="row">
        <div class="col-12 mb-3">
            <a href="{{ route('games.index') }}" class="btn btn-primary">
                <i class="fas fa-arrow-left"></i>
                Volver
            </a>
        </div>

        @if (isset($errors) && $errors->any())
            <div class="col-12">
                <div class="alert alert-danger">
                    <p>
                        <b>
                            <i class="fas fa-times"></i>
                            Errores:
                        </b>
                    </p>

                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>
                                {{ $error }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    @yield('form-name')
                </div>
                <div class="card-body">
                    <form action="@yield('form-action')" method="POST" enctype="multipart/form-data">
                        @csrf
                        @yield('form-method')

                        <div class="input-group has-validation mb-3">
                            <span class="input-group-text">
                                <i class="fas fa-gamepad"></i>
                            </span>
                            <input type="text" name="name" id="name" placeholder="Nombre"
                                class="form-control @if (isset($errors) && $errors->has('levels')) is-invalid @endif"
                                value="{{ old('name', $game->name ?? '') }}">
                            @if (isset($errors) && $errors->has('name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                        </div>

                        <div class="input-group has-validation mb-3">
                            <span class="input-group-text">
                                <i class="fas fa-trophy"></i>
                            </span>
                            <input type="number" name="levels" id="levels" placeholder="Niveles"
                                class="form-control @if (isset($errors) && $errors->has('levels')) is-invalid @endif"
                                value="{{ old('levels', $game->levels ?? '') }}">
                            @if (isset($errors) && $errors->has('levels'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('levels') }}
                                </div>
                            @endif
                        </div>

                        <div class="input-group has-validation mb-3">
                            <span class="input-group-text">
                                <i class="fas fa-calendar-alt"></i>
                            </span>
                            <input type="date" name="release" id="release" placeholder="Fecha de Lanzamiento"
                                class="form-control @if (isset($errors) && $errors->has('release')) is-invalid @endif"
                                value="{{ old('release', $game->release ?? '') }}">
                            @if (isset($errors) && $errors->has('release'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('release') }}
                                </div>
                            @endif
                        </div>

                        <div class="input-group has-validation mb-3">
                            <span class="input-group-text">
                                <i class="fas fa-image"></i>
                            </span>
                            <input type="file" name="image" id="image" accept="image/*"
                                class="form-control @if (isset($errors) && $errors->has('image')) is-invalid @endif">
                            @if (isset($errors) && $errors->has('image'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('image') }}
                                </div>
                            @endif
                        </div>

                        <button type="submit" class="btn btn-success">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
