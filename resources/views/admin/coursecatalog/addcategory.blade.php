<div class="tab-pane fade {{ request()->query('tab') == 3 ? 'show active' : '' }}" id="v-add-ca-1" role="tabpanel" aria-labelledby="v-pills-tab-ones">
    <div class="col-12 col-lg-6 pl-2 pl-lg-1">
        <div class="py-2">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <label class="mb-0 d-flex align-items-center font-weight-bold"><i class="fa-solid fa-eye menuu-icon"></i>Add Category</label>
                </div>
                <div>
                    <a class="btn web-btn ms-auto" href="{{url('coursecatalog?tab=4')}}" ><i class="fa-solid fa-eye btnn-icon"></i> View categories
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="tab-content border-0 rounded-3" id="myTabContent">
        <div class="tab-pane card-border fade show active" id="ad-ca" role="tabpanel" aria-labelledby="ad-ca-tab">
            <div class="">
                <div class="col-12 col-lg-12">
                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <form action="{{url('storecategory')}}" method="POST" class="px-2 rounded-3" enctype="multipart/form-data" id="category_add_form">
                                @csrf <!-- Add CSRF protection -->
                                <input type="hidden" name="id" value="{{ $data_id->id??'' }}" />
                                <div class="form-group row">
                                    <div class="form-group col-12 col-lg-10 my-3">
                                        <label>Category name</label>
                                         <input type="text" class="form-control" id="" name="category_name" value="{{$data_id->category_name??''}}" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="form-group col-12 col-lg-10 my-3">
                                        <div class="d-flex align-items-center">
                                            <label name="status">Status</label>
                                            <a href="#" flow="right" tooltip="Please select Status"><i class="fa-solid fa-circle-info ps-2 web-text-color"></i></a>
                                        </div>
                                        
                                        <select class="form-control" id="status" name="status">
                                            @if(!isset($data_id))
                                            <option selected>-- select --</option>
                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option>
                                            @else
                                            <option value="1" @if($data_id->status == 1) selected @endif>Active</option>
                                            <option value="0" @if($data_id->status == 0) selected @endif>Inactive</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="form-group col-12 col-lg-10 my-3">
                                        <label name="status">Description</label>
                                        <textarea rows="4" name="description" class="form-control">{{$data_id->description??''}}</textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="form-group col-12 col-lg-10 my-3">
                                        <label>Category image</label>
                                        <input type="file" class="form-control px-3 py-2" id="" name="category_image" value="{{$data_id->category_name??''}}" accept=".png,.jpg,.jpeg" style="height: 37px !important;">
                                        <p><span style="color: red;">Allowed File types are .JPEG, .JPG, .PNG. and Max File size 2 MB.</span></p>
                                    </div>
                                </div>
                                @if(isset($data_id->image))
                                <img src="{{ url('storage/app/public/' . $data_id->image) }}" height="100px" width="100px">
                                @endif

                               <div class="form-group row">
                                    <div class="form-group col-12 col-lg-10 my-3">
                                        <div class="d-flex align-items-center">
                                            <label>Select Department</label>
                                            <a href="#" flow="right" tooltip="Please select Department"><i class="fa-solid fa-circle-info ps-2 web-text-color"></i></a>
                                        </div>
<select class="js-example-basic-single form-select-control depart_filter" name="department_id">
   <option value="">Select a Department</option>
   @foreach($departments as $department)
       <option value="{{$department->id ?? ''}}" 
               @if($data_id && $data_id->department_id == $department->id) selected @endif>
           {{$department->department_name ?? ''}}
       </option>
   @endforeach
</select>
                                  </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-10 px-0 mb-3">
                                        <div class="text-center">
                                            <button type="button" class="btn sbmt-btn cancel-btn mr-2">Cancel</button>
                                            <button type="submit" class="btn sbmt-btn">Submit</button>
                                        </div>
                                    </div>
                                </div>

                           



                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="bg-white p-2 rounded-3 h-100">
                                 <div class="form-group row px-1">
                                    <div class="form-group col-12 col-lg-10 my-2">
                                        <label>Parent Category</label>
                                        <div class="row px-2">
                                            <div class="col-12 border px-0" style="height: 77.2vh;overflow-y: auto;">
                                                <ul class="list-unstyled pl-3 mb-0">
                                                    @foreach($category_list as $category)
                                                        @if($category->parent_id === null)
                                                            <li>
                                                                <i class="fas fa-folder"></i>
                                                                <input class="cat-radio-btn" type="radio" name="parent_id" id="parent_id_{{ $category->id }}" value="{{ $category->id }}" @if(isset($data_id)) {{ $data_id->id == $category->id ? 'checked' : '' }} @endif>
                                                                <label class="cat-tree-label" for="parent_id_{{ $category->id }}">{{ $category->category_name }}</label>
                                                                @include('partials.subcategories', ['subcategories' => $category_list, 'parent_id' => $category->id])
                                                            </li>
                                                        @endif
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
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
