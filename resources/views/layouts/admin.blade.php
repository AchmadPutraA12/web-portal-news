<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/toastify-js/1.11.2/toastify.min.css">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastify-js/1.11.2/toastify.min.js"></script>
    <!-- datables-->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.dataTables.css" />
    <link href="https://cdn.jsdelivr.net/npm/material-icons@1.13.14/iconfont/material-icons.min.css" rel="stylesheet">
    @yield('css')
    <style>
        body {
            margin: 0;
            padding: 0;
        }

        .sidebar-container {
            max-width: 250px;
            /* batas maksimal sidebar */
            width: 100%;
            /* tetap fleksibel */
            height: 100vh;
            background-color: #FF5F00;
        }

        @media (max-width: 768px) {
            .sidebar-container {
                height: auto;
                max-width: 100%;
            }
        }
    </style>
</head>

<body>
    <div class="container-fluid px-0">
        <div class="row g-0">
            <div class="sidebar-container col-auto">
                @include('components.admin.sidebar')
            </div>
            <div class="col col-content overflow-auto">
                @yield('content')
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    @if (session('success'))
        <script>
            $(document).ready(function() {
                Toastify({
                    text: '🎉 {{ session('success') }}',
                    duration: 5000,
                    close: true,
                    gravity: "top",
                    position: "right",
                    stopOnFocus: true,
                    style: {
                        background: "linear-gradient(to right, #00b09b, #96c93d)",
                        borderRadius: "10px",
                        boxShadow: "0px 4px 15px rgba(0, 0, 0, 0.1)",
                        padding: "10px 15px",
                    },
                    onClick: function() {}
                }).showToast();
            });
        </script>
    @endif

    @if (session('errors') && is_string(session('errors')))
        <script>
            $(document).ready(function() {
                Toastify({
                    text: '⚠️ {{ session('errors') }}',
                    duration: 5000,
                    close: true,
                    gravity: "top",
                    position: "right",
                    stopOnFocus: true,
                    style: {
                        background: "linear-gradient(to right, #ff5f6d, #ffc371)",
                        borderRadius: "10px",
                        boxShadow: "0px 4px 15px rgba(0, 0, 0, 0.1)",
                        padding: "10px 15px",
                    },
                    onClick: function() {}
                }).showToast();
            });
        </script>
    @endif
    <!-- datables-->
    <script src="https://cdn.datatables.net/2.2.2/js/dataTables.js"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function renderUserDataTable(tableSelector = '#userTable', ajaxUrl = '', columns = []) {
            $(document).ready(function() {
                if (!ajaxUrl || columns.length === 0) {
                    console.warn("❌ renderUserDataTable: 'ajaxUrl' dan 'columns' harus diisi.");
                    return;
                }

                $(tableSelector).DataTable({
                    processing: true,
                    serverSide: true,
                    destroy: true,
                    ajax: ajaxUrl,
                    columns: columns
                });
            });
        }
    </script>

    <script>
        function submitFormAjax({
            formSelector = '#formUser',
            storeRoute = '',
            updateRouteTemplate = '',
            modalSelector = '#addUserModal',
            tableSelector = '#userTable',
            successMessage = 'Data berhasil disimpan'
        }) {
            $(formSelector).on('submit', function(e) {
                e.preventDefault();

                const id = $(`${formSelector} input[name="id"]`).val();
                const url = id ? updateRouteTemplate.replace('__ID__', id) : storeRoute;
                const method = id ? 'POST' : 'POST'; // tetap POST, tapi pakai _method = PUT kalau edit

                const form = $(this)[0];
                const formData = new FormData(form);

                if (id) {
                    formData.append('_method', 'PUT'); // Laravel butuh _method untuk update
                }

                $.ajax({
                    url: url,
                    type: method,
                    data: formData,
                    contentType: false, // HARUS false untuk FormData
                    processData: false, // HARUS false untuk FormData
                    success: function(response) {
                        Toastify({
                            text: response.message || successMessage,
                            backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)",
                            duration: 3000
                        }).showToast();

                        $(formSelector)[0].reset();
                        $(modalSelector).modal('hide');
                        $(tableSelector).DataTable().ajax.reload();
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;
                            $.each(errors, function(key, value) {
                                Toastify({
                                    text: value[0],
                                    backgroundColor: "linear-gradient(to right, #ff5f6d, #ffc371)",
                                    duration: 4000
                                }).showToast();
                            });
                        } else {
                            Toastify({
                                text: "Terjadi kesalahan. Silakan coba lagi.",
                                backgroundColor: "linear-gradient(to right, #ff5f6d, #ffc371)",
                                duration: 4000
                            }).showToast();
                        }
                    }
                });
            });
        }

        function deleteResource(urlTemplate, id, name, tableSelector = '#userTable') {
            Swal.fire({
                title: `Hapus Pengguna?`,
                text: `Apakah kamu yakin ingin menghapus "${name}"? Tindakan ini tidak bisa dibatalkan.`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    const deleteUrl = urlTemplate.replace('__ID__', id);

                    $.ajax({
                        url: deleteUrl,
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            _method: 'DELETE'
                        },
                        success: function(response) {
                            Swal.fire('Berhasil!', response.message || 'Data berhasil dihapus.',
                                'success');
                            $(tableSelector).DataTable().ajax.reload();
                        },
                        error: function() {
                            Swal.fire('Gagal!', 'Terjadi kesalahan saat menghapus data.', 'error');
                        }
                    });
                }
            });
        }
    </script>
    @stack('scripts')
</body>

</html>
