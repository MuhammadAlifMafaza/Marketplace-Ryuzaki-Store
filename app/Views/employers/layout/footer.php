<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; Ryuzaki-Store 2024</span>
        </div>
    </div>
</footer>
<!-- End of Footer -->
</div>
<!-- End of Content Wrapper -->
</div>
<!-- End of Page Wrapper -->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="/admin/logout">Logout</a>
            </div>
        </div>
    </div>
</div>

<!-- Modal Delete -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus produk <strong id="modalProductName"></strong>?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <form action="" method="POST" id="deleteForm">
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- script modal delete data -->
<script>
    $('#deleteModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget); // Tombol yang memicu modal
        var productId = button.data('id'); // Ambil ID produk
        var productName = button.data('name'); // Ambil nama produk

        var modal = $(this);
        modal.find('#modalProductName').text(productName);
        modal.find('#deleteForm').attr('action', '/admin/delete-product/' + productId);
    });
</script>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url('template/sb-admin2/vendor/jquery/jquery.min.js') ?>"></script>
<script src="<?= base_url('template/sb-admin2/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
<script src="<?= base_url('template/sb-admin2/vendor/jquery-easing/jquery.easing.min.js') ?>"></script>
<script src="<?= base_url('template/sb-admin2/js/sb-admin-2.min.js') ?>"></script>
<script src="<?= base_url('template/sb-admin2/vendor/chart.js/Chart.min.js') ?>"></script>
<script src="<?= base_url('template/sb-admin2/js/demo/chart-area-demo.js') ?>"></script>
<script src="<?= base_url('template/sb-admin2/js/demo/chart-pie-demo.js') ?>"></script>
<!-- Page level plugins -->
<script src="<?= base_url('template/sb-admin2/vendor/datatables/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('template/sb-admin2/vendor/datatables/dataTables.bootstrap4.min.js') ?>"></script>

<!-- Page level custom scripts -->
<script src="<?= base_url('template/sb-admin2/js/demo/datatables-demo.js') ?>"></script>
</body>

</html>