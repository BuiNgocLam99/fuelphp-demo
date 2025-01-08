<div class="d-flex justify-content-between w-100">
    <h1>User</h1>
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
        <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3 px-2" method="GET" action="/admin/user">
            <input type="search" name="search" class="form-control" placeholder="Search..." aria-label="Search" value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
        </form>
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
                <td >
                    <a href="/admin/user/edit/<?= $item->id; ?>"><button class="btn btn-dark">Edit</button></a>
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
    let selectedUserId = null;

    function showChangeStatusModal(userId) {
        selectedUserId = userId;
        $('#changeStatusModal').modal('show');
    }

    $('#confirmRemoveButton').on('click', function() {
        if (!selectedUserId) {
            alert('No user selected.');
            return;
        }

        $.ajax({
            url: `/admin/user/status/${selectedUserId}`,
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