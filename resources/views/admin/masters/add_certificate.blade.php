<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Alex+Brush&family=Dancing+Script:wght@600&family=Great+Vibes&family=Montserrat:wght@500;600;700;800&display=swap" rel="stylesheet">

<style>
#signature-pad {
    width: 100%;
    height: 200px;
}

/* New Category Tree Styles */
.category-tree-container {
    border: 1px solid #ced4da;
    border-radius: 0.375rem;
    padding: 15px;
    height: 300px;
    overflow-y: auto;
    background-color: #fff;
}
.category-tree-container ul {
    list-style-type: none;
    padding-left: 20px;
}
.category-tree-container > ul {
    padding-left: 0; /* Remove padding for root level */
}
.category-tree-container li {
    margin: 5px 0;
    display: flex;
    align-items: flex-start;
}
.category-tree-container label {
    margin-bottom: 0;
    font-weight: 400;
    cursor: pointer;
    margin-left: 5px;
    color: #0056b3; /* Match the blue link color from your image */
}
.category-tree-container input[type="radio"] {
    margin-top: 4px;
    cursor: pointer;
}
.folder-icon {
    color: #555;
    margin-right: 5px;
    margin-top: 4px;
}
</style>

<div class="tab-pane fade {{ request()->query('tab') == 5 ? 'show active' : '' }}" id="certificate" role="tabpanel" aria-labelledby="certificate-tab">
    <div class="col-12 col-sm-12">
        <div class="row">
            <!-- Header Section -->
            <div class="col-12">
                <div class="py-2">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <label class="mb-0 d-flex align-items-center font-weight-bold">
                                <i class="fa-solid fa-plus headings-icon mr-2"></i>Add Certificate
                            </label>
                        </div>
                        <div>
                            <a href="{{ url('masters?tab=6') }}" class="btn web-btn">
                                <i class="fa-solid fa-eye btnn-icon mr-1"></i>View Certificate
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Form Wrapper -->
            <div class="col-12">
                <div class="bg-white p-3 rounded-3 shadow-sm">
                    <form action="{{ url('store_certificates') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <!-- Left Column: Certificate Details, Templates & Signatures -->
                            <div class="col-12 col-md-6 col-lg-7">

                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">
                                        Select Category<span class="text-danger">*</span>
                                    </label>

                                    <div class="col-sm-9">
                                        <select
                                            class="js-example-basic-single form-select-control"
                                            id="category_id"
                                            name="category_id"
                                            required
                                        >
                                            <option value="">Select a Category</option>

                                            @foreach($category_list ?? [] as $category)
                                                <option
                                                    value="{{ $category->id }}"
                                                    data-parent-id="{{ $category->parent_id ?? '' }}"
                                                    data-category-name="{{ $category->category_name }}"
                                                    @if(old('category_id') == $category->id)
                                                        selected
                                                    @endif
                                                >
                                                    {{ $category->category_name }}
                                                </option>
                                            @endforeach
                                        </select>

                                        {{-- This will contain the SKI CECO parent ID --}}
                                        <input type="hidden" name="parent_id" id="parent_id" value="{{ old('parent_id') }}">
                                    </div>
                                </div>



                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Certificate Name<span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" placeholder="" name="certificate_name" required />
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Description</label>
                                    <div class="col-sm-9">
                                        <textarea id="editor1" name="code">{{ $courses_id->description ?? '' }}</textarea>
                                    </div>
                                </div>

                                <div class="form-group row mt-3">
                                    <label class="col-sm-3 col-form-label">Select Certificate Template<span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <div class="row">
                                            <div class="col-6 col-lg-6">
                                                <div>
                                                    <img src="{{ asset('public/images/certificate.png') }}" alt="" class="img-fluid d-none d-lg-block">
                                                </div>
                                                <div class="pt-2 text-center">
                                                    <input type="radio" id="template_id" name="template_id" value="1" required>
                                                    <label class="pl-2">Select</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Signature Type</label>

                                    <div class="col-sm-9 pt-2">
                                        <label>
                                            <input type="radio" name="type" value="1" {{ old('type', '1') == '1' ? 'checked' : '' }}>
                                            Upload
                                        </label>

                                        <label class="ml-3">
                                            <input type="radio" name="type" value="2" {{ old('type') == '2' ? 'checked' : '' }}>
                                            Draw
                                        </label>

                                        <label class="ml-3">
                                            <input type="radio" name="type" value="3" {{ old('type') == '3' ? 'checked' : '' }}>
                                            Input
                                        </label>
                                    </div>
                                </div>


                                <!-- ========================================================= -->
                                <!-- UPLOAD SIGNATURE -->
                                <!-- ========================================================= -->

                                <div class="form-group row" id="upload_signature">

                                    <label class="col-sm-3 col-form-label">
                                        Signature Image
                                    </label>

                                    <div class="col-sm-9">

                                        <input
                                            type="file"
                                            class="form-control"
                                            name="signature_image"
                                            id="signature_image"
                                            accept="image/*"
                                        >

                                    </div>
                                </div>


                                <!-- ========================================================= -->
                                <!-- DRAW SIGNATURE -->
                                <!-- ========================================================= -->

                                <div class="form-group row d-none" id="draw_signature">

                                    <label class="col-sm-3 col-form-label">
                                        Draw Signature
                                    </label>

                                    <div class="col-sm-9">

                                        <canvas
                                            id="signature-pad"
                                            class="border rounded"
                                            style="width:100%; height:80px;">
                                        </canvas>

                                        <button
                                            type="button"
                                            id="clear-signature"
                                            class="btn btn-sm btn-danger mt-2">
                                            Clear
                                        </button>

                                    </div>
                                </div>


                                <!-- ========================================================= -->
                                <!-- INPUT SIGNATURE -->
                                <!-- ========================================================= -->

                                <div class="form-group row d-none" id="input_signature">

                                    <label class="col-sm-3 col-form-label">
                                        Signer Details
                                    </label>

                                    <div class="col-sm-9">
                                        <div class="row g-2">
                                            <div class="col-md-6 mb-2">
                                                <label class="form-label text-muted font-smallsize mb-1">
                                                    Signer Full Name <span class="text-danger">*</span>
                                                </label>
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    id="signature_name"
                                                    placeholder="e.g. Sai Puneeth Jella"
                                                    disabled
                                                >
                                            </div>
                                            <div class="col-md-6 mb-2">
                                                <label class="form-label text-muted font-smallsize mb-1">
                                                    Designation / Role (Optional)
                                                </label>
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    id="signature_designation"
                                                    placeholder="e.g. Asst. Manager"
                                                    disabled
                                                >
                                            </div>
                                        </div>

                                        <div class="mt-2">
                                            <label class="form-label text-muted font-smallsize mb-1">
                                                <i class="fa-solid fa-signature text-teal me-1" style="color: #008080;"></i> Generated Signature Stamp Preview:
                                            </label>

                                            <div class="p-3 border rounded bg-white text-center shadow-sm" style="min-height: 180px; display: flex; align-items: center; justify-content: center;">
                                                <canvas
                                                    id="typed-signature-pad"
                                                    class="border rounded"
                                                    style="width:100%; max-width:440px; height:160px; background-color: transparent;">
                                                </canvas>
                                            </div>
                                            <small class="text-muted font-smallsize d-block mt-1">
                                                <i class="fa-solid fa-circle-info text-teal me-1" style="color: #008080;"></i>
                                                Combines cursive handwritten script, horizontal line, capitalized printed name, and designation into an official certificate signature stamp.
                                            </small>
                                        </div>

                                        <button
                                            type="button"
                                            id="clear-typed-signature"
                                            class="btn btn-sm btn-danger mt-2">
                                            <i class="fa-solid fa-trash me-1"></i> Clear
                                        </button>

                                    </div>
                                </div>


                                <!-- ========================================================= -->
                                <!-- ONLY ONE HIDDEN INPUT -->
                                <!-- ========================================================= -->

                                <input
                                    type="hidden"
                                    name="signature_drawn"
                                    id="signature_drawn_hidden"
                                    disabled
                                >


                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="mt-4 text-center border-top pt-3">
                            <button type="submit" class="btn sbmt-btn px-4">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('public/plugins/ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('public/plugins/ckfinder/ckfinder.js') }}"></script>

<script>
    if (document.getElementById('editor1')) {
        CKEDITOR.replace('editor1');
    }
</script>

{{-- Signature Pad Scripts --}}
<script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>

<script>
    $(document).ready(function () {

        const canvas = document.getElementById('signature-pad');
        const typedCanvas = document.getElementById('typed-signature-pad');

        const signaturePad = new SignaturePad(canvas);

        const hiddenSignature = $('#signature_drawn_hidden');
        const signatureName = $('#signature_name');
        const signatureDesignation = $('#signature_designation');
        const signatureImage = $('#signature_image');


        /*
        |--------------------------------------------------------------------------
        | DRAW SIGNATURE - RESIZE
        |--------------------------------------------------------------------------
        */

        function resizeCanvas() {

            const ratio = Math.max(
                window.devicePixelRatio || 1,
                1
            );

            const width = canvas.offsetWidth;
            const height = 100;

            canvas.width = width * ratio;
            canvas.height = height * ratio;

            canvas.getContext('2d').setTransform(
                ratio,
                0,
                0,
                ratio,
                0,
                0
            );

            signaturePad.clear();
            hiddenSignature.val('');
        }


        /*
        |--------------------------------------------------------------------------
        | CROP DRAWN / TYPED SIGNATURE
        |--------------------------------------------------------------------------
        */

        function trimCanvas(canvas) {

            const ctx = canvas.getContext('2d');

            const imageData = ctx.getImageData(
                0,
                0,
                canvas.width,
                canvas.height
            );

            const pixels = imageData.data;

            let minX = canvas.width;
            let minY = canvas.height;
            let maxX = -1;
            let maxY = -1;

            for (let y = 0; y < canvas.height; y++) {

                for (let x = 0; x < canvas.width; x++) {

                    const index =
                        (y * canvas.width + x) * 4;

                    const alpha =
                        pixels[index + 3];

                    if (alpha > 0) {

                        if (x < minX) minX = x;
                        if (y < minY) minY = y;
                        if (x > maxX) maxX = x;
                        if (y > maxY) maxY = y;
                    }
                }
            }

            if (maxX === -1) {
                return null;
            }

            const padding = 6;

            minX = Math.max(0, minX - padding);
            minY = Math.max(0, minY - padding);

            maxX = Math.min(
                canvas.width - 1,
                maxX + padding
            );

            maxY = Math.min(
                canvas.height - 1,
                maxY + padding
            );

            const width = maxX - minX + 1;
            const height = maxY - minY + 1;

            const croppedCanvas =
                document.createElement('canvas');

            croppedCanvas.width = width;
            croppedCanvas.height = height;

            const croppedCtx =
                croppedCanvas.getContext('2d');

            croppedCtx.putImageData(
                ctx.getImageData(
                    minX,
                    minY,
                    width,
                    height
                ),
                0,
                0
            );

            return croppedCanvas.toDataURL('image/png');
        }


        /*
        |--------------------------------------------------------------------------
        | INPUT SIGNATURE STAMP RENDERING
        |--------------------------------------------------------------------------
        */

        const typedCtx =
            typedCanvas.getContext('2d');


        function resizeTypedCanvas() {

            const ratio = Math.max(
                window.devicePixelRatio || 1,
                1
            );

            const width = typedCanvas.offsetWidth || 440;
            const height = 160;

            typedCanvas.width = width * ratio;
            typedCanvas.height = height * ratio;

            typedCtx.setTransform(
                ratio,
                0,
                0,
                ratio,
                0,
                0
            );

            drawTypedSignature();
        }


        function drawTypedSignature() {

            const ratio = Math.max(
                window.devicePixelRatio || 1,
                1
            );

            const displayWidth = typedCanvas.width / ratio;
            const displayHeight = typedCanvas.height / ratio;

            typedCtx.clearRect(
                0,
                0,
                displayWidth,
                displayHeight
            );

            const name =
                signatureName.val().trim();
            const designation =
                signatureDesignation.val().trim();

            if (!name && !designation) {
                return;
            }

            const centerX = displayWidth / 2;

            // Draw Cursive Signature (Top)
            if (name) {
                typedCtx.font = '40px "Great Vibes", "Alex Brush", "Dancing Script", "Brush Script MT", "Segoe Script", cursive';
                typedCtx.fillStyle = '#111827';
                typedCtx.textAlign = 'center';
                typedCtx.textBaseline = 'middle';
                typedCtx.fillText(name, centerX, 40);
            }

            // Measure widths for dynamic horizontal divider line
            typedCtx.font = '40px "Great Vibes", "Alex Brush", "Dancing Script", "Brush Script MT", "Segoe Script", cursive';
            const cursiveWidth = name ? typedCtx.measureText(name).width : 0;

            typedCtx.font = 'bold 15px "Montserrat", Arial, sans-serif';
            const printedNameWidth = name ? typedCtx.measureText(name.toUpperCase()).width : 0;

            typedCtx.font = '600 13px "Montserrat", Arial, sans-serif';
            const desigWidth = designation ? typedCtx.measureText(designation).width : 0;

            const maxContentWidth = Math.max(cursiveWidth, printedNameWidth, desigWidth, 160);
            const lineWidth = Math.min(displayWidth - 30, maxContentWidth + 30);
            const lineStartX = centerX - (lineWidth / 2);
            const lineEndX = centerX + (lineWidth / 2);

            // Draw Horizontal Divider Line
            typedCtx.beginPath();
            typedCtx.strokeStyle = '#374151';
            typedCtx.lineWidth = 1.5;
            typedCtx.moveTo(lineStartX, 78);
            typedCtx.lineTo(lineEndX, 78);
            typedCtx.stroke();

            // Draw Printed Name (Bold Uppercase)
            if (name) {
                typedCtx.font = 'bold 15px "Montserrat", Arial, sans-serif';
                typedCtx.fillStyle = '#111827';
                typedCtx.textAlign = 'center';
                typedCtx.textBaseline = 'middle';
                typedCtx.fillText(name.toUpperCase(), centerX, 102);
            }

            // Draw Designation / Role (Below Name)
            if (designation) {
                typedCtx.font = '600 13px "Montserrat", Arial, sans-serif';
                typedCtx.fillStyle = '#4b5563';
                typedCtx.textAlign = 'center';
                typedCtx.textBaseline = 'middle';
                typedCtx.fillText(designation, centerX, 126);
            }
        }

        if (document.fonts && document.fonts.ready) {
            document.fonts.ready.then(function () {
                drawTypedSignature();
            });
        }


        /*
        |--------------------------------------------------------------------------
        | TYPE NAME & DESIGNATION LISTENERS
        |--------------------------------------------------------------------------
        */

        signatureName.on('input', function () {
            drawTypedSignature();
        });

        signatureDesignation.on('input', function () {
            drawTypedSignature();
        });


        /*
        |--------------------------------------------------------------------------
        | CLEAR DRAW SIGNATURE
        |--------------------------------------------------------------------------
        */

        $('#clear-signature').on('click', function () {

            signaturePad.clear();

            hiddenSignature.val('');
        });


        /*
        |--------------------------------------------------------------------------
        | CLEAR INPUT SIGNATURE
        |--------------------------------------------------------------------------
        */

        $('#clear-typed-signature').on('click', function () {

            signatureName.val('');
            signatureDesignation.val('');

            const ratio = Math.max(
                window.devicePixelRatio || 1,
                1
            );

            typedCtx.clearRect(
                0,
                0,
                typedCanvas.width / ratio,
                typedCanvas.height / ratio
            );

            hiddenSignature.val('');
        });


        /*
        |--------------------------------------------------------------------------
        | SIGNATURE TYPE CHANGE
        |--------------------------------------------------------------------------
        */

        $('input[name="type"], input[name="signature_type"]').on('change', function () {

            const selectedType = $(this).val();

            /*
            |--------------------------------------------------------------------------
            | Hide all
            |--------------------------------------------------------------------------
            */

            $('#upload_signature').addClass('d-none');
            $('#draw_signature').addClass('d-none');
            $('#input_signature').addClass('d-none');

            /*
            |--------------------------------------------------------------------------
            | Disable all signature inputs
            |--------------------------------------------------------------------------
            */

            signatureImage.prop('disabled', true);
            signatureName.prop('disabled', true);
            signatureDesignation.prop('disabled', true);

            hiddenSignature
                .prop('disabled', true)
                .val('');

            /*
            |--------------------------------------------------------------------------
            | UPLOAD (1 or 'upload')
            |--------------------------------------------------------------------------
            */

            if (selectedType === '1' || selectedType === 'upload') {

                $('#upload_signature')
                    .removeClass('d-none');

                signatureImage
                    .prop('disabled', false);
            }

            /*
            |--------------------------------------------------------------------------
            | DRAW (2 or 'draw')
            |--------------------------------------------------------------------------
            */

            else if (selectedType === '2' || selectedType === 'draw') {

                $('#draw_signature')
                    .removeClass('d-none');

                hiddenSignature
                    .prop('disabled', false);

                setTimeout(function () {
                    resizeCanvas();
                }, 100);
            }

            /*
            |--------------------------------------------------------------------------
            | INPUT (3 or 'input')
            |--------------------------------------------------------------------------
            */

            else if (selectedType === '3' || selectedType === 'input') {

                $('#input_signature')
                    .removeClass('d-none');

                signatureName
                    .prop('disabled', false);

                signatureDesignation
                    .prop('disabled', false);

                hiddenSignature
                    .prop('disabled', false);

                setTimeout(function () {
                    resizeTypedCanvas();
                }, 100);
            }

        });

        /*
        |--------------------------------------------------------------------------
        | FORM SUBMIT
        |--------------------------------------------------------------------------
        */

        $('form').on('submit', function () {

            const selectedType =
                $('input[name="type"]:checked, input[name="signature_type"]:checked').val();

            /*
            |--------------------------------------------------------------------------
            | DRAW (2 or 'draw')
            |--------------------------------------------------------------------------
            */

            if (selectedType === '2' || selectedType === 'draw') {

                if (!signaturePad.isEmpty()) {

                    const signature =
                        trimCanvas(canvas);

                    hiddenSignature.val(signature);

                } else {

                    hiddenSignature.val('');
                }
            }

            /*
            |--------------------------------------------------------------------------
            | INPUT (3 or 'input')
            |--------------------------------------------------------------------------
            */

            else if (selectedType === '3' || selectedType === 'input') {

                const name =
                    signatureName.val().trim();
                const designation =
                    signatureDesignation.val().trim();

                if (name !== '' || designation !== '') {

                    const typedSignature =
                        trimCanvas(typedCanvas) || typedCanvas.toDataURL('image/png');

                    hiddenSignature.val(
                        typedSignature
                    );

                } else {

                    hiddenSignature.val('');
                }
            }

        });

        /*
        |--------------------------------------------------------------------------
        | WINDOW RESIZE
        |--------------------------------------------------------------------------
        */

        $(window).on('resize', function () {

            const selectedType =
                $('input[name="type"]:checked, input[name="signature_type"]:checked').val();

            if (selectedType === '2' || selectedType === 'draw') {

                resizeCanvas();
            }

            else if (selectedType === '3' || selectedType === 'input') {

                resizeTypedCanvas();
            }

        });

        /*
        |--------------------------------------------------------------------------
        | INITIAL SIGNATURE TYPE
        |--------------------------------------------------------------------------
        */

        $('input[name="type"]:checked, input[name="signature_type"]:checked')
            .trigger('change');

    });
</script>


<script>
    $(document).ready(function () {

        $('#category_id').on('change', function () {

            let selectedOption = $(this).find('option:selected');

            let categoryId = selectedOption.val();
            let parentId = selectedOption.data('parent-id');

            if (!categoryId) {
                $('#parent_id').val('');
                return;
            }

            /*
            * If the selected category has a parent,
            * store that parent ID.
            *
            * Example:
            *
            * SKI CECO              ID = 10
            * ├── SKI CECO Frames   ID = 11, parent_id = 10
            * ├── SKI CECO Doors    ID = 12, parent_id = 10
            * ├── SKI CECO TRIAGE   ID = 13, parent_id = 10
            * └── SKI CECO Post Audit ID = 14, parent_id = 10
            *
            * Selecting any of the above children
            * will store parent_id = 10.
            */

            if (parentId) {
                $('#parent_id').val(parentId);
            } else {
                /*
                * If SKI CECO itself is selected,
                * its own ID becomes parent_id.
                */
                $('#parent_id').val(categoryId);
            }
        });

    });
</script>
