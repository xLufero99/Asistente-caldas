@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    {{ __('Inicio de sesion valido ¡disfruta del asistente!') }}
                </div>
                <style>
                    #access{
                        height: 250px;
                        width: 250px;
                    }
                    .card{
                        display: flex;
                        justify-content: center;
                        align-items: center; /* Para centrar verticalmente si es necesario */
                    }
                </style>
                <img id="access" src="access.png">
            </div>
        </div>
    </div>
</div>
@endsection