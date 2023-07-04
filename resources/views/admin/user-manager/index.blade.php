@extends('admin.layouts.main')

@section('title', 'User Manager')

@section('vendor_css')
    @parent
@endsection
@section('content')
    <main class="content">
        <div class="container-fluid p-0">

            <h1 class="h3 mb-3">User Manager</h1>

            <div class="row">
                <div class="card flex-fill">
                    <div class="card-header">

                        <h5 class="card-title mb-0">Users</h5>
                        <div class="mt-3">
                            <a href="{{route('admin.user-manager.create')}}" class="btn btn-primary">Create User Manager</a>
                        </div>
                    </div>
                    <table class="table table-hover my-0">
                        <thead>
                        <tr>
                            <th>Username</th>
                            <th class="d-none d-xl-table-cell">Created at</th>
                            <th class="d-none d-xl-table-cell">Status</th>
                            <th class="d-none d-xl-table-cell">Roles</th>
                            <th class="d-none d-xl-table-cell">Last access</th>
                            <th class="d-none d-xl-table-cell">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>Project Apollo</td>
                            <td class="d-none d-xl-table-cell">01/01/2023</td>
                            <td class="d-none d-xl-table-cell">31/06/2023</td>
                            <td><span class="badge bg-success">Done</span></td>
                            <td class="d-none d-md-table-cell">Vanessa Tucker</td>
                            <td class="table-action">
                                <a href="#"><i class="align-middle" data-feather="edit-2"></i></a>
                                <a href=""><i class="align-middle" data-feather="trash"></i></a>
                                <a href=""><i class="align-middle" data-feather="eye"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td>Project Fireball</td>
                            <td class="d-none d-xl-table-cell">01/01/2023</td>
                            <td class="d-none d-xl-table-cell">31/06/2023</td>
                            <td><span class="badge bg-danger">Cancelled</span></td>
                            <td class="d-none d-md-table-cell">William Harris</td>
                            <td class="table-action">
                                <a href="#"><i class="align-middle" data-feather="edit-2"></i></a>
                                <a href=""><i class="align-middle" data-feather="trash"></i></a>
                                <a href=""><i class="align-middle" data-feather="eye"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td>Project Hades</td>
                            <td class="d-none d-xl-table-cell">01/01/2023</td>
                            <td class="d-none d-xl-table-cell">31/06/2023</td>
                            <td><span class="badge bg-success">Done</span></td>
                            <td class="d-none d-md-table-cell">Sharon Lessman</td>
                            <td class="table-action">
                                <a href="#"><i class="align-middle" data-feather="edit-2"></i></a>
                                <a href=""><i class="align-middle" data-feather="trash"></i></a>
                                <a href=""><i class="align-middle" data-feather="eye"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td>Project Nitro</td>
                            <td class="d-none d-xl-table-cell">01/01/2023</td>
                            <td class="d-none d-xl-table-cell">31/06/2023</td>
                            <td>
                                <span class="badge bg-warning">In progress</span>
                                <span class="badge bg-success">Done</span>
                            </td>
                            <td class="d-none d-md-table-cell">Vanessa Tucker</td>
                            <td class="table-action">
                                <a href="#"><i class="align-middle" data-feather="edit-2"></i></a>
                                <a href=""><i class="align-middle" data-feather="trash"></i></a>
                                <a href=""><i class="align-middle" data-feather="eye"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td>Project Phoenix</td>
                            <td class="d-none d-xl-table-cell">01/01/2023</td>
                            <td class="d-none d-xl-table-cell">31/06/2023</td>
                            <td><span class="badge bg-success">Done</span></td>
                            <td class="d-none d-md-table-cell">William Harris</td>
                        </tr>
                        <tr>
                            <td>Project X</td>
                            <td class="d-none d-xl-table-cell">01/01/2023</td>
                            <td class="d-none d-xl-table-cell">31/06/2023</td>
                            <td><span class="badge bg-success">Done</span></td>
                            <td class="d-none d-md-table-cell">Sharon Lessman</td>
                        </tr>
                        <tr>
                            <td>Project Romeo</td>
                            <td class="d-none d-xl-table-cell">01/01/2023</td>
                            <td class="d-none d-xl-table-cell">31/06/2023</td>
                            <td><span class="badge bg-success">Done</span></td>
                            <td class="d-none d-md-table-cell">Christina Mason</td>
                        </tr>
                        <tr>
                            <td>Project Wombat</td>
                            <td class="d-none d-xl-table-cell">01/01/2023</td>
                            <td class="d-none d-xl-table-cell">31/06/2023</td>
                            <td><span class="badge bg-warning">In progress</span></td>
                            <td class="d-none d-md-table-cell">William Harris</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
@endsection
@section('script')
    @parent
@endsection
