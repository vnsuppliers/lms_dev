@include('layouts.admin.header')

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Alex+Brush&family=Dancing+Script:wght@600&family=Great+Vibes&family=Montserrat:wght@500;600;700;800&display=swap" rel="stylesheet">

<style>
#signature-pad {
    width: 100%;
    height: 120px;
}

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
    padding-left: 0;
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
    color: #0056b3;
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

@php
    $currentType = old('type');
    if (!$currentType) {
        if (!empty($certificate->type)) {
            $currentType = (int) $certificate->type;
        } elseif (!empty($certificate->signature_image)) {
            $currentType = 1;
        } elseif (!empty($certificate->signature_drawn)) {
            $currentType = 2;
        } else {
            $currentType = 1;
        }
    }
@endphp

<div class="container-fluid py-3">
    <div class="row">
        <!-- Header Section -->
        <div class="col-12">
            <div class="py-2">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <label class="mb-0 d-flex align-items-center font-weight-bold fs-5">
                            <i class="fa-solid fa-pen-to-square headings-icon mr-2 text-teal"></i>Edit Certificate
                        </label>
                    </div>
                    <div>
                        <a href="{{ url('masters?tab=6') }}" class="btn web-btn">
                            <i class="fa-solid fa-arrow-left btnn-icon mr-1"></i>View Certificates
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Feedback & Alerts -->
        @if(session('success'))
            <div class="col-12 mb-3">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fa-solid fa-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="col-12 mb-3">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fa-solid fa-triangle-exclamation me-2"></i>{{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        @endif

        @if($errors->any())
            <div class="col-12 mb-3">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        @endif

        <!-- Main Form Wrapper -->
        <div class="col-12">
            <div class="bg-white p-4 rounded-3 shadow-sm">
                <form action="{{ url('masters/update-certificate/' . $certificate->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{ $certificate->id }}">

                    <div class="row">
                        <!-- Left Column: Certificate Details, Templates & Signatures -->
                        <div class="col-12 col-md-8 col-lg-7">

                            <!-- Category Selection -->
                            <div class="form-group row mb-3">
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
                                                @if(old('category_id', $certificate->category_id) == $category->id)
                                                    selected
                                                @endif
                                            >
                                                {{ $category->category_name }}
                                            </option>
                                        @endforeach
                                    </select>

                                    {{-- Parent Category ID --}}
                                    <input type="hidden" name="parent_id" id="parent_id" value="{{ old('parent_id', $certificate->parent_id) }}">
                                </div>
                            </div>

                            <!-- Certificate Name -->
                            <div class="form-group row mb-3">
                                <label class="col-sm-3 col-form-label">Certificate Name<span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input
                                        type="text"
                                        class="form-control"
                                        placeholder="Enter certificate name"
                                        name="certificate_name"
                                        value="{{ old('certificate_name', $certificate->certificate_name) }}"
                                        required
                                    />
                                </div>
                            </div>

                            <!-- Description -->
                            <div class="form-group row mb-3">
                                <label class="col-sm-3 col-form-label">Description</label>
                                <div class="col-sm-9">
                                    <textarea id="editor1" name="code">{{ old('code', $certificate->code) }}</textarea>
                                </div>
                            </div>

                            <!-- Certificate Template -->
                            <div class="form-group row mb-3 mt-3">
                                <label class="col-sm-3 col-form-label">Select Certificate Template<span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <div class="row">
                                        <div class="col-6 col-lg-6">
                                            <div class="border rounded p-2 text-center bg-light">
                                                <img src="{{ asset('public/images/certificate.png') }}" alt="Certificate Template" class="img-fluid rounded mb-2" style="max-height: 120px;">
                                                <div class="pt-1 text-center">
                                                    <input type="radio" id="template_id" name="template_id" value="1" {{ old('template_id', $certificate->template_id ?? 1) == 1 ? 'checked' : '' }} required>
                                                    <label for="template_id" class="ps-1 mb-0 fw-semibold">Default Template</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Signature Type Selector (1: Upload, 2: Draw, 3: Input) -->
                            <div class="form-group row mb-3">
                                <label class="col-sm-3 col-form-label">Signature Type</label>

                                <div class="col-sm-9 pt-2">
                                    <label class="me-3 cursor-pointer">
                                        <input type="radio" name="type" value="1" {{ $currentType == 1 ? 'checked' : '' }}>
                                        Upload Image
                                    </label>

                                    <label class="me-3 cursor-pointer">
                                        <input type="radio" name="type" value="2" {{ $currentType == 2 ? 'checked' : '' }}>
                                        Draw Signature
                                    </label>

                                    <label class="cursor-pointer">
                                        <input type="radio" name="type" value="3" {{ $currentType == 3 ? 'checked' : '' }}>
                                        Input Signer Details
                                    </label>
                                </div>
                            </div>

                            <!-- ========================================================= -->
                            <!-- UPLOAD SIGNATURE (Type 1) -->
                            <!-- ========================================================= -->
                            <div class="form-group row mb-3 {{ $currentType == 1 ? '' : 'd-none' }}" id="upload_signature">
                                <label class="col-sm-3 col-form-label">
                                    Signature Image
                                </label>

                                <div class="col-sm-9">
                                    @if(!empty($certificate->signature_image))
                                        <div class="mb-2 p-2 border rounded bg-light d-flex align-items-center gap-3" id="current_upload_preview">
                                            <img src="{{ asset('storage/app/public/signature_images/' . $certificate->signature_image) }}"
                                                 alt="Current Saved Signature"
                                                 class="bg-white border rounded p-1"
                                                 style="max-height: 60px; max-width: 180px; object-fit: contain;">
                                            <div>
                                                <span class="badge bg-secondary text-white mb-1">Current Saved Signature</span>
                                                <small class="text-muted d-block font-smallsize">
                                                    Upload a new image below only if you wish to replace it.
                                                </small>
                                            </div>
                                        </div>
                                    @endif

                                    <div class="input-group">
                                        <input
                                            type="file"
                                            class="form-control"
                                            name="signature_image"
                                            id="signature_image"
                                            accept="image/*"
                                            {{ $currentType == 1 ? '' : 'disabled' }}
                                        >
                                    </div>

                                    {{-- Live Preview for newly selected image file --}}
                                    <div id="new_image_preview_container" class="mt-2 d-none">
                                        <div class="p-2 border rounded bg-light d-flex align-items-center gap-3">
                                            <img id="new_image_preview"
                                                 src=""
                                                 alt="New Selected Signature"
                                                 class="bg-white border rounded p-1"
                                                 style="max-height: 60px; max-width: 180px; object-fit: contain;">
                                            <div>
                                                <span class="badge bg-success text-white mb-1">New Selected Image Preview</span>
                                                <small class="text-muted d-block font-smallsize">
                                                    This new image will replace the current signature on update.
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- ========================================================= -->
                            <!-- DRAW SIGNATURE (Type 2) -->
                            <!-- ========================================================= -->
                            <div class="form-group row mb-3 {{ $currentType == 2 ? '' : 'd-none' }}" id="draw_signature">
                                <label class="col-sm-3 col-form-label">
                                    Draw Signature
                                </label>

                                <div class="col-sm-9">
                                    @if(!empty($certificate->signature_drawn))
                                        <div class="mb-2 p-2 border rounded bg-light d-flex align-items-center gap-3" id="current_drawn_preview">
                                            <img src="{{ $certificate->signature_drawn }}"
                                                 alt="Current Drawn Signature"
                                                 class="bg-white border rounded p-1"
                                                 style="max-height: 60px; max-width: 200px; object-fit: contain;">
                                            <div>
                                                <span class="badge bg-secondary text-white mb-1">Current Signature</span>
                                                <small class="text-muted d-block font-smallsize">
                                                    Draw on the pad below to replace it.
                                                </small>
                                            </div>
                                        </div>
                                    @endif

                                    <div class="border rounded bg-white p-2">
                                        <canvas
                                            id="signature-pad"
                                            class="border rounded w-100"
                                            style="height:110px; background-color: #fafafa;">
                                        </canvas>
                                    </div>

                                    <button
                                        type="button"
                                        id="clear-signature"
                                        class="btn btn-sm btn-danger mt-2">
                                        <i class="fa-solid fa-rotate-left me-1"></i> Clear Drawing
                                    </button>
                                </div>
                            </div>

                            <!-- ========================================================= -->
                            <!-- INPUT SIGNATURE (Type 3) -->
                            <!-- ========================================================= -->
                            <div class="form-group row mb-3 {{ $currentType == 3 ? '' : 'd-none' }}" id="input_signature">
                                <label class="col-sm-3 col-form-label">
                                    Signer Details
                                </label>

                                <div class="col-sm-9">
                                    @if(!empty($certificate->signature_drawn))
                                        <div class="mb-3 p-2 border rounded bg-light d-flex align-items-center gap-3" id="current_input_drawn_preview">
                                            <img src="{{ $certificate->signature_drawn }}"
                                                 alt="Current Saved Signature Stamp"
                                                 class="bg-white border rounded p-1"
                                                 style="max-height: 70px; max-width: 220px; object-fit: contain;">
                                            <div>
                                                <span class="badge bg-secondary text-white mb-1">Current Saved Stamp</span>
                                                <small class="text-muted d-block font-smallsize">
                                                    Enter new details below if you wish to generate a new stamp.
                                                </small>
                                            </div>
                                        </div>
                                    @endif

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
                                                {{ $currentType == 3 ? '' : 'disabled' }}
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
                                                {{ $currentType == 3 ? '' : 'disabled' }}
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
                                        <i class="fa-solid fa-trash me-1"></i> Clear Details
                                    </button>
                                </div>
                            </div>

                            <!-- Hidden signature_drawn input -->
                            <input
                                type="hidden"
                                name="signature_drawn"
                                id="signature_drawn_hidden"
                                value="{{ old('signature_drawn', $certificate->signature_drawn ?? '') }}"
                                {{ ($currentType == 2 || $currentType == 3) ? '' : 'disabled' }}
                            >

                        </div>
                    </div>

                    <!-- Submit & Cancel Buttons -->
                    <div class="mt-4 text-center border-top pt-3">
                        <button type="submit" class="btn sbmt-btn px-4">
                            <i class="fa-solid fa-check me-1"></i> Update Certificate
                        </button>
                        <a href="{{ url('masters?tab=6') }}" class="btn btn-secondary px-4 ms-2">
                            <i class="fa-solid fa-xmark me-1"></i> Cancel
                        </a>
                    </div>
                </form>
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

        let signaturePad = null;
        if (canvas) {
            signaturePad = new SignaturePad(canvas);
        }

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
            if (!canvas || !signaturePad) return;

            const ratio = Math.max(window.devicePixelRatio || 1, 1);
            const width = canvas.offsetWidth || 300;
            const height = 100;

            canvas.width = width * ratio;
            canvas.height = height * ratio;

            const ctx = canvas.getContext('2d');
            ctx.setTransform(ratio, 0, 0, ratio, 0, 0);

            signaturePad.clear();
        }

        /*
        |--------------------------------------------------------------------------
        | CROP DRAWN / TYPED SIGNATURE
        |--------------------------------------------------------------------------
        */
        function trimCanvas(targetCanvas) {
            if (!targetCanvas) return null;

            const ctx = targetCanvas.getContext('2d');
            const imageData = ctx.getImageData(0, 0, targetCanvas.width, targetCanvas.height);
            const pixels = imageData.data;

            let minX = targetCanvas.width;
            let minY = targetCanvas.height;
            let maxX = -1;
            let maxY = -1;

            for (let y = 0; y < targetCanvas.height; y++) {
                for (let x = 0; x < targetCanvas.width; x++) {
                    const index = (y * targetCanvas.width + x) * 4;
                    const alpha = pixels[index + 3];

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
            maxX = Math.min(targetCanvas.width - 1, maxX + padding);
            maxY = Math.min(targetCanvas.height - 1, maxY + padding);

            const width = maxX - minX + 1;
            const height = maxY - minY + 1;

            const croppedCanvas = document.createElement('canvas');
            croppedCanvas.width = width;
            croppedCanvas.height = height;

            const croppedCtx = croppedCanvas.getContext('2d');
            croppedCtx.putImageData(
                ctx.getImageData(minX, minY, width, height),
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
        let typedCtx = typedCanvas ? typedCanvas.getContext('2d') : null;

        function resizeTypedCanvas() {
            if (!typedCanvas || !typedCtx) return;

            const ratio = Math.max(window.devicePixelRatio || 1, 1);
            const width = typedCanvas.offsetWidth || 440;
            const height = 160;

            typedCanvas.width = width * ratio;
            typedCanvas.height = height * ratio;

            typedCtx.setTransform(ratio, 0, 0, ratio, 0, 0);

            drawTypedSignature();
        }

        function drawTypedSignature() {
            if (!typedCanvas || !typedCtx) return;

            const ratio = Math.max(window.devicePixelRatio || 1, 1);
            const displayWidth = typedCanvas.width / ratio;
            const displayHeight = typedCanvas.height / ratio;

            typedCtx.clearRect(0, 0, displayWidth, displayHeight);

            const name = signatureName.val().trim();
            const designation = signatureDesignation.val().trim();

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

        signatureName.on('input', function () {
            drawTypedSignature();
        });

        signatureDesignation.on('input', function () {
            drawTypedSignature();
        });

        /*
        |--------------------------------------------------------------------------
        | FILE UPLOAD LIVE PREVIEW
        |--------------------------------------------------------------------------
        */
        signatureImage.on('change', function () {
            const file = this.files && this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    $('#new_image_preview').attr('src', e.target.result);
                    $('#new_image_preview_container').removeClass('d-none');
                };
                reader.readAsDataURL(file);
            } else {
                $('#new_image_preview_container').addClass('d-none');
                $('#new_image_preview').attr('src', '');
            }
        });

        /*
        |--------------------------------------------------------------------------
        | CLEAR DRAW SIGNATURE
        |--------------------------------------------------------------------------
        */
        $('#clear-signature').on('click', function () {
            if (signaturePad) {
                signaturePad.clear();
            }
            hiddenSignature.val('');
            $('#current_drawn_preview').remove();
        });

        /*
        |--------------------------------------------------------------------------
        | CLEAR INPUT SIGNATURE
        |--------------------------------------------------------------------------
        */
        $('#clear-typed-signature').on('click', function () {
            signatureName.val('');
            signatureDesignation.val('');

            if (typedCanvas && typedCtx) {
                const ratio = Math.max(window.devicePixelRatio || 1, 1);
                typedCtx.clearRect(0, 0, typedCanvas.width / ratio, typedCanvas.height / ratio);
            }
            hiddenSignature.val('');
            $('#current_input_drawn_preview').remove();
        });

        /*
        |--------------------------------------------------------------------------
        | SIGNATURE TYPE CHANGE (1: Upload, 2: Draw, 3: Input)
        |--------------------------------------------------------------------------
        */
        $('input[name="type"], input[name="signature_type"]').on('change', function () {
            const selectedType = $(this).val();

            $('#upload_signature').addClass('d-none');
            $('#draw_signature').addClass('d-none');
            $('#input_signature').addClass('d-none');

            signatureImage.prop('disabled', true);
            signatureName.prop('disabled', true);
            signatureDesignation.prop('disabled', true);

            if (selectedType === '1' || selectedType === 'upload') {
                $('#upload_signature').removeClass('d-none');
                signatureImage.prop('disabled', false);
                hiddenSignature.prop('disabled', true);
            } else if (selectedType === '2' || selectedType === 'draw') {
                $('#draw_signature').removeClass('d-none');
                hiddenSignature.prop('disabled', false);
                setTimeout(function () {
                    resizeCanvas();
                }, 100);
            } else if (selectedType === '3' || selectedType === 'input') {
                $('#input_signature').removeClass('d-none');
                signatureName.prop('disabled', false);
                signatureDesignation.prop('disabled', false);
                hiddenSignature.prop('disabled', false);
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
            const selectedType = $('input[name="type"]:checked, input[name="signature_type"]:checked').val();

            if (selectedType === '2' || selectedType === 'draw') {
                if (signaturePad && !signaturePad.isEmpty()) {
                    const signature = trimCanvas(canvas);
                    if (signature) {
                        hiddenSignature.val(signature);
                    }
                }
            } else if (selectedType === '3' || selectedType === 'input') {
                const name = signatureName.val().trim();
                const designation = signatureDesignation.val().trim();

                if (name !== '' || designation !== '') {
                    const typedSignature = trimCanvas(typedCanvas) || typedCanvas.toDataURL('image/png');
                    hiddenSignature.val(typedSignature);
                }
            }
        });

        /*
        |--------------------------------------------------------------------------
        | WINDOW RESIZE
        |--------------------------------------------------------------------------
        */
        $(window).on('resize', function () {
            const selectedType = $('input[name="type"]:checked, input[name="signature_type"]:checked').val();
            if (selectedType === '2' || selectedType === 'draw') {
                resizeCanvas();
            } else if (selectedType === '3' || selectedType === 'input') {
                resizeTypedCanvas();
            }
        });

        // Trigger initial state
        $('input[name="type"]:checked, input[name="signature_type"]:checked').trigger('change');
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

            if (parentId) {
                $('#parent_id').val(parentId);
            } else {
                $('#parent_id').val(categoryId);
            }
        });
    });
</script>

@include('layouts.admin.footer')
