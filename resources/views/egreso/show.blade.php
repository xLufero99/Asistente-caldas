@extends('layouts.app')

@section('template_title')
    {{ $egreso->name ?? "{{ __('Show') Egreso" }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Egreso</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('egresos.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Monto:</strong>
                            {{ $egreso->monto }}
                        </div>
                        <div class="form-group">
                            <strong>Nombre:</strong>
                            {{ $egreso->nombre }}
                        </div>
                        <div class="form-group">
                            <strong>Fecha:</strong>
                            {{ $egreso->fecha }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
