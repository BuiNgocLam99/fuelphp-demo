<div class="row">
    <!-- Sidebar -->
    <div class="col-md-3 bg-light p-3">
        <ul class="list-unstyled ps-0">
            <?php foreach ($prefectures as $prefecture): ?>
                <li class="mb-1">
                    <a href="/prefecture/<?= $prefecture->id ?>">
                        <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#home-collapse" aria-expanded="true">
                            <?= $prefecture->name_jp ?> (<?= $prefecture->name_en ?>)
                        </button>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>

    <!-- Content -->
    <div class="col-md-9">
        <div>
            <div class="d-flex">
                <div>
                    <?= Asset::img($hotel->file_path, ['alt' => 'Thumbnail', 'class' => 'img-fluid']); ?>
                </div>

                <div>
                    <h2><?= $hotel->name ?></h2>

                    <div class="d-flex justify-content-between">
                        <a href="/prefecture/<?= $prefecture->id ?>">
                            <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#home-collapse" aria-expanded="true">
                                <?= $prefecture->name_jp ?> (<?= $prefecture->name_en ?>)
                            </button>
                        </a>

                        <?php if (Auth::check()) { ?>
                            <button type="button" class="btn btn-sm btn-success" id="booking-btn">Booking</button>
                        <?php } else { ?>
                            <a href="/auth/login?prefecture=<?= $hotel->prefecture->id ?>&hotel=<?= $hotel->id ?>">
                                <button type="button" class="btn btn-sm btn-success">Booking</button>
                            </a>
                        <?php } ?>
                    </div>

                    <div class="p-2">
                        <div class="mb-3">
                            <label for="datetime_from" class="form-label">From</label>
                            <input type="datetime-local" class="form-control" id="datetime_from" name="datetime_from">
                        </div>

                        <div class="mb-3">
                            <label for="datetime_to" class="form-label">To</label>
                            <input type="datetime-local" class="form-control" id="datetime_to" name="datetime_to">
                        </div>

                        <span id="booking-message"></span>
                    </div>
                </div>
            </div>

            <p>The Lorem ipsum text is derived from sections 1.10.32 and 1.10.33 of Cicero's De finibus bonorum et malorum.[6][7] The physical source may have been the 1914 Loeb Classical Library edition of De finibus, where the Latin text, presented on the left-hand (even) pages, breaks off on page 34 with "Neque porro quisquam est qui do-" and continues on page 36 with "lorem ipsum ...", suggesting that the galley type of that page was mixed up to make the dummy text seen today.[1]

                The discovery of the text's origin is attributed to Richard McClintock, a Latin scholar at Hampden–Sydney College. McClintock connected Lorem ipsum to Cicero's writing sometime before 1982 while searching for instances of the Latin word consectetur, which was rarely used in classical literature.[2] McClintock first published his discovery in a 1994 letter to the editor of Before & After magazine,[8] contesting the editor's earlier claim that Lorem ipsum held no meaning.[2]

                The relevant section of Cicero as printed in the source is reproduced below with fragments used in Lorem ipsum highlighted. Letters in brackets were added to Lorem ipsum and were not present in the source text</p>

            <p>
                Sed ut perspiciatis, unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam eaque ipsa, quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt, explicabo. Nemo enim ipsam voluptatem, quia voluptas sit, aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos, qui ratione voluptatem sequi nesciunt, neque porro quisquam est, qui dolorem ipsum, quia dolor sit amet consectetur adipisci[ng] velit, sed quia non numquam [do] eius modi tempora inci[di]dunt, ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum[d] exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? [D]Quis autem vel eum i[r]ure reprehenderit, qui in ea voluptate velit esse, quam nihil molestiae consequatur, vel illum, qui dolorem eum fugiat, quo voluptas nulla pariatur?

                [33] At vero eos et accusamus et iusto odio dignissimos ducimus, qui blanditiis praesentium voluptatum deleniti atque corrupti, quos dolores et quas molestias excepturi sint, obcaecati cupiditate non provident, similique sunt in culpa, qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem reru[d]um facilis est e[r]t expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio, cumque nihil impedit, quo minus id, quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellend[a]us. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet, ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.
            </p>
        </div>

        <hr>

        <div class="album p-3 bg-light">
            <div class="container">
                <h2>Related Hotels in <?= $hotel->prefecture->name_jp ?> (<?= $hotel->prefecture->name_en ?>)</h2>
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-4">
                    <?php if (!empty($related_hotels)): ?>
                        <?php foreach ($related_hotels as $hotel): ?>
                            <div class="col">
                                <div class="card shadow-sm">
                                    <a href="/prefecture/<?= $hotel->prefecture->id ?>/hotel/<?= $hotel->id ?>">
                                        <?= Asset::img($hotel->file_path, ['class' => 'card-img-top zoom-effect', 'alt' => 'Thumbnail']); ?>
                                    </a>
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <a href="" class="hotel-link"><?= $hotel->name ?></a>
                                            <div class="btn-group">
                                                <a href="/prefecture/<?= $hotel->prefecture->id ?>/hotel/<?= $hotel->id ?>" class="hotel-link">
                                                    <button type="button" class="btn btn-sm btn-outline-secondary">Booking</button>
                                                </a>
                                            </div>
                                        </div>
                                        <small class="text-muted">
                                            <?php if (!empty($hotel->prefecture)): ?>
                                                <?= $hotel->prefecture->name_jp ?> (<?= $hotel->prefecture->name_en ?>)
                                            <?php endif; ?>
                                        </small>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>No hotels were found.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('#booking-btn').click(function () {
            $('#booking-message').html('');

            const datetimeFrom = $('#datetime_from').val();
            const datetimeTo = $('#datetime_to').val();
            const hotelId = <?= $hotel->id ?>

            if (!datetimeFrom || !datetimeTo) {
                $('#booking-message').html('Please select both "From" and "To" datetime.').css('color', 'red');
                return;
            }

            if (new Date(datetimeFrom) >= new Date(datetimeTo)) {
                $('#booking-message').html('The "From" datetime must be earlier than the "To" datetime.').css('color', 'red');
                return;
            }

            $.ajax({
                url: '/client/booking',
                method: 'POST',
                data: {
                    datetime_from: datetimeFrom,
                    datetime_to: datetimeTo,
                    hotel_id: hotelId,
                },
                success: function (response) {
                    response = JSON.parse(response);
                    console.log(response);
                    if (response.status == 'success') {
                        $('#booking-message').html('Booking successful! <a href="/booking">Your booking list.</a>').css('color', 'green');
                    } else {
                        $('#booking-message').html('Booking failed');
                    }
                },
                error: function(xhr, status, error) {
                    if (xhr.responseText) {
                        $('#booking-message').html(JSON.parse(xhr.responseText).message);
                    } else {
                        $('#booking-message').html('An error occurred while processing your booking.');
                    }
                }
            });
        });
    });
</script>