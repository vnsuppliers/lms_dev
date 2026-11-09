@include('layouts.user.header')


<div class="container-fluid">
    <div class="row">
        <div class="col-12 col-lg-10 offset-lg-1 mt-2 px-0">
            <div class=""> <i class="fa-solid fa-award me-2 menu-icon4"></i> <span class="text-blue font-weight-500">My Certificates</span> </div>
        </div>
        <div class="col-12 col-lg-10 offset-lg-1 bg-white rounded-3 px-0 mt-2 mb-3">
            <?php $count =0; ?>
            @foreach($data as $courses_data)
            @if(!empty($courses_data->course_details->certificate))
            <?php $count++; ?>
            <div class="courses_list courses_listt">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0" style="width: 180px; cursor: default;">
                                <div class="courses-image-div" style="width: 180px; height: 100px; overflow: hidden; border-radius: 10px; cursor: default;">
                                    @php
                                        $courseImg = $courses_data->course_details->course_image ?? null;
                                        $hasPhysicalFile = $courseImg && file_exists(storage_path('app/public/' . $courseImg));
                                        $imgSrc = $hasPhysicalFile 
                                            ? url('storage/app/public/' . $courseImg) 
                                            : url('public/images/course.jpg');
                                    @endphp
                                    <img src="{{ $imgSrc }}" 
                                         class="img-fluid user-courses-listing-view-image" 
                                         style="width: 180px; height: 100px; object-fit: cover; border-radius: 10px; cursor: default; pointer-events: none;" 
                                         alt="" 
                                         onerror="this.onerror= null;this.src='{{ url('public/images/course.jpg') }}';">
                                </div>
                            </div>
                            <div class="pl-3 ml-1 flex-grow-1">
                                <div>
                                    <div class="text-start course-name font-weight-bold mb-0">
                                        {{$courses_data->course_details->course_name}}
                                    </div>
                                </div>
                                <div class="d-flex flex-wrap align-items-center text-muted py-1">
                                    <span class="d-flex align-items-center pe-3 text-muted fs-7 pt2">
                                    <i class="fa-solid fa-circle id-circle-icon"></i>
                                        <label class="ps-1 mb-0 text-muted">Assigned : </label>
                                        <span class="ps-1"><?php echo \Carbon\Carbon::createFromTimeStamp(strtotime($courses_data->created_at??'1 week Ago'))->diffForHumans() ?> </span>
                                    </span>
                                    <span class="d-flex align-items-center pe-3 text-muted fs-7 pt2">
                                    <i class="fa-solid fa-circle id-circle-icon"></i>
                                        <span>
                                            <label class="ps-1 mb-0 text-muted">Due : </label>
                                            <span><?php echo \Carbon\Carbon::createFromTimeStamp(strtotime($courses_data->course_details->expiration_date??'3 months from now'))->diffForHumans() ?> </span>
                                        </span>
                                    </span>
                                </div>
                                <div class="fs-7 my-course-categori-name py-1">
                                    <!-- <span class="dashed-border-category-icon"><i class="fa-solid fa-folder-tree"></i></span> -->
                                    <span class="ps-1">{{$courses_data->course_details->certificate_data->certificate_name??''}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="d-flex align-items-center justify-content-end">
                            <a href="#" data-id="{{$courses_data->id}}" class="btn web-btn bottom-butun-in-card border-radius-top get_certificates me-2" data-bs-toggle="modal" data-bs-target="#certificateView"><i class="fa-solid fa-eye pr-1"></i> View Certificate</a>
                            <a href="{{url('download_certificates')}}?id={{$courses_data->id}}" class="btn web-btn bottom-butun-in-card border-radius-top"><i class="fa-solid fa-download pr-1"></i> Download Certificate</a>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @endforeach
             @if(empty($count))
            <div class="bg-white pb-5">
                <img src="{{asset('public/images/no-cer-found-image.jpg')}}" class="img-fluid mx-auto d-block" alt="">
                <div class="no-data-found-text">No data found</div>
            </div>
            @endif
        </div>
    </div>
</div>
<div class="modal fade" id="certificateView" tabindex="-1" aria-labelledby="certificateViewLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="certificateViewLabel">Course completion certificate</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body certificate_html">
            
      </div>
      
    </div>
  </div>
</div>
@include('layouts.user.footer')
<script type="text/javascript">
    // Keep the modal outside page containers so it stacks above its backdrop.
    $('#certificateView').appendTo(document.body);
        $('.pdf_name').click(function(){
        $('.videos_division').hide();
        $('.pdf_division').show();

        $('#pdf_views').attr('src',$(this).data('path'));

    });
          $('body').on('click','.get_certificates',function(){
        var  assign_id = $(this).data('id');
         $.ajax({
            type: "GET",
            url: "{{ url('get_certificate') }}",
            data: {
                assign_id: assign_id
            },
            dataType:"html",
            success: function(response) {
               $('.certificate_html').html(response);
              
            },
            error: function(xhr, status, error) {
                console.error("Error saving video time:", error);
            }
        });

    });



</script>


<script>
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl)
    })
</script>
