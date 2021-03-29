@extends('adminlte::page')

@section('content_header')
    <div class="d-flex">
        <h1>Сотрудники</h1>
        <a href="{{ route('users.create') }}" class="btn btn-outline-primary rounded btn mx-3"><i
                class="fas fa-plus-square"></i></a>
    </div>
@stop

@section('content')
    @include('flash::message')
    <div class="card">
        <div class="card-body">
            <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                {!! $builder->table(['class' => 'table table-bordered table-striped dataTable dtr-inline']) !!}
            </div>
        </div>
    </div>
    
@endsection

@push('js')
    {!! $builder->scripts() !!}
    <script>
        function delPerson(deleteUser) {
            console.log(deleteUser);
            $.ajax({
                type: 'DELETE',
                url: deleteUser,
                data: {
                    _token: $("input[name=_token]").val()
                },
                success: function(res) {
                    if (res['status'] == 'success') {
                        LaravelDataTables.dataTableBuilder.ajax.reload();
                    }
                },
                error: function(err) {
                    console.log(err);
                }
            });
        }

    </script>
@endpush
