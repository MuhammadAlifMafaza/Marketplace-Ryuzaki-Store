<?= $this->include('employers/layout/header') ?>
<?= $this->include('employers/layout/sidebar') ?>
<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
        <?= $this->include('employers/layout/topbar') ?>
        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h3 mb-2 text-gray-800">List Data Product</h1>
            <p class="mb-4">Ini merupakan yang ditujukan untuk memanipulasi data product
                <a target="_blank" href="#">official DataTables documentation</a>.
            </p>
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <a href="<?= base_url('karyawan/admin/products/create') ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                    <i class="fas fa-plus fa-sm text-white-50"></i> Add Product</a>
            </div>
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>ID Product</th>
                                    <th>Nama</th>
                                    <th>Category</th>
                                    <th>Price</th>
                                    <th>Stok</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($products as $product): ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $product['id_product'] ?></td>
                                        <td><?= $product['product_name'] ?></td>
                                        <td><?= $product['name_category'] ?? '-' ?></td>
                                        <td>Rp <?= number_format($product['price'], 2) ?></td>
                                        <td><?= $product['stock_quantity'] ?></td>
                                        <td>
                                            <a href="karyawan/admin/products/detail/<?= $product['id_product'] ?>" class="btn btn-info btn-sm">Detail</a>
                                            <a href="<?= base_url('karyawan/admin/products/edit/' . $product['id_product']) ?>" class="btn btn-warning btn-sm">Edit</a>
                                            <button type="button"
                                                class="btn btn-danger btn-sm"
                                                data-toggle="modal"
                                                data-target="#deleteModal"
                                                data-id="<?= $product['id_product'] ?>"
                                                data-name="<?= esc($product['product_name']) ?>">
                                                Delete
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.container-fluid -->
    </div>
    <?= $this->include('employers/layout/footer') ?>