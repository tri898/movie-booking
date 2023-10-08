@extends('admin.layouts.main')

@section('title', 'Welcome')

@section('vendor_css')
@parent
@endsection
@section('content')
    <main class="content">

    </main>
@endsection
@section('script')
<script src="{{ mix('/admin/js/app.js') }}"></script>
@endsection
