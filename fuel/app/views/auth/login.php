<?php echo Form::open(['class' => 'form-signin']); ?>

<?php
    $query_string = $_SERVER['QUERY_STRING'];
    parse_str($query_string, $query_params);
    foreach ($query_params as $key => $value) {
        echo Form::hidden($key, $value);
    }
?>

<img class="mb-4" src="https://getbootstrap.com/docs/4.0/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">

<h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>

<label for="email" class="sr-only">Email address</label>
<?php echo Form::input('email', Input::post('email', isset($email) ? $email : ''), [
    'class' => 'form-control' . (isset($errors['email']) ? ' is-invalid' : ''),
    'placeholder' => 'Email address',
    'required' => true,
    'autofocus' => true
]); ?>
<?php if (isset($errors['email'])): ?>
    <!-- <div class="invalid-feedback"> -->
        <?php echo $errors['email']; ?>
    <!-- </div> -->
<?php endif; ?>

<label for="password" class="sr-only">Password</label>
<?php echo Form::password('password', Input::post('password', isset($password) ? $password : ''), [
    'class' => 'form-control' . (isset($errors['password']) ? ' is-invalid' : ''),
    'placeholder' => 'Password',
    'required' => true
]); ?>
<?php if (isset($errors['password'])): ?>
    <!-- <div class="invalid-feedback"> -->
        <?php echo $errors['password']; ?>
    <!-- </div> -->
<?php endif; ?>

<?php if (isset($errors['login'])): ?>
    <!-- <div class="invalid-feedback"> -->
        <?php echo $errors['login']; ?>
    <!-- </div> -->
<?php endif; ?>

<div class="checkbox mb-3">
    <label>
        <?php echo Form::checkbox('remember-me', '1', Input::post('remember-me')); ?> Remember me
    </label>
</div>

<button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>

<button data-mdb-button-init data-mdb-ripple-init class="btn btn-lg btn-block btn-primary" style="background-color: #dd4b39;" type="submit">
    <i class="fab fa-google me-2"></i> Sign in with Google
</button>

<?php echo Form::close(); ?>