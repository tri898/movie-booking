@extends('admin.layouts.main')

@section('title', 'User Manager | Create')

@section('vendor_css')
    @parent
@endsection
@section('content')
    <main class="content">
        <div class="container-fluid p-0">
            <nav
                style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);"
                aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.welcome.index') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><a
                            href="{{ route('cms.user-manager.index') }}">User Manager</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Create</li>
                </ol>
            </nav>

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
                        <form action="{{ route('cms.user-manager.store') }}" method="POST" id="userManagerForm">
                            @csrf
                            <div class="row">
                                <div class="col-sm-3 mt-3">
                                    <label class="form-label"><strong>Avatar</strong></label>
                                    @include('admin.layouts.components.dropzone.input')
                                </div>
                                <div class="col-sm-9">
                                    <div class="row">
                                        <div class="col-sm-6 mt-3">
                                            <label class="form-label"><strong>Email*</strong></label>
                                            <input class="form-control form-control-lg" type="email" id="adminEmail"
                                                   name="email"
                                                   value="{{ old('email') }}" placeholder="Enter your email"/>
                                        </div>
                                        <div class="col-sm-6 mt-3">
                                            <label class="form-label"><strong>Name*</strong></label>
                                            <input class="form-control form-control-lg" type="text" id="adminName"
                                                   name="name"
                                                   value="{{ old('name') }}" placeholder="Enter your name"/>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6 mt-3">
                                            <label class="form-label"><strong>Password*</strong></label>
                                            <div class="password-group">
                                                <div class="input-group">
                                                    <input class="form-control form-control-lg" type="password"
                                                           id="adminPassword"
                                                           name="password" value="{{ old('password') }}"
                                                           placeholder="Enter your password"/>
                                                    <span class="input-group-text " id="togglePassword">
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox"
                                                               name="toggle_password"
                                                               value="" checked>
                                                    </div>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 mt-3">
                                            <label class="form-label"><strong>Password Confirmation*</strong></label>
                                            <input class="form-control form-control-lg" type="password"
                                                   id="adminPasswordConfirmation" name="password_confirmation"
                                                   value="{{ old('password_confirmation') }}"
                                                   placeholder="Enter your password confirmation"/>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6 mt-3">
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
                                        <div class="col-sm-6 mt-3">
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
                                </div>
                            </div>
                            <div class="mt-3">
                                <button type="submit" class="btn btn-lg btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
    @include('admin.layouts.components.dropzone.modal')
@endsection
@section('script')
    @parent
    @include('admin.layouts.components.dropzone.config')
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
    <script src="{{ mix('/admin/js/pages/create-user-manager.js')}}"></script>
@endsection
