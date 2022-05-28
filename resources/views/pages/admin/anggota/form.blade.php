@extends('layouts.admin')

@section('title', $title)

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <a href="{{ route('admin.anggota.index') }}" class="btn btn-primary">
                    <i class="fas fa-angle-left"></i> Kembali
                </a>
            </div>
            <div class="card-body">
                <form
                    action="{{ $record->id ? route('admin.anggota.update', $record->id) : route('admin.anggota.store') }}"
                    method="POST"
                    enctype="multipart/form-data"
                >
                    @csrf
                    @if ($record->id)
                        @method('PUT')
                        <input type="hidden" name="id" value="{{ $record->id }}">
                    @endif

                    @if ($record->userDetail)
                        @if ($record->userDetail->photo_url)
                            <img src="{{ $record->userDetail->photo_url }}" alt="photo profile" class="img-thumbnail" width="200px">
                        @endif
                    @endif

                    <div class="form-group">
                        <label for="">Foto</label>
                        <input
                            type="file"
                            name="photo"
                            class="form-control @error('photo') is-invalid @enderror"
                            value="{{ old('photo') }}"
                        >
                        <small class="form-text text-info">{{ __('Upload foto kembali jika ingin merubah foto') }}</small>

                        <!-- Error -->
                        @error('photo')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                        <!-- Error -->
                    </div>

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

                    <div class="form-group">
                        <label for="">
                            Nama Ayah
                        </label>
                        <input
                            type="text"
                            name="father_name"
                            class="form-control @error('father_name') is-invalid @enderror"
                            value="{{ old('father_name') ?? ($record->userDetail ? $record->userDetail->father_name : null) }}"
                        >
                        <!-- Error -->
                        @error('father_name')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                        <!-- Error -->
                    </div>

                    <div class="form-group">
                        <label for="">
                            Nama Ibu
                        </label>
                        <input
                            type="text"
                            name="mother_name"
                            class="form-control @error('mother_name') is-invalid @enderror"
                            value="{{ old('mother_name') ?? ($record->userDetail ? $record->userDetail->mother_name : null) }}"
                        >
                        <!-- Error -->
                        @error('mother_name')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                        <!-- Error -->
                    </div>

                    <div class="form-group">
                        <label for="">
                            Nomer Telepon
                        </label>
                        <input
                            type="text"
                            name="phone"
                            class="form-control @error('phone') is-invalid @enderror"
                            value="{{ old('phone') ?? ($record->userDetail ? $record->userDetail->phone : null) }}"
                        >
                        <!-- Error -->
                        @error('phone')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                        <!-- Error -->
                    </div>

                    <div class="form-group">
                        <label for="">
                            Umur
                        </label>
                        <input
                            type="text"
                            name="age"
                            class="form-control @error('age') is-invalid @enderror"
                            value="{{ old('age') ?? ($record->userDetail ? $record->userDetail->age : null) }}"
                        >
                        <!-- Error -->
                        @error('age')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                        <!-- Error -->
                    </div>

                    <div class="form-group">
                        <label for="">
                            Hobi
                        </label>
                        <input
                            type="text"
                            name="hobby"
                            class="form-control @error('hobby') is-invalid @enderror"
                            value="{{ old('hobby') ?? ($record->userDetail ? $record->userDetail->hobby : null) }}"
                        >
                        <!-- Error -->
                        @error('hobby')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                        <!-- Error -->
                    </div>

                    <div class="form-group">
                        <label for="">
                            Alamat
                        </label>
                        <textarea
                            name="address"
                            class="form-control @error('address') is-invalid @enderror"
                            rows="10"
                        >{{ old('address') ?? ($record->userDetail ? $record->userDetail->address : null) }}</textarea>
                        <!-- Error -->
                        @error('address')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                        <!-- Error -->
                    </div>

                    <div class="form-group">
                        <label for="">
                            Kesinoman
                        </label>
                        <select
                            name="kesinoman"
                            class="form-control @error('kesinoman') is-invalid @enderror"
                        >
                            <option value="">- Pilih -</option>
                            @foreach ($kesinoman as $data)
                                <option value="{{ $data }}" @if ($record->userDetail) @if ($record->userDetail->kesinoman == $data) selected @endif @endif>{{ ucwords($data) }}</option>
                            @endforeach
                        </select>

                        <!-- Error -->
                        @error('kesinoman')
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