@extends('master')


@push('css')
    <link href="css/login.css" rel="stylesheet">
@endpush
@section('content')


    <div class="container">

        @error('nofoundUser')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <form class="form-signin" method="post" action="./authenticate">
            @csrf
            <h2 class="form-signin-heading">Por favor Inicia Sesion</h2>
            <label for="inputEmail" class="sr-only">Email </label>
            <input type="email" id="inputEmail" class="form-control" placeholder="Email address" name="email" required
                autofocus>
            <label for="inputPassword" class="sr-only">Password</label>
            <input type="password" id="inputPassword" class="form-control" placeholder="Password" name="password" required>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Ingresar</button>
        </form>

    </div> <!-- /container -->
@endsection
