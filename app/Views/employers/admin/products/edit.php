<!-- SAMA SEPERTI CREATE -->
<?= $this->include('employers/layout/header') ?>
<?= $this->include('employers/layout/sidebar') ?>
<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
        <?= $this->include('employers/layout/topbar') ?>
        <div class="container-fluid">
            <h1 class="h3 mb-4 text-gray-800">Edit Product</h1>

            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
            <?php endif; ?>

            <form action="<?= base_url('karyawan/admin/products/update-product/' . $product['id_product']) ?>" method="post" enctype="multipart/form-data">
                <div class="row">
                    <!-- LEFT COLUMN -->
                    <div class="col-lg-8">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Product Details</h6>
                            </div>
                            <div class="card-body">
                                <input type="hidden" name="id_product" value="<?= esc($product['id_product']) ?>">

                                <div class="form-group">
                                    <label for="product_name">Product Name</label>
                                    <input type="text" class="form-control" name="product_name" value="<?= esc($product['product_name']) ?>" required>
                                </div>

                                <div class="form-group">
                                    <label for="id_master_category">Category</label>
                                    <select class="form-control" name="id_master_category" required>
                                        <option value="">-- Select Category --</option>
                                        <?php foreach ($masterCategories as $cat): ?>
                                            <option value="<?= $cat['id_master_category'] ?>" <?= $product['id_master_category'] == $cat['id_master_category'] ? 'selected' : '' ?>>
                                                <?= esc($cat['name_category']) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea class="form-control" name="description" rows="3"><?= esc($product['description']) ?></textarea>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="price">Price</label>
                                        <input type="number" class="form-control" name="price" step="0.01" value="<?= $product['price'] ?>" required>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="stock_quantity">Stock Quantity</label>
                                        <input type="number" class="form-control" name="stock_quantity" value="<?= $product['stock_quantity'] ?>" required>
                                    </div>
                                </div>

                                <!-- Hidden input to store sorted image order -->
                                <input type="hidden" name="image_order" id="image_order">

                                <button type="submit" class="btn btn-primary btn-block mt-3">Update Product</button>
                            </div>
                        </div>
                    </div>

                    <!-- RIGHT COLUMN -->
                    <div class="col-lg-4">
                        <!-- IMAGE PREVIEW -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Image Preview</h6>
                            </div>
                            <div class="card-body text-center">
                                <img id="heroPreview" class="img-fluid border rounded" style="max-height: 300px; object-fit: contain; width: 100%;" src="<?= explode(',', $product['image'])[0] ?? '' ?>">
                            </div>
                        </div>

                        <!-- DRAG & DROP IMAGE MANAGER -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Manage Uploaded Images</h6>
                            </div>
                            <div class="card-body">
                                <div class="d-flex flex-wrap gap-2" id="imageManager">
                                    <?php
                                    $images = explode(',', $product['image']);
                                    foreach ($images as $imgPath): ?>
                                        <div class="image-thumb position-relative m-1" style="width:100px;height:100px;cursor:grab;" draggable="true" data-path="<?= $imgPath ?>">
                                            <img src="<?= base_url($imgPath) ?>" class="img-thumbnail" style="width:100px;height:100px;object-fit:cover;">
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                                <label class="border rounded d-flex justify-content-center align-items-center mt-2"
                                    style="width:100px;height:100px;cursor:pointer;border-style:dashed;position:relative;">
                                    <span style="font-size:2rem;">+</span>
                                    <input type="file" name="images[]" id="imageUpload"
                                        accept="image/*" multiple
                                        style="position:absolute;width:100%;height:100%;opacity:0;cursor:pointer;top:0;left:0;">
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <?= $this->include('employers/layout/footer') ?>
</div>
<!-- SCRIPT -->
<script>
    const imageManager = document.getElementById('imageManager');
    const imageOrderInput = document.getElementById('image_order');

    let dragged = null;

    imageManager.addEventListener('dragstart', e => {
        if (e.target.classList.contains('image-thumb')) {
            dragged = e.target;
        }
    });

    imageManager.addEventListener('dragover', e => {
        e.preventDefault();
        const target = e.target.closest('.image-thumb');
        if (target && target !== dragged) {
            imageManager.insertBefore(dragged, target);
        }
    });

    imageManager.addEventListener('drop', () => {
        updateImageOrder();
    });

    function updateImageOrder() {
        const thumbs = document.querySelectorAll('.image-thumb');
        const paths = Array.from(thumbs).map(el => el.dataset.path);
        imageOrderInput.value = paths.join(',');
    }

    // Inisialisasi urutan awal
    updateImageOrder();
</script>