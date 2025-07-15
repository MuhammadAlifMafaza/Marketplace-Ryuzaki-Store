<?= $this->include('employers/layout/header') ?>
<?= $this->include('employers/layout/sidebar') ?>
<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
        <?= $this->include('employers/layout/topbar') ?>
        <div class="container-fluid">
            <h1 class="h3 mb-4 text-gray-800">Add New Product</h1>

            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
            <?php endif; ?>

            <form action="<?= base_url('karyawan/admin/products/store-product') ?>" method="post" enctype="multipart/form-data">
                <div class="row">
                    <!-- LEFT COLUMN: PRODUCT FORM -->
                    <div class="col-lg-8">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Product Details</h6>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="id_product">Product ID</label>
                                    <input type="text" class="form-control" name="id_product" id="id_product" value="<?= old('id_product') ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="product_name">Product Name</label>
                                    <input type="text" class="form-control" name="product_name" id="product_name" required>
                                </div>
                                <div class="form-group">
                                    <label for="id_master_category">Category</label>
                                    <select class="form-control" name="id_master_category" required>
                                        <option value="">-- Select Category --</option>
                                        <?php foreach ($masterCategories as $cat): ?>
                                            <option value="<?= $cat['id_master_category'] ?>"><?= esc($cat['name_category']) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea class="form-control" name="description" rows="3" style="resize: none; overflow-y: auto;"></textarea>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="price">Price</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Rp</span>
                                            </div>
                                            <input type="number" class="form-control" name="price" step="0.01" required>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="stock_quantity">Stock Quantity</label>
                                        <input type="number" class="form-control" name="stock_quantity" required>
                                    </div>
                                </div>
                                <!-- <input type="hidden" name="image_order" id="image_order"> -->
                                <button type="submit" class="btn btn-primary btn-block mt-3">Save Product</button>
                            </div>
                        </div>
                    </div>

                    <!-- RIGHT COLUMN: IMAGE PREVIEW & MANAGER -->
                    <div class="col-lg-4">
                        <!-- HERO PREVIEW -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Image Preview</h6>
                            </div>
                            <div class="card-body text-center">
                                <img id="heroPreview" class="img-fluid border rounded" style="max-height: 300px; object-fit: contain; width: 100%;" src="">
                            </div>
                        </div>

                        <!-- IMAGE MANAGER -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Manage Uploaded Images</h6>
                            </div>
                            <div class="card-body">
                                <div class="d-flex flex-wrap gap-2" id="imageManager">
                                    <!-- Thumbnail Preview akan dirender di sini lewat JS -->
                                </div>
                                <label class="border rounded d-flex justify-content-center align-items-center mt-2"
                                    style="width:100px;height:100px;cursor:pointer;border-style:dashed;position:relative;">
                                    <span style="font-size:2rem;">+</span>
                                    <input type="file" name="images[]" id="imageUpload"
                                        accept="image/*"
                                        multiple
                                        required
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
    const imageInput = document.getElementById('imageUpload');
    const heroPreview = document.getElementById('heroPreview');
    const imageManager = document.getElementById('imageManager');

    const productNameInput = document.getElementById('product_name');
    const productIdInput = document.getElementById('id_product');

    // Auto-generate product ID as user types
    productNameInput.addEventListener('input', function() {
        let name = this.value;
        let slug = name.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/(^-|-$)/g, '');
        productIdInput.value = slug + '_xxxx'; // Placeholder, backend handles final suffix
    });
    
    let imageFiles = [];
    let slideIndex = 0;
    let slideTimer = null;

    imageInput.addEventListener('change', function() {
        const files = Array.from(this.files);
        imageFiles = files; // Simpan semua file asli untuk preview dan upload
        renderImagePreview();
    });

    function renderImagePreview() {
        imageManager.innerHTML = ''; // Bersihkan dulu semua thumbnail

        imageFiles.forEach((file, index) => {
            if (!file.type.startsWith('image/')) return;

            const reader = new FileReader();
            reader.onload = (e) => {
                const wrapper = document.createElement('div');
                wrapper.className = 'position-relative m-1 image-thumb';
                wrapper.style.width = '100px';
                wrapper.style.height = '100px';

                wrapper.innerHTML = `
                    <img src="${e.target.result}" class="img-thumbnail" style="width:100px;height:100px;object-fit:cover;">
                    <button type="button" class="btn btn-sm btn-danger position-absolute" style="top:2px;right:2px;">&times;</button>
                `;

                wrapper.querySelector('button').onclick = () => {
                    imageFiles.splice(index, 1);
                    renderImagePreview();
                };

                imageManager.appendChild(wrapper);

                if (index === 0) {
                    heroPreview.src = e.target.result;
                    slideIndex = 0;
                    startAutoSlide();
                }
            };
            reader.readAsDataURL(file);
        });
    }

    function startAutoSlide() {
        clearInterval(slideTimer);
        if (imageFiles.length > 1) {
            slideTimer = setInterval(() => {
                slideIndex = (slideIndex + 1) % imageFiles.length;
                const file = imageFiles[slideIndex];
                const reader = new FileReader();
                reader.onload = (e) => {
                    heroPreview.src = e.target.result;
                };
                reader.readAsDataURL(file);
            }, 3000);
        }
    }
</script>