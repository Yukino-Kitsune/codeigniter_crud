<div class="container student-form">
    <h2 class="text-center">Изменение оценки</h2>
    <form action="<?= site_url('/grades/update'); ?>" method="POST">
        <div class="mb-3">
            <input type="text" hidden="hidden" class="form-control" id="id" name="id" value="<?= $data['id']; ?>"
                   required>
        </div>
        <div>
            <label for="subject_id">Дисциплина</label>
            <select class="form-select" name="subject_id" id="subject_id">
                <?php
                foreach ($subjects as $subject): ?>
                    <?php
                    if ($data['subject_id'] == $subject['id']): ?>
                        <option value="<?= $subject['id']; ?>" selected><?= $subject['subject_name']; ?></option>
                    <?php
                    else: ?>
                        <option value="<?= $subject['id']; ?>"><?= $subject['subject_name']; ?></option>
                    <?php
                    endif ?>
                <?php
                endforeach ?>
            </select>
        </div>
        <div>
            <label for="student_id">Студент</label>
            <select class="form-select" name="student_id" id="student_id">
                <?php
                foreach ($students as $student): ?>
                    <?php
                    if ($data['student_id'] == $student['id']): ?>
                        <option value="<?= $student['id']; ?>"
                                selected><?= $student['surname'] . ' ' . $student['name']; ?></option>
                    <?php
                    else: ?>
                        <option
                            value="<?= $student['id']; ?>"><?= $student['surname'] . ' ' . $student['name']; ?></option>
                    <?php
                    endif ?>
                <?php
                endforeach ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="grade" class="form-label">Имя</label>
            <input type="number" class="form-control" id="grade" name="grade" required maxlength="16"
                   value="<?= $data['grade']; ?>">
        </div>
        <button type="submit" class="btn btn-primary btn-confirm">Подтвердить</button>
    </form>
</div>