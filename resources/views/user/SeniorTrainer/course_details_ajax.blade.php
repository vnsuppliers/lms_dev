<div class="content-bg">
<div class="row">
            <div class="col-md-12">
                <div class="bg-white rounded-3 p-2">
                    <div class="row">
                        <div class="col-lg-1">
                            <div class="">
                                <img src="{{ url('public/images/face12.jpg') }}" class="img-fluid" alt="">
                            </div>
                        </div>
                        <div class="col-lg-11 my-auto">
                            <div class="py-1 web-text-color font-weight-bold">{{$user->first_name??''}}</div>
                            <div class="sub-text py-1">{{$user->email??''}}</div>
                            <div class="sub-text py-1 d-flex align-items-center">
                                <i class="fa-solid fa-circle id-circle-icon"></i>
                                <span class="mr-4"> {{$user->emp_id??''}}</span>
                                
                            </div>
                        </div>
                    </div>
                </div>

  
               
                <div class="row mt-4">
                    <div class="col-12">
                    
                     <div class="row mt-4">
                            <div class="">
                                <nav class="d-flex justify-content-between align-items-center border-bottom">
                                    <div class="nav nav-tabs align-items-center justify-content-between font-smallsize border-0 bg-white rounded-3" id="nav-tab" role="tablist">
                                        <button class="nav-link d-flex align-items-center active" id="upload-tab" data-bs-toggle="pill" data-bs-target="#upload" type="button" role="tab" aria-controls="upload" aria-selected="true"><i class="fa-solid fa-upload headings-icon"></i> Assigned Courses</button>
                                    
                                        <button class="nav-link d-flex align-items-center" id="feedback-tab" data-bs-toggle="pill" data-bs-target="#feedback" type="button" role="tab" aria-controls="feedback" aria-selected="false"> <i class="fa-solid fa-comment headings-icon"></i> Report</button>
                                    </div>
                                </nav>
                                <div class="tab-content rounded-3 border-0 border-bottom pt-2 p-0" id="navtabContent">
                        <div class="tab-pane fade show active" id="upload" role="tabpanel" aria-labelledby="upload-tab">
                                <div class="bg-white rounded-3 p-2">
                                     <table class="table mt-2" style="width:100%">
                                    <thead>
                                    <tr>
                                    <th>Course Details</th>
                                    <th>Status</th>
                                    <th>Assigned at</th>
                                    <!-- <th>Result</th> -->
                                    </tr>
                                    </thead>
                                    <tbody >
                                     <?php $i=1;?>
                                     @foreach($assignedcourse as $assigned)
                                     <tr>
                                         <td> {{ $assigned->course_details->course_name ??''}}</td>
                                         <td>
                                             
                                             @if($assigned->status==1)
                                             Inprogress
                                             @elseif($assigned->status==0)
                                             Pending
                                             @elseif($assigned->status==3)
                                             Completed
                                             @else
                                             @endif
                                         </td>
                                         <td>
                                             
                                            @if(isset($assigned->created_at))
        @php
            $createdAt = new DateTime($assigned->created_at);
            $createdAt->setTimezone(new DateTimeZone('Asia/Kolkata'));
            $formattedDate = $createdAt->format('F j, Y g:i a \I\S\T');
        @endphp
        {{ $formattedDate }}
    @else
        No Assigned Data
    @endif
                                         </td>
                                         <!-- <td></td> -->
                                     </tr>
                                     @endforeach
                                 </tbody>
                             </table>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="feedback" role="tabpanel" aria-labelledby="feedback-tab">
                                                      <div class="row">
                <div class="col-12 col-md-6 col-lg-3 my-3">
                    <div class="reports-card reports-card1">
                        <div class="d-flex align-items-center justify-content-start">
                            <div class="reports-icon reports-icon1"><i class="fa-solid fa-book-open-reader"></i></div>
                            <div class="ms-3">
                                <h6>No of Courses Assigned</h6>
                                <h6 class="text-center mb-0">{{$totalassigned??'0'}}</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-3 my-3">
                    <div class="reports-card reports-card2">
                        <div class="d-flex align-items-center justify-content-start">
                            <div class="reports-icon reports-icon2"><i class="fa-solid fa-user-check"></i></div>
                             <div class="ms-3">
                                <h6>Completed</h6>
                                <h6 class="text-center mb-0">{{$completed_course??'0'}}</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-3 my-3">
                    <div class="reports-card reports-card3">
                        <div class="d-flex align-items-center justify-content-start">
                            <div class="reports-icon reports-icon3"><i class="fa-solid fa-user-xmark"></i></div>
                             <div class="ms-3">
                                <h6>Pending </h6>
                                <h6 class="text-center mb-0">{{ $notresponce??'0'}}</h6>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-3 my-3">
                    <div class="reports-card reports-card3">
                        <div class="d-flex align-items-center justify-content-start">
                            <div class="reports-icon reports-icon3"><i class="fa-solid fa-user-xmark"></i></div>
                             <div class="ms-3">
                                <h6>In progress</h6>
                                <h6 class="text-center mb-0">{{ $inprogress??'0'}}</h6>
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
        <div><a href="javascript:void(0)" class="closebtn" onclick="closeData()">&times;</a></div>
    </div>