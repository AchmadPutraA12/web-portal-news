@extends('layouts.admin')

@section('content')
    <div class="main-content">
        <div class="card border">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Daftar Article</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="articleTable" class="table-bordered nowrap table" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Category</th>
                                <th>Title</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
            @include('pages.admin.verifikasi.create')
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        const updateUrlTemplate = @json(route('admin.verifikasi-article.update', ['id' => '__ID__']));

        const table = $('#articleTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('admin.verifikasi-article.index') }}',
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'category_id',
                    name: 'category_id'
                },
                {
                    data: 'title',
                    name: 'title'
                },
                {
                    data: null,
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    className: 'text-center',
                    render: function(data, type, row) {
                        let buttons = `
                            <button class="btn btn-sm btn-warning" onclick='openEditModal(${JSON.stringify(row)})'>Verifikasi</button>
                        `;

                        return buttons;
                    }
                }
            ]
        });

        submitFormAjax({
            formSelector: '#formArticle',
            updateRouteTemplate: updateUrlTemplate,
            modalSelector: '#addArticleModal',
            tableSelector: '#articleTable',
            successMessage: 'Article berhasil disimpan'
        });

        function openEditModal(article) {
            $('#addArticleModalLabel').text('Verifikasi Article');
            $('#formArticle')[0].reset();
            $('#id').val(article.id);

            $('#addArticleModal').modal('show');
        }
    </script>
@endpush
