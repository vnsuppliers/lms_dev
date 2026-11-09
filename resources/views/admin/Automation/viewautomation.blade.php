<div class="content-bg">
    <div class="row px-2">
        <div class="p-2">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <label class="mb-0 d-flex align-items-center font-weight-bold"><i class="fa-solid fa-eye headings-icon"></i>View Automation </label>
                </div>

                <div>
                    <a href="{{url('automation?tab=2')}}" class="btn web-btn"><i class="fa-solid fa-plus btnn-icon"></i>Add Automation</a>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="row px-2">
                <div class="col-12 py-2 bg-white rounded-3 mb-2">
                    <div class="card card-border border-top-0 shadow-none rounded-0">
                        <div class="card-body p-0 rounded-3">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Name</th>
                                            <th scope="col">Automations</th>
                                            <th scope="col" class="text-center">Operations</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td scope="row">Assign a course 1hr after another one is completed</td>
                                            <td >Z hours after course X completion, assign course(s) Y</td>
                                            <td class="text-center">...</td>
                                        </tr>
                                        <tr>
                                            <td scope="row">Assign course (24hours)</td>
                                            <td >Z hours after course X completion, assign course(s) Y</td>
                                            <td class="text-center">...</td>
                                        </tr>
                                        <tr>
                                            <td scope="row">When a certificate expires reset and assign the course</td>
                                            <td >Z hours before course X certification expiration, reset and  assign course(s) Y</td>
                                            <td class="text-center">...</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>        
        </div>