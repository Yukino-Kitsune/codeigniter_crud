<div class="container">
    <h2 class="text-center">Изменение студента</h2>
    <form action="<?= site_url('/students/update'); ?>" method="POST">
        <div class="mb-3">
            <input type="text" hidden="hidden" class="form-control" id="id" name="id" value="<?= $data['id']; ?>"
                   required>
            <div class="mb-3">
                <label for="surname" class="form-label">Фамилия</label>
                <input type="text" aria-valuetext="" class="form-control" id="surname" name="surname" required
                       maxlength="16"
                       value="<?= $data['surname']; ?>">
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Имя</label>
                <input type="text" class="form-control" id="name" name="name" required maxlength="16"
                       value="<?= $data['name']; ?>">
            </div>
            <div>
                <label for="group_id">Группа</label>
                <select class="form-select" name="group_id" id="group_id" aria-label="Выберите группу">
                    <?php
                    foreach ($groups as $group): ?>
                        <?php
                        if ($data['group_id'] == $group['group_id']): ?>
                            <option value="<?= $group['group_id']; ?>" selected><?= $group['group_name']; ?></option>
                        <?php
                        else: ?>
                            <option value="<?= $group['group_id']; ?>"><?= $group['group_name']; ?></option>
                        <?php
                        endif ?>
                    <?php
                    endforeach ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Подтвердить</button>
    </form>
</div>