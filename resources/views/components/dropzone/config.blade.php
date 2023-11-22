<script>
    const notyf = new Notyf();
    const previewNode = document.querySelector("#dropzoneTemplate{{$generateRandomName()}}");
    const uploadBtn = document.getElementById('dropzoneUpload{{$generateRandomName()}}');
    previewNode.id = "";
    const previewTemplate = previewNode.parentNode.innerHTML;
    previewNode.parentNode.removeChild(previewNode);
    const textValidate = document.getElementById('textValidate{{$generateRandomName()}}');
    const formUsed = document.getElementById('{{ $formId }}');
    let myDropzone = new dropzone.Dropzone("div#myDropzone{{$generateRandomName()}}", {
        url: '{{ route('media.upload') }}',
        paramName: 'media',
        maxFilesize: {{ $maxFilesize ?? 2 }}, // MB
        maxFiles: {{ $maxFiles  ?? 1 }},
        autoProcessQueue: true,
        uploadMultiple: false,
        parallelUploads: 20,
        acceptedFiles: '{{ $acceptedFiles ?? ''}}',
        addRemoveLinks: false,
        previewsContainer: "#dropzonePreview{{$generateRandomName()}}",
        hiddenInputContainer: "body",
        thumbnailWidth: 220,
        thumbnailHeight: 140,
        previewTemplate: previewTemplate,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        init: function () {
            @php
                $media = !is_array($medias)  ? array_filter([$medias]) : $medias;
            @endphp
            @foreach($media as $item)
                let mockFile = {id: {{$item->id}}, name: '{{$item->basename }}', size: '1222'};
                let callback = null;
                let crossOrigin = '*';
                let resizeThumbnail = true;
                let url = '{{ route('media.get',$item->id) }}';
                this.files.push(mockFile);
                this.displayExistingFile(mockFile, url, callback, crossOrigin, resizeThumbnail);
            @endforeach

                uploadBtn.hidden = this.files.length >= this.options.maxFiles;
            this.on("addedfile", function (file) {
                if (this.files.length > this.options.maxFiles) {
                    this.removeFile(file);
                }
                textValidate.textContent = `Please select ${myDropzone.options.acceptedFiles} type, maximum ${myDropzone.options.maxFilesize} MB. Uploaded ${myDropzone.files.length}/${myDropzone.options.maxFiles} file(s).`;
                uploadBtn.hidden = this.files.length >= this.options.maxFiles;
                bootstrap.Modal.getOrCreateInstance(document.getElementById('dropzoneModal{{$generateRandomName()}}')).hide();
            });
            this.on("removedfile", function (file) {
                uploadBtn.hidden = this.files.length >= this.options.maxFiles;
                textValidate.textContent = `Please select ${myDropzone.options.acceptedFiles} type, maximum ${myDropzone.options.maxFilesize} MB. Uploaded ${myDropzone.files.length}/${myDropzone.options.maxFiles} file(s).`;
                let medias = formUsed.elements.namedItem('{{ $paramName }}').value;
                medias = medias.split(',');
                const index = medias.indexOf(String(file.id) );
                if (index > -1) {
                    medias.splice(index, 1);
                    formUsed.elements.namedItem('{{ $paramName }}').value = medias.join(',');
                }
                console.log(file, medias);
            });
            this.on("error", function (file, response) {
                notyf.error('Something wrong');
            });
            this.on("success", function (file, response) {
                console.log('res', response);
                let medias = formUsed.elements.namedItem('{{ $paramName }}').value;
                medias = medias.split(',').filter(Boolean);
                console.log('media', medias);
                medias.push(response)
                console.log('media push', medias);
                formUsed.elements.namedItem('{{ $paramName }}').value = medias.join(',');
                file.id = response;
            });
        },

    });

    textValidate.textContent = `Please select ${myDropzone.options.acceptedFiles} type, maximum ${myDropzone.options.maxFilesize} MB. Uploaded ${myDropzone.files.length}/${myDropzone.options.maxFiles} file(s).`;
</script>
