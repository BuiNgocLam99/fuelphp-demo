<h1>Booking list</h1>

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