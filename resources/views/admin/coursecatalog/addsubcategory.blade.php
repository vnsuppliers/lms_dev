<div class="tab-pane fade {{ request()->query('tab') == 5 ? 'show active' : '' }}" id="v-add-sub-ca-1" role="tabpanel" aria-labelledby="v-pills-tab-ones">
            
                <div>
                     <nav>
                        <div class="nav nav-tabs font-smallsize" id="nav-tab" role="tablist">
                            <button class="nav-link active" style="border-bottom: 0px !important;" id="add-sub-category-tab" data-bs-toggle="tab" data-bs-target="#add-sub-category" type="button" role="tab" aria-controls="add-sub-category" aria-selected="true">Add Sub Category</button>

                            <a class="d-flex align-items-center icon-img btn btn-primary btn-sm" style="position: relative;
    left: 35%;" href="{{url('coursecatalog?tab=6')}}" >
                        <img src="images/icons/view-courses.jpg" alt="">
                        <span>View Subcategory</span>
                    </a>
                        </div>
                    </nav>
                </div>
                <div class="tab-content border-0 p-0 mb-2" id="myTabContent">
                    <div class="tab-pane card-border fade show active" id="ad-su-ca" role="tabpanel" aria-labelledby="ad-su-ca-tab">
                            <div class="">
                                <div class="col-12 col-lg-7 py-2">
                                    <form action="{{url('subcategory_store')}}" 
                                    method="post">
                                    @csrf
                                     <input type="hidden" name="id" value="{{ $sub_id->id??'' }}">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Select Category</label>
                                            <div class="col-sm-9">
                                                <select class="js-example-basic-single form-select-control" name=" category_id" id="category_id">
                                                 @foreach($category_list as $d)
                                               <!--  <option value="{{$d->category_id}}">{{$d->category_name}}</option> -->
                                                  <option value="{{$d->id??''}}"@if(isset($sub_id)) @if($d->id == $sub_id->category_id??"") selected @endif @endif>{{$d->category_name??''}}</option>
                                                 @endforeach
                                                  
                                                </select>
                                               
                                            </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="exampleInputUsername1" class="col-sm-3 col-form-label" >Sub category</label>
                                        <div class="col-sm-9">
                                        <input type="text" class="form-control" id="exampleInputUsername1" name="subcategory_name" value="{{$sub_id->subcategory_name??''}}">
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
                                       
                                        <button type="submit" class="btn btn-primary customized-btn-green px-4 py-2 mr-2">Submit</button>
                                        <button type="button" class="btn cancel-btn">Cancel</button>
                                    </div>
                                      </form>
                                </div>
                                
                            </div>
                    </div>
                </div>
            </div>
        
