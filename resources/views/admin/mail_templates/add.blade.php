
        <div class="p-2">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <label class="mb-0 d-flex align-items-center font-weight-bold"><i class="fa-solid fa-plus headings-icon"></i>Add Mail Template </label>
                </div>

                <div>
                    <a href="{{url('automation?tab=1')}}" class="btn web-btn"><i class="fa-solid fa-eye btnn-icon"></i>View Mail Template</a>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="row px-2">
                <div class="col-12 py-2 bg-white rounded-3 mb-3">
                    <div class="row">
                        <div class="col-12 col-lg-7">
                            <form action="{{url('add_mail_template')}}" method="post" class="forms-sample pt-2">
                                @csrf
                                <input type="hidden" name="id" value="{{$data->id??''}}">
                                <div class="form-group row">
                                    <label for="exampleInputUsername1" class="col-sm-4 col-form-label">Name</label>
                                    <div class="col-sm-8 pl-1">
                                        <input type="text" class="form-control" name="title" required value="{{$data->title??''}}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="exampleInputUsername1" class="col-sm-4 col-form-label">Subject</label>
                                    <div class="col-sm-8 pl-1">
                                        <input type="text" class="form-control" name="subject" value="{{$data->subject??''}}" required>
                                    </div>
                                </div> 
                                <div class="form-group row">
                                    <label for="exampleInputUsername1" class="col-sm-4 col-form-label">Mail To</label>
                                    <div class="col-sm-8 pl-1">
                                        <input type="text" class="form-control" value="{{$data->mail_to??''}}" name="mail_to" >
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="exampleInputUsername1" class="col-sm-4 col-form-label">Mail From</label>
                                    <div class="col-sm-8 pl-1">
                                        <input type="text" class="form-control" value="{{$data->mail_from??''}}" name="mail_from" >
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="exampleInputUsername1" class="col-sm-4 col-form-label">CC Emails (If multiple, use comma to separate)</label>
                                    <div class="col-sm-8 pl-1">
                                        <input type="text" class="form-control" value="{{$data->mail_cc??''}}" name="mail_cc" >
                                    </div>
                                </div>
                                 <div class="form-group row">
                                    <label for="exampleInputUsername1" class="col-sm-4 col-form-label">Status</label>
                                    <div class="col-sm-8 pl-1">
                                        <select class="form-control" name="status">
                                            <option value="1" @if(isset($data)) @if($data->status==1) Selected @endif @endif>Active</option>
                                            <option value="2" @if(isset($data)) @if($data->status==2) Selected @endif @endif>In-Active</option>
                                        </select>
                                    </div>
                                </div>
                                 <div class="form-group row">
                                    <label for="exampleInputUsername1" class="col-sm-4 col-form-label">Template</label>
                                    <div class="col-sm-8 pl-1">
                                        <textarea name="template" id="editor1" rows="5"><?php echo $data->template??''; ?></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="text-center my-2">
                                        <button class="btn sbmt-btn mr-2"  type="submit">
                                         Submit
                                        </button>
                                        <button type="button" class="btn cancel-btn">Cancel</button>
                                    </div>
                                </div>                                                 
                            </form>
                        </div>
                    </div>
                </div>
            </div>        
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="{{asset('public/plugins/ckeditor/ckeditor.js')}}"></script>
<script src="{{asset('public/plugins/ckfinder/ckfinder.js')}}"></script>
<script>
    CKEDITOR.replace('editor1');            
</script>  