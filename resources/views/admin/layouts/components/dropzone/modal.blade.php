<div class="modal fade" id="dropzoneModal" tabindex="-1" aria-labelledby="dropzoneModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bg-white">
            <div class="modal-header">
                <h5 class="modal-title" id="dropzoneModalDelLabel">Add or select media</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                        <div class="row">
                            <form action="/">
                                <div id="my-dropzone" class="dropzone p-4" style="border: dashed #939ba2 1px; border-radius: 5px;"></div>
                            </form>
                        </div>
                        <h5 class="card-title mt-3 mb-3">Select existed media</h5>
                        <div class="row g-3">
                            <div class="col-sm-5">
                                <input type="text" class="form-control" placeholder="Media name" aria-label="Name">
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
                                    <label class="input-group-text" for="inputGroupSelect02">Sort by</label>
                                    <select class="form-select" id="inputGroupSelect02">
                                        <option value="CO">Newest</option>
                                        <option value="ID">Oldest</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-4 mt-3 mb-3 overflow-auto vh-50">
                            <div class="col">
                                <img src="https://demo.adminkit.io/img/avatars/avatar.jpg"
                                     class="rounded img-fluid img-thumbnail float-start" alt="...">
                            </div>
                            <div class="col">
                                <img src="https://demo.adminkit.io/img/avatars/avatar.jpg"
                                     class="rounded img-fluid img-thumbnail float-start" alt="...">
                            </div>
                            <div class="col">
                                <img src="https://demo.adminkit.io/img/avatars/avatar.jpg"
                                     class="rounded img-fluid img-thumbnail float-start" alt="...">
                            </div>
                            <div class="col">
                                <img src="https://demo.adminkit.io/img/avatars/avatar.jpg"
                                     class="rounded img-fluid img-thumbnail float-start" alt="...">
                            </div>
                            <div class="col">
                                <img src="https://demo.adminkit.io/img/avatars/avatar.jpg"
                                     class="rounded img-fluid img-thumbnail float-start" alt="...">
                            </div>
                            <div class="col">
                                <img src="https://demo.adminkit.io/img/avatars/avatar.jpg"
                                     class="rounded img-fluid img-thumbnail float-start" alt="...">
                            </div>
                            <div class="col">
                                <img src="https://demo.adminkit.io/img/avatars/avatar.jpg"
                                     class="rounded img-fluid img-thumbnail float-start" alt="...">
                            </div>
                            <div class="col">
                                <img src="https://demo.adminkit.io/img/avatars/avatar.jpg"
                                     class="rounded img-fluid img-thumbnail float-start" alt="...">
                            </div>
                            <div class="col">
                                <img src="https://demo.adminkit.io/img/avatars/avatar.jpg"
                                     class="rounded img-fluid img-thumbnail float-start" alt="...">
                            </div>
                            <div class="col">
                                <img src="https://demo.adminkit.io/img/avatars/avatar.jpg"
                                     class="rounded img-fluid img-thumbnail float-start" alt="...">
                            </div>
                            <div class="col">
                                <img src="https://demo.adminkit.io/img/avatars/avatar.jpg"
                                     class="rounded img-fluid img-thumbnail float-start" alt="...">
                            </div>
                            <div class="col">
                                <img src="https://demo.adminkit.io/img/avatars/avatar.jpg"
                                     class="rounded img-fluid img-thumbnail float-start" alt="...">
                            </div>
                            <div class="col">
                                <img src="https://demo.adminkit.io/img/avatars/avatar.jpg"
                                     class="rounded img-fluid img-thumbnail float-start" alt="...">
                            </div>
                            <div class="col">
                                <img src="https://demo.adminkit.io/img/avatars/avatar.jpg"
                                     class="rounded img-fluid img-thumbnail float-start" alt="...">
                            </div>
                            <div class="col">
                                <img src="https://demo.adminkit.io/img/avatars/avatar.jpg"
                                     class="rounded-3 img-fluid img-thumbnail float-start" alt="...">
                            </div>
                            <div class="col">
                                <img src="https://demo.adminkit.io/img/avatars/avatar.jpg"
                                     class="rounded-3 img-fluid img-thumbnail float-start" alt="...">
                            </div>
                        </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="deleteRole">Insert selected</button>
            </div>
        </div>
    </div>
</div>

