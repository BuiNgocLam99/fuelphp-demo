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
        <?php echo Form::label('Username', 'username'); ?>
        <?php echo Form::input('username', Input::post('username', ''), ['class' => 'form-control', 'placeholder' => 'Username', 'required' => 'required']); ?>
        <?php if (!empty($errors) && isset($errors['username'])): ?>
            <div class="text-danger">
                <?php echo $errors['username']; ?>
            </div>
        <?php endif; ?>
    </div><br>

    <div class="form-group">
        <?php echo Form::label('Email', 'email'); ?>
        <?php echo Form::input('email', Input::post('email', ''), ['type' => 'email', 'class' => 'form-control', 'placeholder' => 'Email', 'required' => 'required']); ?>
        <?php if (!empty($errors) && isset($errors['email'])): ?>
            <div class="text-danger">
                <?php echo $errors['email']; ?>
            </div>
        <?php endif; ?>
    </div><br>

    <div class="form-group">
        <?php echo Form::label('Password', 'password'); ?>
        <div class="input-group">
            <?php echo Form::input('password', Input::post('password', ''), [
                'class' => 'form-control', 
                'id' => 'password-field',
                'placeholder' => 'Password', 
                'required' => 'required',
                'minlength' => '6',
                'type' => 'password'
            ]); ?>
            <button type="button" class="btn btn-outline-secondary" id="toggle-password">
                Show
            </button>
        </div>
        <?php if (!empty($errors) && isset($errors['password'])): ?>
            <div class="text-danger">
                <?php echo $errors['password']; ?>
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

<script>
    $(document).ready(function () {
        $('#toggle-password').on('click', function () {
            const passwordField = $('#password-field');
            const fieldType = passwordField.attr('type');

            if (fieldType === 'password') {
                passwordField.attr('type', 'text');
                $(this).text('Hide');
            } else {
                passwordField.attr('type', 'password');
                $(this).text('Show');
            }
        });
    });
</script>