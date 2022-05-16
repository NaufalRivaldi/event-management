@extends('layouts.admin')

@section('title', $title)

@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h4>Informasi User</h4>
            </div>
            <div class="card-body">
                <form
                    action="{{ route('admin.profile.update', auth()->user()->id) }}"
                    method="POST"
                >
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="">
                            Nama <span class="text-danger">*</span>
                        </label>
                        <input
                            type="text"
                            name="name"
                            class="form-control @error('name') is-invalid @enderror"
                            value="{{ old('name') ?? auth()->user()->name }}"
                            required
                        >
                        <!-- Error -->
                        @error('name')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                        <!-- Error -->
                    </div>

                    <div class="form-group">
                        <label for="">
                            Email <span class="text-danger">*</span>
                        </label>
                        <input
                            type="email"
                            name="email"
                            class="form-control @error('email') is-invalid @enderror"
                            value="{{ old('email') ?? auth()->user()->email }}"
                            required
                        >
                        <!-- Error -->
                        @error('email')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                        <!-- Error -->
                    </div>

                    @if (auth()->user()->isAnggota)
                        <div class="form-group">
                            <label for="">
                                Nama Ayah
                            </label>
                            <input
                                type="text"
                                name="father_name"
                                class="form-control @error('father_name') is-invalid @enderror"
                                value="{{ old('father_name') ?? (auth()->user()->userDetail ? auth()->user()->userDetail->father_name : null) }}"
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
                                value="{{ old('mother_name') ?? (auth()->user()->userDetail ? auth()->user()->userDetail->mother_name : null) }}"
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
                                value="{{ old('phone') ?? (auth()->user()->userDetail ? auth()->user()->userDetail->phone : null) }}"
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
                                value="{{ old('age') ?? (auth()->user()->userDetail ? auth()->user()->userDetail->age : null) }}"
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
                                value="{{ old('hobby') ?? (auth()->user()->userDetail ? auth()->user()->userDetail->hobby : null) }}"
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
                            >{{ old('address') ?? (auth()->user()->userDetail ? auth()->user()->userDetail->address : null) }}</textarea>
                            <!-- Error -->
                            @error('address')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                            <!-- Error -->
                        </div>
                    @endif

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

    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h4>Ubah Password</h4>
            </div>
            <div class="card-body">
                <form
                    action="{{ route('admin.profile.update-password', auth()->user()->id) }}"
                    method="POST"
                >
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="">
                            Password Lama <span class="text-danger">*</span>
                        </label>
                        <input
                            type="password"
                            name="current_password"
                            class="form-control @error('current_password') is-invalid @enderror"
                            value="{{ old('current_password') ?? auth()->user()->current_password }}"
                            required
                        >
                        <!-- Error -->
                        @error('current_password')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                        <!-- Error -->
                    </div>

                    <div class="form-group">
                        <label for="">
                            Password Baru <span class="text-danger">*</span>
                        </label>
                        <input
                            type="password"
                            name="new_password"
                            class="form-control @error('new_password') is-invalid @enderror"
                            value="{{ old('new_password') ?? auth()->user()->new_password }}"
                            required
                        >
                        <!-- Error -->
                        @error('new_password')
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