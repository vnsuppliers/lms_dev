<style>
#signature-pad {
    width: 100%;
    height: 200px;
}

/* Disabled buttons - proper greyed out appearance */
#authorizedSignatureForm button:disabled {
    background-color: #adb5bd !important;
    border-color: #adb5bd !important;
    color: #ffffff !important;
    opacity: 1 !important;
    cursor: not-allowed !important;
    box-shadow: none !important;
}

/* Disabled Save Signature button */
#saveSignatureBtn:disabled {
    background-color: #adb5bd !important;
    border-color: #adb5bd !important;
    color: #ffffff !important;
    opacity: 1 !important;
    cursor: not-allowed !important;
}

/* Disabled Cancel button */
#cancelSignatureBtn:disabled {
    background-color: #adb5bd !important;
    border-color: #adb5bd !important;
    color: #ffffff !important;
    opacity: 1 !important;
    cursor: not-allowed !important;
}

/* Disabled Remove Signature button */
#removeSignatureBtn:disabled {
    background-color: #adb5bd !important;
    border-color: #adb5bd !important;
    color: #ffffff !important;
    opacity: 1 !important;
    cursor: not-allowed !important;
}

/* Disabled file input */
#authorised_sign:disabled {
    background-color: #e9ecef !important;
    border-color: #ced4da !important;
    color: #6c757d !important;
    opacity: 1 !important;
    cursor: not-allowed !important;
}
</style>

<div class="tab-pane fade" id="singature" role="tabpanel" aria-labelledby="singature-tab">

    <div class="row">

        <div class="col-12 col-md-6 col-lg-7">

            <div class="py-2">
                <label class="mb-0 d-flex align-items-center font-weight-bold">
                    <i class="fa-solid fa-plus headings-icon"></i>
                    Add Signature
                </label>
            </div>

            <div class="bg-white p-3 rounded-3 shadow-sm">

                <form id="authorizedSignatureForm"
                      action="{{ url('store_authorized_signature') }}"
                      method="POST"
                      enctype="multipart/form-data">

                    @csrf

                    <div class="form-group row">

                        <label class="col-sm-3 col-form-label">
                            Signature Image
                            <span class="text-danger">*</span>
                        </label>

                        <div class="col-sm-9">

                            <input type="file"
                                   class="form-control"
                                   name="authorised_sign"
                                   id="authorised_sign"
                                   accept="image/png,image/jpeg,image/jpg"
                                   required>

                            <small class="text-muted d-block mt-1">
                                Upload a clear signature image.
                                Transparent background is recommended
                                (PNG, JPEG, JPG, max size: 2MB).
                            </small>

                        </div>

                    </div>

                    <div class="text-center mt-4">

                        <button type="submit"
                                id="saveSignatureBtn"
                                class="btn btn-btn-secondary sbmt-btn mr-2">
                            Save Signature
                        </button>

                        <button type="button"
                                id="removeSignatureBtn"
                                class="btn btn-danger mr-2 d-none">
                            Remove Signature
                        </button>

                        <button type="reset"
                                id="cancelSignatureBtn"
                                class="btn cancel-btn">
                            Cancel
                        </button>

                    </div>

                </form>

            </div>

        </div>

        <div class="col-12 col-md-6 col-lg-5">

            <div class="py-2">

                <label class="mb-0 d-flex align-items-center font-weight-bold">
                    <i class="fa-solid fa-signature headings-icon"></i>
                    Existing Signature
                </label>

            </div>

            <div id="signaturePreview"
                 class="bg-white p-3 rounded-3 shadow-sm text-center"
                 style="min-height:250px;">

                <div class="text-muted py-5">

                    <i class="fa-solid fa-signature fa-3x mb-3"></i>

                    <p class="mb-0">
                        No signature added yet.
                    </p>

                </div>

            </div>

        </div>

    </div>

</div>

<script>

function loadAuthorizedSignature() {

    $.ajax({

        url: "{{ url('get_authorized_signature') }}",

        type: 'GET',

        success: function (response) {

            if (response.status && response.signature) {

                var sig = response.signature;

                $('#signaturePreview').html(`
                    <img src="${sig.signature_url}"
                         alt="Authorized Signature"
                         class="img-fluid"
                         style="max-width:300px; max-height:180px; object-fit:contain;">
                `);

                $('#authorised_sign')
                    .prop('disabled', true)
                    .prop('required', false);

                $('#saveSignatureBtn')
                    .prop('disabled', true)
                    .text('Signature Saved');

                $('#removeSignatureBtn')
                    .removeClass('d-none')
                    .prop('disabled', false);

            }

        }

    });

}

$(document).ready(function () {

    $('#singature-tab').on('shown.bs.tab', function () {

        loadAuthorizedSignature();

    });

});

$(document).on('submit', '#authorizedSignatureForm', function (e) {

    e.preventDefault();

    var form = this;

    var formData = new FormData(form);

    $('#saveSignatureBtn')
        .prop('disabled', true)
        .text('Saving...');

    $.ajax({

        url: $(form).attr('action'),

        type: 'POST',

        data: formData,

        processData: false,

        contentType: false,

        success: function (response) {

            if (response.status) {

                $('#signaturePreview').html(`

                    <img src="${response.signature_url}"
                         alt="Authorized Signature"
                         class="img-fluid"
                         style="max-width:300px; max-height:180px; object-fit:contain;">

                `);

                $('#authorised_sign')
                    .prop('disabled', true)
                    .prop('required', false);

                $('#saveSignatureBtn')
                    .prop('disabled', true)
                    .text('Signature Saved');

                $('#removeSignatureBtn')
                    .removeClass('d-none')
                    .prop('disabled', false);

                $('#cancelSignatureBtn')
                    .prop('disabled', true);

                $.toast({

                    heading: 'Success',

                    text: response.message,

                    position: 'bottom-right',

                    stack: false,

                    icon: 'success'

                });

            }

        },

        error: function (xhr) {

            $('#saveSignatureBtn')
                .prop('disabled', false)
                .text('Save Signature');

            if (xhr.status === 422) {

                var errors = xhr.responseJSON.errors;

                var message = '';

                $.each(errors, function (key, value) {

                    message += value[0] + '<br>';

                });

                $.toast({

                    heading: 'Warning',

                    text: message,

                    position: 'bottom-right',

                    stack: false,

                    icon: 'warning'

                });

            } else {

                $.toast({

                    heading: 'Error',

                    text: 'Unable to save signature.',

                    position: 'bottom-right',

                    stack: false,

                    icon: 'error'

                });

            }

        }

    });

});

$(document).on('click', '#removeSignatureBtn', function () {

    if (!confirm('Are you sure you want to remove the signature?')) {

        return;

    }

    var button = $(this);

    button.prop('disabled', true);

    $.ajax({

        url: "{{ url('remove_authorized_signature') }}",

        type: 'POST',

        data: {

            _token: "{{ csrf_token() }}"

        },

        success: function (response) {

            if (response.status) {

                $('#signaturePreview').html(`

                    <div class="text-muted py-5">

                        <i class="fa-solid fa-signature fa-3x mb-3"></i>

                        <p class="mb-0">
                            No signature added yet.
                        </p>

                    </div>

                `);

                $('#authorised_sign')
                    .prop('disabled', false)
                    .prop('required', true)
                    .val('');

                $('#saveSignatureBtn')
                    .prop('disabled', false)
                    .text('Save Signature');

                $('#removeSignatureBtn')
                    .addClass('d-none')
                    .prop('disabled', false);

                $('#cancelSignatureBtn')
                    .prop('disabled', false);

                $.toast({

                    heading: 'Success',

                    text: response.message,

                    position: 'bottom-right',

                    stack: false,

                    icon: 'success'

                });

            }

        },

        error: function () {

            button.prop('disabled', false);

            $.toast({

                heading: 'Error',

                text: 'Unable to remove signature.',

                position: 'bottom-right',

                stack: false,

                icon: 'error'

            });

        }

    });

});

</script>