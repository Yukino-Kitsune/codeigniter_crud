<div class="container">
<?php
if ($session->has('msg')):?>
    <h3 class="alert <?=$session->get('msg_type');?> text-center"><?=$session->get('msg');?></h3>
<?php $session->remove('msg');
    $session->remove('msg_type');
endif?>
    <h2 class="text-center">Таблица Студентов</h2>
    <div class="box-table mx-auto d-table">
        <?php if($isAdmin):?>
            <a class="btn btn-primary create-btn" href="<?= site_url('/students/create'); ?>">Создать</a>
        <?php endif;?>
        <table class="table table_sort table-hover table-bordered w-auto mx-auto">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Фамилия</th>
                <th scope="col">Имя</th>
                <th scope="col">Группа</th>
                <?php if($isAdmin):?>
                <th scope="col">Действия</th>
                <?php endif;?>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($data as $student): ?>
                <tr>
                    <th scope="row"><?= $student['id']; ?></th>
                    <th scope="row"><?= $student['surname']; ?></th>
                    <th scope="row"><?= $student['name']; ?></th>
                    <th scope="row"><?= $student['group_name']; ?></th>
                    <?php if($isAdmin):?>
                    <th scope="row">
                        <a class="btn btn-success"
                           href="<?= site_url('students/edit/' . $student['id']) ?>">Изменить</a>
                        <a class="btn btn-danger"
                           href="<?= site_url('students/delete/' . $student['id']) ?>">Удалить</a>
                    </th>
                    <?php endif;?>
                </tr>
            <?php
            endforeach; ?>
            </tbody>
        </table>
    </div>
</div>