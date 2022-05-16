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
                <form
                    action="{{ $record->id ? route('admin.events.update', $record->id) : route('admin.events.store') }}"
                    method="POST"
                >
                    @csrf
                    @if ($record->id)
                        @method('PUT')
                        <input type="hidden" name="id" value="{{ $record->id }}">
                    @endif

                    <div class="form-group">
                        <label for="">Judul</label>
                        <input
                            type="text"
                            name="title"
                            class="form-control @error('title') is-invalid @enderror"
                            value="{{ old('title') ?? $record->title }}"
                        >

                        <!-- Error -->
                        @error('title')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                        <!-- Error -->
                    </div>

                    <div class="form-group">
                        <label for="">
                            Deskripsi
                        </label>
                        <textarea
                            name="description"
                            class="form-control @error('description') is-invalid @enderror"
                            rows="10"
                        >{{ old('description') ?? $record->description }}</textarea>
                        <!-- Error -->
                        @error('description')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                        <!-- Error -->
                    </div>

                    <div class="form-group">
                        <label for="">Lokasi</label>
                        <input
                            type="text"
                            name="location"
                            class="form-control @error('location') is-invalid @enderror"
                            value="{{ old('location') ?? $record->location }}"
                        >

                        <!-- Error -->
                        @error('location')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                        <!-- Error -->
                    </div>

                    <div class="form-group">
                        <label for="">Waktu Mulai</label>
                        <input
                            type="datetime-local"
                            name="start_date"
                            class="form-control @error('start_date') is-invalid @enderror"
                            value="{{ old('start_date') ?? ($record->start_date ? date('Y-m-d\TH:i:s', strtotime($record->start_date)) : null) }}"
                        >

                        <!-- Error -->
                        @error('start_date')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                        <!-- Error -->
                    </div>

                    <div class="form-group">
                        <label for="">Waktu Berakhir</label>
                        <input
                            type="datetime-local"
                            name="end_date"
                            class="form-control @error('end_date') is-invalid @enderror"
                            value="{{ old('end_date') ?? ($record->end_date ? date('Y-m-d\TH:i:s', strtotime($record->end_date)) : null) }}"
                        >

                        <!-- Error -->
                        @error('end_date')
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