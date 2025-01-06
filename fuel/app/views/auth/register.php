<?php echo Form::open(['class' => 'form-signin']); ?>

<img class="mb-4" src="https://getbootstrap.com/docs/4.0/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">

<h1 class="h3 mb-3 font-weight-normal">Register</h1>

<label for="name" class="sr-only">Name</label>
<?php echo Form::input('username', Input::post('username', isset($username) ? $username : ''), [
    'class' => 'form-control' . (isset($errors['username']) ? ' is-invalid' : ''),
    'placeholder' => 'Name',
    'required' => true,
    'autofocus' => true
]); ?>
<?php if (isset($errors['username'])): ?>
    <div class="invalid-feedback">
        <?php echo $errors['username']; ?>
    </div>
<?php endif; ?>

<label for="email" class="sr-only">Email address</label>
<?php echo Form::input('email', Input::post('email', isset($email) ? $email : ''), [
    'class' => 'form-control' . (isset($errors['email']) ? ' is-invalid' : ''),
    'placeholder' => 'Email address',
    'required' => true
]); ?>
<?php if (isset($errors['email'])): ?>
    <div class="invalid-feedback">
        <?php echo $errors['email']; ?>
    </div>
<?php endif; ?>

<label for="password" class="sr-only">Password</label>
<?php echo Form::password('password', Input::post('password', isset($password) ? $password : ''), [
    'class' => 'form-control' . (isset($errors['password']) ? ' is-invalid' : ''),
    'placeholder' => 'Password',
    'required' => true
]); ?>
<?php if (isset($errors['password'])): ?>
    <div class="invalid-feedback">
        <?php echo $errors['password']; ?>
    </div>
<?php endif; ?>

<button class="btn btn-lg btn-primary btn-block" type="submit">Register</button>

<?php echo Form::close(); ?>