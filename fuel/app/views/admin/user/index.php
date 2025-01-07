<h1>User</h1>

<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">ID</th>
            <th scope="col">Username</th>
            <th scope="col">Email</th>
            <th scope="col">Number of bookings</th>
            <th scope="col">Last login</th>
        </tr>
    </thead>
    <tbody>
    <?php 
        $start = Pagination::instance('pagination')->offset + 1;
        
        foreach ($users as $item): ?>
            <tr>
                <td><?= $start++; ?></td>
                <td><?= $item->id; ?></td>
                <td><?= $item->username; ?></td>
                <td><?= $item->email; ?></td>
                <td><?= count($item->booking_list); ?></td>
                <td><?= date('Y-m-d H:i', $item->last_login); ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?= Pagination::instance('pagination')->render(); ?>