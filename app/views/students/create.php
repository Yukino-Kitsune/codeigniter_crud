<div class="container student-form">
    <h2 class="text-center">Добавление студента</h2>
    <form action="<?= site_url('/students/store'); ?>" method="POST">
        <div class="mb-3">
            <label for="surname" class="form-label">Фамилия</label>
            <input type="text" class="form-control" id="surname" name="surname" required maxlength="16">
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Имя</label>
            <input type="text" class="form-control" id="name" name="name" required maxlength="16">
        </div>
        <div>
            <label for="group_id">Группа</label>
            <select class="form-select" name="group_id" id="group_id" aria-label="Выберите группу">
                <?php
                foreach ($data as $group): ?>
                    <option value="<?= $group['group_id']; ?>"><?= $group['group_name']; ?></option>
                <?php
                endforeach ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary btn-confirm">Подтвердить</button>
    </form>
</div>