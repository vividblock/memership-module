
</div>
            <!-- End of Main Content -->
            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; C3SC <?= date('Y') ?></span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
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
                    <a class="btn btn-primary" href="{{ route('logout') }}">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

    <!-- Page level plugins -->
    <!-- <script src="{{ asset('vendor/chart.js/Chart.min.js') }}"></script> -->

    <!-- Page level custom scripts -->
    <!-- <script src="{{ asset('js/demo/chart-area-demo.js') }}"></script> -->
    <!-- <script src="{{ asset('js/demo/chart-pie-demo.js') }}"></script> -->

    <script>
        $(document).ready(function () {
            // Highlight from localStorage
            const activeUrl = localStorage.getItem('activeSidebarLink');
            if (activeUrl) {
                $('#accordionSidebar .nav-item').removeClass('active');
                $('#accordionSidebar .nav-link').each(function () {
                    if (this.href === activeUrl) {
                        $(this).closest('.nav-item').addClass('active');
                    }
                });
            }

            // On click, store clicked URL
            $('#accordionSidebar .nav-link').on('click', function () {
                localStorage.setItem('activeSidebarLink', this.href);
            });
        });
    </script>



</body>

</html>