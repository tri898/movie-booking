@extends('admin.layouts.main')

@section('title', 'User Manager | Create')

@section('vendor_css')
    @parent
@endsection
@section('content')
    <main class="content">
        <div class="container-fluid p-0">

            <h1 class="h3 mb-3">Create User Manager</h1>

            <div class="row">

                <div class="card flex-fill">
                    <div class="card-header">
                        <h5 class="card-title mb-3">New User</h5>
                        @if ($errors->any())
                            <div class="alert alert-warning" role="alert">
                                @foreach ($errors->all() as $error)
                                    <div class="alert-message text-wrap">
                                        {{ $error }}
                                    </div>
                                @endforeach
                            </div>
                        @endif
                        <form action="{{ route('admin.user-manager.store') }}" method="POST" id="userManagerForm">
                            @csrf
                            <div class="mb-3 row">
                                <div class="col-sm-3">
                                    <label class="form-label"><strong>Email*</strong></label>
                                    <input class="form-control form-control-lg" type="email" id="adminEmail"
                                           name="email"
                                           value="{{ old('email') }}" placeholder="Enter your email"/>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <label class="form-label"><strong>Name*</strong></label>
                                    <input class="form-control form-control-lg" type="text" id="adminName" name="name"
                                           value="{{ old('name') }}" placeholder="Enter your name"/>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <label class="form-label"><strong>Password*</strong></label>
                                    <div class="password-group">
                                        <div  class="input-group">
                                            <input class="form-control form-control-lg" type="password" id="adminPassword"
                                                   name="password" value="{{ old('password') }}"
                                                   placeholder="Enter your password"/>
                                            <span class="input-group-text " id="togglePassword">
                                               <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" name="toggle_password"
                                                           value="" checked>
                                               </div>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <label class="form-label"><strong>Password Confirmation*</strong></label>
                                    <input class="form-control form-control-lg" type="password"
                                           id="adminPasswordConfirmation" name="password_confirmation"
                                           value="{{ old('password_confirmation') }}"
                                           placeholder="Enter your password confirmation"/>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <label class="form-label"><strong>Status</strong></label>
                                    <label class="form-check">
                                        <input class="form-check-input" type="radio" value="1"
                                               name="status" @checked(old('status', 1))>
                                        <span class="form-check-label">Active</span>
                                    </label>
                                    <label class="form-check">
                                        <input class="form-check-input" type="radio" value="0"
                                               name="status" @checked(!old('status', 1))>
                                        <span class="form-check-label">Blocked</span>
                                    </label>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <label class="form-label"><strong>Roles*</strong></label>
                                    <div id="rolesGroup">
                                        @foreach($roles as $role)
                                            <label class="form-check">
                                                <input class="form-check-input" type="checkbox"
                                                       id="rolesGroup-{{$role->name}}" name="roles[]"
                                                       value="{{ $role->name }}"
                                                    {{ (is_array(old('roles')) and in_array($role->name, old('roles'))) ? 'checked' : '' }}
                                                >
                                                <span class="form-check-label">{{ $role->name }}</span>
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="mt-3">
                                <button type="submit" class="btn btn-lg btn-primary">Create</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
@section('script')
    @parent
    <script type="text/javascript">
        const togglePassword = document.querySelector("#togglePassword");
        const password = document.querySelector("#adminPassword");
        const passwordConfirmation = document.querySelector("#adminPasswordConfirmation");

        togglePassword.addEventListener("click", function () {
            // toggle the type attribute
            const type = password.getAttribute("type") === "password" ? "text" : "password";
            password.setAttribute("type", type);
            passwordConfirmation.setAttribute("type", type);
        });
    </script>
    <script src="{{ mix('/admin/js/validate-forms/create-user-manager.js')}}"></script>
@endsection
