<div class="rounded-3 p-2 bg-white">
    <div class="tab-content border-0 px-0 py-0" id="v-pills-tabContent">
        <div class="tab-pane fade show active" id="v-pills" role="tabpanel" aria-labelledby="v-pills-course-edit-tab">
            <div class="row align-items-center mb-2">
                <div class="col-4 col-lg-2">
                    <div class="view-course-imagee">
                        <img src="{{ url('public/images/course.jpg') }}" class="img-fluid" alt="course-image">
                    </div>
                </div>
                <div class="col-8 col-lg-10 ps-0">
                    <div class="mb-1 course-name font-weight-bold">{{ $exam_details->name }}</div>
                    <div class="py-1 sub-categories-styles d-flex align-items-center" value="{{$user->category_details->id??''}}">
                        <span class="dashed-border-category-icon"><i class="fa-solid fa-folder-tree"></i></span>
                        <span class="ps-2">{{ $exam_details->exam_code }}</span>
                         <span class="ps-2">Number of questions - {{ $exam_details->questions->count() ??'0' }}</span>
                    </div>
                    <div class="py-1 sub-categories-styles d-flex align-items-center">
                        <span class="dashed-border-category-icon" style="font-size: 9px;padding: 3px 5px;"><i class="fa-solid fa-calendar-days"></i></span>
                        <span class="ps-2">Created on : {{ $exam_details->created_at }}</span>
                    </div>
                </div>
            </div>

            <div class="">
                <nav>
                    <div class="nav nav-tabs font-smallsize" id="nav-tab" role="tablist">
                       <button class="nav-link nav-linkk active my-3" id="about-course-tab" data-bs-toggle="tab" data-bs-target="#about-course" type="button" role="tab" aria-controls="about-course" aria-selected="true">Exam Details</button>

<button class="nav-link nav-linkk my-3" id="users-list-tab" data-bs-toggle="tab" data-bs-target="#users-list" type="button" role="tab" aria-controls="users-list" aria-selected="false">Assigned Users</button>
                    </div>
                
                </nav>

        <div class="tab-content border-0 mt-0 p-0 admin-course-det-height height-100vh" id="myTabContent">
                    <div class="tab-pane fade show active card-border border-top-0" id="about-course" role="tabpanel" aria-labelledby="about-course-tab">
                        <form id="exam-form" action="{{ route('admin.exams.edit_store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12 px-3">
                                    <div id="course-details">
                                        <div class="row">
                                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 px-4">
                                                <div class="form-group row my-3">
                                                    <div class="col-6 col-lg-2 my-auto">
                                                        <label class="mb-0">Exam:</label>
                                                    </div>
                                                    <div class="col-6 col-lg-10 my-auto">
                                                        <input type="text" class="form-control" name="name" value="{{ $exam_details->name }}" placeholder="Exam Name">
                                                        <input type="hidden" class="form-control" name="exam_id" value="{{ $exam_details->id }}" placeholder="Exam Name">
                                                    </div>
                                                </div>
                                                <div class="form-group row my-3">
                                                    <div class="col-6 col-lg-2 my-auto">
                                                        <label class="mb-0">Due Date:</label>
                                                    </div>
                                                    <div class="col-6 col-lg-10 my-auto">
                                                        <input type="date" class="form-control" name="due_date" value="{{ $exam_details->due_date }}" placeholder="Due Date">
                                                    </div>
                                                </div>
                                                <div class="form-group row my-3">
                                                    <div class="col-6 col-lg-2 my-auto">
                                                        <label class="mb-0">Marks Percentage:</label>
                                                    </div>
                                                    <div class="col-6 col-lg-10 my-auto">
                                                        <input type="text" class="form-control" name="pass_percentage" value="{{ $exam_details->pass_percentage??'' }}" placeholder="Pass Percentage">
                                                    </div>
                                                </div>

                                                <div class="question-list">
                                                    <label class="mb-3">Questions:</label>
                                                    <?php $i = 1; ?>
                                                    @foreach($questions as $question)
                        <div class="question-item mb-3" id="question_{{ $question->id }}">
                            <div class="form-group row">
                                <div class="col-sm-3">Question {{ $i++ }}:</div>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="questions[{{ $question->id }}][name]" value="{{ $question->question_name }}" placeholder="Question Name">
                                    <input type="hidden" class="form-control" name="questions[{{ $question->id }}][id]" value="{{ $question->id }}" placeholder="Question Name">
                                </div>
                            </div>
            @if($question->question_file)
                <div class="form-group row my-3">
                    <div class="col-sm-3">Question File:</div>
                    <div class="col-sm-9">
                        <a href="{{ url('storage/app/public/' . $question->question_file) }}" target="_blank">View File</a>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-3">Replace Question File:</div>
                    <div class="col-sm-9">
                        <input type="file" class="form-control" name="questions[{{ $question->id }}][file]">
                    </div>
                </div>

            @endif
                <div class="form-group row">
                    <div class="col-sm-3">Question Marks:</div>
                    <div class="col-sm-9">
                        
                        <input type="number" class="form-control" name="questions[{{ $question->id }}][mark]" value="{{ $question->question_mark ??''}}" placeholder="Question Mark"  max="5" min="1" step="0.1">
                    </div>
                </div>
            <input type="hidden" name="questions[{{ $question->id }}][existing]" value="1">
            <!-- Add Remove Button for Existing Questions -->
            <button type="button" class="btn btn-danger btn-sm remove-existing-question" data-id="{{ $question->id }}">Remove</button>
        </div>
    @endforeach
                                                </div>

                                                <!-- Add New Question Dynamically -->
                                                <div id="new-questions-container"></div>

                                                <div class="my-2">
                                                    <button type="button" class="btn sbmt-btn" id="add-question-btn">Add Question</button>
                                                </div>

                                                <div class="form-group text-center my-4">
                                                    <button type="submit" class="btn sbmt-btn">Submit Exam</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>


                    <div class="tab-pane fade card-border border-top-0" id="users-list" role="tabpanel" aria-labelledby="users-list-tab">
                        <div class="col-12 mt-2 px-1">
                                    <div class="table-responsive mt-2">
                                                <!-- <label class="mb-2 d-flex align-items-center"><i class="fa-solid fa-check headings-icon py-1"></i>Completed Users </label> -->
                                                <div class="table-responsive">
                                                   <table class="table" style="width:100%">
                                                        <thead>
           
                                                        <tr>
                                                            <th>User Name</th>
                                                            <th>Course Name</th>
                                                            <th>Result</th>
                                                            <th>Action</th>
                                                        </tr>
                                                        </thead>
                                                    <tbody>
                                                         @foreach($course_withCourses as $course)
                @foreach($course->Assigned_usersdetails as $user)  
                    <tr>
                        <td>{{ $user->users_data->first_name??'' }}</td>  <!-- Assuming user has 'name' attribute -->
                        <td>{{ $course->course_name ??''}}</td>  <!-- Assuming course has 'name' attribute -->
                        <td>{{ $user->assigned_exam_data->exam_result??'N/A' }}</td>  <!-- Display the exam code -->
                        <td>
                            @if(isset($user->assigned_exam_data->exam_result))
                            @if($user->assigned_exam_data->exam_result != 'Pending')
                                                              <a href="{{ route('admin.exams.Resultview') }}?course_id={{ $course->id }}&exam_name={{ urlencode(optional($exam_details)->exam_code ?? '') }}&ex_c={{ $exam_details->id ?? '' }}&user_id={{ $user->user_id }}&attempt_id={{ $user->assigned_exam_data->id ?? '' }}" target="_blank" class="btn btn-primary">
                                                                View Results </a>
                                                            @else
                                                                 {{'WaitIng for evaluation'}}
                                                            @endif
                            @endif
                            
                        </td>
                    </tr>
                @endforeach
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
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script type="text/javascript">
    $(document).ready(function () {
        // Add new question dynamically
        $('#add-question-btn').on('click', function () {
            const newQuestionIndex = $('.question-item').length + 1;
            const newQuestionHtml = `
                <div class="question-item mb-3" id="new-question-${newQuestionIndex}">
                    <div class="form-group row my-3 pt-2">
                        <div class="col-6 col-lg-2 my-auto">New Question ${newQuestionIndex}:</div>
                        <div class="col-6 col-lg-10 my-auto">
                            <input type="text" class="form-control" name="questions[new_${newQuestionIndex}][name]" placeholder="Question Name">
                        </div>
                    </div>
                    <div class="form-group row my-3">
                        <div class="col-6 col-lg-2 my-auto">Question File:</div>
                        <div class="col-6 col-lg-10 my-auto">
                            <input type="file" class="form-control" name="questions[new_${newQuestionIndex}][file]">
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <div class="col-sm-3 col-lg-2">Question Mark:</div>
                        <div class="col-sm-9 col-lg-10">
                            <input type="number" class="form-control" name="questions[new_${newQuestionIndex}][mark]"  max="5" min="1" step="0.1" oninput="validateMarks(this)">
                        </div>
                    </div>
                    <button type="button" class="btn btn-danger btn-sm remove-question" data-id="new_${newQuestionIndex}">Remove</button>
                </div>
            `;
            $('#new-questions-container').append(newQuestionHtml);
        });

        // Remove new question dynamically using event delegation
        $(document).on('click', '.remove-question', function () {
            const questionId = $(this).data('id');
            console.log("Removing new question with id: ", questionId);

            // Remove the parent div of the button clicked
            $(this).closest('.question-item').remove();
        });

        // Handle removing existing questions
        $(document).on('click', '.remove-existing-question', function () {
            const questionId = $(this).data('id');

            // Show confirmation dialog using SweetAlert
            Swal.fire({
                title: 'Are you sure?',
                text: 'This action will permanently delete the question!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    // If the user confirms, make an AJAX request to delete the question
                    $.ajax({
                        url: "{{ route('admin.exams.delete_question') }}", // Route for deleting question
                        method: 'POST',
                        data: {
                            _token: "{{ csrf_token() }}", // CSRF token
                            question_id: questionId
                        },
                        success: function(response) {
                            if (response.success) {
                                // Successfully deleted the question, remove it from the DOM
                                $('#question_' + questionId).remove();
                                Swal.fire(
                                    'Deleted!',
                                    'The question has been deleted.',
                                    'success'
                                );
                            } else {
                                Swal.fire(
                                    'Error!',
                                    'There was an issue deleting the question.',
                                    'error'
                                );
                            }
                        },
                        error: function() {
                            Swal.fire(
                                'Error!',
                                'There was an issue with the request.',
                                'error'
                            );
                        }
                    });
                }
            });
        });
    });

function validateMarks(input) {
    let value = parseFloat(input.value);
    if (value < 1 || value > 5 || isNaN(value)) {
        input.setCustomValidity("Marks must be between 1 and 5.");
    } else {
        input.setCustomValidity(""); // Remove the custom error message if the input is valid
    }
}
</script>


