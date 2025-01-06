<h1>Danh sách Prefecture</h1>

<table border="1" cellpadding="10">
    <thead>
        <tr>
            <th>ID</th>
            <th>Tên</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($prefectures)): ?>
            <?php foreach ($prefectures as $item): ?>
                <tr>
                    <td><?= $item->id; ?></td>
                    <td><?= $item->name_en; ?></td>
                    <td>
                        <a href="<?= Uri::create('admin/prefecture/edit/' . $item->id); ?>">Sửa</a>
                        <a href="<?= Uri::create('admin/prefecture/delete/' . $item->id); ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa?');">Xóa</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="3">Không có dữ liệu</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<!-- Hiển thị phân trang -->
<div class="pagination">
    <?= !empty($pagination) ? $pagination : ''; ?>
</div>