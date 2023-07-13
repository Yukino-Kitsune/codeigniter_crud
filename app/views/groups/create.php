<div class="container student-form">
    <h2 class="text-center">Добавление группы</h2>
    <form action="<?= site_url('/groups/store'); ?>" method="POST">
        <div class="mb-3">
            <label for="group_name" class="form-label">Название группы</label>
            <input type="text" class="form-control" id="group_name" name="group_name" required maxlength="16">
        </div>
        <button type="submit" class="btn btn-primary btn-confirm">Подтвердить</button>
    </form>
</div>