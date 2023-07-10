<script>
    document.addEventListener('DOMContentLoaded', function() {
        function loadSubjects() {
            fetch('/subjects',
                {
                    method: "get",
                    headers: {
                        "Content-Type": "application/json",
                        "X-Requested-With": "XMLHttpRequest"
                    }
                })
                .then(response => response.json())
                .then(data => {
                    var tableBody = document.getElementById('subjectsTable');

                    var createButton = document.createElement('button');
                    createButton.classList.add('btn', 'btn-primary');
                    createButton.textContent = 'Создать';
                    createButton.addEventListener('click', function () {
                        var row = document.createElement('tr');
                        var idCell = document.createElement('th');
                        idCell.scope = 'row';
                        var subjectNameCell = document.createElement('th');
                        subjectNameCell.scope = 'row';
                        var teacherCell = document.createElement('th');
                        teacherCell.scope = 'row';
                        var actionCell = document.createElement('th');
                        actionCell.scope = 'row';

                        subjectNameCell.innerHTML = '<input type="text" class="form-control" value="">';
                        fetch('/teachers', {
                            method: 'GET',
                            headers: {
                                "Content-Type": "application/json",
                                "X-Requested-With": "XMLHttpRequest"
                            }
                        })
                            .then(response => response.json())
                            .then(data => {
                                var select = document.createElement('select');
                                select.classList.add('form-select');
                                data.forEach(teacher => {
                                    var option = document.createElement('option')
                                    option.value = teacher.id;
                                    option.textContent = teacher.surname + ' ' + teacher.name;
                                    select.appendChild(option);
                                });
                                teacherCell.innerHTML = ''; // TODO mb useless
                                teacherCell.appendChild(select);
                            });

                        var storeButton = document.createElement('button');
                        storeButton.classList.add('btn','btn-success');
                        storeButton.textContent = 'Подтвердить';
                        storeButton.addEventListener('click', function () {
                            var createdSubject = new URLSearchParams();
                            createdSubject.set('subject_name', subjectNameCell.querySelector('input').value);
                            createdSubject.set('teacher_id', teacherCell.querySelector('select').selectedOptions[0].value);
                            console.log('created', createdSubject); // TODO remove
                            fetch('/subjects/store',{
                                method: 'POST',
                                headers: {
                                    "Content-Type": "application/x-www-form-urlencoded",
                                    "X-Requested-With": "XMLHttpRequest"
                                },
                                body: createdSubject
                            })
                                .then(response => response.json())
                                .then(data => {
                                    if(data['msg'] !== 'success') {
                                        var alert = document.createElement('h3')
                                        alert.classList.add('alert', 'alert-danger', 'text-center');
                                        alert.textContent = 'Ошибка!';
                                        var cont = document.getElementById('container'); // TODO переделать в одну строку
                                        cont.insertAdjacentElement('afterbegin', alert);
                                        return;
                                    }
                                    // editButton.hidden = false;
                                    // deleteButton.hidden = false;
                                    // saveButton.hidden = true;
                                    idCell.textContent = data['id'];
                                    subjectNameCell.textContent = createdSubject.get('subject_name');
                                    teacherCell.textContent = teacherCell.querySelector('select').selectedOptions[0].text;
                                });

                        });

                        actionCell.appendChild(storeButton);

                        row.appendChild(idCell);
                        row.appendChild(subjectNameCell);
                        row.appendChild(teacherCell);
                        row.appendChild(actionCell);
                        tableBody.insertAdjacentElement('afterbegin', row);
                        // document.getElementsByClassName('table table-sort')[0].insertAdjacentElement('afterbegin', row);
                    });
                    document.getElementsByClassName('table')[0].insertAdjacentElement('beforebegin', createButton);
                    // Очищаем содержимое таблицы
                    tableBody.innerHTML = '';

                    // Добавляем данные в таблицу
                    data['data'].forEach(subject => {
                        var row = document.createElement('tr');
                        var idCell = document.createElement('th');
                        idCell.scope = 'row';
                        var subjectNameCell = document.createElement('th');
                        subjectNameCell.scope = 'row';
                        var teacherCell = document.createElement('th');
                        teacherCell.scope = 'row';

                        idCell.textContent = subject.id;
                        subjectNameCell.textContent = subject.subject_name;
                        teacherCell.textContent = subject.surname + ' ' + subject.name;
                        teacherCell.id = subject.teacher_id;


                        row.appendChild(idCell);
                        row.appendChild(subjectNameCell);
                        row.appendChild(teacherCell);

                        if(data['isAdmin'] == 1){
                            var actionCell = document.createElement('th');
                            actionCell.scope = 'row';
                            row.appendChild(actionCell);

                            var saveButton = document.createElement('button');
                            saveButton.classList.add('btn', 'btn-success');
                            saveButton.textContent = 'Сохранить';
                            saveButton.hidden = true;
                            saveButton.addEventListener('click', function () {
                                var updatedSubject = new URLSearchParams();
                                updatedSubject.set('id', subject.id);
                                updatedSubject.set('subject_name', subjectNameCell.querySelector('input').value);
                                updatedSubject.set('teacher_id', teacherCell.querySelector('select').selectedOptions[0].value);
                                fetch('/subjects/update',{
                                    method: 'POST',
                                    headers: {
                                        "Content-Type": "application/x-www-form-urlencoded",
                                        "X-Requested-With": "XMLHttpRequest"
                                    },
                                    body: updatedSubject
                                })
                                    .then(response => response.json())
                                    .then(data => {
                                        if(data['msg'] !== 'success') {
                                            var alert = document.createElement('h3')
                                            alert.classList.add('alert', 'alert-danger', 'text-center');
                                            alert.textContent = 'Ошибка!';
                                            var cont = document.getElementById('container'); // TODO переделать в одну строку
                                            cont.insertAdjacentElement('afterbegin', alert);
                                            return;
                                        }
                                        editButton.hidden = false;
                                        deleteButton.hidden = false;
                                        saveButton.hidden = true;
                                        subjectNameCell.textContent = updatedSubject.subject_name;
                                        teacherCell.textContent = teacherCell.querySelector('select').selectedOptions[0].text;
                                    });

                            });
                            actionCell.appendChild(saveButton);

                            var editButton = document.createElement('button');
                            editButton.classList.add('btn', 'btn-success');
                            editButton.textContent = 'Изменить';
                            editButton.addEventListener('click', function () {
                                subjectNameCell.innerHTML = '<input type="text" class="form-control" value="' + subject.subject_name + '">';
                                fetch('/teachers', {
                                    method: 'GET',
                                    headers: {
                                        "Content-Type": "application/json",
                                        "X-Requested-With": "XMLHttpRequest"
                                    }
                                })
                                    .then(response => response.json())
                                    .then(data => {
                                        var select = document.createElement('select');
                                        select.classList.add('form-select');
                                        data.forEach(teacher => {
                                            var option = document.createElement('option')
                                            option.value = teacher.id;
                                            option.textContent = teacher.surname + ' ' + teacher.name;
                                            select.appendChild(option);
                                        });
                                        select.value = subject.teacher_id;
                                        teacherCell.innerHTML = '';
                                        teacherCell.appendChild(select);
                                    });
                                editButton.hidden = true;
                                deleteButton.hidden = true;
                                saveButton.hidden = false;
                            });
                            actionCell.appendChild(editButton);

                            var deleteButton = document.createElement('button');
                            deleteButton.classList.add('btn', 'btn-danger');
                            deleteButton.textContent = 'Удалить';
                            deleteButton.addEventListener('click', function () {
                                fetch('/subjects/delete/'+subject.id,{
                                    method: 'GET',
                                    headers: {
                                        "Content-Type": "application/json",
                                        "X-Requested-With": "XMLHttpRequest"
                                    }
                                })
                                    .then(response => response.json())
                                    .then(data => {
                                        if(data['msg'] === 'success'){
                                            row.innerHTML = '';
                                        }

                                    });
                            });
                            actionCell.appendChild(deleteButton);
                        }

                        tableBody.appendChild(row);
                    });
                })
                .catch(error => {
                    console.error('Request failed:', error);
                });
        }
        // Загрузка данных при загрузке страницы
        loadSubjects();
    });
</script>
<div class="container" id="container">
    <?php
    if ($session->has('msg')):?>
        <h3 class="alert <?=$session->get('msg_type');?> text-center"><?=$session->get('msg');?></h3>
        <?php $session->remove('msg');
        $session->remove('msg_type');
    endif?>
    <h2 class="text-center">Таблица дисциплин</h2>
    <div class="box-table mx-auto">
        <table class="table table_sort table-hover table-bordered w-auto mx-auto">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Дисциплина</th>
                <th scope="col">Преподаватель</th>
                <?php if($isAdmin):?>
                    <th scope="col">Действия</th>
                <?php endif;?>
            </tr>
            </thead>
            <tbody id="subjectsTable">
            </tbody>
        </table>
    </div>
</div>