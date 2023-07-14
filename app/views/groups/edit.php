<div class="container student-form">
    <h2 class="text-center">Изменение группы</h2>
    <form action="<?= site_url('/groups/update'); ?>" method="POST">
        <div class="mb-3">
            <input type="text" hidden="hidden" class="form-control" id="id" name="id" value="<?= $data['group_id']; ?>"
                   required>
            <div class="mb-3">
                <label for="group_name" class="form-label">Название группы</label>
                <input type="text" aria-valuetext="" class="form-control" id="group_name" name="group_name" required
                       maxlength="16"
                       value="<?= $data['group_name']; ?>">
            </div>
        </div>
        <button type="submit" class="btn btn-primary btn-confirm">Подтвердить</button>
    </form>
</div>