<!-- <form class="form-signin">
    <img class="mb-4" src="https://getbootstrap.com/docs/4.0/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
    
    <h1 class="h3 mb-3 font-weight-normal">Register</h1>
    
    <label for="name" class="sr-only">Name</label>
    <input type="text" id="name" class="form-control" placeholder="Name" required autofocus>

    <label for="email" class="sr-only">Email address</label>
    <input type="email" id="email" class="form-control" placeholder="Email address" required>

    <label for="password" class="sr-only">Password</label>
    <input type="password" id="password" class="form-control" placeholder="Password" required>

    <button class="btn btn-lg btn-primary btn-block" type="submit">Register</button>
</form> -->

<form class="form-signin">
    <img class="mb-4" src="https://getbootstrap.com/docs/4.0/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">

    <h1 class="h3 mb-3 font-weight-normal">Register</h1>

    <label for="name" class="sr-only">Name</label>
    <input type="text" name="username" id="name" class="form-control" placeholder="Name" autofocus>

    <label for="email" class="sr-only">Email address</label>
    <input type="text" name="email" id="email" class="form-control" placeholder="Email address">

    <label for="password" class="sr-only">Password</label>
    <input type="password" name="password" id="password" class="form-control" placeholder="Password">

    <button class="btn btn-lg btn-primary btn-block" type="submit">Register</button>
</form>

<script>
    $(document).ready(function() {
        $('.form-signin').on('submit', function(e) {
            e.preventDefault();

            var formData = {
                username: $('#name').val(),
                email: $('#email').val(),
                password: $('#password').val()
            };

            $.ajax({
                type: 'POST',
                url: '/auth/register',
                data: formData,
                success: function(response) {
                    alert('Đăng ký thành công!');
                },
                error: function() {
                    alert('Đã xảy ra lỗi. Vui lòng thử lại.');
                }
            });
        });

    });
</script>