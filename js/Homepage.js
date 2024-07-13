document.addEventListener('DOMContentLoaded', (event) => {
    const uploadButton = document.getElementById('imageUpload');
    const imagePreview = document.getElementById('imagePreview');

    uploadButton.addEventListener('change', () => {
        const file = uploadButton.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = (e) => {
                imagePreview.src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });
});

