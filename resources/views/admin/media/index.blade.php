@extends('admin.layouts.main')

@section('title', 'Media')

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
                    <li class="breadcrumb-item active" aria-current="page">Media</li>
                </ol>
            </nav>

            <div class="row">
                <div class="card flex-fill">
                    <div class="card-header">

                        <h5 class="card-title mb-0">Medias</h5>
                        @if(session('message'))
                            <div class="alert alert-success mt-3" role="alert">
                                <div class="alert-message text-wrap">
                                    {{ session('message') }}
                                </div>
                            </div>
                        @endif
                        <div class="mt-3">
                            <a href="{{route('cms.media.create')}}" class="btn btn-primary">Upload Media</a>
                        </div>
                        <form action="" method="GET">
                            <div class="row mt-3">
                                <div class="col-sm-5">
                                    <div class="input-group mb-3"> <input type="text" class="form-control" placeholder="Media name" aria-label="Name"></div>

                                </div>
                                <div class="col-sm">
                                    <div class="input-group mb-3">
                                        <select class="form-select" id="inputGroupSelect01">
                                            <option>All</option>
                                            <option value="AZ">PNG</option>
                                            <option value="CO">JPG</option>
                                            <option value="ID">SVG</option>
                                            <option value="MT">GIF</option>
                                        </select>
                                        <label class="input-group-text" for="inputGroupSelect01">Type</label>
                                    </div>
                                </div>
                                <div class="col-sm">
                                    <div class="input-group mb-3">
                                        <label class="input-group-text" for="inputGroupSelect02">Published</label>
                                        <select class="form-select" id="inputGroupSelect02">
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm">
                                    <div class="input-group mb-3">
                                        <label class="input-group-text" for="inputGroupSelect02">Sort by</label>
                                        <select class="form-select" id="inputGroupSelect02">
                                            <option value="CO">Newest</option>
                                            <option value="ID">Oldest</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm">
                                    <button type="submit" class="btn btn-secondary">Search</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <table class="table table-hover my-0">
                        <thead>
                        <tr>
                            <th class="text-black">
                                <input class="form-check-input" type="checkbox"
                                       id="selectionAll" name="selectionAll"
                                       value="">
                            </th>
                            <th class="text-black">Thumbnail</th>
                            <th class="text-black">Media Name</th>
                            <th class="d-none d-xl-table-cell text-black">Directory</th>
                            <th class="d-none d-xl-table-cell text-black">Type</th>
                            <th class="d-none d-xl-table-cell text-black">Published</th>
                            <th class="d-none d-xl-table-cell text-black">Created</th>
                            <th class="text-black">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($medias as $media)
                            <tr>
                                <td>
                                    <input class="form-check-input" type="checkbox"
                                           id="selection" name="selection[]"
                                           value="{{ $media->id }}">
                                </td>
                                <td>
                                    @if($media->aggregate_type == 'image' && $media->hasVariant('thumbnail') )
                                        <img
                                            src="{{ $media->findVariant('thumbnail')->getUrl() }}"
                                            class="rounded img-fluid img-thumbnail" style="max-width: 100px;"
                                            alt="{{ $media->filename}}">
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ $media->getUrl() }}"
                                       target="_blank">{{$media->basename}}</a>
                                </td>
                                <td class="d-none d-xl-table-cell">{{ $media->directory }}</td>
                                <td class="d-none d-xl-table-cell">{{ $media->aggregate_type }}</td>
                                <td class="d-none d-xl-table-cell">
                                    @if($media->isPubliclyAccessible())
                                        Yes
                                    @else
                                        No
                                    @endif
                                </td>
                                <td class="d-none d-xl-table-cell">{{ $media->created_at }}</td>
                                <td>
                                    <a href="{{ route('entity.delete.confirm',['media', $media->id]) }}"><i
                                            class="align-middle" data-feather="trash-2"></i></a>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                    <div class="mt-3">
                        {{ $medias->links() }}
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
@section('script')
    @parent
    <script>
        const selectionAll = document.getElementById('selectionAll');
        const selection = document.getElementsByName('selection[]');
        selectionAll.addEventListener('change', function() {
            console.log(selection)
            for (let i = 0; i < selection.length; i++) {
                selection[i].checked = this.checked;
            }
        });
    </script>
@endsection
