<?= $this->include('employers/layout/header') ?>
<?= $this->include('employers/layout/sidebar_admin') ?>
<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
        <?= $this->include('employers/layout/topbar') ?>

        <div class="container-fluid">
            <h1 class="h3 mb-4 text-gray-800">Master Categories</h1>
            <a href="<?= base_url('admin/categories/create') ?>" class="btn btn-primary mb-3">+ Tambah Kategori</a>

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Daftar Kategori & Subkategori</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Kategori / Subkategori</th>
                                    <th>Deskripsi / Tipe</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($masterCategories as $cat): ?>
                                    <tr data-toggle="collapse" data-target="#sub-<?= $cat['id_master_category'] ?>" class="accordion-toggle">
                                        <td><?= $no++ ?></td>
                                        <td>
                                            <i class="fas fa-chevron-down text-secondary mr-2"></i>
                                            <?= esc($cat['name_category']) ?>
                                        </td>
                                        <td><?= esc($cat['description']) ?></td>
                                        <td>
                                            <a href="<?= base_url('admin/categories/edit/' . $cat['id_master_category']) ?>" class="btn btn-sm btn-warning">Edit</a>
                                            <a href="<?= base_url('admin/categories/delete/' . $cat['id_master_category']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')">Hapus</a>
                                            <a href="<?= base_url('admin/categories/subcategories/create/' . $cat['id_master_category']) ?>" class="btn btn-sm btn-info">+ Sub</a>
                                        </td>
                                    </tr>

                                    <tr class="collapse bg-light" id="sub-<?= $cat['id_master_category'] ?>">
                                        <td colspan="4">
                                            <ul class="list-unstyled mb-0">
                                                <?php
                                                $found = false;
                                                foreach ($subCategories as $sub):
                                                    if ($sub['id_master_category'] === $cat['id_master_category']):
                                                        $found = true;
                                                ?>
                                                        <li class="mb-2">
                                                            <strong>↳ <?= esc($sub['name_sub_category']) ?></strong>
                                                            <span class="text-muted ml-2">[<?= esc($sub['type']) ?>]</span>
                                                            <a href="<?= base_url('admin/categories/subcategories/edit/' . $sub['id_sub_category']) ?>" class="btn btn-sm btn-warning ml-2">Edit</a>
                                                            <a href="<?= base_url('admin/categories/subcategories/delete/' . $sub['id_sub_category']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus subkategori?')">Hapus</a>
                                                        </li>
                                                <?php endif;
                                                endforeach; ?>
                                                <?php if (!$found): ?>
                                                    <li class="text-muted">Tidak ada subkategori</li>
                                                <?php endif; ?>
                                            </ul>
                                        </td>
                                    </tr>
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