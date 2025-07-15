<?= $this->include('employers/layout/header') ?>
<?= $this->include('employers/layout/sidebar') ?>
<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
        <?= $this->include('employers/layout/topbar') ?>

        <div class="container-fluid">
            <h1 class="h3 mb-4 text-gray-800">List Categories</h1>
            <a href="<?= base_url('karyawan/admin/categories/create') ?>" class="btn btn-primary mb-3">+ Tambah Kategori</a>

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Daftar Kategori & Subkategori</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead class="thead-light">
                                <tr>
                                    <th style="width: 5%;">No</th>
                                    <th style="width: 35%;">Nama Kategori / Subkategori</th>
                                    <th style="width: 35%;">Deskripsi / Tipe</th>
                                    <th style="width: 25%;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($masterCategories as $cat): ?>
                                    <!-- Kategori Utama -->
                                    <tr class="bg-white font-weight-bold toggle-row" data-toggle="collapse" data-target=".sub-<?= $cat['id_master_category'] ?>" style="cursor: pointer;">
                                        <td><?= $no++ ?></td>
                                        <td><i class="text-secondary mr-2">▸</i> <?= esc($cat['name_category']) ?></td>
                                        <td><?= esc($cat['description']) ?></td>
                                        <td>
                                            <a href="<?= base_url('karyawan/admin/categories/edit/' . $cat['id_master_category']) ?>" class="btn btn-sm btn-warning">Edit</a>
                                            <a href="<?= base_url('karyawan/admin/categories/delete/' . $cat['id_master_category']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus kategori ini?')">Hapus</a>
                                            <a href="<?= base_url('karyawan/admin/categories/subcategories/create/' . $cat['id_master_category']) ?>" class="btn btn-sm btn-info">+ Sub</a>
                                        </td>
                                    </tr>

                                    <?php
                                    $hasSub = false;
                                    foreach ($subCategories as $sub):
                                        if ($sub['id_master_category'] === $cat['id_master_category']):
                                            $hasSub = true;
                                    ?>
                                            <!-- Subkategori (tersembunyi default) -->
                                            <tr class="collapse sub-<?= $cat['id_master_category'] ?> bg-light">
                                                <td></td>
                                                <td>↳ <?= esc($sub['name_sub_category']) ?></td>
                                                <td><?= esc($sub['type']) ?></td>
                                                <td>
                                                    <a href="<?= base_url('karyawan/admin/categories/subcategories/edit/' . $sub['id_sub_category']) ?>" class="btn btn-sm btn-warning">Edit</a>
                                                    <a href="<?= base_url('karyawan/admin/categories/subcategories/delete/' . $sub['id_sub_category']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus subkategori ini?')">Hapus</a>
                                                </td>
                                            </tr>
                                    <?php endif;
                                    endforeach; ?>

                                    <?php if (!$hasSub): ?>
                                        <tr class="collapse sub-<?= $cat['id_master_category'] ?> bg-light text-muted">
                                            <td></td>
                                            <td>↳ Tidak ada subkategori</td>
                                            <td colspan="2"></td>
                                        </tr>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
</div>

<?= $this->include('employers/layout/footer') ?>

