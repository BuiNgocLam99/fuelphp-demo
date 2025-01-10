<?php echo Form::open(['class' => 'form-signin']); ?>

<?php
    $query_string = $_SERVER['QUERY_STRING'];
    parse_str($query_string, $query_params);
    foreach ($query_params as $key => $value) {
        echo Form::hidden($key, $value);
    }
?>

<img class="mb-4" src="https://getbootstrap.com/docs/4.0/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">

<h1 class="h3 mb-3 font-weight-normal">Type your new password</h1>



<label for="password" class="sr-only">New Password</label>
<div class="input-group">
    <?php echo Form::input('password', Input::post('password', isset($password) ? $password : ''), [
        'class' => 'form-control',
        'id' => 'password-field',
        'placeholder' => 'Password',
        'required' => true,
        'autofocus' => true,
        'type' => 'password'
    ]); ?>
    <button type="button" class="btn btn-outline-secondary h-100" style="padding: 10px;" id="toggle-password" >
        Show
    </button>
</div>
<?php if (isset($errors['password'])): ?>
    <div class="text-danger">
        <?php echo $errors['password']; ?>
    </div>
<?php endif; ?>


<?php if (Session::get_flash('success')): ?>
    <div class="alert alert-success" role="alert">
        <?php echo Session::get_flash('success'); ?>
    </div>
<?php elseif (Session::get_flash('error')): ?>
    <div class="alert alert-danger" role="alert">
        <?php echo Session::get_flash('error'); ?>
    </div>
<?php endif; ?>

<br><button class="btn btn-lg btn-primary btn-block" type="submit">Change password</button>

<?php echo Form::close(); ?>

<script>
    $(document).ready(function() {
    $('#toggle-password').on('click', function() {
        const passwordField = $('#password-field');
        const fieldType = passwordField.attr('type'); // Lấy kiểu của input password

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