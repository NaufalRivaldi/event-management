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
                                <th>Nama Anggota</th>
                                <th>Email</th>
                                @if (auth()->user()->isAdmin)
                                    <th>Ayah</th>
                                    <th>Ibu</th>
                                    <th>No Telp</th>
                                    <th>Umur</th>
                                    <th>Hobi</th>
                                    <th>Alamat</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($record->eventRegisters()->get() as $register)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $register->user->name }}</td>
                                    <td>{{ $register->user->email }}</td>
                                    <th>{{ $register->user->userDetail ? $register->user->userDetail->father_name : null }}</th>
                                    <th>{{ $register->user->userDetail ? $register->user->userDetail->mother_name : null }}</th>
                                    <th>{{ $register->user->userDetail ? $register->user->userDetail->phone : null }}</th>
                                    <th>{{ $register->user->userDetail ? $register->user->userDetail->age : null }}</th>
                                    <th>{{ $register->user->userDetail ? $register->user->userDetail->hobby : null }}</th>
                                    <th>{{ $register->user->userDetail ? $register->user->userDetail->address : null }}</th>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
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
@endpush