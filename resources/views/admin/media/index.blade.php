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
                                <div class="col-sm-3">
                                    <div class="input-group mb-3">
                                        <input type="text" name="file_name"
                                               value="{{ old('', request()->get('file_name')) }}" class="form-control"
                                               placeholder="Media name" aria-label="Name"></div>

                                </div>
                                <div class="col-sm-3">
                                    <div class="input-group mb-3">
                                        <select class="form-select" id="aggregate_type" name="aggregate_type">
                                            <option value="">All</option>
                                            <option
                                                value="image" @selected(request()->get('aggregate_type') == 'image')>
                                                Image (jpg, jpeg, png, gif)
                                            </option>
                                            <option
                                                value="vector" @selected(request()->get('aggregate_type') == 'vector')>
                                                Vector (svg)
                                            </option>
                                            <option value="pdf" @selected(request()->get('aggregate_type') == 'pdf')>
                                                PDF
                                            </option>
                                            <option
                                                value="video" @selected(request()->get('aggregate_type') == 'video')>
                                                Video (mp4)
                                            </option>
                                            <option
                                                value="document" @selected(request()->get('aggregate_type') == 'document')>
                                                Document (csv, txt)
                                            </option>
                                            <option
                                                value="spreadsheet" @selected(request()->get('aggregate_type') == 'spreadsheet')>
                                                Spreadsheet (xlsx, xls)
                                            </option>
                                            <option
                                                value="presentation" @selected(request()->get('aggregate_type') == 'presentation')>
                                                Presentation (pptx, ppt)
                                            </option>
                                        </select>
                                        <label class="input-group-text" for="aggregate_type">Aggregate Type</label>
                                    </div>
                                </div>
                                <div class="col-sm">
                                    <div class="input-group mb-3">
                                        <label class="input-group-text" for="inputGroupSelect02">Sort by</label>
                                        <select class="form-select" name="sort_order" id="sort_order">
                                            <option value="desc">Newest</option>
                                            <option value="asc" @selected(request()->get('sort_order') == 'asc')>
                                                Oldest
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm mb-3">
                                    <button type="submit" class="btn btn-secondary">Search</button>
                                    <a href="{{ route('cms.media.index') }}" class="btn btn-outline-danger">Reset</a>
                                </div>
                            </div>
                        </form>

                        <div class="dropdown">
                            <a class="btn btn-outline-secondary dropdown-toggle" href="#" role="button"
                               id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                Action selected items
                            </a>

                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <li><a class="dropdown-item" id="selectionDelete" href="#"
                                       onClick="redirectAction(this.id)">Delete</a></li>
                                <li><a class="dropdown-item" href="#">Publish</a></li>
                                <li><a class="dropdown-item" href="#">Unpublished</a></li>
                            </ul>
                        </div>
                    </div>
                    <table class="table table-hover my-0">
                        <thead>
                        <tr>
                            <th class="d-none d-xl-table-cell">
                                <input class="form-check-input" type="checkbox"
                                       id="selectionAll" name="selectionAll"
                                       value="">
                            </th>
                            <th class="text-black">Thumbnail</th>
                            <th class="text-black">Media Name</th>
                            <th class="d-none d-xl-table-cell text-black">Directory</th>
                            <th class="d-none d-xl-table-cell text-black">Aggregate Type</th>
                            <th class="d-none d-xl-table-cell text-black">Published</th>
                            <th class="d-none d-xl-table-cell text-black">Created</th>
                            <th class="text-black">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($medias as $media)
                            <tr>
                                <td class="d-none d-xl-table-cell">
                                    <input class="form-check-input" type="checkbox"
                                           id="selection" name="selection[]"
                                           value="{{ $media->id }}">
                                </td>
                                <td>
                                    @if($media->aggregate_type == 'image' && $media->hasVariant('thumbnail') )
                                        <img
                                            src="{{ $media->findVariant('thumbnail')->getUrl() }}"
                                            class="rounded img-fluid img-thumbnail" style="max-width: 100px;"
                                            alt="{{ $media->filename }}">
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ $media->getUrl() }}" class="text-truncate"
                                       target="_blank">{{ $media->basename }}</a>
                                    ({{ round($media->size / 1024, 2) }} KB)
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
                        @empty
                            <tr>
                                <td colspan="8" class="text-sm-center">No media</td>
                            </tr>
                        @endforelse

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
        const selections = document.getElementsByName('selection[]');
        const selectionDelete = document.getElementById('selectionDelete');

        selectionAll.addEventListener('change', function () {
            for (let i = 0; i < selections.length; i++) {
                selections[i].checked = this.checked;
            }
        });

        function redirectAction(buttonID) {
            let selected = document.querySelectorAll('input[name="selection[]"]:checked');
            let ids = [];

            selected.forEach((item) => {
                ids.push(item.value);
            });
            if (ids.length === 0) {
                return;
            }

            switch (buttonID) {
                case 'selectionDelete':
                    window.location.replace("{{ route('entity.delete.confirm',['media', ':id']) }}".replace(':id', ids.join(',')));
                    break;
            }
        }


    </script>
@endsection
