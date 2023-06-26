@extends('layouts.app')

@section('title', 'Студенты')

@section('content')
    <div class="container">
    <h2 class="text-center">Добавление студента</h2>
    <form action="{{ route('students.store') }}" method="POST">
        <div class="mb-3">
            <label for="name" class="form-label">Имя</label>
            <input type="text" class="form-control" id="name">
        </div>
        <div class="mb-3">
            <label for="surname" class="form-label">Фамилия</label>
            <input type="text" class="form-control" id="surname">
        </div>
        <div>
            <label for="group_id">Группа</label>
            <select class="form-select" name="group_id" id="group_id" aria-label="Выберите группу">
                @foreach($records as $student)
                    <option value="{{$student->group_id}}">{{$student->group_id}}</option> {{--TODO Изменить id группы на название--}}
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Подтвердить</button>
    </form>
    </div>
@endsection
