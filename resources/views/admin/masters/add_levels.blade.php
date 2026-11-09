  
<div class="tab-pane fade {{ request()->query('tab') == 3 ? 'show active' : '' }}" id="levels" role="tabpanel" aria-labelledby="v-pills-tab-twos">
    
     
            <div class="row mx-0">
                <div class="col-12 col-lg-7 px-2">
                    <div class="py-2">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <label class="mb-0 d-flex align-items-center font-weight-bold"><i class="fa-solid fa-plus headings-icon"></i>Add Levels </label>
            </div>

            <div>
                <a href="{{url('masters?tab=4')}}" class="btn web-btn {{ request()->query('tab') == 4 ? 'active' : '' }}"><i class="fa-solid fa-eye btnn-icon"></i>View Levels</a>
            </div>
        </div>
    </div>
                    <div class="bg-white p-2 rounded-3">
                        <form action="{{url('level_store')}}" 
                        method="post" class="">
                        @csrf
                        <input type="hidden" name="id" value="{{ $permision_id->id??'' }}">
                        <div class="form-group row">
                            <label for="exampleInputUsername1" class="col-sm-3 col-form-label" >Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="name" value="{{$permision_id->name??''}}">
                            </div>
                        </div>

                        
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" >Status</label>
                            <div class="col-sm-9">
                                <select class="js-example-basic-single form-select-control" name="status" >
                                 @if(!isset($permision_id))
                                 <option selected>-- select --</option>
                                 <option value="1">Active</option>
                                 <option value="0">Inactive</option>
                                 @else
                                 <option value="1" @if($permision_id->status == 1) selected @endif>Active</option>
                                 <option value="0" @if($permision_id->status == 0) selected @endif>Inactive</option>
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