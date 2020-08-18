@extends('master')


@push('css')
    <link href="css/home.css" rel="stylesheet">
@endpush
@section('content')

    <a href="logout" style="float: right; margin: 10px"> Cerrar Sesi&oacute;n</a> <a href="home" style="float: right; margin: 10px"> Home</a>

    <h1> Bienvenido al HOME </h1>
    <h4>by Alejandro Marcano</h4>


    <table class="table  table-hover">
        <thead>
            <tr>
                <th>
                    Fecha
                </th>
                <th>
                    Titulo
                </th>
                <th>
                    Autor
                </th>
                <th>
                    Opciones
                </th>
            </tr>
        </thead>
        <tbody>
            @forelse ($publications as $publication)
                <tr>
                    <td>
                        {{ $publication->created_at }}
                    </td>
                    <td>
                        {{ $publication->title }}
                    </td>
                    <td>
                        {{ $publication->autor->name }}
                    </td>
                    <td>
                        <a href="post_{{ $publication->id }}"> <button type="button" class="btn btn-primary">Ver</button> </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td>
                        No hay datos
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
    {{ $publications->links() }}
@endsection
