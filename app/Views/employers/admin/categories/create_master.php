<?= $this->include('employers/layout/header') ?>
<?= $this->include('employers/layout/sidebar_admin') ?>
<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
        <?= $this->include('employers/layout/topbar') ?>
        <!-- Begin Page Content -->
        <div class="container-fluid">
            <h1 class="h3 mb-4 text-gray-800">Tambah Kategori</h1>

            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
            <?php endif; ?>

            <form action="<?= base_url('admin/categories/store') ?>" method="post">

                <div class="form-group">
                    <label for="id_master_category">ID Kategori</label>
                    <input type="text" class="form-control" name="id_master_category" id="id_master_category" value="<?= old('id_master_category') ?>" readonly>
                </div>

                <div class="form-group">
                    <label for="name_category">Nama Kategori</label>
                    <input type="text" class="form-control" name="name_category" id="name_category" value="<?= old('name_category') ?>" required>
                </div>


                <div class="form-group">
                    <label for="description">Deskripsi</label>
                    <textarea class="form-control" name="description"><?= old('description') ?></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>

        <!-- Generate ID secara dinamis via JS saat nama diubah -->
        <script>
            document.getElementById('name_category').addEventListener('input', function() {
                let name = this.value;
                let slug = name.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/(^-|-$)/g, '');
                document.getElementById('id_master_category').value = slug + '-xxx'; // Placeholder, backend akan hitung angka
            });
        </script>
        <!-- /.container-fluid -->
    </div>
    <?= $this->include('employers/layout/footer') ?>
</div>