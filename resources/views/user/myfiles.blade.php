@include('layouts.user.header')

<div class="container-fluid">
    <div class="row">
        {{-- Responsive Mobile Title --}}
        <div class="col-12 d-block d-lg-none px-1 px-md-2 mt-2">
            <div class="res-main-headings mb-2">
                <i class="fa-solid fa-file me-2 menu-icon5"></i>
                <span class="text-blue font-weight-500">My Files</span>
            </div>
        </div>

        {{-- Desktop Title --}}
        <div class="col-12 col-lg-10 offset-lg-1 mt-2 px-0 d-none d-lg-block">
            <div class="">
                <i class="fa-solid fa-file me-2 menu-icon5"></i>
                <span class="text-blue font-weight-500">My Files</span>
            </div>
        </div>

        {{-- Main Container --}}
        <div class="col-12 col-lg-10 offset-lg-1 bg-white rounded-3 px-0 mt-2 mb-3">
            @php $count = 0; @endphp
            @foreach($data as $courses_data)
                @if(!empty($courses_data->course_details) && !empty($courses_data->course_details->only_attachments))
                    @foreach($courses_data->course_details->only_attachments as $attachment)
                        @php 
                            $count++; 
                            $filePath = url('storage/app/public/' . $attachment->file_path);
                            $fileName = $attachment->org_file_name ?? $attachment->file_name ?? 'Attachment';
                            $fileExt = strtolower(pathinfo($attachment->file_path, PATHINFO_EXTENSION));
                        @endphp
                        <div class="courses_list courses_listt">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0" style="width: 180px;">
                                            <div class="courses-image-div" style="width: 180px; height: 100px; overflow: hidden; border-radius: 10px;">
                                                @php
                                                    $courseImg = $courses_data->course_details->course_image ?? null;
                                                    $hasCourseImg = !empty($courseImg) && (file_exists(storage_path('app/public/' . $courseImg)) || file_exists(public_path('storage/' . $courseImg)));
                                                @endphp
                                                @if($hasCourseImg)
                                                    <img src="{{ url('storage/app/public/' . $courseImg) }}" 
                                                         onerror="this.onerror=null; this.src='{{ url('public/images/dummy-course.jpg') }}';" 
                                                         class="img-fluid user-courses-listing-view-image" 
                                                         style="width: 180px; height: 100px; object-fit: cover; border-radius: 10px;" 
                                                         alt="course image">
                                                @else
                                                    <img src="{{ url('public/images/dummy-course.jpg') }}" 
                                                         class="img-fluid user-courses-listing-view-image" 
                                                         style="width: 180px; height: 100px; object-fit: cover; border-radius: 10px;" 
                                                         alt="course image">
                                                @endif
                                            </div>
                                        </div>
                                        <div class="pl-3 ml-1">
                                            <div>
                                                <div class="text-start course-name font-weight-bold mb-0">
                                                    {{ $courses_data->course_details->course_name }}
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center text-muted py-1">
                                                <span class="d-flex align-items-center pe-3 text-muted fs-7 pt2">
                                                    <i class="fa-solid fa-circle id-circle-icon"></i>
                                                    <label class="ps-1 mb-0 text-muted">File : </label>
                                                    <span class="ps-1 font-weight-500 text-dark">{{ $fileName }}</span>
                                                </span>
                                            </div>
                                            <div class="d-flex flex-wrap align-items-center text-muted py-1">
                                                @if(!empty($courses_data->created_at))
                                                <span class="d-flex align-items-center pe-3 text-muted fs-7 pt2">
                                                    <i class="fa-solid fa-circle id-circle-icon"></i>
                                                    <label class="ps-1 mb-0 text-muted">Assigned : </label>
                                                    <span class="ps-1"><?php echo \Carbon\Carbon::createFromTimeStamp(strtotime($courses_data->created_at))->diffForHumans() ?></span>
                                                </span>
                                                @endif
                                                @if(!empty($courses_data->course_details->expiration_date))
                                                <span class="d-flex align-items-center pe-3 text-muted fs-7 pt2">
                                                    <i class="fa-solid fa-circle id-circle-icon"></i>
                                                    <label class="ps-1 mb-0 text-muted">Due : </label>
                                                    <span class="ps-1"><?php echo \Carbon\Carbon::createFromTimeStamp(strtotime($courses_data->course_details->expiration_date))->diffForHumans() ?></span>
                                                </span>
                                                @endif
                                            </div>
                                            @if(!empty($courses_data->category_details->category_name))
                                            <div class="fs-7 my-course-categori-name py-1">
                                                <span class="dashed-border-category-icon"><i class="fa-solid fa-folder-tree"></i></span>
                                                <span class="ps-1">{{ $courses_data->category_details->category_name }}</span>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="d-flex align-items-center justify-content-end">
                                        <a href="javascript:;" 
                                           data-path="{{ $filePath }}" 
                                           data-title="{{ $fileName }}" 
                                           class="btn web-btn bottom-butun-in-card border-radius-top view_file_btn me-2" 
                                           data-bs-toggle="modal" 
                                           data-bs-target="#fileViewModal">
                                            <i class="fa-solid fa-eye pr-1"></i> View File
                                        </a>
                                        <a href="{{ $filePath }}" 
                                           download="{{ $fileName }}" 
                                           class="btn web-btn bottom-butun-in-card border-radius-top">
                                            <i class="fa-solid fa-download pr-1"></i> Download File
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            @endforeach

            @if(empty($count))
                <div class="bg-white pb-5">
                    <img src="{{ asset('public/images/no-cer-found-image.jpg') }}" class="img-fluid mx-auto d-block" alt="">
                    <div class="no-data-found-text">No data found</div>
                </div>
            @endif
        </div>
    </div>
</div>

{{-- File Preview Modal --}}
<div class="modal fade" id="fileViewModal" tabindex="-1" aria-labelledby="fileViewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold" id="fileViewModalLabel">
                    <i class="fa-solid fa-file-lines me-2 text-primary"></i>
                    <span id="fileModalTitle">File Preview</span>
                </h5>
                <div class="d-flex align-items-center gap-2">
                    <a href="#" id="fileModalDownloadBtn" class="btn btn-sm btn-outline-primary" download>
                        <i class="fa-solid fa-download me-1"></i> Download
                    </a>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            </div>
            <div class="modal-body p-0" style="min-height: 550px; background: #f8fafc;">
                <iframe width="100%" height="600" src="" id="file_iframe_view" frameborder="0" allowfullscreen style="border: none; display: block; width: 100%; height: 75vh;"></iframe>
            </div>
        </div>
    </div>
</div>

@include('layouts.user.footer')

<script type="text/javascript">
    // Keep modal outside page containers so it stacks cleanly above its backdrop
    $('#fileViewModal').appendTo(document.body);

    $('body').on('click', '.view_file_btn', function () {
        var filePath = $(this).data('path');
        var fileTitle = $(this).data('title') || 'File Preview';

        $('#fileModalTitle').text(fileTitle);
        $('#fileModalDownloadBtn').attr('href', filePath).attr('download', fileTitle);
        $('#file_iframe_view').attr('src', filePath);
    });

    $('#fileViewModal').on('hidden.bs.modal', function () {
        $('#file_iframe_view').attr('src', '');
    });
</script>