@extends('admin.layouts.main')

@section('title', 'User Manager')

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
                    <li class="breadcrumb-item active" aria-current="page">User Manager</li>
                </ol>
            </nav>

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
                            <th class="text-black">Email</th>
                            <th class="text-black">Status</th>
                            <th class="d-none d-xl-table-cell text-black">Roles</th>
                            <th class="d-none d-xl-table-cell text-black">Created at</th>
                            <th class="d-none d-xl-table-cell text-black">Last access</th>
                            <th class="d-none d-md-table-cell text-black">IP access</th>
                            <th class="text-black">Actions</th>
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
                                    <a href="{{ route('cms.user-manager.edit',$admin->id) }}"><i class="align-middle"
                                                                                                 data-feather="edit-2"></i></a>
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
