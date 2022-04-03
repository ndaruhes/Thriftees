<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <link rel="shortcut icon" href="{{ asset('images/logo.png') }}">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/navbar.css') }}" rel="stylesheet">
    <link href="{{ asset('css/footer.css') }}" rel="stylesheet">
    @yield('addedCSS')
</head>

<body>
    <div id="app">
        <!-- NAVBAR -->
        @include('layouts.navbar')

        <!-- CONTENT -->
        @yield('content')

        <!-- FOOTER -->
        @include('layouts.footer')

        <!-- DELETE MODAL -->
        <div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered confirm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Hapus</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Apakah anda yakin ingin menghapus data?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary btn-sm"
                            data-dismiss="modal">Close</button>
                        <form id="confirm_delete" method="POST" action="">
                            @method('delete')
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm text-white">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- TERIMA PESANAN MODAL -->
        <div class="modal fade" id="konfirmasiTerimaPesananModal" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered confirm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Terima Pesanan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Anda yakin ingin menerima pesanan ini?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary btn-sm"
                            data-dismiss="modal">Close</button>
                        <form id="confirm_accept" method="POST" action="">
                            @method('put')
                            @csrf
                            <button type="submit" class="btn btn-success btn-sm text-white">Terima</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#confirmDeleteModal').on('show.bs.modal', function(e) {
                $(this).find('#confirm_delete').attr('action', $(e.relatedTarget).data('uri'));
            });
        });

        $(document).ready(function() {
            $('#konfirmasiTerimaPesananModal').on('show.bs.modal', function(e) {
                $(this).find('#confirm_accept').attr('action', $(e.relatedTarget).data('uri'));
            });
        });
    </script>
    @yield('addedScript')
</body>

</html>
