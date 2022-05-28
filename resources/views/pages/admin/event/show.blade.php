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
                <a href="{{ route('admin.events.index') }}" class="btn btn-primary">
                    <i class="fas fa-angle-left"></i> Kembali
                </a>
                <a href="{{ route('admin.events.register.create', $record->id) }}" class="btn btn-success ml-2">
                    <i class="fas fa-plus"></i> Daftar Hadir Manual
                </a>
            </div>
            <div class="card-body">
                <h2>
                    {{ $record->title }}
                </h2>
                <b>Deskripsi</b>
                <p>
                    {{ $record->description }}
                </p>
                <b>Lokasi</b>
                <p>
                    {{ $record->location }}
                </p>
                <b>Waktu</b>
                <p>
                    {{ date('d F Y, H:i:s', strtotime($record->start_date)) }} {{ $record->end_date ? 's/d '.date('d F Y, H:i:s', strtotime($record->end_date)) : null }}
                </p>

                @if ($record->is_register)
                <b>Waktu Absen</b>
                <p>
                    {{ $record->start_time }} s/d {{ $record->end_time }}
                </p>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3>List Hadir</h3>
            </div>
            <div class="card-body">
            <div class="table-responsive">
                    <table id="datatable-export" class="table table-striped">
                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>Foto</th>
                                <th>Nama Anggota</th>
                                <th>Email</th>
                                @if (auth()->user()->isAdmin)
                                    <th>Ayah</th>
                                    <th>Ibu</th>
                                    <th>No Telp</th>
                                    <th>Umur</th>
                                    <th>Hobi</th>
                                    <th>Alamat</th>
                                    <th>Kesinoman</th>
                                    <th>Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($record->eventRegisters()->get() as $register)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>
                                        @if ($register->user->userDetail)
                                            @if ($register->user->userDetail->photo_url)
                                                <img src="{{ $register->user->userDetail->photo_url }}" class="img-thumbnail" alt="photo" width="100">
                                            @else
                                                -
                                            @endif
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>{{ $register->user->name }}</td>
                                    <td>{{ $register->user->email }}</td>
                                    <td>{{ $register->user->userDetail ? $register->user->userDetail->father_name : null }}</td>
                                    <td>{{ $register->user->userDetail ? $register->user->userDetail->mother_name : null }}</td>
                                    <td>{{ $register->user->userDetail ? $register->user->userDetail->phone : null }}</td>
                                    <td>{{ $register->user->userDetail ? $register->user->userDetail->age : null }}</td>
                                    <td>{{ $register->user->userDetail ? $register->user->userDetail->hobby : null }}</td>
                                    <td>{{ $register->user->userDetail ? $register->user->userDetail->address : null }}</td>
                                    <td>{{ $register->user->userDetail ? $register->user->userDetail->kesinoman : null }}</td>
                                    <td>
                                        <button
                                            class="btn btn-danger btn-sm ml-1"
                                            data-toggle="tooltip"
                                            data-placement="top"
                                            title="Hapus Data"
                                            @click="deleteData({{ $register->id }})"
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

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3>Dokumentasi</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <form
                            action="{{ route('admin.events.image.store', $record->id) }}"
                            method="POST"
                            enctype="multipart/form-data"
                        >
                            @csrf
                            <div class="form-group">
                                <label for="">Photo</label>
                                <input type="file" name="photo" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <button class="btn btn-primary">Post</button>
                            </div>
                        </form>
                    </div>
                </div>

                <hr>

                @if (count($record->eventImages) > 0)
                    <div class="row">
                        @foreach($record->eventImages as $eventImage)
                        <div class="col-md-4">
                            <div class="card" style="min-height: 300px;">
                                <img src="{{ $eventImage->image }}" class="card-img-top" alt="gallery">
                                <div class="card-body text-center">
                                    <a href="{{ route('admin.events.image.destroy', $eventImage->id) }}" onclick="return confirm('Delete gambar?')" class="btn btn-danger">Hapus Gambar</a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <p>Tidak ada dokumentasi</p>
                @endif
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
                let url = "{{ route('admin.events.register.delete', ':id') }}";
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