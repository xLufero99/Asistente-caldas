@extends('layouts.app')

@section('template_title')
    {{ $ingreso->name ?? "{{ __('Show') Ingreso" }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Ingreso</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('ingresos.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Monto:</strong>
                            {{ $ingreso->monto }}
                        </div>
                        <div class="form-group">
                            <strong>Nombre:</strong>
                            {{ $ingreso->nombre }}
                        </div>
                        <div class="form-group">
                            <strong>Fecha:</strong>
                            {{ $ingreso->fecha }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
