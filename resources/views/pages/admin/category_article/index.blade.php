@extends('layouts.admin')

@section('content')
    <div class="main-content">
        <div class="card border">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Daftar Category Article</h5>
                <button onclick="openCreateModal()" class="btn btn-primary">
                    <i class="material-icons-outlined me-1">add_circle</i> Tambah Category Article
                </button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="categoryArticleTable" class="table-bordered nowrap table" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
            @include('pages.admin.category_article.create')
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        const storeUrl = @json(route('admin.category-article.store'));
        const updateUrlTemplate = @json(route('admin.category-article.update', ['id' => '__ID__']));
        const deleteUrlTemplate = @json(route('admin.category-article.destroy', ['id' => '__ID__']));

        const table = $('#categoryArticleTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('admin.category-article.index') }}',
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'name',
                    name: 'name'
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
                            <button class="btn btn-sm btn-danger" onclick='deleteResource("${deleteUrlTemplate}", ${row.id}, "${row.name.replace(/"/g, '\\"')}", "#categoryArticleTable")'>Hapus</button>
                        `;

                        return buttons;
                    }
                }
            ]
        });

        submitFormAjax({
            formSelector: '#formCategoryArticle',
            storeRoute: storeUrl,
            updateRouteTemplate: updateUrlTemplate,
            modalSelector: '#addCategoryModal',
            tableSelector: '#categoryArticleTable',
            successMessage: 'Category Article berhasil disimpan'
        });

        function openCreateModal() {
            $('#addCategoryArticleModalLabel').text('Tambah Category Article');
            $('#formCategoryArticle')[0].reset();
            $('#id').val('');
            $('#name').prop('required', true);
            $('#addCategoryModal').modal('show');
        }

        function openEditModal(user) {
            $('#addCategoryArticleModalLabel').text('Edit Category Article');
            $('#id').val(user.id);
            $('[name="name"]').val(user.name);
            $('#addCategoryModal').modal('show');
        }
    </script>
@endpush
