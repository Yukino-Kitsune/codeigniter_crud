class SubjectsCrud{

    isAdmin = false;
    records;
    tableBody;
    constructor(){
        this.tableBody = document.getElementById('subjectsTable');
    }

    async getAll(){
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
                if(data['isAdmin'] == 1)
                    this.isAdmin = true;
                this.records = data['data']; // TODO rename 'data'
            })
            .catch(error => {
                console.error('Request failed:', error);
            });
    }

    createRow(record){
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

        if(this.isAdmin){
            let actionCell = document.createElement('th');
            actionCell.scope = 'row';

            actionCell.appendChild(SubjectsCrud.createButton('edit', 'btn-success', 'Изменить', this.editAction));

            row.appendChild(actionCell);
        }
        this.tableBody.appendChild(row);
    }

    static createButton(id, color_class, title, action){
        let button = document.createElement('button');
        button.classList.add('btn', color_class);
        button.id = id;
        button.textContent = title;
        button.addEventListener('click', action);
        return button;
    }
    generateTable(){
        this.getAll().then(r =>{
            this.tableBody.innerHTML = '';
            this.records.forEach(record => {
                this.createRow(record);
            });
        });
    }
    static async getTeachers(){
        let records;
        await fetch('/teachers',{
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
            .then(response => response.json())
            .then(data => {records = data;})
            .catch(error => {
                console.log('Failed to load teachers: ', error);
            })
        return records;
    }
    async editAction(){
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
        select.id = 'teacherSelect'; // TODO For what?

        let records = await SubjectsCrud.getTeachers(); // TODO тут статик, до этого не статик. ПИЗДЕЦ
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

        let saveButton = SubjectsCrud.createButton('save', 'btn-success', 'Сохранить',
            () => SubjectsCrud.saveAction(idCell.textContent, input.value, select.selectedOptions[0].value));
        // console.log(this);
        this.hidden = true;
        actionCell.appendChild(saveButton);
    }

    static async saveAction(id, subjectName, teacher_id){
        let editedSubject = new URLSearchParams();
        editedSubject.set('id', id);
        editedSubject.set('subject_name', subjectName);
        editedSubject.set('teacher_id', teacher_id);
        await fetch('/subjects/update', {
            method: 'POST',
            headers:{
                'Content-Type': 'application/x-www-form-urlencoded',
                'X-Request-With': 'XMLHttpRequest'
            },
            body: editedSubject
        })
            .then(response => response.json())
            .then(data => {
                console.log(this);
                console.log('post data: ', data); // TODO add alert
            })
    }


}
