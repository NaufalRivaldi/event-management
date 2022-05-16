@extends('layouts.admin')

@section('title', $title)

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <a href="{{ route('admin.users.index') }}" class="btn btn-primary">
                    <i class="fas fa-angle-left"></i> Kembali
                </a>
            </div>
            <div class="card-body">
                <form
                    action="{{ $record->id ? route('admin.users.update', $record->id) : route('admin.users.store') }}"
                    method="POST"
                >
                    @csrf
                    @if ($record->id)
                        @method('PUT')
                        <input type="hidden" name="id" value="{{ $record->id }}">
                    @endif

                    <div class="form-group">
                        <label for="">Nama</label>
                        <input
                            type="text"
                            name="name"
                            class="form-control @error('name') is-invalid @enderror"
                            value="{{ old('name') ?? $record->name }}"
                        >

                        <!-- Error -->
                        @error('name')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                        <!-- Error -->
                    </div>

                    <div class="form-group">
                        <label for="">Email</label>
                        <input
                            type="email"
                            name="email"
                            class="form-control @error('email') is-invalid @enderror"
                            value="{{ old('email') ?? $record->email }}"
                        >

                        <!-- Error -->
                        @error('email')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                        <!-- Error -->
                    </div>

                    <div class="form-group">
                        <label for="">Password</label>
                        <input
                            type="password"
                            name="password"
                            class="form-control @error('password') is-invalid @enderror"
                            value="{{ old('password') }}"
                        >

                        <!-- Error -->
                        @error('password')
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