<div class="container">
    
    <h2>Client information</h2>

    <div class="d-flex align-items-center mb-3" style="max-width: 400px;">
        <label for="username" class="form-label me-2" style="width: 120px;">Name: </label>
        <input type="text" id="username" value="<?= $user->username; ?>" class="form-control" disabled>
    </div>

    <div class="d-flex align-items-center mb-3" style="max-width: 400px;">
        <label for="email" class="form-label me-2" style="width: 120px;">Email: </label>
        <input type="text" id="email" value="<?= $user->email; ?>" class="form-control" disabled>
    </div>

    <hr>

    <?php if (!empty($user['booking_list'])): ?>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Prefecture</th>
                    <th scope="col">Hotel</th>
                    <th scope="col">Checkin Time</th>
                    <th scope="col">Checkout Time</th>
                    <th scope="col">Created at</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($user['booking_list'] as $booking): ?>
                    <tr>
                        <th scope="row">1</th>
                        <td>
                            <?= htmlspecialchars($booking->hotel->prefecture->name_jp); ?>
                            (<?= htmlspecialchars($booking->hotel->prefecture->name_en); ?>)
                        </td>
                        <td><?= htmlspecialchars($booking->hotel->name); ?></td>
                        <td><?= htmlspecialchars($booking->checkin_time); ?></td>
                        <td><?= htmlspecialchars($booking->checkout_time); ?></td>
                        <td><?= htmlspecialchars($booking->created_at); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <h2>No bookings found.</h2>
    <?php endif; ?>
</div>