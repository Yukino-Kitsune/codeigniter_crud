@section('header')
<div class="header d-flex justify-content-between p-3">
    <div class="left d-flex">
{{--        <p class="">CRUD</p>--}}
        <ul class="list-inline ms-3 mb-0">
            <li class="list-inline-item">
                <p class="mb-0" >CRUD</p>
            </li>
            <li class="list-inline-item">
                <a class="nav-link" href="/students">Студенты</a>
            </li>
            <li class="list-inline-item">
                <a class="nav-link" href="/teachers">Преподаватели</a>
            </li>
            <li class="list-inline-item">
                <a class="nav-link" href="/groups">Группы</a>
            </li>
            <li class="list-inline-item">
                <a class="nav-link" href="/subjects">Дисциплины</a>
            </li>
            <li class="list-inline-item">
                <a class="nav-link" href="/grades">Оценки</a>
            </li>
        </ul>
    </div>
    <div class="right">
        <a class="btn btn-primary" href="/auth">Войти</a>
    </div>
</div>
