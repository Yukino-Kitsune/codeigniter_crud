<div class="container">
    <?php
    if ($session->has('msg')):?>
        <h3 class="alert <?=$session->get('msg_type');?> text-center"><?=$session->get('msg');?></h3>
        <?php $session->remove('msg');
        $session->remove('msg_type');
    endif?>
    <h2 class="text-center">Таблица преподавателей</h2>
    <?php if($isAdmin):?>
        <a class="btn btn-primary create-btn" href="<?= site_url('/teachers/create'); ?>">Создать</a>
    <?php endif;?>
    <div class="box-table mx-auto">
        <table class="table table_sort table-hover table-bordered w-auto mx-auto">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Фамилия</th>
                <th scope="col">Имя</th>
                <?php if($isAdmin):?>
                    <th scope="col">Действия</th>
                <?php endif;?>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($data as $teacher): ?>
                <tr>
                    <th scope="row"><?= $teacher['id']; ?></th>
                    <th scope="row"><?= $teacher['surname']; ?></th>
                    <th scope="row"><?= $teacher['name']; ?></th>
                    <?php if($isAdmin):?>
                        <th scope="row">
                            <a class="btn btn-success"
                               href="<?= site_url('teachers/edit/' . $teacher['id']) ?>">Изменить</a>
                            <a class="btn btn-danger"
                               href="<?= site_url('teachers/delete/' . $teacher['id']) ?>">Удалить</a>
                        </th>
                    <?php endif;?>
                </tr>
            <?php
            endforeach; ?>
            </tbody>
        </table>
    </div>
</div>