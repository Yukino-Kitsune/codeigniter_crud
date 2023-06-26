@extends('layouts.app')

@section('title', 'Студенты')

@section('content')
    <div class="container">
        <h2 class="text-center">Таблица Студентов</h2>
        <a class="btn btn-primary create-btn" href="{{ route('students.create') }}">Создать</a>
        <div class="box-table mx-auto">
        <table class="table table-hover table-bordered w-100">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Фамилия</th>
                    <th scope="col">Имя</th>
                    <th scope="col">Группа</th>
    {{--                TODO Можно ли сделать чтобы данный столбец показывался только админу?--}}
    {{--                <th scope="col">Действия</th>--}}
                </tr>
            </thead>
            <tbody>
            @foreach($records as $student)
                <tr>
                    <th scope="row">{{$student->id}}</th>
                    <th scope="row">{{$student->surname}}</th>
                    <th scope="row">{{$student->name}}</th>
                    <th scope="row">{{$student->group_id}}</th>
    {{--                <th scope="row">--}}
    {{--                    <a class="btn btn-primary" href="#">Изменить</a>--}}
    {{--                    <a class="btn btn-primary" href="#">Удалить</a>--}}
    {{--                </th>--}}
                </tr>
            @endforeach
            </tbody>
        </table>
        </div>
    </div>
@endsection
