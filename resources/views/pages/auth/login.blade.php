@extends('layouts.auth')

@section('title', $title)

@section('content')
<div class="header">
    <div class="logo text-center"><img src="{{ asset('assets/images/logo-dark.png') }}" alt="Klorofil Logo"></div>
    <p class="lead">Login to your account</p>
</div>
<form class="form-auth-small" action="{{ route('admin.login.attempt') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="signin-email" class="control-label sr-only">Email</label>
        <div class="input-group">
            <input
                type="email"
                name="email"
                class="form-control"
                id="signin-email"
                placeholder="Email"
                required
            >
            <span class="input-group-append">
                <span class="input-group-text">
                    <i class="fas fa-envelope"></i>
                </span>
            </span>
        </div>
    </div>

    <div class="form-group">
        <label for="signin-password" class="control-label sr-only">Password</label>
        <div class="input-group">
            <input
                :type="formLogic.password.type"
                name="password"
                class="form-control"
                id="signin-password"
                placeholder="Password"
                required
            >
            <span class="input-group-append">
                <button
                    v-if="formLogic.password.type == 'password'"
                    type="button"
                    class="input-group-text"
                    @click="formLogic.password.type = 'text'"
                >
                    <i class="fas fa-eye"></i>
                </button>

                <button
                    v-else
                    type="button"
                    class="input-group-text"
                    @click="formLogic.password.type = 'password'"
                >
                    <i class="fas fa-eye-slash"></i>
                </button>
            </span>
        </div>
    </div>

    <div class="form-group">
        <label class="fancy-checkbox element-left custom-bgcolor-blue">
            <input type="checkbox">
            <span class="text-muted">Remember me</span>
        </label>
    </div>

    <button type="submit" class="btn btn-primary btn-lg btn-block">LOGIN</button>
    <div class="bottom">
        <span class="helper-text d-block">
            Don't have an account? <a href="{{ route('admin.register') }}">Register</a>
        </span>
        <span class="helper-text"><i class="fa fa-lock"></i> <a href="#">Forgot password?</a></span>
    </div>
</form>
@endsection

@push('scripts')
<script>
    Vue.createApp({
        data() {
            return {
                formLogic: {
                    password: {
                        type: 'password',
                    }
                }
            }
        }
    }).mount('#app')
</script>
@endpush