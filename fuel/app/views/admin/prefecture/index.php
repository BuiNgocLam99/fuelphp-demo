<div class="d-flex justify-content-between w-100">
    <h1>Prefectures</h1>
    <div class="dropdown">
        <a class="btn btn-dark dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="bi bi-filter"></i> Filter
        </a>

        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
            <a class="dropdown-item" href="/admin/prefecture">Newest</a>
            <a class="dropdown-item" href="/admin/prefecture?filter=oldest">Oldest</a>
        </div>
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
                <td class="text-center">
                    <a href="/admin/prefecture/edit/<?= $item->id; ?>"><button class="btn btn-dark">Edit</button></a>
                    <button class="btn btn-dark" onclick="showRemoveModal(<?= $item->id; ?>)">Remove</button>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?= Pagination::instance('pagination')->render(); ?>

<!-- Modal Popup -->
<div class="modal fade" id="removeRelationModal" tabindex="-1" role="dialog" aria-labelledby="removeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="removeModalLabel">Remove Prefecture and Hotels</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Select hotels to remove along with the prefecture:</p>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th><input type="checkbox" id="selectAllHotels"></th>
                            <th>Hotel ID</th>
                            <th>Hotel Name</th>
                        </tr>
                    </thead>
                    <tbody id="relationTableBody"></tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger" id="confirmRemoveButton">Remove</button>
            </div>
        </div>
    </div>
</div>

<script>
    let selectedPrefectureId = null;

    function showRemoveModal(prefectureId) {
        selectedPrefectureId = prefectureId;

        $.get(`/admin/hotel/hotels/${prefectureId}`, function(data) {
            const hotels = Object.values(data.hotels);

            const tbody = $('#relationTableBody');
            tbody.empty();

            hotels.forEach(hotel => {
                const row = `
                    <tr>
                        <td><input type="checkbox" class="hotel-checkbox" value="${hotel.id}"></td>
                        <td>${hotel.id}</td>
                        <td>${hotel.name}</td>
                    </tr>
                `;
                tbody.append(row);
            });

            $('#removeRelationModal').modal('show');
        });

    }

    $('#selectAllHotels').on('change', function() {
        $('.hotel-checkbox').prop('checked', this.checked);
    });

    $('#confirmRemoveButton').on('click', function() {
        const selectedHotels = $('.hotel-checkbox:checked').map(function() {
            return $(this).val();
        }).get();

        $.ajax({
            url: `/admin/prefecture/delete/${selectedPrefectureId}`,
            method: 'POST',
            data: {
                hotels: selectedHotels
            },
            success: function() {
                alert('Prefecture and selected hotels removed successfully!');
                $('#removeRelationModal').modal('hide');
                location.reload();
            },
            error: function() {
                alert('Error while removing prefecture or hotels.');
            }
        });
    });
</script>