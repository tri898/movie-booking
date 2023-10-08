@extends('admin.layouts.main')

@section('title', 'Roles')

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
                    <li class="breadcrumb-item active" aria-current="page">Roles</li>
                </ol>
            </nav>

            <div class="row">
                <div class="card flex-fill">
                    <div class="card-header">

                        <h5 class="card-title mb-0">Roles</h5>
                        <div class="mt-3">
                            <button type="button" class="btn btn-primary" id="createButton" data-bs-toggle="modal"
                                    data-bs-target="#roleModal">
                                Create role
                            </button>
                        </div>
                    </div>
                    <table class="table table-hover my-0 mb-3" id="rolesTable">
                        <thead>
                        <tr>
                            <th class="text-black">Name</th>
                            <th class="text-black">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($roles as $role)
                            <tr data-id="{{ $role->id }}" data-name="{{ $role->name }}">
                                <td>{{ $role->name }}</td>
                                <td>
                                    <a href="#" class="me-2" data-bs-toggle="modal" data-bs-target="#roleModal"><i
                                            class="align-middle" data-feather="edit-2"></i></a>
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#roleModalDelete"><i
                                            class="align-middle" data-feather="trash-2"></i></a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2">
                                    <p class="text-black text-center">No records to display</p>
                                </td>
                            </tr>

                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Modal Insert/Update-->
        <div class="modal fade" id="roleModal" tabindex="-1" aria-labelledby="roleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="roleModalLabel">Create Role</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <form action="#" id="roleForm">
                                <div class="mb-3 row">
                                    <div class="col-sm-12">
                                        <input type="hidden" name="id" id="id">
                                        <label class="form-label"><strong>Name*</strong></label>
                                        <input class="form-control form-control-lg" type="text" id="adminRoleName"
                                               name="name"
                                               value="" placeholder="Enter role name"/>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="saveRole">Save</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Delete-->
        <div class="modal fade" id="roleModalDelete" tabindex="-1" aria-labelledby="roleModalDelLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="roleModalDelLabel">Delete Role</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <p>Do you want delete this role ?</p>
                            <form id="deleteForm" class="form-horizontal">
                                <input type="hidden" name="id" id="deleteRoleId">
                            </form>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" id="deleteRole">Delete</button>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
@section('script')
    @parent
    <script src="{{ mix('/admin/js/pages/roles.js')}}"></script>
@endsection
