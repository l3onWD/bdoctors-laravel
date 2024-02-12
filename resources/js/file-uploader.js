// VARS
const placeholder = '/img/profile-placeholder.png';

// MAIN DOM ELEMS
const fileUploaders = document.querySelectorAll('.file-uploader');

// LOGIC
fileUploaders.forEach(uploader => {

    let blobUrl = null;

    const fileInput = uploader.querySelector('.file-input');
    const imagePreview = uploader.querySelector('.image-preview');
    const videoPreview = uploader.querySelector('.video-preview');
    const fileChangeElem = uploader.querySelector('.file-change');
    const fileRemoveElem = uploader.querySelector('.file-remove');
    const fileDeleteElem = uploader.querySelector('.file-delete');

    // File preview
    const updatePreview = () => {

        if (fileInput.files[0]) {

            // Get blob
            const file = fileInput.files[0];
            blobUrl = URL.createObjectURL(file);

            // Set preview src
            if (videoPreview) {
                videoPreview.src = blobUrl;
                videoPreview.load();
                videoPreview.classList.remove('d-none');
                imagePreview.classList.add('d-none');
            } else {
                imagePreview.src = blobUrl;
            }

            // Show remove file button
            fileRemoveElem.classList.remove('d-none');

        } else {

            // Set placeholder
            imagePreview.src = placeholder;
            if (videoPreview) {
                videoPreview.src = '';
                videoPreview.classList.add('d-none');
                imagePreview.classList.remove('d-none');
            }

            // Hide remove file button
            fileRemoveElem.classList.add('d-none');
        }

        // Set delete checkbox
        fileDeleteElem.checked = false;

    };


    // Change file
    const changeFile = () => {

        // Toggle input
        fileChangeElem.classList.add('d-none');
        fileInput.classList.remove('d-none');

        // Set placeholder
        imagePreview.src = placeholder;
        if (videoPreview) {
            videoPreview.src = '';
            videoPreview.classList.add('d-none');
            imagePreview.classList.remove('d-none');
        }

        // Click file input
        fileInput.click();

        // Hide remove file button
        fileRemoveElem.classList.add('d-none');

        // Set delete checkbox
        fileDeleteElem.checked = false;
    };


    // Remove file
    const removeFile = () => {

        // Toggle input
        fileChangeElem.classList.add('d-none');
        fileInput.classList.remove('d-none');
        fileInput.value = '';

        // Set placeholder
        imagePreview.src = placeholder;
        if (videoPreview) {
            videoPreview.src = '';
            videoPreview.classList.add('d-none');
            imagePreview.classList.remove('d-none');
        }

        // Hide remove file button
        fileRemoveElem.classList.add('d-none');

        // Set delete checkbox
        fileDeleteElem.checked = true;
    }


    // Update file preview
    fileInput.addEventListener('change', updatePreview);

    // Change file
    fileChangeElem.addEventListener('click', changeFile);

    // Remove file
    fileRemoveElem.addEventListener('click', removeFile);


    // Delete blob url
    window.addEventListener('beforeunload', () => {
        if (blobUrl) URL.revokeObjectURL(blobUrl);
    });

});