@extends('admin.layouts.main')

@section('title', 'Media | Create')

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
                            href="{{ route('cms.media.index') }}">Media</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Upload</li>
                </ol>
            </nav>

            <div class="row">

                <div class="card flex-fill">
                    <div class="card-header">
                        <h5 class="card-title mb-3">New Media</h5>
                        @if ($errors->any())
                            <div class="alert alert-warning" role="alert">
                                @foreach ($errors->all() as $error)
                                    <div class="alert-message text-wrap">
                                        {{ $error }}
                                    </div>
                                @endforeach
                            </div>
                        @endif
                        <form action="{{ route('cms.media.store') }}" method="POST" id="mediaForm" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <label class="form-label"><strong>Name*</strong></label>
                                            <input class="form-control form-control-lg" type="text" id="fileName"
                                                   name="fileName"
                                                   value="{{ old('fileName') }}" placeholder="Enter media name"/>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 mt-3">
                                            <label class="form-label"><strong>Media*</strong></label>
                                            <p class="text-sm">Upload several png, jpg, jpeg, gif, webp, svg, csv, txt, pdf, mp4 files with max size
                                                5MBs</p>
                                            <table class="mb-3" id="previewTable" style="display: none;">
                                                <tr>
                                                    <td><img id="previewImg" src="" alt="preview" width="110"></td>
                                                    <td class="p-3"><a href="" target="_blank" id="previewMediaName"></a></td>
                                                </tr>
                                            </table>
                                            <input class="form-control form-control-lg" type="file" id="media"
                                                   name="media">
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

@endsection
@section('script')
    @parent
    <script src="{{ mix('/admin/js/pages/media.js')}}"></script>
@endsection
