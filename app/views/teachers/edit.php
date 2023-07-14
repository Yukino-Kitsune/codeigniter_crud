<div class="container student-form">
    <h2 class="text-center">Изменение преподавателя</h2>
    <form action="<?= site_url('/teachers/update'); ?>" method="POST">
        <div class="mb-3">
            <input type="text" hidden="hidden" class="form-control" id="id" name="id" value="<?= $data['id']; ?>"
                   required>
        </div>
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
        <button type="submit" class="btn btn-primary btn-confirm">Подтвердить</button>
    </form>
</div>