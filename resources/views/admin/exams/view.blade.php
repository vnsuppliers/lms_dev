@include('layouts.admin.header')
<style type="text/css">
    .hidden {
        display: none;
    }
    .form-check-input {
        position: relative;
        margin-top: 0px;
        margin-left: 0px;
        margin-right: 10px;
    }
    .green-background {
        background-color: #c6e4ff !important;
    }
    .cat-checkbox {
        position: relative;
        left: 3%;
        top: 3px;
    }
    .child-cat-checkbox {
        position: relative;
        left: 3%;
        top: 2px;
    }
    .cat-text {
        line-height: 15px !important;
    }
    .ck-blurred.ck.ck-content.ck-editor__editable.ck-rounded-corners.ck-editor__editable_inline {
        height: 250px;
    }
    #progressBar {
        width: 100%;
        background-color: #f3f3f3;
        border: 1px solid #ccc;
        margin-top: 10px;
        display: none;
    }
    #progressBar div {
        height: 20px;
        width: 0;
        background-color: #4caf50;
        text-align: center;
        line-height: 20px;
        color: white;
    }
    #progressBar.red div {
        background-color: #f44336;
    }
    label.error {
        color: red;
        font-size: 1rem;
        display: block;
        margin-top: 5px;
    }
    input.error {
        border: 1px dashed red;
        font-weight: 300;
        color: red;
    }
    .filters-indicator {
        display: none;
        width: 8px;
        height: 8px;
        background-color: red;
        border-radius: 50%;
        position: relative;
        top: -8px;
        right: -5px;
    }
</style>

<div class="px-2 pt-2 pb-3">
    <label class="mb-0 d-flex align-items-center font-weight-bold"><i class="fa-solid fa-eye headings-icon"></i>View Exams </label>
</div>
<div class="tab-pane fade mb-2 pb-2 {{ request()->query('tab') == 2 || !request()->query('tab') ? 'show active' : '' }}" id="courses" role="tabpanel" aria-labelledby="courses-tab">
    <div class="row">
        <div class="col-12">
            <div class="card card-border shadow-none rounded-0 border-0">
                <div class="card-body px-2 py-0 rounded-0 mx-2">
                    <div class="row">
                        <div class="col-12 col-md-12 col-lg-4 bg-white py-2 rounded-3">
                            <div class="d-flex justify-content-between align-items-center pb-2">
                                <div>
                                    <form id="courseFilterForm" class="forms-sample" method="get" action="{{ url('trainercourseslist') }}">
                                        @csrf

                                        <!-- <button class="btn filterBtn filters-btnn dropdown-toggle" type="button">
                                            <i class="bi bi-filter"></i> Filters <i class="fa-solid fa-circle filters-dot-icon"></i>
                                        </button> -->
                                        
                                        <div class="dropdown-menu filterMenu filters-dropdown-menuu p-3 w-96" style="display: none; top: 7%;">
                                            <div class="form-group row">
                                                <div class="col-sm-6 my-1">
                                                    <select id="categoryFilter" class="js-example-basic-single form-select-control category_filter" name="category_id">
                                                       
                                                    </select>
                                                </div>
                                                <div class="col-sm-6 my-1">
                                                    <select id="statusFilter" class="js-example-basic-single form-select-control statusFilter" name="status">
                                                       
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-12 mt-2">
                                                    <div class="text-right">
                                                        <button type="submit" class="btn sbmt-btn submitBtn">Submit</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <form class="forms-sample"  method="get" action="{{route('admin.exams.view')}}">
  
                                    <div class="d-flex">
                                        <input type="hidden" name="tab" value="2">
                                        <input type="text" class="form-control rounded-0" name="search_name" value="{{Request::get('search_name')}}" placeholder="Search" />
                                        <div class="input-group-append">
                                            <span class="input-group-text" style="height: 40px;">
                                                <button type="submit" class="bi bi-search border-0"></button>
                                            </span>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="height-98vh">
                                <div class="table-responsive">
                                    <table class="table ">
                                      <thead>
                                         <tr>
                                            <th>Exam Name</th>
                                             <th>Code</th>
                                             
                                         </tr></thead>
                                    <tbody id="courses_list_div">
                                     
                                       <?php $i=1;?>
                                       @foreach($exam as $exam_info)
                                      
                                         <tbody>
                                            <tr class="" style="cursor:pointer;">
                                            <td >
                                             <div class="">
                                                        <a href="javascript:;" data-id="{{$exam_info->id}}" class="pb-1 exam-name font-weight-bold exam_view_click" style="height: 17px;">{{$exam_info->name??''}} </a>
                                                  </div>
                                              </td>

                                           
                                            <td>{{$exam_info->exam_code??''}}</td>
                                        </tr>
                                             

                                         </tbody>
                                      
                                        </tbody>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-12 col-lg-8 border-left p-0 border-left-15 ajax_html_div">
                            <div class="py-5">
                                <div class="py-4 mt-5">
                                    <img src="{{ url('public/images/file.png') }}" class="img-fluid mx-auto d-block" alt="">
                                </div>
                                <div class="d-flex align-items-center justify-content-center text-muted fs-5">---- ---- Please select a exam ---- ----</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<script type="text/javascript">

    $(document).ready(function() {

            $('.exam_view_click').on('click', function() {

            $(this).parents('#courses_list_div').find('tr').removeClass('course-active');
            $(this).parents('tr').addClass('course-active');
            var exam_id = $(this).data('id');

            $.ajax({
                url: "{{url('fetch_exam_details')}}?exam_id=" + exam_id,
                type: 'GET',
                dataType: 'html',
                success: function(response) {

                    $('.ajax_html_div').html(response);
                }
            });
        });
    });
</script>


@include('layouts.admin.footer')
