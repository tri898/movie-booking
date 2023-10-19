<div class="px-3" style="border: dashed #939ba2 1px; border-radius: 5px;">
    <div id="dropzonePreview" class="row row-cols-1 row-cols-md-1 g-4 mt-0 mb-3 dropzone-previews">
    </div>
    <div class="btn btn-lg btn-info" id="dropzoneUpload" data-bs-toggle="modal"
         data-bs-target="#dropzoneModal">Add media
    </div>
    <p class="form-text" id="textValidate">Please select png, jpg type, maximum 2MB.</p>
</div>

{{--preview--}}
<div class="table table-striped" id="previews" style="opacity: 0; visibility: hidden;">
    <div id="dropzoneTemplate" class="col">
        <!-- This is used as the file preview template -->
        <div class="preview">
            <div class="mx-auto position-relative" style="width: fit-content">
                <a class="btn-close position-absolute top-0 start-100 translate-middle badge border border-light rounded-circle bg-white text-black"
                   data-dz-remove=""> </a>
                <img class="rounded img-fluid img-thumbnail" loading="lazy" src="https://placehold.co/220x140" data-dz-thumbnail alt="preview"/>
            </div>
        </div>
        <div class="text-center text-black mx-auto d-block" style="max-width: 240px;">
            <p class="text-truncate fs-6" data-dz-name></p>
        </div>
    </div>

</div>

@pushOnce('html')
    @include('admin.layouts.components.dropzone.modal')
@endPushOnce
@pushOnce('script')
    @include('admin.layouts.components.dropzone.config')
@endPushOnce
