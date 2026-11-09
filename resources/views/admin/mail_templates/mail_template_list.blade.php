<div class="content-bg">
    <div class="row px-2">
         @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <div class="p-2">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <label class="mb-0 d-flex align-items-center font-weight-bold"><i class="fa-solid fa-eye headings-icon"></i>View Mail Template List </label>
                </div>

                <div>
                    <a href="{{url('mail_template?tab=2')}}" class="btn web-btn"><i class="fa-solid fa-plus btnn-icon"></i>Add Mail Template</a>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="row px-2">
                <div class="col-12 py-2 bg-white rounded-3 mb-2">
                    <div class="card card-border border-top-0 shadow-none rounded-0">
                        <div class="card-body p-0 rounded-3 mb-2">
                            <div class="col-12 col-lg-12">
                                <div class="table-responsive">
                                    <table class="table table-bodered">
                                        <thead>
                                            <tr>
                                                <th>S.no</th>
                                                <th>Title</th>
                                                <th>Subject</th>
                                                <th>Mail To</th>
                                                <th>Mail From</th>
                                                <th>Mail CC</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i=1; ?>
                                            @foreach($lists as $list)
                                            <tr>
                                                <td>{{$i++}}</td>
                                                <td>{{$list->title}}</td>
                                                <td>{{$list->subject}}</td>
                                                <td>{{$list->mail_to}}</td>
                                                <td>{{$list->mail_from}}</td>
                                                <td>{{$list->mail_cc}}</td>
                                                <td>@if($list->status==1) Active @else In-Active @endif</td>
                                                <td><a href="{{url('mail_templates')}}?id={{$list->id}}&tab=1"><i class="bi bi-pen font-16 text-primary" style="font-weight: bold !important;"></i></a>
                                                    <a href="{{url('delete_mail_template')}}?id={{$list->id}}" onclick="return confirm('Are you sure?')" title="{{__('Delete')}}" class=""><i class="bi bi-trash text-danger font-16"></i></a></td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>        
        </div>