<div class="d-flex justify-content-between w-100">
    <h1>Booking list</h1>
    <div class="dropdown">
        <a class="btn btn-dark dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Filter
        </a>

        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
            <a class="dropdown-item" href="/admin/booking">Newest</a>
            <a class="dropdown-item" href="/admin/booking?filter=oldest">Oldest</a>
        </div>
    </div>
    <div class="w-25"></div>
</div>

<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">ID</th>
            <th scope="col">Customer name</th>
            <th scope="col">Customer contact</th>
            <th scope="col">Prefecture</th>
            <th scope="col">Hotel</th>
            <th scope="col">Checkin time</th>
            <th scope="col">Checkout time</th>
        </tr>
    </thead>
    <tbody>
    <?php 
        $start = Pagination::instance('pagination')->offset + 1;
        
        foreach ($booking_list as $item): ?>
            <tr>
                <td><?= $start++; ?></td>
                <td><?= $item->id; ?></td>
                <td><?= $item->user->username; ?></td>
                <td><?= $item->user->email; ?></td>
                <td><?= $item->hotel->prefecture->name_jp; ?> (<?= $item->hotel->prefecture->name_en; ?>)</td>
                <td><?= $item->hotel->name; ?></td>
                <td><?= $item->checkin_time; ?></td>
                <td><?= $item->checkout_time; ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?= Pagination::instance('pagination')->render(); ?>