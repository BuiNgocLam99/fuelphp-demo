<div class="d-flex justify-content-between w-100">
    <h1>Booking list</h1>
    <div class="d-flex">
        <div class="dropdown">
            <a class="btn btn-dark dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Filter
            </a>

            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                <a class="dropdown-item" onclick="buildQueryString('filter', 'newest')">Newest</a>
                <a class="dropdown-item" onclick="buildQueryString('filter', 'oldest')">Oldest</a>
            </div>
        </div>

        <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3 px-2" method="GET" action="/admin/booking">
            <input type="search" name="search" class="form-control" placeholder="Search..." aria-label="Search" value="<?= isset($search) ? htmlspecialchars($search) : ''; ?>">
        </form>
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
            <th scope="col">Status</th>
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
                <td>
                    <?php if ($item->status == 0) { ?>
                        <button class="btn btn-danger">Canceled</button>
                    <?php } else if ($item->status == 1) { ?>
                        <button class="btn btn-info">Pending</button>
                    <?php } else { ?>
                        <button class="btn btn-success">Booked</button>
                    <?php } ?>
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