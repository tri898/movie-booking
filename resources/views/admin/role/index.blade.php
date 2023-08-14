@extends('admin.layouts.main')

@section('title', 'Roles')

@section('vendor_css')
    @parent
@endsection
@section('content')
    <main class="content">
        <div class="container-fluid p-0">
            <h1 class="h3 mb-3">Roles</h1>

            <div class="row">
                <div class="card flex-fill">
                    <div class="card-header">

                        <h5 class="card-title mb-0">Roles</h5>
                        <div class="mt-3">
                            <button type="button" class="btn btn-primary" id="createButton" data-bs-toggle="modal" data-bs-target="#roleModal">
                                Create role
                            </button>
                        </div>
                    </div>
                    <table class="table table-hover my-0" id="rolesTable">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($roles as $role)
                            <tr data-id="{{ $role->id }}" data-name="{{ $role->name }}">
                                <td>{{ $role->name }}</td>
                                <td>
                                    <a href="#" class="me-2" data-bs-toggle="modal" data-bs-target="#roleModal"><i class="align-middle" data-feather="edit-2"></i></a>
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#roleModalDelete"><i class="align-middle" data-feather="trash-2"></i></a>
                                </td>
                            </tr>
                        @endforeach
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
        <div class="modal fade" id="roleModalDelete" tabindex="-1" aria-labelledby="roleModalDelLabel" aria-hidden="true">
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
