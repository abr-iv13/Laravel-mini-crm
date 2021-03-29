@extends('adminlte::page')

@section('content')
    <div class="col-md-12 mt-1">
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">Добавить сотрудника</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('users.store') }}" method="POST">
                    @csrf
                    @method('POST')

                    <div class="form-group">
                        <label for="name_person">Имя</label>
                        <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" name="name"
                            value="{{ old('name') }}" placeholder="Введите имя">
                        @error('name')
                            <span class="error invalid-feedback">{{ $message }}</span>
                        @enderror

                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                            name=" email" value="{{ old('email') }}" aria-describedby="emailHelp"
                            placeholder="Введите Email">
                        @error('email')
                            <span class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="exampleInputPassword">Пароль</label>
                        <input type="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                            name="password" placeholder="Введите пароль">
                        @error('password')
                            <span class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group mb-3 mt-5">
                        <label>Права</label>
                        <select class="custom-select {{ $errors->has('role') ? 'is-invalid' : '' }}" name="role">
                            <option value="null" selected>Права доступа</option>
                            @foreach ($roles as $key => $value)
                                <option value="{{ $key }}">{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label>Пол </label>
                        <select class="custom-select {{ $errors->has('gender') ? 'is-invalid' : '' }}" name="gender_id">
                            <option value="null" selected>Выберите пол</option>
                            @foreach ($genders as $gender)
                                <option value="{{ $gender->id }}">{{ $gender->title }}</option>
                            @endforeach

                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label>Должность </label>
                        <select class="custom-select {{ $errors->has('position') ? 'is-invalid' : '' }}"
                            name="position_id">
                            <option value="null" selected>Выберите должность</option>
                            @foreach ($positions as $position)
                                <option value="{{ $position->id }}">{{ $position->title }}</option>
                            @endforeach

                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label>Отдел</label>
                        <select class="custom-select {{ $errors->has('section') ? 'is-invalid' : '' }}"
                            name="section_id">
                            <option value="null" selected>Выберите отдел</option>
                            @foreach ($sections as $section)
                                <option value="{{ $section->id }}">{{ $section->title }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label>Статус</label>
                        <select class="custom-select {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status_id">
                            <option value="null" selected>Выберите статус</option>
                            @foreach ($statuses as $status)
                                <option value="{{ $status->id }} "> {{ $status->title }} </option>
                            @endforeach
                        </select>
                    </div>

            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-success">Добавить</button>
            </div>

            </form>
        </div>
    </div>
    </div>

@endsection
