
<div class="tab-pane fade {{ request()->query('tab') == 4 ? 'show active' : '' }}" id="levels" role="tabpanel" aria-labelledby="viewLevels">
    <div class="p-2">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <label class="mb-0 d-flex align-items-center font-weight-bold"><i class="fa-solid fa-eye headings-icon"></i>View Levels</label>
            </div>

            <div>
                <a href="{{url('masters?tab=3')}}" class="btn web-btn {{ request()->query('tab') == 3 ? 'active' : '' }}"><i class="fa-solid fa-plus btnn-icon"></i>Add Levels</a>
            </div>
        </div>
    </div>
    <div class="row mx-0">
        <div class="col-12 col-sm-12 px-2">
            <div class="card card-border border-top-0 shadow-none">
                <div class="card-body p-2 rounded-3">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                  <th style="width: 50px;">Sl.NO.</th>                           
                                  <th scope="col">Name</th>
                                  <th scope="col">Status</th>
                                  <th scope="col">Action</th>
                              </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    @foreach($level_data as $s)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$s->name??''}}</td>
                                        <td >@if(isset($s))
                                            @if($s->status == 1)
                                            Active
                                            @else
                                            Inactive
                                            @endif
                                        @endif</td>
                                        <td>
                                         <!-- <a class="btn btn-primary btn-sm mr-2" href="{{url('roles')}}?id={{$s->id}}">Edit</a>   
                                             <a class="btn btn-danger btn-sm" href="{{url('permission_destroy')}}?id={{$s->id}}">Delete</a> -->
                                             <a class="mr-2" href="{{url('masters')}}?tab=3&id={{$s->id}}" ><i class="bi bi-pen font-16 text-primary" style="font-weight: bold !important;"></i></a>
                                             <!-- <a href="{{url('permission_destroy')}}?id={{$s->id}}" title="{{__('Delete')}}" class=""><i class="bi bi-trash text-danger font-16"></i></a> -->
                                         </td>
                                     </tr>
                                     @endforeach
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>