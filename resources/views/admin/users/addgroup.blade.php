<div class="tab-pane fade {{ request()->query('tab') == 3 ? 'show active' : '' }}" id="v-pills-groups" role="tabpanel" aria-labelledby="">
    <div class="p-2">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <label class="mb-0 d-flex align-items-center font-weight-bold"><i class="fa-solid fa-plus menuu-icon"></i>Add Group</label>
            </div>

            <div>
                <a href="{{url('users?tab=4')}}" class="btn web-btn"><i class="fa-solid fa-eye btnn-icon"></i>View Groups</a>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="tab-content border-0 p-0 mb-2" id="myTabContent">
            <div class="tab-pane card-border fade show active pb-2" id="add-groups" role="tabpanel" aria-labelledby="add-groups-tab">
                <div class="">
                    <div class="col-12 col-lg-7">
                        <form action="{{url('storegroup')}}" method="POST" class="forms-sample p-2 rounded-3">
                            @csrf <!-- Add CSRF protection -->
                            <input type="hidden" name="id" value="{{ $groups_id->id??'' }}" />
                            <div class="form-group row">
                                <label for="exampleInputUsername1" class="col-sm-3 col-form-label">Group name</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="exampleInputUsername1" name="name" value="{{$groups_id->name??''}}" >
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label mb-0" name="status">Status</label>
                                <div class="col-sm-9">
                                    <select class="form-control" id="status" name="status">
                                        @if(!isset($groups_id))
                                        <option selected>-- select --</option>
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                        @else
                                        <option value="1" @if($groups_id->status == 1) selected @endif>Active</option>
                                        <option value="0" @if($groups_id->status == 0) selected @endif>Inactive</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12 px-0">
                                    <div class="my-2 text-center">
                                        <button type="submit" class="btn sbmt-btn mr-2">Submit</button>
                                        <button type="button" class="btn cancel-btn">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {

 $('.group_list_data').on('click', function() {
         $('.group_list_data').find('td').removeClass('course-active');
      $(this).find('td').addClass('course-active');

   $('#groupuserDetailsContainer tbody').html(' <tr><td colspan="4"> <div class="ball-scale"><img src="{{url("storage/app/public/Loading_2.gif")}}" style="height:60px;width:60px;"> </div></tr>');

              var groupId = $(this).data('id');

              //alert(groupId);
           

       $.ajax({
            url: "{{url('fetch_assigned_groups')}}?groupId=" + groupId,
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                // $('.theme-loader').hide();
                var groupuserDetailsContainer = $('#groupuserDetailsContainer tbody');
                groupuserDetailsContainer.empty(); 
                response.forEach(function(user) {

                    var isChecked = user.assigned_user_id !== 0 ? 'checked' : '';  
                      var userDetailsHtml = `
                        <tr>
                           
                             <!-- Checkbox -->
                            <td>${user.first_name}</td>
                            <td>${user.email}</td>
                            <td>${user.emp_id}</td>
                         
                          <td><div class="custom-control custom-switch">
                                <input type="checkbox" 
                            data-assigned_user_id="${user.assigned_user_id}" data-user_id="${user.userid}"    data-groupid="${user.groupId}"                 data-onstyle="1"  data-offstyle="0" id="grouptogglesecond-${user.userid}" class="group_user_checked custom-control-input toggle-class" ${isChecked} > <label class="custom-control-label" for="grouptogglesecond-${user.userid}"></label>
                            </div></td>
                          
                        </tr>
                    `;
                    groupuserDetailsContainer.append(userDetailsHtml);
                });



                               
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
    
    });


    $('body').on('change','.group_user_checked', function() {
                        
                            var groupId = $(this).data('groupid');
                            var assignedUserId = $(this).data('assigned_user_id');
                            var userid = $(this).data('user_id');
                            var isChecked = $(this).prop('checked');
                            // console.log(groupId,assignedUserId,userid);
                            if (isChecked) {
                                var status =1;
                            }else{
                                var status =0;
                            }
                                $.ajax({
                                    url: "{{url('add_group_to_user')}}",
                                    method: 'get',
                                    data: {
                                        groupId: groupId,
                                        id: assignedUserId,
                                        userid: userid,
                                        status:status
                                    },
                                    success: function(response) {
                                         if(status == 1){
                        $.toast({
                        heading: 'Success',
                        text: 'Added user to group successfully',
                        position: 'bottom-right',
                        stack: false,
                        icon: 'success'
                    });
                         }else{
                         $.toast({
                        heading: 'warning',
                        text: 'Removed user from group  successfully.',
                        position: 'bottom-right',
                        stack: false,
                        icon: 'warning'
                    });
                    }
                                       
                                    },
                                    error: function(xhr, status, error) {
                                         $.toast({
                        heading: 'warning',
                        text: 'Failed to add user to group.',
                        position: 'bottom-right',
                        stack: false,
                        icon: 'warning'
                    });
                                       
                                    }
                                });
                            

                    });       



            
});

</script>
                                                             





























