@extends('layouts.auth')

@section('title', $title)

@section('content')
<div class="header">
    <div class="logo text-center"><img src="{{ asset('assets/images/logo-dark.png') }}" alt="Klorofil Logo"></div>
    <p class="lead">Create an account</p>
</div>
<form class="form-auth-small" action="" method="POST">
    @csrf
    <div class="form-group">
        <label for="first-name" class="control-label">
            First Name
            <span class="text-danger">*</span>
        </label>
        <input
            type="text"
            name="first_name"
            class="form-control"
            id="first-name"
            required
        >
    </div>

    <div class="form-group">
        <label for="last-name" class="control-label">
            Last Name
            <span class="text-danger">*</span>
        </label>
        <input
            type="text"
            name="last_name"
            class="form-control"
            id="last-name"
            required
        >
    </div>

    <div class="form-group">
        <label for="signup-email" class="control-label">
            Email
            <span class="text-danger">*</span>
        </label>
        <input
            type="email"
            name="email"
            class="form-control"
            id="signup-email"
            placeholder="Example: hello@example.com"
            required
        >
    </div>

    <div class="form-group">
        <label for="password" class="control-label">
            Password
            <span class="text-danger">*</span>
        </label>
        <div class="input-group">
            <input
                :type="formLogic.password.type"
                name="password"
                class="form-control"
                id="password"
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
        <label for="confirm-password" class="control-label">
            Confirm Password
            <span class="text-danger">*</span>
        </label>
        <div class="input-group">
            <input
                :type="formLogic.passwordConfirm.type"
                name="password-confirm"
                class="form-control"
                id="confirm-password"
                required
            >
            <span class="input-group-append">
                <button
                    v-if="formLogic.passwordConfirm.type == 'password'"
                    type="button"
                    class="input-group-text"
                    @click="formLogic.passwordConfirm.type = 'text'"
                >
                    <i class="fas fa-eye"></i>
                </button>

                <button
                    v-else
                    type="button"
                    class="input-group-text"
                    @click="formLogic.passwordConfirm.type = 'password'"
                >
                    <i class="fas fa-eye-slash"></i>
                </button>
            </span>
        </div>
    </div>
    <button type="submit" class="btn btn-primary btn-lg btn-block">REGISTER</button>
    <div class="bottom">
        <span class="helper-text">
            Already have an account? <a href="{{ route('admin.login') }}">Login</a>
        </span>
    </div>
</form>

{{--
<div class="separator-linethrough">
    <span>OR</span>
</div>

<button class="btn btn-signin-social">
    <i class="fa fa-facebook-official facebook-color"></i> Sign in with Facebook
</button>
<button class="btn btn-signin-social">
    <i class="fa fa-twitter twitter-color"></i> Sign in with Twitter
</button>
--}}

@endsection

@push('scripts')
<script>
    Vue.createApp({
        data() {
            return {
                formLogic: {
                    password: {
                        type: 'password',
                    },
                    passwordConfirm: {
                        type: 'password',
                    }
                }
            }
        }
    }).mount('#app')
</script>
@endpush