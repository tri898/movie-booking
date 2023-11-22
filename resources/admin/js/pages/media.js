import JustValidate from 'just-validate';
const validator  = new JustValidate('#mediaForm',{
    errorLabelCssClass: 'mt-2 form-text',
    validateBeforeSubmitting: true,
});
const previewTable = document.getElementById('previewTable');
const previewImg = document.getElementById('previewImg');
const media = document.getElementById('media');
const previewMediaName = document.getElementById('previewMediaName');
const fileName = document.getElementById('fileName');

media.onchange = evt => {
    previewTable.style.display = 'block';
    if (media.files[0] && media.files[0].type.includes('image')) {
        previewImg.src = URL.createObjectURL(media.files[0]);
    } else {
        previewTable.style.display = 'none';
    }
    previewMediaName.textContent = media.files[0].name;
    previewMediaName.href = previewImg.src;
    fileName.value = media.files[0].name.substring(0, media.files[0].name.lastIndexOf('.')) || media.files[0].name;
    console.log(media.files[0].name, fileName)
}
validator
    .addField('#fileName', [
        {
            rule: 'required',
        }
    ])
    .addField('#media', [
        {
            rule: 'minFilesCount',
            value: 1,
        },
        {
            rule: 'maxFilesCount',
            value: 1,
        },
        {
            rule: 'files',
            value: {
                files: {
                    extensions: ['jpeg', 'jpg', 'png', 'gif', 'svg', 'webp', 'txt', 'csv', 'pdf', 'mp4'],
                    maxSize: 5 * 1024 * 1024,
                    types: ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/svg+xml', 'image/webp', 'text/plain', 'text/csv', 'application/pdf', 'video/mp4'],
                },
            },
        },
    ])
    .onSuccess((event) => {
        document.getElementById("mediaForm").submit();
    });
