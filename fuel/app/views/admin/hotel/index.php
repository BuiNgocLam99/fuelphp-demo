<div class="d-flex justify-content-between w-100">
    <h1>Hotels</h1>
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

        <div class="dropdown px-2">
            <a class="btn btn-dark dropdown-toggle" href="#" role="button" id="dropdownMenuLinkPrefectures" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="bi bi-filter"></i> Prefectures
            </a>

            <div class="dropdown-menu" aria-labelledby="dropdownMenuLinkPrefectures" style="max-height: 400px; overflow-y: auto; padding: 10px; width: auto; min-width: 500px;">
                <div class="row g-2">
                    <?php
                    $chunkedPrefectures = array_chunk($prefectures, 10);
                    foreach ($chunkedPrefectures as $chunk): ?>
                        <div class="col-6">
                            <?php foreach ($chunk as $item): ?>
                                <a class="dropdown-item" onclick="buildQueryString('prefecture', '<?= $item->id ?>')"><?= $item->name_jp ?> (<?= $item->name_en ?>)</a>
                            <?php endforeach; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3 px-2" method="GET" action="/admin/hotel">
            <input type="search" name="search" class="form-control" placeholder="Search..." aria-label="Search" value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
        </form>
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
                <td><?= (isset($item->booking_list) && count($item->booking_list) > 0) ? count($item->booking_list) : 0; ?></td>
                <td><?= Asset::img($item->file_path, ['height' => '150px']); ?></td>
                <td class="text-center">
                    <a href="/admin/hotel/edit/<?= $item->id; ?>"><button class="btn btn-dark">Edit</button></a>
                    <button class="btn <?= $item->status ? 'btn-success' : 'btn-danger'; ?>"
                        onclick="showChangeStatusModal(<?= $item->id; ?>)">
                        <?= $item->status ? 'Activating' : 'Inactivating'; ?>
                    </button>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?= Pagination::instance('pagination')->render(); ?>

<!-- Modal Popup -->
<div class="modal fade" id="changeStatusModal" tabindex="-1" role="dialog" aria-labelledby="removeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="removeModalLabel">Change status</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Do you want to change status?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger" id="confirmRemoveButton">Change</button>
            </div>
        </div>
    </div>
</div>

<script>
    let selectedHotelId = null;

    function showChangeStatusModal(hotelId) {
        selectedHotelId = hotelId;
        $('#changeStatusModal').modal('show');
    }

    $('#confirmRemoveButton').on('click', function() {
        if (!selectedHotelId) {
            alert('No hotel selected.');
            return;
        }

        $.ajax({
            url: `/admin/hotel/status/${selectedHotelId}`,
            method: 'POST',
            success: function(response) {
                if (response.status === 'success') {
                    alert(response.message);
                    $('#changeStatusModal').modal('hide');
                    location.reload();
                } else {
                    alert(response.message || 'Error while changing status.');
                }
            },
            error: function(xhr) {
                const response = xhr.responseJSON || {};
                alert(response.message || 'An unexpected error occurred.');
            }
        });
    });

    function buildQueryString(param = '', value) {
        const currentUrl = window.location.pathname;
        const urlParams = new URLSearchParams(window.location.search);
        
        urlParams.set(param, value);

        const newUrl = currentUrl + '?' + urlParams.toString();

        window.location.href = newUrl;
    }
</script>