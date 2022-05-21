@extends('layouts.admin')

@section('title', $title)

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

                <hr>

                <form
                    action="{{ route('admin.events.register.store', $record->id) }}"
                    method="POST"
                >
                    @csrf

                    <div class="form-group">
                        <label for="">Anggota</label>
                        <select
                            name="user_id"
                            class="form-control @error('user_id') is-invalid @enderror"
                        >
                            <option value="">- Pilih -</option>
                            @foreach($anggotas as $anggota)
                                @if(!in_array($anggota->id, $userIds))
                                    <option value="{{ $anggota->id }}">{{ $anggota->name }}</option>
                                @endif
                            @endforeach
                        </select>

                        <!-- Error -->
                        @error('user_id')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                        <!-- Error -->
                    </div>

                    <div class="form-group text-right">
                        <button
                            type="submit"
                            class="btn btn-primary"
                        >
                            <i class="fas fa-save"></i> Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection