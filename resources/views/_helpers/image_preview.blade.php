<script>
    function previewThumb(fileInput, _target_el) {
        const previewContainer = document.getElementById(_target_el);
        const file = fileInput.files[0];
        console.log(file);
        if (file) {
            const reader = new FileReader();
            reader.addEventListener('load', () => {
                const previewElement = document.createElement('div');
                previewElement.className = 'video-preview';
                if (file.type.startsWith('image/')) {
                    const imgElement = document.createElement('img');
                    imgElement.src = reader.result;
                    imgElement.alt = 'Image Preview';
                    previewElement.appendChild(imgElement);
                } else if (file.type.startsWith('video/')) {
                    const videoElement = document.createElement('video');
                    videoElement.src = reader.result;
                    videoElement.alt = 'Video Preview';
                    videoElement.controls = true;
                    previewElement.appendChild(videoElement);
                    videoElement.style.cssText = "max-width:200px;max-height:200px"
                }

                previewContainer.innerHTML = '';
                previewContainer.appendChild(previewElement);
                previewContainer.style.display = "block"
            });
            reader.readAsDataURL(file);
        }
    }

    function resetImage(id) {
        const input_el = document.getElementById('{{$name}}');
        const target_el = document.getElementById(id || "featured-thumb");
        input_el.value = "";
        target_el.style.display = "none";
    }

</script>
