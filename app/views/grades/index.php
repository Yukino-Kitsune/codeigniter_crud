<div class="container">
    <?php
    if ($session->has('msg')): ?>
        <h3 class="alert <?= $session->get('msg_type'); ?> text-center"><?= $session->get('msg'); ?></h3>
        <?php
        $session->remove('msg');
        $session->remove('msg_type');
    endif ?>
    <h2 class="text-center">Таблица Оценок</h2>
    <div class="box-table mx-auto d-table">
        <?php
        if ($isAdmin): ?>
            <a class="btn btn-primary create-btn" href="<?= site_url('/grades/create'); ?>">Создать</a>
        <?php
        endif; ?>
        <table class="table table_sort table-hover table-bordered w-auto mx-auto">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Дисциплина</th>
                <th scope="col">Студент</th>
                <th scope="col">Оценка</th>
                <?php
                if ($isAdmin): ?>
                    <th scope="col">Действия</th>
                <?php
                endif; ?>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($data as $grade): ?>
                <tr>
                    <th scope="row"><?= $grade['id']; ?></th>
                    <th scope="row"><?= $grade['subject_name']; ?></th>
                    <th scope="row"><?= $grade['surname'] . ' ' . $grade['name']; ?></th>
                    <th scope="row"><?= $grade['grade']; ?></th>
                    <?php
                    if ($isAdmin): ?>
                        <th scope="row">
                            <a class="btn btn-success"
                               href="<?= site_url('grades/edit/' . $grade['id']) ?>">Изменить</a>
                            <a class="btn btn-danger"
                               href="<?= site_url('grades/delete/' . $grade['id']) ?>">Удалить</a>
                        </th>
                    <?php
                    endif; ?>
                </tr>
            <?php
            endforeach; ?>
            </tbody>
        </table>
    </div>
</div>