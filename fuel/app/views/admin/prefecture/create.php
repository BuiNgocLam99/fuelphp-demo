<div class="d-flex justify-content-between w-100">
    <h1>Create prefecture</h1>
    <a href="/admin/prefecture">
        <button class="btn btn-dark">Back</button>
    </a>
</div>

<hr class="w-100">

<div>
    <?php echo Form::open(); ?>

    <div class="form-group">
        <?php echo Form::label('Japanese name', 'name_jp'); ?>
        <?php echo Form::input('name_jp', Input::post('name_jp', ''), ['class' => 'form-control', 'placeholder' => 'Japanese name', 'required' => 'required']); ?>
        <?php if (!empty($errors) && isset($errors['name_jp'])): ?>
            <div class="text-danger">
                <?php echo $errors['name_jp']; ?>
            </div>
        <?php endif; ?>
    </div><br>

    <div class="form-group">
        <?php echo Form::label('English name', 'name_en'); ?>
        <?php echo Form::input('name_en', Input::post('name_en', ''), ['class' => 'form-control', 'placeholder' => 'English name', 'required' => 'required']); ?>
        <?php if (!empty($errors) && isset($errors['name_en'])): ?>
            <div class="text-danger">
                <?php echo $errors['name_en']; ?>
            </div>
        <?php endif; ?>
    </div><br>

    <?php echo Form::submit('submit', 'Create', ['class' => 'btn btn-secondary']); ?>

    <?php echo Form::close(); ?><br>

    <?php if (Session::get_flash('success')): ?>
        <div class="alert alert-success">
            <?php echo Session::get_flash('success'); ?>
        </div>
    <?php endif; ?>

    <?php if (Session::get_flash('error')): ?>
        <div class="alert alert-danger">
            <?php echo Session::get_flash('error'); ?>
        </div>
    <?php endif; ?>
</div>