@extends('layouts.admin')

@section('content')
    <div class="main-content">
        <div class="card border">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Daftar Article</h5>
                <button onclick="openCreateModal()" class="btn btn-primary">
                    <i class="material-icons-outlined me-1">add_circle</i> Tambah Article
                </button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="articleTable" class="table-bordered nowrap table" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Category</th>
                                <th>Title</th>
                                <th>Verifikasi</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
            @include('pages.admin.article.create')
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        const storeUrl = @json(route('admin.article.store'));
        const updateUrlTemplate = @json(route('admin.article.update', ['id' => '__ID__']));
        const deleteUrlTemplate = @json(route('admin.article.destroy', ['id' => '__ID__']));

        const table = $('#articleTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('admin.article.index') }}',
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'category',
                    name: 'category'
                },
                {
                    data: 'title',
                    name: 'title'
                },
                {
                    data: 'is_verified',
                    name: 'is_verified'
                },
                {
                    data: null,
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    className: 'text-center',
                    render: function(data, type, row) {
                        let buttons = `
                            <button class="btn btn-sm btn-warning" onclick='openEditModal(${JSON.stringify(row)})'>Edit</button>
                            <button class="btn btn-sm btn-danger" onclick='deleteResource("${deleteUrlTemplate}", ${row.id}, "${row.title.replace(/"/g, '\\"')}", "#articleTable")'>Hapus</button>
                        `;

                        return buttons;
                    }
                }
            ]
        });

        submitFormAjax({
            formSelector: '#formArticle',
            storeRoute: storeUrl,
            updateRouteTemplate: updateUrlTemplate,
            modalSelector: '#addArticleModal',
            tableSelector: '#articleTable',
            successMessage: 'Article berhasil disimpan'
        });

        function openCreateModal() {
            $('#addArticleModalLabel').text('Tambah Article');
            $('#formArticle')[0].reset();
            $('#id').val('');
            $('#formArticle input[type="file"]').val('');

            // Tambahkan required hanya saat create
            $('[name="image_1"]').attr('required', true);

            $('#addArticleModal').modal('show');
            setTimeout(() => {
                toggleImagesByLayout();
            }, 200);
        }

        $(document).ready(function() {
            function toggleImagesByLayout() {
                const layout = $('[name="layout"]').val();
                if (layout === '1' || layout === '') {
                    // Sembunyikan Gambar 2 & 3 jika layout = 1 atau kosong
                    $('#image_2_group, #image_3_group').hide();
                } else {
                    // Tampilkan Gambar 2 & 3 jika layout = 2 atau 3
                    $('#image_2_group, #image_3_group').show();
                }
            }

            // Saat modal ditampilkan, evaluasi kondisi awal
            $('#addArticleModal').on('shown.bs.modal', function() {
                toggleImagesByLayout();
            });

            // Saat user mengganti layout
            $('[name="layout"]').on('change', function() {
                toggleImagesByLayout();
            });
        });

        function openEditModal(article) {
            $('#addArticleModalLabel').text('Edit Article');
            $('#formArticle')[0].reset();
            $('#id').val(article.id);
            $('[name="category"]').val(article.category);
            $('[name="title"]').val(article.title);
            $('[name="content"]').val(article.content);
            $('[name="content_article"]').val(article.content_article);
            $('[name="layout"]').val(article.layout).trigger('change');
            $('#formArticle input[type="file"]').val('');

            // Hapus atribut required saat edit
            $('[name="image_1"]').removeAttr('required');

            $('#addArticleModal').modal('show');
        }
    </script>
@endpush
