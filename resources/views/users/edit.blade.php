@extends('adminlte::page')

@section('content')
    <div class=" col-md-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Редактировать</h3>
            </div>
            <form action="{{ route('users.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="card-body">

                    <div class="form-group">
                        <label for="name">Изменить имя</label>
                        <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" name="name"
                            value="{{ old('name', optional($user)->name) }}">
                        @error('name')
                            <span class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Изменить email</label>
                        <input type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                            name="email" value="{{ old('email', optional($user)->email) }}">
                        @error('email')
                            <span class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Пароль</label>
                        <input type="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                            name="password" placeholder="Введите пароль">
                        @error('password')
                            <span class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group mb-3 mt-5">
                        <label>Права</label>
                        <select class="custom-select {{ $errors->has('role') ? 'is-invalid' : '' }}" name="role">
                            @foreach ($roles as $key => $value)
                                <option @if ($roleId->contains($key)) selected @endif value="{{ $key }}">{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label>Пол </label>
                        <select class="custom-select {{ $errors->has('gender') ? 'is-invalid' : '' }}" name="gender_id">
                            @foreach ($genders as $gender)
                                <option @if ($gender->id == $user->gender_id) selected @endif value="{{ $gender->id }}">{{ $gender->title }}</option>
                            @endforeach

                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label>Должность </label>
                        <select class="custom-select {{ $errors->has('position') ? 'is-invalid' : '' }}"
                            name="position_id">
                            @foreach ($positions as $position)
                                <option @if ($position->id == $user->position_id) selected @endif value="{{ $position->id }}">
                                    {{ $position->title }}</option>
                            @endforeach

                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label>Отдел</label>
                        <select class="custom-select {{ $errors->has('section') ? 'is-invalid' : '' }}"
                            name="section_id">
                            @foreach ($sections as $section)
                                <option @if ($section->id == $user->section_id) selected @endif value="{{ $section->id }}">{{ $section->title }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label>Статус</label>
                        <select class="custom-select {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status_id">
                            @foreach ($statuses as $status)
                                <option @if ($status->id == $user->status_id) selected @endif value="{{ $status->id }} "> {{ $status->title }} </option>
                            @endforeach
                        </select>
                    </div>

                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Изменить</button>
                </div>
            </form>
        </div>
    </div>
@endsection
