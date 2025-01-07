<div class="d-flex justify-content-between w-100">
    <h1>Create hotel</h1>
    <a href="/admin/hotel">
        <button class="btn btn-dark">Back</button>
    </a>
</div>

<hr class="w-100">

<div>
    <?php echo Form::open(['enctype' => 'multipart/form-data']); ?>

    <div class="form-group">
        <?php echo Form::label('Hotel name', 'name'); ?>
        <?php echo Form::input('name', Input::post('name', ''), ['class' => 'form-control', 'placeholder' => 'Hotel name', 'required' => 'required']); ?>
        <?php if (!empty($errors) && isset($errors['name'])): ?>
            <div class="text-danger">
                <?php echo $errors['name']; ?>
            </div>
        <?php endif; ?>
    </div><br>

    <!-- Prefecture select box -->
    <div class="form-group">
        <?php echo Form::label('Prefecture', 'prefecture_id'); ?>
        <?php echo Form::select('prefecture_id', Input::post('prefecture_id', ''), array_merge(array_column($prefectures, 'name_jp', 'id')), ['class' => 'form-select', 'required' => 'required']); ?>
        <?php if (!empty($errors) && isset($errors['prefecture_id'])): ?>
            <div class="text-danger">
                <?php echo $errors['prefecture_id']; ?>
            </div>
        <?php endif; ?>
    </div><br>

    <!-- Image input and preview -->
    <div class="form-group">
        <?php echo Form::label('Hotel image', 'image'); ?>
        <?php echo Form::file('image', ['class' => 'form-control', 'id' => 'image', 'required' => 'required', 'accept' => 'image/jpeg,image/png,image/gif']); ?>
        <?php if (!empty($errors['image'])): ?>
            <div class="alert alert-danger">
                <?php echo $errors['image']; ?>
            </div>
        <?php endif; ?>
        <br>
        <img id="previewImage" src="#" alt="Preview" style="display: none; max-width: 200px; max-height: 200px;" />
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
    document.getElementById('image').addEventListener('change', function(event) {
        var reader = new FileReader();
        reader.onload = function() {
            var preview = document.getElementById('previewImage');
            preview.style.display = 'block';
            preview.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    });
</script>