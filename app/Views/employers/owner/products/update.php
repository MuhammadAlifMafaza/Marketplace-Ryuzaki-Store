<!-- Update Product View -->
<?= $this->include('admin/layout/header') ?>
<?= $this->include('admin/layout/sidebar') ?>
<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
        <?= $this->include('admin/layout/topbar') ?>
        <div class="container-fluid">
            <h1 class="h3 mb-2 text-gray-800">Edit Product</h1>
            <form action="/admin/update-product/<?= $product['id_product'] ?>" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="product_name">Product Name</label>
                    <input type="text" class="form-control" name="product_name" value="<?= $product['product_name'] ?>" required>
                </div>
                <div class="form-group">
                    <label for="category">Category</label>
                    <select class="form-control" name="category" required>
                        <option value="Atasan Pria" <?= $product['category'] == 'Atasan Pria' ? 'selected' : '' ?>>Atasan Pria</option>
                        <option value="Atasan Wanita" <?= $product['category'] == 'Atasan Wanita' ? 'selected' : '' ?>>Atasan Wanita</option>
                        <option value="Bawahan Pria" <?= $product['category'] == 'Bawahan Pria' ? 'selected' : '' ?>>Bawahan Pria</option>
                        <option value="Bawahan Wanita" <?= $product['category'] == 'Bawahan Wanita' ? 'selected' : '' ?>>Bawahan Wanita</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="tags">Tags</label>
                    <input type="text" class="form-control" name="tags" value="<?= $product['tags'] ?>">
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" name="description"><?= $product['description'] ?></textarea>
                </div>
                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="number" class="form-control" name="price" value="<?= $product['price'] ?>" step="0.01" required>
                </div>
                <div class="form-group">
                    <label for="stock_quantity">Stock Quantity</label>
                    <input type="number" class="form-control" name="stock_quantity" value="<?= $product['stock_quantity'] ?>" required>
                </div>
                <div class="form-group">
                    <label for="images">Upload New Images</label>
                    <input type="file" class="form-control" name="images[]" multiple>
                </div>
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </form>
        </div>
    </div>
    <?= $this->include('admin/layout/footer') ?>
</div>