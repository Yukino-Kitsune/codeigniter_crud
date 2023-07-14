let isAdmin = false;
let tableBody;

async function initCrud() {
    tableBody = document.getElementById('subjectsTable');
    await getAll().then(records => {
        tableBody.innerHTML = '';
        records.forEach(record => {
            createRow(record);
        });
    });
    if (isAdmin) {
        let table = document.getElementsByClassName('table')[0];
        let createBtn = createButton('create', ['btn-primary','create-btn'], 'Создать', createAction);
        table.insertAdjacentElement('beforebegin', createBtn);
    }
}

async function getAll() {
    let records;
    await fetch('/subjects',
        {
            method: "get",
            headers: {
                "Content-Type": "application/json",
                "X-Requested-With": "XMLHttpRequest"
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data['isAdmin'] == 1)
                isAdmin = true;
            records = data['records'];
        })
        .catch(error => {
            console.error('Request failed:', error);
        });
    return records;
}

async function getTeachers() {
    let records;
    await fetch('/teachers', {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
        .then(response => response.json())
        .then(data => {
            records = data;
        })
        .catch(error => {
            console.log('Failed to load teachers: ', error);
        })
    return records;
}

function createRow(record) {
    let row = document.createElement('tr');
    let idCell = document.createElement('th');
    idCell.scope = 'row';
    idCell.id = 'idCell';
    let subjectNameCell = document.createElement('th');
    subjectNameCell.scope = 'row';
    subjectNameCell.id = 'subjectNameCell';
    let teacherCell = document.createElement('th');
    teacherCell.scope = 'row';
    teacherCell.id = 'teacherCell';

    idCell.textContent = record['id'];
    subjectNameCell.textContent = record['subject_name'];
    teacherCell.textContent = record['surname'] + ' ' + record['name'];
    teacherCell.id = record['teacher_id'];

    row.appendChild(idCell);
    row.appendChild(subjectNameCell);
    row.appendChild(teacherCell);

    if (isAdmin) {
        let actionCell = document.createElement('th');
        actionCell.scope = 'row';
        actionCell.appendChild(createButton('edit_' + record['id'], ['btn-success'], 'Изменить', editAction));
        actionCell.appendChild(createButton('delete_' + record['id'], ['btn-danger'], 'Удалить', () => deleteAction(record['id'])));

        row.appendChild(actionCell);
    }
    tableBody.appendChild(row);
}

function createButton(id, additional_classes, title, action) {
    let button = document.createElement('button');
    button.classList.add('btn', ...additional_classes);
    button.id = id;
    button.textContent = title;
    button.addEventListener('click', action);
    return button;
}

function createAlert() {
    let alert = document.createElement('h3')
    alert.classList.add('alert', 'alert-danger', 'text-center');
    alert.textContent = 'Ошибка!';
    let alerts = document.getElementsByClassName('alert');
    if (alerts.length > 0) {
        for (const element of alerts) {
            element.remove();
        }
    }
    document.getElementById('container').insertAdjacentElement('afterbegin', alert);
}

async function createAction() {
    let row = document.createElement('tr');
    let idCell = document.createElement('th');
    idCell.scope = 'row';
    let subjectNameCell = document.createElement('th');
    subjectNameCell.scope = 'row';
    let teacherCell = document.createElement('th');
    teacherCell.scope = 'row';
    let actionCell = document.createElement('th');
    actionCell.scope = 'row';

    let input = document.createElement('input');
    input.type = 'text';
    input.classList.add('form-control');
    subjectNameCell.appendChild(input);

    let select = document.createElement('select');
    let records = await getTeachers();
    records.forEach(record => {
        let option = document.createElement('option');
        option.value = record['id'];
        option.textContent = record['surname'] + ' ' + record['name'];
        select.appendChild(option);
    });
    teacherCell.appendChild(select);

    let confirmBtn = createButton('confirm', ['btn-success'], 'Подтвердить',
        () => confirmAction(input.value, select.selectedOptions[0].value));

    actionCell.appendChild(confirmBtn);

    row.appendChild(idCell);
    row.appendChild(subjectNameCell);
    row.appendChild(teacherCell);
    row.appendChild(actionCell);

    tableBody.insertAdjacentElement('afterbegin', row);
}

async function confirmAction(subjectName, teacherId) {
    let createdSubject = new URLSearchParams();
    createdSubject.set('subject_name', subjectName);
    createdSubject.set('teacher_id', teacherId);
    await fetch('/subjects/store', {
        method: 'POST',
        headers: {
            "Content-Type": "application/x-www-form-urlencoded",
            "X-Requested-With": "XMLHttpRequest"
        },
        body: createdSubject
    })
        .then(response => response.json())
        .then(data => {
            if (data['msg'] !== 'success') {
                createAlert();
                return;
            }

            let confirmBtn = document.getElementById('confirm');

            let row = confirmBtn.parentNode.parentNode;
            let idCell = row.querySelector('th');
            let subjectNameCell = row.querySelector('th:nth-child(2)');
            let teacherCell = row.querySelector('th:nth-child(3)');
            let actionCell = row.querySelector('th:nth-child(4)');

            idCell.textContent = data['id'];
            subjectNameCell.innerHTML = '';
            subjectNameCell.textContent = subjectName;
            let teacher = teacherCell.children[0].selectedOptions[0].textContent;
            teacherCell.innerHTML = '';
            teacherCell.textContent = teacher;

            confirmBtn.remove();
            actionCell.appendChild(createButton('edit_' + data['id'], ['btn-success'], 'Изменить', editAction));
            actionCell.appendChild(createButton('delete_' + data['id'], ['btn-danger'], 'Удалить', () => deleteAction(data['id'])));
        })
}

async function editAction() {
    let row = this.parentNode.parentNode;

    let idCell = row.querySelector('th');
    let subjectNameCell = row.querySelector('th:nth-child(2)');
    let teacherCell = row.querySelector('th:nth-child(3)');
    let actionCell = row.querySelector('th:nth-child(4)');

    let input = document.createElement('input');
    input.type = 'text';
    input.classList.add('form-control');
    input.value = subjectNameCell.textContent;

    let select = document.createElement('select');
    select.classList.add('form-control');

    let records = await getTeachers();
    records.forEach(record => {
        let option = document.createElement('option');
        option.value = record['id'];
        option.textContent = record['surname'] + ' ' + record['name'];
        select.appendChild(option);
    })

    subjectNameCell.textContent = '';
    subjectNameCell.appendChild(input);
    teacherCell.textContent = '';
    teacherCell.appendChild(select);

    let saveButton = createButton('save_' + idCell.textContent, ['btn-success'], 'Сохранить',
        () => saveAction(idCell.textContent, input.value, select.selectedOptions[0].value));

    document.getElementById('delete_' + idCell.textContent).hidden = true; // Скрываем кнопки
    document.getElementById('edit_' + idCell.textContent).hidden = true;

    actionCell.appendChild(saveButton);
}

async function saveAction(id, subjectName, teacher_id) {
    let editedSubject = new URLSearchParams();
    editedSubject.set('id', id);
    editedSubject.set('subject_name', subjectName);
    editedSubject.set('teacher_id', teacher_id);
    await fetch('/subjects/update', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
            'X-Request-With': 'XMLHttpRequest'
        },
        body: editedSubject
    })
        .then(response => response.json())
        .then(data => {
            if (data['msg'] !== 'success') {
                createAlert();
                return;
            }
        })

    let saveBtn = document.getElementById('save_' + id);
    let row = saveBtn.parentNode.parentNode;
    let subjectNameCell = row.querySelector('th:nth-child(2)');
    let teacherCell = row.querySelector('th:nth-child(3)');

    subjectNameCell.innerHTML = '';
    subjectNameCell.textContent = subjectName;
    let teacher = teacherCell.children[0].selectedOptions[0].textContent;
    teacherCell.innerHTML = '';
    teacherCell.textContent = teacher;

    saveBtn.remove();

    document.getElementById('edit_' + id).hidden = false; // Показываем кнопку изменить
    document.getElementById('delete_' + id).hidden = false;
}

async function deleteAction(id) {
    await fetch('/subjects/delete/' + id, {
        method: 'GET',
        headers: {
            "Content-Type": "application/json",
            "X-Requested-With": "XMLHttpRequest"
        }
    })
        .then(response => response.json())
        .then(data => {
            if (data['msg'] === 'success') {
                let deleteBtn = document.getElementById('delete_' + id);
                let row = deleteBtn.parentNode.parentNode;
                row.innerHTML = '';
            }
        })
}

