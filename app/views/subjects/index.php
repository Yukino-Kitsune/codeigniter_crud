<script src="/js/SubjectsCrud.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        initCrud();
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
    <div class="box-table mx-auto d-table">
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