<div class="d-flex justify-content-between w-100">
    <h1>Hotels</h1>
    <div class="dropdown">
        <a class="btn btn-dark dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="bi bi-filter"></i> Filter
        </a>

        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
            <a class="dropdown-item" href="/admin/hotel">Newest</a>
            <a class="dropdown-item" href="/admin/hotel?filter=oldest">Oldest</a>
        </div>
    </div>
    <a href="/admin/hotel/create"><button class="btn btn-dark">Add hotel</button></a>
</div>

<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">ID</th>
            <th scope="col">Prefecture</th>
            <th scope="col">Name</th>
            <th scope="col">Number of rooms booked</th>
            <th scope="col"></th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
    <?php
        $start = Pagination::instance('pagination')->offset + 1;
        
        foreach ($hotels as $item): ?>
            <tr>
                <td><?= $start++; ?></td>
                <td><?= $item->id; ?></td>
                <td><?= isset($item->prefecture->name_jp) ? $item->prefecture->name_jp : ''; ?></td>
                <td><?= $item->name; ?></td>
                <td><?= count($item->booking_list); ?></td>
                <td><?= Asset::img($item->file_path, ['height' => '150px']); ?></td>
                <td class="text-center">
                    <a href="/admin/hotel/edit/<?= $item->id; ?>"><button class="btn btn-dark">Edit</button></a>
                    <button class="btn btn-dark" onclick="showRemoveModal(<?= $item->id; ?>)">Remove</button>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?= Pagination::instance('pagination')->render(); ?>