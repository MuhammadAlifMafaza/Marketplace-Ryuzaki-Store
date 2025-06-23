<?= $this->include('employers/layout/header') ?>
<?= $this->include('employers/layout/sidebar_admin') ?>
<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
        <?= $this->include('employers/layout/topbar') ?>
        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h3 mb-4 text-gray-800">Master Categories</h1>
            <a href="<?= base_url('admin/categories/create') ?>" class="btn btn-primary mb-3">+ Tambah Kategori</a>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive"></div>
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Kategori</th>
                                <th>Deskripsi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($masterCategories as $cat): ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= esc($cat['name_category']) ?></td>
                                    <td><?= esc($cat['description']) ?></td>
                                    <td>
                                        <a href="<?= base_url('categories/edit/' . $cat['id_master_category']) ?>" class="btn btn-sm btn-warning">Edit</a>
                                        <a href="<?= base_url('categories/delete/' . $cat['id_master_category']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')">Hapus</a>
                                        <a href="<?= base_url('categories/subcategories/' . $cat['id_master_category']) ?>" class="btn btn-sm btn-info">Subkategori</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </div>
</div>

</div>
<?= $this->include('employers/layout/footer') ?>