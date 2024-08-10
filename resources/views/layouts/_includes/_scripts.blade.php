<!-- Core JS -->
<script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
<script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>

<script src="{{ asset('assets/vendor/js/menu.js') }}"></script>


<!-- Main JS -->
<script src="{{ asset('assets/js/main.js') }}"></script>

<!-- Page JS -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>

<script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="//cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>

@if (Session::has('success') || Session::has('error'))
    <script>
        Swal.fire({
            toast: true,
            position: 'top-end',
            timer: 3500,
            timerProgressBar: true,
            icon: '{{ session('success') ? 'success' : 'error' }}',
            title: '{{ session('success') ?? session('error') }}',
            showConfirmButton: false,
        })
    </script>
@endif


<style>
    .image-modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.9);
        justify-content: center;
        align-items: center;
        z-index: 999999
    }

    .modal-content {
        min-height: 400px;
        position: relative;
        max-width: 80%;
        max-height: 80%;
    }

    .modal-image {
        width: 100%;
        height: 100%;
        object-fit: contain;
    }

    .gallerclose-btn {
        position: absolute;
        top: -65px;
        right: 10px;
        font-size: 54px;
        color: #fff !important;
        background-color: #b9b9b9a1;
        cursor: pointer;
        border-radius: 50%;
        padding: 20px;
        line-height: 15px;
    }

    .galler-btn {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        font-size: 54px;
        color: #fff !important;
        background-color: #b9b9b9a1;
        cursor: pointer;
        border-radius: 50%;
        padding: 20px;
        line-height: 15px;
    }

    .prev-btn {
        left: -65px;
    }

    .next-btn {
        right: -65px;
    }

    .multi-select-container {
        box-shadow: 0px 0px 8px 1px #ccc;
        border: 1px solid #d2d2d2;
        height: 200px;
        overflow-y: scroll;
        width: 90%;
    }
</style>


<div class="image-modal" id="imageModal">
    <div class="modal-content">
        <span class="gallerclose-btn" onclick="closeModal()">&times;</span>
        <a class="galler-btn prev-btn" onclick="changeImage(-1)">&#8249;</a>
        <img class="modal-image" id="modalImage">
        <a class="galler-btn next-btn" onclick="changeImage(1)">&#8250;</a>
    </div>
</div>

<script>
    var currentImageIndex = 0;
    var images = [];

    console.log(images)

    $(document).on("click", ".image-thumbnail", function(e) {
        var imageListElement = document.getElementsByClassName('image-thumbnail');
        console.log(images)
        images = [];
        for (var i = 0; i < imageListElement.length; i++) {
            images.push(imageListElement[i].src);
        }
        currentImageIndex = images.indexOf(e.target.src);;
        document.getElementById('modalImage').src = e.target.src;
        document.getElementById('imageModal').style.display = 'flex';
    })

    function closeModal() {
        document.getElementById('imageModal').style.display = 'none';
    }

    function changeImage(offset) {
        currentImageIndex += offset;

        // Loop back to the first image if at the end
        if (currentImageIndex >= images.length) {
            currentImageIndex = 0;
        }

        // Loop to the last image if at the beginning
        if (currentImageIndex < 0) {
            currentImageIndex = images.length - 1;
        }

        var nextImageSrc = images[currentImageIndex];
        document.getElementById('modalImage').src = nextImageSrc;
    }
</script>


@stack('custom_js')

</body>

</html>
