<div class="d-flex justify-content-between w-100">
    <h1>User</h1>
    <div class="dropdown">
        <a class="btn btn-dark dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Filter
        </a>

        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
            <a class="dropdown-item" href="/admin/user">Newest</a>
            <a class="dropdown-item" href="/admin/user?filter=oldest">Oldest</a>
        </div>
    </div>
    <a href="/admin/user/create"><button class="btn btn-dark">Add user</button></a>
</div>

<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">ID</th>
            <th scope="col">Username</th>
            <th scope="col">Email</th>
            <th scope="col">Number of bookings</th>
            <th scope="col">Last login</th>
            <th scope="col"></th>
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
                <td><?= !empty($item->booking_list) ? count($item->booking_list) : 0 ?></td>
                <td><?= date('Y-m-d H:i', $item->last_login); ?></td>
                <td class="text-center">
                    <a href="/admin/user/edit/<?= $item->id; ?>"><button class="btn btn-dark">Edit</button></a>
                    <button class="btn btn-dark" onclick="showRemoveModal(<?= $item->id; ?>)">Remove</button>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?= Pagination::instance('pagination')->render(); ?>