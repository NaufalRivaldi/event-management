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
                <a href="{{ route('admin.events.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Tambah Data
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="datatable-export" class="table table-striped">
                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>Judul</th>
                                <th>Lokasi</th>
                                <th>Waktu</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($records as $record)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $record->title }}</td>
                                    <td>{{ $record->location }}</td>
                                    <td>{{ date('d F Y, H:i:s', strtotime($record->start_date)) }} {{ $record->end_date ? 's/d '.date('d F Y, H:i:s', strtotime($record->end_date)) : null }}</td>
                                    <td>
                                        <a
                                            href="{{ route('admin.events.show', $record->id) }}"
                                            class="btn btn-info btn-sm"
                                            data-toggle="tooltip"
                                            data-placement="top"
                                            title="Show Event"
                                        >
                                            <i class="fas fa-eye"></i>
                                        </a>

                                        <a
                                            href="{{ route('admin.events.edit', $record->id) }}"
                                            class="btn btn-warning btn-sm ml-1"
                                            data-toggle="tooltip"
                                            data-placement="top"
                                            title="Edit Data"
                                        >
                                            <i class="fas fa-cog"></i>
                                        </a>

                                        <button
                                            class="btn btn-danger btn-sm ml-1"
                                            data-toggle="tooltip"
                                            data-placement="top"
                                            title="Hapus Data"
                                            @click="deleteData({{ $record->id }})"
                                        >
                                            <i class="fas fa-trash"></i>
                                        </button>
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
                {
                    extend: 'csv',
                    exportOptions: {
                        modifier: {
                            selected: null
                        }
                    }
                },
                {
                    extend: 'excel',
                    exportOptions: {
                        modifier: {
                            selected: null
                        }
                    }
                },
                {
                    extend: 'pdf',
                    exportOptions: {
                        modifier: {
                            selected: null
                        }
                    }
                },
                {
                    extend: 'print',
                    exportOptions: {
                        modifier: {
                            selected: null
                        }
                    }
                },
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
                let url = "{{ route('admin.events.destroy', ':id') }}";
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