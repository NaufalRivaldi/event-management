@extends('layouts.admin')

@section('title', $title)

@push('css')
<!-- Datatables core css -->
<link href="{{ asset('assets/plugins/datatables.net-bs4/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />

<!-- Datatables extensions css -->
<link href="{{ asset('assets/plugins/datatables.net-buttons-bs4/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/plugins/datatables.net-colreorder-bs4/colreorder.bootstrap4.min.css" rel="stylesheet') }}" type="text/css" />
@endpush

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Tambah Data
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="datatable-export" class="table table-striped">
                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Level</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($records as $record)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $record->name }}</td>
                                    <td>{{ $record->email }}</td>
                                    <td>{{ $record->level }}</td>
                                    <td>
                                        <a
                                            href="{{ route('admin.users.edit', $record->id) }}"
                                            class="btn btn-warning btn-sm"
                                            data-toggle="tooltip"
                                            data-placement="top"
                                            title="Edit Data"
                                        >
                                            <i class="fas fa-cog"></i>
                                        </a>

                                        @if (auth()->user()->id != $record->id)
                                            <button
                                                class="btn btn-danger btn-sm ml-1"
                                                data-toggle="tooltip"
                                                data-placement="top"
                                                title="Hapus Data"
                                                @click="deleteData({{ $record->id }})"
                                            >
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<form :action="deleteUrl" method="POST" ref="formDelete">
    @csrf
    @method('DELETE')
</form>
@endsection

@push('scripts')
<!-- Datables Core -->
<script src="{{ asset('assets/plugins/datatables.net/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables.net-bs4/dataTables.bootstrap4.min.js') }}"></script>

<!-- Datables Extension -->
<script src="{{ asset('assets/plugins/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('assets/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('assets/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('assets/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables.net-buttons-bs4/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables.net-colreorder/dataTables.colReorder.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables.net-colreorder-bs4/colReorder.bootstrap4.min.js') }}"></script>

<!-- Datatables Init -->
<script>
    $(document).ready(function() {
        $('#datatable-export').DataTable( {
            dom: 'Bfrtip',
            buttons: [
                'csv', 'excel', 'pdf', 'print'
            ]
        } );
    } );
</script>

<script>
    Vue.createApp({
        data() {
            return {
                deleteUrl: null,
            };
        },

        methods: {
            deleteData(userId) {
                let url = "{{ route('admin.users.destroy', ':id') }}";
                if (confirm('Hapus data?')) {
                    url = url.replace(':id', userId);

                    this.deleteUrl = url;

                    setTimeout(() => {
                        this.$refs.formDelete.submit();
                    }, 200);
                }
            },
        },
    }).mount('#app')
</script>
@endpush