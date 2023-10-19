<script>
    const notyf = new Notyf();
    const modal = bootstrap.Modal.getOrCreateInstance(document.getElementById('dropzoneModal'));
    const previewNode = document.querySelector("#dropzoneTemplate");
    const uploadBtn = document.getElementById('dropzoneUpload');
    previewNode.id = "";
    const previewTemplate = previewNode.parentNode.innerHTML;
    previewNode.parentNode.removeChild(previewNode);
    const textValidate = document.getElementById('textValidate');
    const formUsed = document.getElementById('{{ $formId }}');


    let myDropzone = new dropzone.Dropzone("div#my-dropzone", {
        url: formUsed.getAttribute('action') ?? '/',
        paramName: '{{ $paramName ?? 'media' }}',
        maxFilesize: {{ $maxFilesize ?? 2 }}, // MB
        maxFiles: {{ $maxFiles ?? 2 }},
        autoProcessQueue: true,
        uploadMultiple: true,
        parallelUploads: 20,
        acceptedFiles: '{{ $acceptedFiles ?? ''}}',
        addRemoveLinks: false,
        previewsContainer: "#dropzonePreview",
        hiddenInputContainer: "body",
        thumbnailWidth: 220,
        thumbnailHeight: 140,
        previewTemplate: previewTemplate,
        headers: {
            'X-CSRF-TOKEN':document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        init: function () {
            var images = [
                {name: "image_1.jpg", url: "https://picsum.photos/200/300/?blur", size: "12345"},
                {name: "image_2.jpg", url: "https://picsum.photos/seed/picsum/200/300", size: "12345"},
                {name: "image_2.jpg", url: "https://picsum.photos/200/300?grayscale", size: "12345"},
            ]

            for (let i = 0; i < images.length; i++) {
                // And optionally show the thumbnail of the file:
                let mockFile = {name: images[i].name, size: 12345};
                let callback = null; // Optional callback when it's done
                let crossOrigin = '*'; // Added to the `img` tag for crossOrigin handling
                let resizeThumbnail = true; // Tells Dropzone whether it should resize the image first
                let url = images[i].url;
                this.files.push(mockFile);
                this.displayExistingFile(mockFile, url, callback, crossOrigin, resizeThumbnail);
            }
            uploadBtn.hidden = this.files.length >= this.options.maxFiles;
            this.on("addedfile", function (file) {
                if (this.files.length > this.options.maxFiles) {
                    this.removeFile(file);
                }
                textValidate.textContent = `Please select ${myDropzone.options.acceptedFiles} type, maximum ${myDropzone.options.maxFilesize} MB. Uploaded ${myDropzone.files.length}/${myDropzone.options.maxFiles} file(s).`;
                uploadBtn.hidden = this.files.length >= this.options.maxFiles;
                modal.hide();
            });
            this.on("removedfile", function (file) {
                uploadBtn.hidden = this.files.length >= this.options.maxFiles;
                textValidate.textContent = `Please select ${myDropzone.options.acceptedFiles} type, maximum ${myDropzone.options.maxFilesize} MB. Uploaded ${myDropzone.files.length}/${myDropzone.options.maxFiles} file(s).`;
            });
            this.on("error", function (file, response) {
                this.removeFile(file);
                notyf.error(response);
                console.log(response)
            });
            this.on("sending", function(file, xhr, formData) {
                formData = new FormData(formUsed);
                console.log(formData)
            });
        },

    });


    textValidate.textContent = `Please select ${myDropzone.options.acceptedFiles} type, maximum ${myDropzone.options.maxFilesize} MB. Uploaded ${myDropzone.files.length}/${myDropzone.options.maxFiles} file(s).`;

</script>
