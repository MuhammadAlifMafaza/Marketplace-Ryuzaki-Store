<?= $this->include('employers/layout/header') ?>
<?= $this->include('employers/layout/sidebar_admin') ?>
<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
        <?= $this->include('employers/layout/topbar') ?>
        <!-- Begin Page Content -->
        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-4 text-gray-800">Subkategori dari: <?= esc($master['name_category']) ?></h1>
            <a href="<?= base_url('categories/subcategories/create/' . $master['id_master_category']) ?>" class="btn btn-primary mb-3">+ Tambah Subkategori</a>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nama Subkategori</th>
                        <th>Tipe</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($subCategories as $sub): ?>
                        <tr>
                            <td><?= esc($sub['name_sub_category']) ?></td>
                            <td><?= esc($sub['type']) ?></td>
                            <td>
                                <a href="<?= base_url('categories/subcategories/edit/' . $sub['id_sub_category']) ?>" class="btn btn-sm btn-warning">Edit</a>
                                <a href="<?= base_url('categories/subcategories/delete/' . $sub['id_sub_category']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus subkategori ini?')">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <!-- /.container-fluid -->
    </div>
</div>

</div>
<?= $this->include('employers/layout/footer') ?>