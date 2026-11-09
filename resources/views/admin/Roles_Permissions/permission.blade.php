  
<div class="tab-pane fade {{ request()->query('tab') == 3 ? 'show active' : '' }}" id="permissions" role="tabpanel" aria-labelledby="v-pills-tab-twos">
    
      <div class="row">
        <div class="col-12 col-sm-12">
            <div class="tab-content border-0" id="v-pills-tabContent">
                <div class="tab-pane card-border border-top-0 fade show active" id="view-permissions" role="tabpanel" aria-labelledby="view-permissions-tab">
                    <div class="col-12 col-lg-7 px-2">
                        <div class="py-2">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <label class="mb-0 d-flex align-items-center font-weight-bold"><i class="fa-solid fa-plus headings-icon"></i>Add Permissions </label>
            </div>

            <div>
                <a href="{{url('roles?tab=4')}}" class="btn web-btn"><i class="fa-solid fa-eye btnn-icon"></i>View Permissions</a>
            </div>
        </div>
    </div>
                        <div class="bg-white p-2 rounded-3">
                        <form action="{{url('permission_store')}}" 
                        method="post" class="">
                        @csrf
                        <input type="hidden" name="id" value="{{ $permision_id->id??'' }}">
                        <div class="form-group row">
                            <label for="exampleInputUsername1" class="col-sm-3 col-form-label" >Permission</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="permission" value="{{$permision_id->permission??''}}">
                            </div>
                        </div>

                        
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" >Status</label>
                            <div class="col-sm-9">
                                <select class="js-example-basic-single form-select-control" name="status" >
                                 @if(!isset($sub_id))
                                 <option selected>-- select --</option>
                                 <option value="1">Active</option>
                                 <option value="0">Inactive</option>
                                 @else
                                 <option value="1" @if($sub_id->status == 1) selected @endif>Active</option>
                                 <option value="0" @if($sub_id->status == 0) selected @endif>Inactive</option>
                                 @endif
                             </select>
                         </div>
                     </div>



                     <div class="text-center">

                        <button type="submit" class="btn sbmt-btn mr-2">Submit</button>
                        <button type="button" class="btn cancel-btn">Cancel</button>
                    </div>
                </form>
            </div>
            </div>
        </div>
    </div>

</div>
</div>
</div>
