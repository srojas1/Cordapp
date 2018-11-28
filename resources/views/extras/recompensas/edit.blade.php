@extends('layouts.default')

@section('title')
    Editar {{ $recompensa->recompensa }}
@stop

@section('top')
    <div class="page-header">
        <h1>Editar {{ $recompensa->recompensa }}</h1>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-xs-6">
            <p class="lead">
                Editar el recompensa:
            </p>
        </div>
        <div class="col-xs-6">
            <div class="pull-right">
                <a class="btn btn-success" href="{!! URL::route('recompensa.show', array('recompensa' => $recompensa->id)) !!}"><i class="fa fa-file-text"></i> Mostrar Cuppones</a>
                <a class="btn btn-danger" href="#delete_recompensa" data-toggle="modal" data-target="#delete_recompensa"><i class="fa fa-times"></i>Eliminar</a>
            </div>
        </div>
    </div>
    <hr>
    <div class="well">
		<?php
		$form = ['url' => URL::route('recompensa.update',['recompensa' => $recompensa->id]),
			'_method'   => 'PATCH',
			'method' => 'POST',
			'button'   => 'Guardar recompensa',
			'defaults' => [
				'recompensa'   => $recompensa->recompensa,
				'puntos'   => $recompensa->puntos,
				'descripcion'   => $recompensa->descripcion,
			], ];
		?>
        @include('recompensas.form')
    </div>
@stop

@section('bottom')
    @auth('edit')
        @include('recompensas.delete')
    @endauth
@stop

@section('css')
    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-markdown/2.8.0/css/bootstrap-markdown.min.css">
    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/3.1.3/css/bootstrap-datetimepicker.min.css">
@stop

@section('js')
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-markdown/2.8.0/js/bootstrap-markdown.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/3.1.3/js/bootstrap-datetimepicker.min.js"></script>
    <script>
        js_datetime_format = '{{ Config::get('date.js_format') }}';
    </script>
    <script type="text/javascript" src="{{ asset('assets/scripts/cms-picker.js') }}"></script>
@stop
