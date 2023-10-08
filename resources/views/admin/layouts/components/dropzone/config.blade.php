<script>
    const notyf = new Notyf();
    const modal = bootstrap.Modal.getOrCreateInstance(document.getElementById('dropzoneModal'));
    const previewNode = document.querySelector("#dropzoneTemplate");
    previewNode.id = "";
    const previewTemplate = previewNode.parentNode.innerHTML;
    previewNode.parentNode.removeChild(previewNode);

    let myDropzone = new dropzone.Dropzone("div#my-dropzone", {
        url: `{{ route('admin.welcome.index') }}`,
        paramName: "media",
        maxFilesize: 2, // MB
        maxFiles: 3,
        autoProcessQueue: false,
        uploadMultiple: true,
        parallelUploads: 100,
        // acceptedFiles: '',
        addRemoveLinks: false,
        previewsContainer: "#dropzonePreview",
        hiddenInputContainer: "body",
        thumbnailWidth: 220,
        thumbnailHeight: 140,
        previewTemplate: previewTemplate,
        init: function() {
            this.on("addedfile", function(file) {
                console.log(file);
                modal.hide();
            });
            this.on("error", function(file, response) {
                notyf.error(response);
                file.previewElement.remove();
            });
        },

    });
</script>
