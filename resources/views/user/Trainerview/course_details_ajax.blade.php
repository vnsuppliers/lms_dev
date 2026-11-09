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
                            <div class="py-1 web-text-color font-weight-bold">{{$user->first_name??''}}{{$user->last_name??''}}</div>
                            <div class="sub-text py-1">{{$user->email??''}}</div>
                            <div class="sub-text py-1 d-flex align-items-center">
                                <!-- <i class="fa-solid fa-circle id-circle-icon"></i> -->
                                <span class="mr-4"></span>
                                
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
                                        <button class="nav-link d-flex align-items-center active" id="upload-tab" data-bs-toggle="pill" data-bs-target="#upload" type="button" role="tab" aria-controls="upload" aria-selected="true"><i class="fa-solid fa-upload headings-icon"></i> Assessments</button>
                                    
                                        <button class="nav-link d-flex align-items-center" id="feedback-tab" data-bs-toggle="pill" data-bs-target="#feedback" type="button" role="tab" aria-controls="feedback" aria-selected="false"> <i class="fa-solid fa-comment headings-icon"></i>Certificates</button>
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
                                    <!-- <th>Result</th> -->
                                    </tr>
                                    </thead>
                                    <tbody >
                                    
                                    
                                 </tbody>
                             </table>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="feedback" role="tabpanel" aria-labelledby="feedback-tab">
                                                      <div class="row">
                
                                         <?php $count =0; ?>
                            @foreach($data as $courses_data)
                            @if(!empty($courses_data->course_details->certificate))
                            <?php $count++; ?>
                           
                            <div class="border my-2">
                                <div class="row my-3">
                                    <div class="col-2 my-auto">
                                        <div>
                                            <img src="{{asset('public/images/attached-file.png')}}" class="img-fluid" alt="powerpoint-icon" />
                                        </div>
                                    </div>
                                    <div class="col-10 my-auto ps-0">
                                        <div class="pr-2">
                                            <h6 style="line-height: 17px;">{{$courses_data->course_details->course_name}}</h6>
                                           
                                            <div >{{$courses_data->course_details->certificate_data->certificate_name??''}}</div>
                                            <a href="#" data-id="{{$courses_data->id}}" class="btn btn-primary btn-sm get_certificates my-1" data-bs-toggle="modal" data-bs-target="#certificateView"><i class="fa-solid fa-eye pr-1"></i> View Certificate</a>
                                            <a href="{{url('download_certificates')}}?id={{$courses_data->id}}"  class="btn btn-primary btn-sm my-1"><i class="fa-solid fa-download pr-1"></i> Download Certificate</a>
                                        </div>
                                    </div>
                                   
                                </div>
                            </div>
                          
                            @endif
                            @endforeach
                             @if(empty($count))
                            <img src="{{asset('public/images/no-cer-found-image.jpg')}}" class="img-fluid mx-auto d-block" alt="">
                               <div class="no-data-found-text">No data found</div>
                            @endif
                

                
              
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