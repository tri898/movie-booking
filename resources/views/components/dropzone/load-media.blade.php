<script>
    let url = "{{ route('cms.media.index') }}";
    fetch(url)
        .then((response) => {
            return response.json();
        })
        .then((data) => {

        })
</script>
