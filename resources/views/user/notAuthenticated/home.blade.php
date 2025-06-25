@extends('layouts.app')
@section('content')

    @if( $user )
        <h1 class="text-center">Bienvenido {{ $user['name'] }}</h1>
    @else
        <h1 class="text-center">Aun no estas logueado, porfavor loguearse</h1>
    @endif
@endsection