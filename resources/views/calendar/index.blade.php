@extends('adminlte::page')
@section('plugins.FullCalendar', true)

@section('content')
    <div class="container-fluid">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-body p-3">
                    <button type="button" class="btn btn-primary ml-3" data-toggle="modal" data-target="#exampleModal"
                        onclick="showModalCreateEvent()">Добавить задачу</button>
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Добавить новую задачу</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form" action="{{ route('calendars.store') }}">
                    @csrf
                    @method('POST')
                    <div class="modal-body">
                        <label class="text-dark mt-2">Название задачи</label>
                        <input id="modal-event" type="text" class="form-control" required placeholder="Введите задачу"
                            name="title">

                        <label class="text-dark mt-2">Сотрудник</label>
                        <select class="custom-select" name="user_id">
                            @foreach ($roleUsers as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>

                        <label class="text-dark mt-2 ">Начало задачи</label>
                        <input type="date" class="form-control" required placeholder="Введите задачу" name="start">

                        <label class="text-dark mt-2">Конец задачи</label>
                        <input type="date" class="form-control" placeholder="Введите задачу" name="end">

                        <hr>
                        <div class="form-check d-flex">
                            <input class="form-check-input" type="checkbox" value="true" name="compilited_at">
                            <label class="form-check-label">Готово</label>
                        </div>

                    </div>
                    <div class="modal-footer ">
                        <button type="button" id="deleteElement" class="btn btn-danger"
                            style="visibility: hidden">Удалить</button>
                        <button id="add-btn" type="submit" class="btn btn-primary">Добавить</button>
                        <button id="close-clear" type="button" class="btn btn-secondary"
                            data-dismiss="modal">Закрыть</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        // Айди редактируемого элемента
        var elementId;
        var fullCalendar;

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay',
                },
                themeSystem: 'bootstrap',
                locale: 'ru',
                events: {
                    url: 'calendars/show',
                },

                // Клик по элементу в календаре
                eventClick: function(element) {
                    let formDateStart = moment(element.event.start).format('YYYY-MM-DD');
                    let formDateEnd = moment(element.event.end).format('YYYY-MM-DD');
                    $('.modal').modal('show');
                    $('#form').attr('action', 'calendars/' + element.event.id);
                    $('#form').find('[name=start]').val(formDateStart);
                    $('#form').find('[name=end]').val(formDateEnd);
                    $('#form').find('[name=_method]').val('PATCH');
                    $('#form').find('[name=title]').val(element.event.title);
                    $('#form').find('[name=compilited_at], .form-check-label').show();
                    $('#form').find('select option[value=" + element.event.extendedProps.user_id + "]')
                        .attr('selected', true);
                    $('#add-btn, .modal-title').text('Изменить');
                    $('#deleteElement').attr('style', 'visibility: visible');
                    // проверка на cheked в input-check
                    if (element.event.extendedProps.compilited_at !== null) {
                        $('#form').find('[name=compilited_at]').attr('checked', true);
                    } else {
                        $('#form').find('[name=compilited_at]').attr('checked', false);
                    }
                    // Вывод функции из области видимости. 
                    elementId = element.event.id;
                    fullCalendar = function() {
                        return calendar.refetchEvents();
                    }
                },
            });
            calendar.render();

            // Сабмит формы
            $('#form').submit(function(event) {
                event.preventDefault();
                thisSelector = $(this);
                formData = new FormData(thisSelector[0]);
                $.ajax({
                    url: thisSelector.attr('action'),
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(res) {
                        calendar.refetchEvents();
                        $('.modal').modal('hide');
                    },
                    error: function(err) {
                        console.log(err);
                    },
                });

            })
        });

        $('#deleteElement').click(function() {
            $.ajax({
                url: "calendars/" + elementId,
                type: 'DELETE',
                processData: false,
                contentType: false,
                success: function(res) {
                    fullCalendar();
                    $('.modal').modal('hide');
                },
                error: function(err) {
                    console.log(err);
                }
            })
        })

        function showModalCreateEvent() {
            $('#form').find('[name=_method]').val('POST');
            $('#form').find('[name=start], [name=end], [name=title]').val('');
            $('#form').find('[name=compilited_at], .form-check-label').hide();
            $('#add-btn, .modal-title').text('Добавить');
            $('#deleteElement').attr('style', 'visibility: hidden');
        }

    </script>
@endsection
