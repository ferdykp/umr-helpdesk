 <!-- Core JS -->
<script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/chartjs.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

{{-- @if (session('status'))
  <script>
    Swal.fire({
        icon: 'success', // Tipe ikon (success, error, warning, info)
        text: {!! json_encode(session('status')) !!}, // Pesan toast
        toast: true, // Tentukan bahwa ini adalah toast
        position: 'bottom-end', // Posisi toast (top-start, top-end, bottom-start, bottom-end)
        showConfirmButton: false, // Tampilkan tombol OK
        background:"#fff",
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
        }
    });
  </script>
@endif

@if ($errors->any())
  @foreach ($errors->all() as $error)
    <script>
      Swal.fire({
        icon: 'error', // Tipe ikon (success, error, warning, info)
        text: {!! json_encode($error) !!}, // Pesan toast
        toast: true, // Tentukan bahwa ini adalah toast
        position: 'bottom-end', // Posisi toast (top-start, top-end, bottom-start, bottom-end)
        showConfirmButton: false, // Tampilkan tombol OK
        background:"#fff",
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
        }
      });
    </script>
  @endforeach
@endif --}}