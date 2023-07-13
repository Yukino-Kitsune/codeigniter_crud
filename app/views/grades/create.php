<div class="container student-form">
    <h2 class="text-center">Добавление оценки</h2>
    <form action="<?= site_url('/grades/store'); ?>" method="POST">
        <div>
            <label for="subject_id">Дисциплина</label>
            <select class="form-select" name="subject_id" id="subject_id" aria-label="Выберите дисциплину">
                <?php
                foreach ($subjects as $subject): ?>
                    <option value="<?= $subject['id']; ?>"><?= $subject['subject_name']; ?></option>
                <?php
                endforeach ?>
            </select>
        </div>
        <div>
            <label for="student_id">Студент</label>
            <select class="form-select" name="student_id" id="student_id" aria-label="Выберите студента">
                <?php
                foreach ($students as $student): ?>
                    <option value="<?= $student['id']; ?>"><?= $student['surname'].' '.$student['name']; ?></option>
                <?php
                endforeach ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="grade" class="form-label">Оценка</label>
            <input type="number" class="form-control" id="grade" name="grade" required maxlength="16">
        </div>
        <button type="submit" class="btn btn-primary btn-confirm">Подтвердить</button>
    </form>
</div>