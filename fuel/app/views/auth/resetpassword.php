<?php echo Form::open(['class' => 'form-signin']); ?>

<?php
    $query_string = $_SERVER['QUERY_STRING'];
    parse_str($query_string, $query_params);
    foreach ($query_params as $key => $value) {
        echo Form::hidden($key, $value);
    }
?>

<img class="mb-4" src="https://getbootstrap.com/docs/4.0/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">

<h1 class="h3 mb-3 font-weight-normal">Type your email</h1>

<?php if (Session::get_flash('success')): ?>
    <div class="alert alert-success" role="alert">
        <?php echo Session::get_flash('success'); ?>
    </div>
<?php elseif (Session::get_flash('error')): ?>
    <div class="alert alert-danger" role="alert">
        <?php echo Session::get_flash('error'); ?>
    </div>
<?php endif; ?>

<label for="email" class="sr-only">Email address</label>
<?php echo Form::input('email', Input::post('email', isset($email) ? $email : ''), [
    'class' => 'form-control' . (isset($errors['email']) ? ' is-invalid' : ''),
    'placeholder' => 'Email address',
    'required' => true,
    'autofocus' => true
]); ?><br>
<?php if (isset($errors['email'])): ?>
    <div class="text-danger">
        <?php echo $errors['email']; ?>
    </div>
<?php endif; ?>

<div class="checkbox mb-3">
    Already have a password?<a href="/auth/login">Login</a>
</div>

<button class="btn btn-lg btn-primary btn-block" type="submit">Reset password</button>



<?php echo Form::close(); ?>