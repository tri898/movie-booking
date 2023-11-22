@extends('admin.layouts.main')

@section('title', 'Confirm delete ' . $model->$display_name)

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
                    <li class="breadcrumb-item active" aria-current="page">Delete</li>
                    <li class="breadcrumb-item active" aria-current="page">Confirm</li>
                </ol>
            </nav>

            <div class="row">
                <div class="card flex-fill">
                    <div class="card-header">

                        <h5 class="card-title mb-0">Are you sure you want to delete {{ $entity }} {{ $model->$display_name }}?</h5>
                        @if(session('message'))
                            <div class="alert alert-success mt-3" role="alert">
                                <div class="alert-message text-wrap">
                                    {{ session('message') }}
                                </div>
                            </div>
                        @endif
                        <div class="m-3">
                            <form action="{{route('cms.'. $entity . '.destroy', $id)}}" style="display: inline;" method="POST">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-primary">Delete</button>
                            </form>
                            <a href="{{route('cms.'. $entity . '.index')}}" class="btn btn-danger">Cancel</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
@section('script')
    @parent
@endsection
