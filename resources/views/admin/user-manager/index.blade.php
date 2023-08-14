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
                        @if(session('message'))
                            <div class="alert alert-success mt-3" role="alert">
                                <div class="alert-message text-wrap">
                                    {{ session('message') }}
                                </div>
                            </div>
                        @endif
                        <div class="mt-3">
                            <a href="{{route('cms.user-manager.create')}}" class="btn btn-primary">Create User
                                Manager</a>
                        </div>
                    </div>
                    <table class="table table-hover my-0">
                        <thead>
                        <tr>
                            <th>Username</th>
                            <th>Status</th>
                            <th class="d-none d-xl-table-cell">Roles</th>
                            <th class="d-none d-xl-table-cell">Created at</th>
                            <th class="d-none d-xl-table-cell">Last access</th>
                            <th class="d-none d-md-table-cell">IP access</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($admins as $admin)
                            <tr>
                                <td>{{ $admin->email }}</td>
                                <td>
                                    @if ($admin->status)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-danger">Blocked</span>
                                    @endif

                                </td>
                                <td class="d-none d-xl-table-cell">
                                    @if(!empty($admin->getRoleNames()))
                                        <ul>
                                            @foreach($admin->getRoleNames() as $role)
                                                <li>{{ $role }}</li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </td>
                                <td class="d-none d-xl-table-cell">
                                    @if ($admin->created_at)
                                        {{ Carbon\Carbon::parse($admin->created_at)->diffForHumans() }}
                                    @endif
                                </td>
                                <td class="d-none d-xl-table-cell">
                                    @if ($admin->last_login_at)
                                        {{ Carbon\Carbon::parse($admin->last_login_at)->diffForHumans() }}
                                    @endif
                                </td>
                                <td class="d-none d-md-table-cell">{{ $admin->last_login_ip }}</td>
                                <td>
                                    <a href="{{ route('cms.user-manager.edit',$admin->id) }}"><i class="align-middle" data-feather="edit-2"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="mt-3">
                        {{ $admins->links() }}
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
@section('script')
    @parent
@endsection
