<?= $this->include('employers/layout/header') ?>
<?= $this->include('employers/layout/sidebar') ?>
<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
        <?= $this->include('employers/layout/topbar') ?>

        <div class="container-fluid">
            <h1 class="h3 mb-4 text-gray-800">Tambah Subkategori untuk: <?= esc($master['name_category']) ?></h1>

            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
            <?php endif; ?>

            <form action="<?= base_url('karyawan/admin/categories/subcategories/store') ?>" method="post">
                <!-- Readonly ID (will be filled by JS) -->
                <div class="form-group">
                    <label for="id_sub_category">ID Subkategori</label>
                    <input type="text" class="form-control" name="id_sub_category" id="id_sub_category" readonly required>
                </div>

                <div class="form-group">
                    <label for="id_master_category">ID Kategori Utama</label>
                    <input type="text" class="form-control" name="id_master_category" value="<?= esc($master['id_master_category']) ?>" readonly>
                </div>

                <div class="form-group">
                    <label for="name_sub_category">Nama Subkategori</label>
                    <input type="text" class="form-control" name="name_sub_category" id="name_sub_category" required>
                </div>

                <div class="form-group">
                    <label for="type">Tipe Subkategori</label>
                    <select class="form-control" name="type" required>
                        <option value="Color">Color</option>
                        <option value="Size">Size</option>
                        <option value="Type">Type</option>
                        <option value="Category">Category</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="<?= base_url('admin/categories/') ?>" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>
</div>
<?= $this->include('employers/layout/footer') ?>

<script>
    // Auto-generate ID saat ketik nama
    document.getElementById('name_sub_category').addEventListener('input', function() {
        let name = this.value.trim().toLowerCase();
        let slug = name.replace(/[^a-z0-9]+/g, '-').replace(/(^-|-$)/g, '');
        document.getElementById('id_sub_category').value = slug + '-xxx'; // dummy preview, final di-backend
    });
</script>