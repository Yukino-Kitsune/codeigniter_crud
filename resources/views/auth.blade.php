@extends('layouts.app')

@section('title', 'Авторизация')

@section('content')
    <div class="container">
    <h1>Авторизация</h1>
    <form>
        <div class="mb-3">
            <label for="login" class="form-label">Логин</label>
            <input type="text" class="form-control" id="login">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Пароль</label>
            <input type="password" class="form-control" id="password">
        </div>
        <button type="submit" class="btn btn-primary">Войти</button>
    </form>
    </div>
@endsection
