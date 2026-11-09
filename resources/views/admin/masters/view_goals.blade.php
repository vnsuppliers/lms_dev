<div class="tab-pane fade {{ request()->query('tab') == 2 ? 'show active' : '' }}" id="goals" role="tabpanel" aria-labelledby="viewGoals">
    <div class="p-2">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <label class="mb-0 d-flex align-items-center font-weight-bold"><i class="fa-solid fa-eye headings-icon"></i>View Goals</label>
            </div>

            <div>
                <a href="{{url('masters?tab=1')}}" class="btn web-btn {{ request()->query('tab') == 1  || !request()->query('tab') ? 'active' : '' }}"><i class="fa-solid fa-plus btnn-icon"></i>Add Goals</a>
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
                                    <!-- <th style="width: 50px;">Sl.NO.</th> -->
                                    <th scope="col">Goal</th>
                                    <th scope="col">Status</th>
                                    <th scope="col" >Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($goal as $values)
                                <tr>
                                    <!-- <td>{{$loop->iteration}}</td> -->
                                    <td scope="row">{{$values->name}}</td>
                                    <td> @if(isset($values))
                                            @if($values->status == 1)
                                                Active
                                            @else
                                                Inactive
                                            @endif
                                        @endif
                                    </td>
                                    <td>
                                         <!-- <a class="btn btn-primary btn-sm mr-2" href="{{url('roles')}}?id={{$values->id}}" >Edit</a>
                                         <a class="btn btn-danger btn-sm" href="{{url('role_destroy') }}?id={{$values->id}}">Delete</a> -->
                                         <a class="mr-2" href="{{url('masters')}}?tab=1&id={{$values->id}}" ><i class="bi bi-pen font-16 text-primary" style="font-weight: bold !important;"></i></a>
                                        <!-- <a href="{{url('role_destroy') }}?id={{$values->id}}" title="{{__('Delete')}}" class=""><i class="bi bi-trash text-danger font-16"></i></a> -->
                                     </td>
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
                                   