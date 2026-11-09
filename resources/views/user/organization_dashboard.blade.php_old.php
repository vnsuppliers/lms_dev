@include('layouts.user.header')

<style>
    .table > thead > tr > th {
        font-weight: 500;
        font-size: 16px;
    }
    .select-dropdown{
        background: #2b5797;
        color: #fff;
        border: none;
        border-radius: 4px;
        padding: 4px;
        font-size: 12px;
    }
</style>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>

<div class="tab-content px-0 py-0 my-2" id="navtabContent" style="border-top: 1px solid #eeeef0;">
    <div class="tab-pane fade show active py-2" id="od" role="tabpanel" aria-labelledby="od-tab">
        <div class="row px-3">
            <div class="col-12 col-lg-4 py-2">
                <div class="table-responsive shadow-sm">
                    <table class="table-bordered table">
                        <thead>
                            <th>
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="mr-5 pr-4">Recently Visited</div>
                                    <div>
                                        <!-- <select class="select-dropdown">
                                            <option>Today</option>
                                            <option>Yesterday</option>
                                            <option>Last Week</option>
                                            <option>Last Month</option>
                                        </select> -->
                                    </div>
                                </div>
                            </th>
                        </thead>
                        <tbody>
                            @foreach($recently as $recent)
                            <tr>
                                <td class="p-2">
                                    <div class="d-flex align-items-center">
                                        <div class="circle-bg bg-primary d-flex align-items-center justify-content-center px-3">
                                            <i class="bi bi-person-circle"></i>
                                        </div>
                                        
                                        <div class="pl-3 table-categories">
                                            <div>
                                                <a href="{{url('start_course')}}?id={{$recent->assign_id}}" class="text-uppercase">{{$recent->assign_details->course_details->course_name??''}}</a>
                                            </div>
                                            <small class="d-flex justify-content-center align-items-center"><a href="#" class="text-primary">{{$recent->assign_details->category_details->category_name??''}}</a><i class="bi bi-dot pl-2 fs-4"></i> <span>{{date('d M, Y',strtotime($recent->view_time))}}</span></small>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                           
                           <!--  <tr>
                                <td class="p-2">
                                    <div class="text-end">
                                        <a href="{{url('user_courses')}}" class="btn btn-outline-primary btn-xs">View All</a>
                                    </div>
                                </td>
                            </tr> -->
                        </tbody>
                    </table>
                </div>

                <div class="table-responsive shadow-sm">
                    <div class="table-responsive shadow-sm">
                        <table class="table-bordered table">
                            <thead>
                                <th>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="mr-3">Courses Expired</div>
                                        <div>
                                            <!-- <select class="select-dropdown">
                                                <option>Today</option>
                                                <option>Yesterday</option>
                                                <option>Last Week</option>
                                                <option>Last Month</option>
                                            </select> -->
                                        </div>
                                    </div>
                                </th>
                            </thead>
                                <tbody>
                                 @foreach($expired as $recent)
                            <tr>
                                <td class="p-2">
                                    <div class="d-flex align-items-center">
                                        <div class="circle-bg bg-primary d-flex align-items-center justify-content-center px-3">
                                            <i class="bi bi-person-circle"></i>
                                        </div>
                                        
                                        <div class="pl-3 table-categories">
                                            <div>
                                                <a href="javascript:;" class="text-uppercase">{{$recent->course_details->course_name??''}}</a>
                                            </div>
                                            <small class="d-flex justify-content-center align-items-center"><a href="#" class="text-primary">{{$recent->category_details->category_name??''}}</a><i class="bi bi-dot pl-2 fs-4"></i> <span>{{date('d M, Y',strtotime($recent->course_details->expiration_date))}}</span></small>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                                <tr>
                                    <td class="p-2">
                                        <div class="text-end">
                                            <!-- <a href="{{url('user_courses')}}" class="btn btn-outline-primary btn-xs">View All</a> -->
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-4 py-2">
                <div class="table-responsive shadow-sm">
                    <div class="table-responsive shadow-sm">
                        <table class="table-bordered table">
                            <thead>
                                <th>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="mr-3">Courses Expired</div>
                                        <div>
                                            <!-- <select class="select-dropdown">
                                                <option>Today</option>
                                                <option>Yesterday</option>
                                                <option>Last Week</option>
                                                <option>Last Month</option>
                                            </select> -->
                                        </div>
                                    </div>
                                </th>
                            </thead>
                                <tbody>
                                 @foreach($expired as $recent)
                            <tr>
                                <td class="p-2">
                                    <div class="d-flex align-items-center">
                                        <div class="circle-bg bg-primary d-flex align-items-center justify-content-center px-3">
                                            <i class="bi bi-person-circle"></i>
                                        </div>
                                        
                                        <div class="pl-3 table-categories">
                                            <div>
                                                <a href="javascript:;" class="text-uppercase">{{$recent->course_details->course_name??''}}</a>
                                            </div>
                                            <small class="d-flex justify-content-center align-items-center"><a href="#" class="text-primary">{{$recent->category_details->category_name??''}}</a><i class="bi bi-dot pl-2 fs-4"></i> <span>{{date('d M, Y',strtotime($recent->course_details->expiration_date))}}</span></small>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                                <tr>
                                    <td class="p-2">
                                        <div class="text-end">
                                            <!-- <a href="{{url('user_courses')}}" class="btn btn-outline-primary btn-xs">View All</a> -->
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- <div class="col-12 col-lg-4 py-2">
                <div class="shadow-sm borderr">
                    <div class="bg-grey" style="padding: 17.5px 10px;">Courses Report</div>
                    <canvas id="coursePieChart" class="p-2" style="width:100%;max-width:600px; height: 224px;"></canvas>
                </div>
            </div> -->
            <div class="col-12 col-lg-4 py-2">
                <div class="shadow-sm borderr">
                    <div class="bg-grey" style="padding: 17.5px 10px;">Logins (Last 7 Days)</div>
                    <canvas id="coursebarChart" class="p-2" style="width:100%;max-width:600px; height: 224px;"></canvas>
                </div>
            </div>
        </div>

        <div class="row px-3">
            <div class="col-12 col-lg-4 py-2">
                <div class="table-responsive shadow-sm">
                    <div class="table-responsive shadow-sm">
                        <table class="table-bordered table">
                            <thead>
                                <th>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="mr-5 pr-4">Courses Due By</div>
                                        <div>
                                            <!-- <select class="select-dropdown">
                                                <option>Today</option>
                                                <option>Tomorrow</option>
                                                <option>Week</option>
                                                <option>Month</option>
                                            </select> -->
                                        </div>
                                    </div>
                                </th>
                            </thead>
                                <tbody>
                                @foreach($due_soon as $recent)
                            <tr>
                                <td class="p-2">
                                    <div class="d-flex align-items-center">
                                        <div class="circle-bg bg-primary d-flex align-items-center justify-content-center px-3">
                                            <i class="bi bi-person-circle"></i>
                                        </div>
                                        
                                        <div class="pl-3 table-categories">
                                            <div>
                                                <a href="{{url('start_course')}}?id={{$recent->id}}" class="text-uppercase">{{$recent->course_details->course_name??''}}</a>
                                            </div>
                                            <small class="d-flex justify-content-center align-items-center"><a href="#" class="text-primary">{{$recent->category_details->category_name??''}}</a><i class="bi bi-dot pl-2 fs-4"></i> <span>{{date('d M, Y',strtotime($recent->course_details->expiration_date))}}</span></small>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                                <tr>
                                    <td class="p-2">
                                        <div class="text-end">
                                            <a href="{{url('user_courses')}}?expire=1&menu=expire" class="btn btn-outline-primary btn-xs">View All</a>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-4 py-2">
                <div class="table-responsive shadow-sm">
                    <div class="table-responsive shadow-sm">
                        <table class="table-bordered table">
                            <thead>
                                <th>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="mr-3">Recently Assigned</div>
                                        <div>
                                            <!-- <select class="select-dropdown">
                                                <option>Today</option>
                                                <option>Yesterday</option>
                                                <option>Last Week</option>
                                                <option>Last Month</option>
                                            </select> -->
                                        </div>
                                    </div>
                                </th>
                            </thead>
                                <tbody>
                                @foreach($recently_assign as $recent)
                            <tr>
                                <td class="p-2">
                                    <div class="d-flex align-items-center">
                                        <div class="circle-bg bg-primary d-flex align-items-center justify-content-center px-3">
                                            <i class="bi bi-person-circle"></i>
                                        </div>
                                        
                                        <div class="pl-3 table-categories">
                                            <div>
                                                <a href="{{url('start_course')}}?id={{$recent->id}}" class="text-uppercase">{{$recent->course_details->course_name??''}}</a>
                                            </div>
                                            <small class="d-flex justify-content-center align-items-center"><a href="#" class="text-primary">{{$recent->category_details->category_name??''}}</a><i class="bi bi-dot pl-2 fs-4"></i> <span>{{date('d M, Y',strtotime($recent->created_at))}}</span></small>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                                <tr>
                                    <td class="p-2">
                                        <div class="text-end">
                                            <a href="{{url('user_courses')}}" class="btn btn-outline-primary btn-xs">View All</a>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-4 py-2">
                <div class="shadow-sm borderr">
                    <div class="bg-grey" style="padding: 17.5px 10px;">Courses Assigned</div>
                    <canvas id="userbarChart" class="p-2" style="width:100%;max-width:600px; height: 224px;"></canvas>
                </div>
            </div>  
        </div>

        <div class="row px-3">
            <div class="col-12 col-lg-4 py-2">
                <div class="table-responsive shadow-sm">
                    <div class="table-responsive shadow-sm">
                        <table class="table-bordered table">
                            <thead>
                                <th>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="mr-5 pr-4">Bookmarked Courses</div>
                                    </div>
                                </th>
                            </thead>
                            <tbody>
                                 @foreach($bookmark as $recent)
                            <tr>
                                <td class="p-2">
                                    <div class="d-flex align-items-center">
                                        <div class="circle-bg bg-primary d-flex align-items-center justify-content-center px-3">
                                            <i class="bi bi-person-circle"></i>
                                        </div>
                                        
                                        <div class="pl-3 table-categories">
                                            <div>
                                                <a href="{{url('start_course')}}?id={{$recent->assign_id}}" class="text-uppercase">{{$recent->assign_details->course_details->course_name??''}}</a>
                                            </div>
                                            <small class="d-flex justify-content-center align-items-center"><a href="#" class="text-primary">{{$recent->assign_details->category_details->category_name??''}}</a><i class="bi bi-dot pl-2 fs-4"></i> <span>{{date('d M, Y',strtotime($recent->created_at))}}</span></small>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                                <tr>
                                    <td class="p-2">
                                        <div class="text-end">
                                            <a href="{{url('user_courses')}}?bookmark=1" class="btn btn-outline-primary btn-xs">View All</a>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>

<script>
    var xValues = ["Pending", "In-Progress", "Completed"];
    var yValues = [30, 20, 50];
    var barColors = [
      "#b91d47",
      "#00aba9",
      "#2b5797",
      "#e8c3b9",
      "#1e7145"
    ];

    new Chart("coursePieChart", {
      type: "doughnut",
      data: {
        labels: xValues,
        datasets: [{
          backgroundColor: barColors,
          data: yValues
        }]
      }
    });
</script>
<script>
    var xValues = ["Pending", "In-Progress", "Completed"];
    var yValues = [20, 50, 30];
    var barColors = [
      "#2b5797",
      "#e8c3b9",
      "#1e7145"
    ];

    new Chart("userPieChart", {
      type: "doughnut",
      data: {
        labels: xValues,
        datasets: [{
          backgroundColor: barColors,
          data: yValues
        }]
      }
    });
</script>
<script>
var xValues = <?php echo json_encode($xvalues); ?>;
var yValues = <?php echo json_encode($loginyvalues); ?>;
var barColors = ["red", "green","blue","orange","brown", "yellow", "purple"];

new Chart("coursebarChart", {
  type: "bar",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  }
});
</script>
<script>
var xValues = <?php echo json_encode($xvalues); ?>;
var yValues = <?php echo json_encode($assignedyvalues); ?>;
var barColors = ["orange","brown","red", "green","blue","yellow", "purple"];

new Chart("userbarChart", {
  type: "bar",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  }
});
</script>
    @include('layouts.user.footer')