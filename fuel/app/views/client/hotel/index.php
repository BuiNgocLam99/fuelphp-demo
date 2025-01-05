<div class="row">
    <!-- Sidebar -->
    <div class="col-md-3 bg-light p-3">
        <ul class="list-unstyled ps-0">
            <?php foreach ($prefectures as $prefecture): ?>
                <li class="mb-1">
                    <a href="/prefecture/<?= $prefecture->id ?>">
                        <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#home-collapse" aria-expanded="true">
                            <?= $prefecture->name_jp ?> (<?= $prefecture->name_en ?>)
                        </button>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>

    <!-- Content -->
    <div class="col-md-9">
        <div class="album p-3 bg-light">
            <div class="container">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                    <?php if (!empty($hotels)): ?>
                        <?php foreach ($hotels as $hotel): ?>
                            <div class="col">
                                <div class="card shadow-sm">
                                    <a href="/prefecture/<?= $hotel->prefecture->id ?>/hotel/<?= $hotel->id ?>">
                                        <?= Asset::img($hotel->file_path, ['class' => 'card-img-top zoom-effect', 'alt' => 'Thumbnail']); ?>
                                    </a>
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <a href="" class="hotel-link"><?= $hotel->name ?></a>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-sm btn-outline-secondary">Booking</button>
                                            </div>
                                        </div>
                                        <small class="text-muted">
                                            <?php if (!empty($hotel->prefecture)): ?>
                                                <?= $hotel->prefecture->name_jp ?> (<?= $hotel->prefecture->name_en ?>)
                                            <?php endif; ?>
                                        </small>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>No hotels were found.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>