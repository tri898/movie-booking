@extends('admin.layouts.main')

@section('title', 'Permission')

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
                    <li class="breadcrumb-item active" aria-current="page">Permissions</li>
                </ol>
            </nav>

            <div class="row">
                <div class="card flex-fill">
                    <div class="card-header">

                        <h5 class="card-title mb-0">Permissions</h5>
                        @if(session('message'))
                            <div class="alert alert-success mt-3" role="alert">
                                <div class="alert-message text-wrap">
                                    {{ session('message') }}
                                </div>
                            </div>
                        @endif
                        <div class="mt-3 float-end">
                            <form action="{{ route('cms.permission.sync') }}" method="POST" id="permissionForm">
                                @csrf
                            <button type="submit" class="btn btn-flickr" id="syncButton">
                                Sync permissions
                            </button>
                            </form>
                        </div>
                    </div>
                    <form action="{{ route('cms.permission.update') }}" method="POST" id="permissionForm">
                        @csrf
                        @method('PUT')
                        <div class="table-responsive">
                        <table class="table table-hover my-0">
                            <thead>
                            <tr>
                                <td></td>
                                @foreach ($roles as $role)
                                    <th scope="col" class="text-center text-black">{{ $role->name }}</th>
                                @endforeach
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($permissions as $permission)
                                <tr>
                                    <td>{{ $permission->name }}</td>
                                    @foreach ($roles as $role)
                                        <td>
                                            <div class="text-center">
                                                <input type="checkbox" class="form-check-input" value="1"
                                                       name="data[{{ $role->name }}][{{ $permission->name }}]"
                                                    {{ (is_array($role->permissions->pluck('name')->toArray()) and in_array($permission->name,$role->permissions->pluck('name')->toArray()) or $role->name == 'super-admin') ? 'checked' : '' }}
                                                    {{ $role->name == 'super-admin' ? 'disabled' : '' }}
                                                >
                                            </div>
                                        </td>
                                    @endforeach
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        </div>
                        <div class="m-3">
                            <button type="submit" class="btn btn-lg btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </main>
@endsection
@section('script')
    @parent
@endsection
