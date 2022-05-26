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
                    <a class="btn btn-primary" href="<?=base_url()."index.php/"?>Admin/logout">Logout</a>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- End of Main Content -->
<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; <?=APPNAME?> <?=date('Y')?></span>
        </div>
    </div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<script
    src="<?= base_url('assets/js/bootstrap/bootstrap.bundle.min.js')?>">
</script>

<!-- Core plugin JavaScript-->
<script
    src="<?= base_url('assets/js/jquery-easing/jquery.easing.min.js')?>">
</script>


<!-- Custom scripts for all pages-->
<script src="<?= base_url('assets/js/sb-admin-2.min.js')?>">
</script>

<!-- Page level plugins -->
<?php if ($this->uri->segment(1)!=='login'): ?>
<!-- <script
    src="<?= base_url('assets/js/chart.js/Chart.min.js')?>">
</script>
 -->
<!-- Page level custom scripts -->
<!-- <script
    src="<?= base_url('assets/js/demo/chart-area-demo.js')?>">
</script> -->
<!-- <script
    src="<?= base_url('assets/js/demo/chart-pie-demo.js')?>">
</script> -->

<?php endif;?>

<link
    href="<?=base_url('assets/css/fontawesome-free/css/fontawesome.min.css')?>"
    rel="stylesheet" type="text/css" />
<!-- <script
    src="<?= base_url('assets/js/bootstrap/bootstrap.min.js')?>">
</script> -->

</body>

</html>