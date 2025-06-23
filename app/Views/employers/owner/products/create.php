<?= $this->include('admin/layout/header') ?>
<?= $this->include('admin/layout/sidebar') ?>
<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
        <?= $this->include('admin/layout/topbar') ?>
        <div class="container-fluid">
            <h1 class="h3 mb-2 text-gray-800">Add New Product</h1>
            <form action="<?= base_url('/admin/store-product')?>" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="product_name">Product Name</label>
                    <input type="text" class="form-control" name="product_name" required>
                </div>
                <div class="form-group">
                    <label for="category">Category</label>
                    <select class="form-control" name="category" required>
                        <option value="Atasan Pria">Atasan Pria</option>
                        <option value="Atasan Wanita">Atasan Wanita</option>
                        <option value="Bawahan Pria">Bawahan Pria</option>
                        <option value="Bawahan Wanita">Bawahan Wanita</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="tags">Tags</label>
                    <input type="text" class="form-control" name="tags">
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" name="description"></textarea>
                </div>
                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="number" class="form-control" name="price" step="0.01" required>
                </div>
                <div class="form-group">
                    <label for="stock_quantity">Stock Quantity</label>
                    <input type="number" class="form-control" name="stock_quantity" required>
                </div>
                <div class="form-group">
                    <label for="images">Upload Images</label>
                    <input type="file" class="form-control" name="images[]" multiple>
                </div>
                <button type="submit" class="btn btn-primary">Save Product</button>
            </form>
        </div>
    </div>
    <?= $this->include('admin/layout/footer') ?>
</div>