@extends('adminlte::page')

@section('content_header')
    <h1 id="header_title" class="m-3">{{ $title }}</h1>
@stop

@section('content')
    @include('flash::message')
    <div class="card">
        <div class="card-header">
            <button type="button" class="btn btn-outline-primary rounded btn" data-toggle="modal" data-target="#modal"
                onclick="showCreateForm()">Создать</button>
        </div>
        <div class="card-body">
            <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                {!! $builder->table(['class' => 'table table-bordered table-striped dataTable dtr-inline']) !!}
            </div>
        </div>
    </div>
@endsection

@push('js')

    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form" action="{{ route($routeName . '.store') }}" onsubmit="createUpdateItem(event, $(this))">
                        @csrf
                        <input id="method" name="_method" type="hidden">
                        <div class="form-group">
                            <input id="input" type="text" class="form-control input" required=true name="title" value="">
                            <small for='input' class="error invalid-feedback"></small>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                            <button type="submit" class="btn btn-primary"></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.form-js')
@endpush
