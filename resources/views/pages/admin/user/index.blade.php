@extends('layouts.admin')

@section('content')
    <div class="main-content">
        <div class="card border">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Daftar Pengguna</h5>
                <button onclick="openCreateModal()" class="btn btn-primary">
                    <i class="material-icons-outlined me-1">add_circle</i> Tambah Akun
                </button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="userTable" class="table-bordered nowrap table" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Jenis Kelamin</th>
                                <th>Role</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
            @include('pages.admin.user.create')
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        const storeUrl = @json(route('admin.user.store'));
        const updateUrlTemplate = @json(route('admin.user.update', ['id' => '__ID__']));
        const deleteUrlTemplate = @json(route('admin.user.destroy', ['id' => '__ID__']));

        const table = $('#userTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('admin.user.index') }}',
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
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'jk',
                    name: 'jk'
                },
                {
                    data: 'role',
                    name: 'role'
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
                            <button class="btn btn-sm btn-danger" onclick='deleteResource("${deleteUrlTemplate}", ${row.id}, "${row.name.replace(/"/g, '\\"')}")'>Hapus</button>
                        `;

                        return buttons;
                    }
                }
            ]
        });

        submitFormAjax({
            formSelector: '#formUser',
            storeRoute: storeUrl,
            updateRouteTemplate: updateUrlTemplate,
            modalSelector: '#addUserModal',
            tableSelector: '#userTable',
            successMessage: 'User berhasil disimpan'
        });

        function openCreateModal() {
            $('#addUserModalLabel').text('Tambah User');
            $('#formUser')[0].reset();
            $('#id').val('');
            $('#passwordField').prop('required', true);
            $('#addUserModal').modal('show');
        }

        function openEditModal(user) {
            $('#addUserModalLabel').text('Edit User');
            $('#id').val(user.id);
            $('[name="name"]').val(user.name);
            $('[name="email"]').val(user.email);
            $('[name="username"]').val(user.username);
            $('[name="role"]').val(user.role);
            $('[name="jk"]').val(user.jk);
            $('[name="phone"]').val(user.phone);
            $('[name="is_active"]').prop('checked', user.is_active == 1);
            $('#passwordField').val('').prop('required', false);
            $('#addUserModal').modal('show');
        }
    </script>
@endpush
