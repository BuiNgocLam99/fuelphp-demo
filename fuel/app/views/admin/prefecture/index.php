<div class="d-flex justify-content-between w-100">
    <h1>Prefectures</h1>
    <div class="d-flex">
        <div class="dropdown">
            <a class="btn btn-dark dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="bi bi-filter"></i> Filter
            </a>

            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                <a class="dropdown-item" onclick="buildQueryString('filter', 'newest')">Newest</a>
                <a class="dropdown-item" onclick="buildQueryString('filter', 'oldest')">Oldest</a>
            </div>
        </div>

        <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3 px-2" method="GET" action="/admin/prefecture">
            <input type="search" name="search" class="form-control" placeholder="Search..." aria-label="Search" value="<?= isset($search) ? htmlspecialchars($search) : ''; ?>">
        </form>
    </div>
    <a href="/admin/prefecture/create"><button class="btn btn-dark">Add prefecture</button></a>
</div>

<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">ID</th>
            <th scope="col">Japanese name</th>
            <th scope="col">English name</th>
            <th scope="col">Hotels</th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
        <?php
        $start = Pagination::instance('pagination')->offset + 1;

        foreach ($prefectures as $item): ?>
            <tr>
                <td><?= $start++; ?></td>
                <td><?= $item->id; ?></td>
                <td><?= $item->name_jp; ?></td>
                <td><?= $item->name_en; ?></td>
                <td><?= count($item->hotels); ?></td>
                <td class="text-center">
                    <a href="/admin/prefecture/edit/<?= $item->id; ?>"><button class="btn btn-dark">Edit</button></a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?= Pagination::instance('pagination')->render(); ?>

<script>
    function buildQueryString(param = '', value) {
        const currentUrl = window.location.pathname;
        const urlParams = new URLSearchParams(window.location.search);
        
        urlParams.set(param, value);

        const newUrl = currentUrl + '?' + urlParams.toString();

        window.location.href = newUrl;
    }
</script>