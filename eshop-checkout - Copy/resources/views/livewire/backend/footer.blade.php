<div>
    <div>
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; <a href="" target="_blank">Jayesh Kanani</a>
                        {{ date('Y') }}</span>
                </div>
            </div>
        </footer>
        <!-- End of Footer -->
    </div>

     <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

</div>

<!-- Bootstrap core JavaScript-->
<script src="{{asset('backend/vendor/jquery/jquery.min.js')}}"></script>
<script src="{{asset('backend/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

<!-- Core plugin JavaScript-->
<script src="{{asset('backend/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

<!-- Custom scripts for all pages-->
<script src="{{asset('backend/js/sb-admin-2.min.js')}}"></script>

<!-- Page level plugins -->
<script src="{{asset('backend/vendor/chart.js/Chart.min.js')}}"></script>

<!-- Page level custom scripts -->
{{-- <script src="{{asset('backend/js/demo/chart-area-demo.js')}}"></script> --}}
{{-- <script src="{{asset('backend/js/demo/chart-pie-demo.js')}}"></script> --}}

@stack('scripts')

<script>
  setTimeout(function(){
    $('.alert').slideUp();
  },4000);
</script>
