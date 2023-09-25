@extends('admin.layouts.main')

@section('title', 'Permissions')

@section('vendor_css')
    @parent
@endsection
@section('content')
    <main class="content">
        <div class="container-fluid p-0">
            <h1 class="h3 mb-3">Permissions</h1>

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
                            <form action="{{ route('cms.permissions.sync') }}" method="POST" id="permissionForm">
                                @csrf
                            <button type="submit" class="btn btn-sm btn-info" id="syncButton">
                                Sync permissions
                            </button>
                            </form>
                        </div>
                    </div>
                    <form action="{{ route('cms.permissions.update') }}" method="POST" id="permissionForm">
                        @csrf
                        @method('PUT')
                        <table class="table table-hover table-reflow">
                            <thead>
                            <tr>
                                <td></td>
                                @foreach ($roles as $role)
                                    <th class="text-center">{{ $role->name }}</th>
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
                        <div class="m-3">
                            <button type="submit" class="btn btn-lg btn-primary">Save permissions</button>
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
