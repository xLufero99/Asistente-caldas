@extends('layouts.app')
@section('template_title')
Ingreso
@endsection
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <span id="card_title">
                            {{ __('Ingresos') }}
                        </span>
                        <div id="resultados">
                            <div></div>
                        </div>
                        <div class="float-right">
                            <a href="{{ route('ingresos.create') }}" class="btn btn-primary btn-sm float-right" data-placement="left">
                                {{ __('Crear Nuevo') }}
                            </a>
                        </div>
                    </div>
                </div>
                @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
                @endif
                <div class="card-body">
                    <div class="table-responsive">
                        <!-- Sección de buscadores y reportes -->
                        <div class="buscadores">
                            <div class="botonsfecha">
                                <tr>
                                    <td>Fecha mínima:</td>
                                    <td><input type="text" id="min" name="min"></td>
                                </tr>
                                <tr>
                                    <td>Fecha máxima:</td>
                                    <td><input type="text" id="max" name="max"></td>
                                </tr>
                            </div>
                            <div class="reports">
                                <button type="button" class="btn btn-warning">Total con filtros: <span id="total"></span></button>
                                <button type="button" class="btn btn-success">Total ingresos: <span id="totalsinf"></span></button>
                            </div>
                        </div>
                        <br>
                        <!-- Tabla de datos -->
                        <table border="0" cellspacing="5" cellpadding="5">
                            <style>
                                .buscadores {
                                    display: grid;
                                    grid-template-columns: 1fr 1fr;
                                    grid-gap: 5%;
                                }
                                .reports {
                                    display: grid;
                                    grid-template-columns: 1fr 1fr;
                                    grid-gap: 5%;
                                }
                                #total {
                                    font-size: 20px;
                                }
                                #totalsinf {
                                    font-size: 20px;
                                }
                            </style>
                            <tbody>
                                <table id="tbingre" class="table table-striped table-hover">
                                    <thead class="thead">
                                        <tr>
                                            <th>No</th>
                                            <th>Monto</th>
                                            <th>Nombre</th>
                                            <th>Fecha</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($ingresos as $ingreso)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $ingreso->monto }}</td>
                                            <td>{{ $ingreso->nombre }}</td>
                                            <td>{{ $ingreso->fecha }}</td>
                                            <td>
                                                <form action="{{ route('ingresos.destroy',$ingreso->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('ingresos.show',$ingreso->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Mostrar') }}</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('ingresos.edit',$ingreso->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Editar') }}</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> {{ __('Eliminar') }}</button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            {!! $ingresos->links() !!}
        </div>
    </div>
</div>
<!-- Scripts y estilos necesarios para el funcionamiento de la tabla -->
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js"></script>
<script src="https://cdn.datatables.net/datetime/1.5.1/js/dataTables.dateTime.min.js"></script>
<script src="https://cdn.datatables.net/plug-ins/1.13.7/api/sum().js"></script>
<!-- Script personalizado para filtrar fechas -->
<script>
    $(document).ready(function() {
        var minDate, maxDate;
        // Función de filtrado personalizada que buscará datos en la columna cuatro entre dos valores
        $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {
            var min = minDate.val();
            var max = maxDate.val();
            var date = new Date(data[3]);
            if (
                (min === null && max === null) ||
                (min === null && date <= max) ||
                (min <= date && max === null) ||
                (min <= date && date <= max)
            ) {
                return true;
            }
            return false;
        });
        // Crear entradas de fecha
        minDate = new DateTime('#min', {
            format: 'MMMM DD YYYY'
        });
        maxDate = new DateTime('#max', {
            format: 'MMMM DD YYYY'
        });
        // Inicialización de DataTables
        var table = $('#tbingre').DataTable();
        // Refiltrar la tabla
        $('#min, #max').on('change', function() {
            table.draw();
        });
    });
</script>
<!-- Script personalizado para inicializar la DataTable y calcular la suma -->
<script>
    function initializeDataTable() {
        // Inicialización de DataTables
        var table = $('#tbingre').DataTable();
        // Evento que se dispara después de que DataTables haya aplicado el filtrado
        table.on('draw', function() {
            updateSum();
        });
        // Evento que se dispara cuando cambia el valor de los campos de fecha o nombre
        $('#min, #max, #nombre-filter').on('change input', function() {
            table.draw();
        });
        // Llamar a la función al inicio para mostrar la suma inicial
        updateSum();
        // Función para actualizar la suma
        function updateSum() {
            var sumWithFilters = 0;
            var sumWithoutFilters = 0;
            // Obtener todas las filas
            var allRows = table.rows().nodes();
            // Obtener las filas visibles después de aplicar el filtro de DataTables
            var visibleRows = table.rows({
                search: 'applied'
            }).nodes();
            // Iterar sobre todas las filas y sumar los valores de la columna 1
            $(allRows).each(function() {
                sumWithoutFilters += parseFloat($(this).find('td:eq(1)').text());
            });
            // Iterar sobre las filas visibles y sumar los valores de la columna 1
            $(visibleRows).each(function() {
                sumWithFilters += parseFloat($(this).find('td:eq(1)').text());
            });
            // Actualizar el contenido del elemento con el ID 'total' con la suma calculada
            $('#total').text(sumWithFilters);
            // Actualizar el contenido del elemento con el ID 'totalsinf' con la suma sin filtros
            $('#totalsinf').text(sumWithoutFilters);
        }
    }
    // Llamar a la función para inicializar DataTable y la suma
    initializeDataTable();
</script>
<!-- Estilos de la DataTable -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/datetime/1.5.1/css/dataTables.dateTime.min.css">
@endsection