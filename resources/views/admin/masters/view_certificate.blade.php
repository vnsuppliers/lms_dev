<div class="tab-pane fade {{ request()->query('tab') == 6 ? 'show active' : '' }}" id="view_certificates" role="tabpanel" aria-labelledby="viewPermissions">
    <div class="p-2">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <label class="mb-0 d-flex align-items-center font-weight-bold"><i class="fa-solid fa-eye headings-icon"></i>View Certificate</label>
            </div>

            <div>
                <a href="{{url('masters?tab=5')}}" class="btn web-btn {{ request()->query('tab') == 5 ? 'active' : '' }}"><i class="fa-solid fa-plus btnn-icon"></i>Add Certificate</a>
            </div>
        </div>
    </div>
    <div class="row mx-0">
        <div class="col-12 col-sm-12 px-2">
            <div class="card card-border border-top-0 shadow-none">
                <div class="card-body p-2 rounded-3">
                    <div class="table-responsive">
                        <div class="table-responsive">
                            <table class="table mt-1" style="width: 100%;">
                                <thead>
                                    <th>Certificate Name</th>
                                    <th>Description</th>
                                    <th>Certificate Image</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                    @foreach($certificates as $cert)
                                    
                                    <tr>
                                        <td>{{$cert->certificate_name}}</td>
                                        <td>{{$cert->code}}</td>
                                        <td> <img src="{{asset('public/images/certificate.png')}}" alt="" class="img-fluid d-none d-lg-block" width="200"></td>
                                        <td>
                                            <div class="d-flex flex-wrap gap-1 align-items-center">
                                                <a href="#"
                                                    class="btn btn-primary btn-sm viewCertificate"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#certificateView"
                                                    data-id="{{ $cert->id }}"
                                                    data-certificate-name="{{ $cert->certificate_name }}"
                                                    data-signature-image="{{ $cert->signature_image }}"
                                                    data-signature-drawn="{{ $cert->signature_drawn }}"
                                                    data-signer-name="{{ $cert->signer_name }}"
                                                    data-signer-profession="{{ $cert->signer_profession }}"
                                                    data-issued-on="{{ $cert->created_at }}"
                                                    data-download-url="{{ url('masters/download-certificate/' . $cert->id) }}"
                                                    >
                                                        <i class="fa-solid fa-eye pr-1"></i> View
                                                    </a>
                                                    <!-- <a class="btn btn-success btn-sm text-white" href="{{ url('masters/download-certificate/'. $cert->id) }}" target="_blank" title="Download Landscape PDF">
                                                        <i class="fa-solid fa-download pr-1"></i> Download PDF
                                                    </a> -->
                                                    <a class="btn btn-secondary btn-sm text-white" href="{{ url('masters/edit-certificate/'. $cert->id) }}">
                                                       <i class="fa-solid fa-pen-to-square pr-1"></i> Edit
                                                    </a>
                                                    <a class="btn btn-danger btn-sm text-white deleteCertificate" data-id="{{ $cert->id }}" data-name="{{ $cert->certificate_name }}">
                                                       <i class="fa-solid fa-trash pr-1"></i> Delete
                                                    </a>
                                            </div>
                                        </td>
                                    </tr>
                                   @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- View Modal -->
<div class="modal fade" id="certificateView" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="certificateViewLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl">
    <div class="modal-content">
      <div class="modal-header d-flex justify-content-between align-items-center">
        <h5 class="modal-title mb-0" id="certificateViewLabel"></h5>
        <div class="d-flex align-items-center gap-2">
            <!-- <a id="modalDownloadPdfBtn" href="#" class="btn btn-sm btn-success text-white" target="_blank">
                <i class="fa-solid fa-download me-1"></i> Download PDF
            </a> -->
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
      </div>
      <div class="modal-body">
            <div class="center-div">
                <div class="container-fluid">
                    <div class="container rounded-3">
                        <div class="row">
                            <div class="col-12 col-lg-10 offset-lg-1">
                                <div class="certificate-main bg-white m-4 rounded-2">
                                    <div class="crt-inner border-gold pt-4 container-sm">
                                        <div class="row">
                                            <div class="col-2 d-none d-lg-block">
                                                <div>
                                                    <img src="{{asset('public/images/tas-logo.png')}}" alt="" class="img-fluid d-none d-lg-block ms-3 mt-2" />
                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-8 mt-lg-5">
                                                <div class="text-center">
                                                    <h1 class="title text-uppercase display-4">Certificate</h1>
                                                    <h3 class="title">OF ACHIEVEMENT</h3>
                                                </div>
                                            </div>
                                            <div class="col-2 d-none d-lg-block">
                                                <div>
                                                    <img src="{{asset('public/images/certificate-logo.png')}}" alt="" class="img-fluid d-none d-lg-block" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <h4 class="title text-uppercase text-gold">THIS Certificate IS PRESENTED TO:</h4>
                                            <h1 class="crt-name display-2 text-user">[Learner_name]</h1>
                                        </div>
                                        <div class="description text-center mb-5">
                                            <p class="title fw-bold">
                                                For successfully completing the course <br />
                                                
                                            </p>
                                            <h5>[Course_name]</h5>
                                        </div>

                                      <div class="sig text-center mb-5 mt-5">
                                        <div id="certificateFooterRow" style="display: flex; justify-content: center; align-items: center; gap: 100px;">

                                            <div style="width: 240px; text-align: center;">
                                                <div id="certificateSignature"
                                                    style="margin-bottom: 0px; font-size: 22px; font-weight: 600;">
                                                    No Signature
                                                </div>

                                                <div id="certificateSignatureLine" style="width: 100%; border-top: 2px solid black;"></div>

                                                <h5 id="certificateSignatureLabel" class="mt-2" style="font-weight: 600;">
                                                    Signature
                                                </h5>
                                            </div>

                                            <div style="width: 200px; text-align: center;">
                                                <div id="certificateIssuedOn"
                                                    style="margin-bottom: 10px; font-size: 22px; font-weight: 600;">
                                                </div>

                                                <div style="width: 100%; border-top: 2px solid black;"></div>

                                                <h5 class="mt-2" style="font-weight: 600;">
                                                    Issued Date
                                                </h5>
                                            </div>

                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
      </div>
      
    </div>
  </div>
</div>

<!-- Delete Certificate Modal -->
<div class="modal fade" id="deleteCertificateModal" tabindex="-1" aria-labelledby="deleteCertificateModalLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteCertificateModalLabel">Delete Certificate</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <div class="modal-body text-center text-break py-4">
                Are you sure you want to delete<br>
                <strong id="deleteCertificateName" class="d-block my-2 text-dark fs-6"></strong>?
            </div>
            
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-secondary px-3 py-2" style="min-width: 100px;" data-bs-dismiss="modal">Cancel</button>
                <form id="deleteCertificateForm" action="{{ url('masters/delete-certificate') }}" method="POST" class="d-inline">
                    @csrf
                    <input type="hidden" name="id" id="delete_certificate_id" value="">
                    <button type="submit" class="btn btn-danger px-3 py-2" style="min-width: 100px;">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    // Append modals directly to body to avoid tab-pane/overflow centering bugs
    $('#certificateView').appendTo('body');
    $('#deleteCertificateModal').appendTo('body');
});

$(document).on('click', '.viewCertificate', function () {

    let certificateName = $(this).data('certificate-name');
    let signatureImage = $(this).data('signature-image');
    let signatureDrawn = $(this).data('signature-drawn');
    let signerName = $(this).data('signer-name');
    let signerProfession = $(this).data('signer-profession');
    let issuedOn = $(this).data('issued-on');
    let downloadUrl = $(this).data('download-url') || ('{{ url("masters/download-certificate") }}/' + $(this).data('id'));

    // Certificate name and Download URL
    $('#certificateViewLabel').text(certificateName);
    $('#modalDownloadPdfBtn').attr('href', downloadUrl);

    // Issued On
    let formattedDate = '';

    if (issuedOn) {
        formattedDate = new Date(issuedOn).toLocaleDateString('en-GB', {
            day: '2-digit',
            month: '2-digit',
            year: 'numeric'
        });
    }

    $('#certificateIssuedOn').text(formattedDate);
    $('#certificateSignerName').text(signerName || '');
    $('#certificateSignerProfession').text(signerProfession || '');

    // Signature
    let signature = '';

    if (signatureDrawn) {

        signature = `
            <img src="${signatureDrawn}"
                 alt="Signature Stamp"
                 style="display:block; width:auto; height:auto; max-width:240px; max-height:110px; object-fit:contain; margin:0 auto;">
        `;
        $('#certificateSignatureLine').hide();
        $('#certificateSignatureLabel').hide();
        $('#certificateSignature').css('margin-bottom', '0px');
        $('#certificateFooterRow').css('align-items', 'center');

    } else if (signatureImage) {

        signature = `
            <img src="{{ asset('storage/app/public/signature_images') }}/${signatureImage}"
                 alt="Signature"
                 style="display:block; width:auto; height:auto; max-width:220px; max-height:70px; object-fit:contain; margin:0 auto;">
        `;
        $('#certificateSignatureLine').show();
        $('#certificateSignatureLabel').show();
        $('#certificateSignature').css('margin-bottom', '10px');
        $('#certificateFooterRow').css('align-items', 'flex-end');

    } else {

        signature = '<h5>No Signature</h5>';
        $('#certificateSignatureLine').show();
        $('#certificateSignatureLabel').show();
        $('#certificateSignature').css('margin-bottom', '10px');
        $('#certificateFooterRow').css('align-items', 'flex-end');
    }

    $('#certificateSignature').html(signature);
});

$(document).on('click', '.deleteCertificate', function (e) {
    e.preventDefault();
    let certId = $(this).data('id');
    let certName = $(this).data('name') || $(this).closest('tr').find('td:first').text().trim() || 'this certificate';

    $('#delete_certificate_id').val(certId);
    $('#deleteCertificateName').text(certName);

    $('#deleteCertificateModal').modal('show');
});
</script>
