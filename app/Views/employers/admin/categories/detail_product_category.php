<!-- Product Detail View -->
<?= $this->include('admin/layout/header') ?>
<?= $this->include('admin/layout/sidebar') ?>
<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
        <?= $this->include('admin/layout/topbar') ?>
        <div class="container-fluid">
            <h1 class="h3 mb-4 text-gray-800">Product Detail</h1>
            <div class="row">
                <!-- Gambar Produk -->
                <div class="col-md-6 mb-4">
                    <div id="productCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <?php $images = explode(',', $product['image']); ?>
                            <?php foreach ($images as $index => $imgPath): ?>
                                <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                                    <img src="<?= base_url($imgPath) ?>" class="d-block w-100 img-fluid rounded" alt="Product Image">
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#productCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
                <!-- Detail Produk -->
                <div class="col-md-6 mb-4">
                    <div class="card shadow-sm p-4">
                        <h4 class="mb-3">Product Information</h4>
                        <p><strong>Product Name:</strong> <?= $product['product_name'] ?></p>
                        <p><strong>Category:</strong> <?= $product['category'] ?></p>
                        <p><strong>Tags:</strong> <?= $product['tags'] ?></p>
                        <p><strong>Description:</strong> <?= $product['description'] ?></p>
                        <p><strong>Price:</strong> Rp <?= number_format($product['price'], 2) ?></p>
                        <p><strong>Stock Quantity:</strong> <?= $product['stock_quantity'] ?></p>
                        <div class="btn-group mt-3" role="group" aria-label="Product Action Buttons">
                            <a href="/admin/product-list/" class="btn btn-primary btn-sm me-2">Back to List</a>
                            <a href="/admin/update-product/<?= $product['id_product'] ?>" class="btn btn-warning btn-sm">Edit</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?= $this->include('admin/layout/footer') ?>
</div>
