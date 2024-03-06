@extends('base')

@section('title', 'Login')

@section('content')
    <h1>Login</h1>
    <div class="row">
        <div class="col-xl-6 col-lg-6 col-md-12 pb-4 mx-auto">
            <div class="card h-100 text-light bg-dark shadow-lg">
                <div class="card-body">
                    <form action="{{ route('auth.login') }}" method="post">
                        @csrf
                        <div class="form-group pb-2">
                            <label for="email">Email</label>
                            <input type="email" name="email" class="form-control" id="email">
                            @error("email")
                                {{ $message }}
                            @enderror
                        </div>
                        <div class="form-group pb-2">
                            <label for="password">Mot de passe</label>
                            <input type="password" name="password" class="form-control" id="password">
                            @error("password")
                                {{ $message }}
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-dark">Se connecter</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection