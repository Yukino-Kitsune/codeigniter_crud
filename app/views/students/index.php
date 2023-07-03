<?php
if (isset($_SESSION['msg'])) {
    echo $_SESSION['msg'];
    # TODO create alert
    unset($_SESSION['msg']);
}
?>
<div class="container">
        <h2 class="text-center">Таблица Студентов</h2>
        <a class="btn btn-primary create-btn" href="/students/create">Создать</a> <!-- TODO add href -->
        <div class="box-table mx-auto">
        <table class="table table-hover table-bordered w-100">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Фамилия</th>
                    <th scope="col">Имя</th>
                    <th scope="col">Группа</th>
<!--                    TODO Можно ли сделать чтобы данный столбец показывался только админу?-->
                    <th scope="col">Действия</th>
                </tr>
            </thead>
            <tbody>
<?php foreach ($data as $student):?>
                <tr>
                    <th scope="row"><?= $student['id']; ?></th>
                    <th scope="row"><?= $student['surname']; ?></th>
                    <th scope="row"><?= $student['name']; ?></th>
                    <th scope="row"><?= $student['group_name']; ?></th>
                    <th scope="row">
                        <a class="btn btn-success" href="<?php echo base_url('students/edit/'.$student['id'])?>">Изменить</a>
                        <a class="btn btn-danger" href="<?php echo base_url('students/delete/'.$student['id'])?>">Удалить</a>
                    </th>
                </tr>
<?php endforeach;?>
            </tbody>
        </table>
        </div>
    </div>