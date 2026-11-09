@include('layouts.admin.header')

<style type="text/css">
    .hidden {
        display: none;
    }
    .green-background {
        background-color: #c6e4ff !important;
    }
    label.error {
        color: red;
        font-size: 1rem;
        display: block;
        margin-top: 5px;
    }
    input.error {
        border: 1px dashed red;
        font-weight: 300;
        color: red;
    }
    #file-error-message {
        color: red;
        font-size: 0.875rem;
        margin-top: 5px;
    }
    .question-error-message {
        color: red;
        font-size: 0.875rem;
        margin-top: 5px;
    }
</style>

<div class="tab-pane" id="ui" role="tabpanel" aria-labelledby="ui-tab">
    <div class="row">
        @if(session('error'))
        <script type="text/javascript">
            $.toast({
                heading: 'Warning',
                text: '{{ session("error") }}',
                position: 'bottom-right',
                stack: false,
                icon: 'error'
            });
        </script>
        @endif 
        @if(session('success'))
        <script type="text/javascript">
            $.toast({
                heading: 'Success',
                text: '{{ session("success") }}',
                position: 'bottom-right',
                stack: false,
                icon: 'success'
            });
        </script>
        @endif

        <div class="col-12 col-lg-12">
            <div class="tab-content border-0 p-0 mb-3 content-bg rounded-3" id="v-pills-tabContent">
                <div class="tab-pane {{ request()->query('tab') == 1 || !request()->query('tab') ? ' show active' : '' }}" id="v-pills-user" role="tabpanel" aria-labelledby="v-pills-tab-ones">
                    <div>
                        <div class="p-2">
                            <div class="d-flex justify-content-between align-items-center">
                                @if(hasPermission(1))
                                <div>
                                    <label class="mb-0 d-flex align-items-center font-weight-bold @if(Request::get('menu')=='') active @endif">
                                        <i class="fa-solid fa-plus headings-icon"></i>Add Exam
                                    </label>
                                </div>
                                @endif
                                <div>
                                    <a href="{{ route('admin.exams.view') }}" class="btn web-btn">
                                        <i class="fa-solid fa-eye btnn-icon"></i>View Exams
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="tab-content border-0 p-0" id="myTabContent">
                            @if(hasPermission(1))
                            <div class="tab-pane px-2 card-border border-top-0 fade @if(Request::get('menu')=='') show active @endif" id="ad" role="tabpanel" aria-labelledby="addc-tab">
                                <div class="card border-0 shadow-none border-radius-none">
                                    <div class="row">
                                        <div class="col-12 col-lg-7">
                                            <form class="p-2 rounded-3" id="exam-form" action="{{ route('admin.exams.store') }}" method="POST" enctype="multipart/form-data">
                                                <div class="row">
                                                    @csrf

                                                    <div class="col-12 col-md-12 col-lg-12">
                                                        <div class="form-group row">
                                                            <label for="name" class="col-sm-3 col-form-label">Exam Name</label>
                                                            <div class="col-sm-9">
                                                                <input type="text" class="form-control" id="name" name="name" required />
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label for="due_date" class="col-sm-3 col-form-label">Due Date</label>
                                                            <div class="col-sm-9">
                                                                <input type="date" class="form-control" id="due_date" name="due_date" required />
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="pass_percentage" class="col-sm-3 col-form-label">Pass Percentage</label>
                                                            <div class="col-sm-9">
                                                                <input type="number" class="form-control" id="pass_percentage" name="pass_percentage" max="100" min="1" required />
                                                            </div>
                                                        </div>

                                                        <div id="questions-container"></div>
                                                        <button type="button" class="btn sbmt-btn mr-2" id="add-question">Add Question</button>
                                                    </div>

                                                    <div class="col-12 col-md-12 col-lg-12">
                                                        <div class="text-center my-2">
                                                            <button type="submit" class="btn sbmt-btn mr-2">Save Exam</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Add question
        $('#add-question').on('click', function() {
            const container = $('#questions-container');
            if (container.children().length < 30) {
                const index = container.children().length;
                const newField = `
                    <div class="question-field">
                        <div class="form-group row">
                            <label for="question_name_${index}" class="col-sm-3 col-form-label">Question Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="question_name_${index}" name="questions[${index}][name]" placeholder="Question Name" required>
                                <div class="text-danger question-error-message" id="name-error-${index}"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="question_file_${index}" class="col-sm-3 col-form-label">Question File</label>
                            <div class="col-sm-9">
                                <input type="file" class="form-control" id="question_file_${index}" name="questions[${index}][file]">
                                <div class="text-danger question-error-message" id="file-error-message_${index}"></div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="question_mark_${index}" class="col-sm-3 col-form-label">Question Marks</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" id="question_mark_${index}" name="questions[${index}][mark]" placeholder="Question Mark" max="5" min="1" step="0.1" required>
                                <div class="text-danger question-error-message" id="mark-error-${index}"></div>
                            </div>
                        </div>
                        <button type="button" class="remove-question btn btn-danger btn-sm my-2">Remove</button>
                    </div>
                `;
                container.append(newField);
            } else {
                alert('You can add up to 30 questions only.');
            }
        });

        // Handle question removal
        $('#questions-container').on('click', '.remove-question', function() {
            $(this).parent().remove();
        });

        // File validation
        $(document).on('change', 'input[type=file]', function() {
            var index = $(this).attr('id').split('_')[2];  // Get the question index
            var file = this.files[0];
            var ext = $(this).val().split('.').pop().toLowerCase();
            var errorMessage = '';

            // Validate file extension
            if ($.inArray(ext, ['pdf', 'png', 'jpg', 'jpeg']) == -1) {
                errorMessage = 'Invalid file format! Only PDF, PNG, JPG, and JPEG files are allowed lessthan 2MB.';
            }
            // Validate file size
            else if (file.size >= 2097152) { // 2MB in bytes
                errorMessage = 'File must be less than 2MB!';
            }

            // Display file error message
            if (errorMessage) {
                $(this).val('');  // Clear the input
                $('#file-error-message_' + index).text(errorMessage);  // Show error
            } else {
                $('#file-error-message_' + index).text('');  // Clear error
            }
        });

        // Form submission validation
        // Form submission validation
$('#exam-form').submit(function(event) {
    let isValid = true;

    if ($('#questions-container .question-field').length === 0) {
            isValid = false;
            alert('Please add at least one question before submitting the form.');
        }

    // Check each question for missing name and mark
    $('#questions-container .question-field').each(function(index) {
        const questionName = $(this).find(`#question_name_${index}`).val().trim();
        const questionMark = $(this).find(`#question_mark_${index}`).val().trim();

        // Clear previous error messages
        $(`#name-error-${index}`).text('');
        $(`#mark-error-${index}`).text('');

        // Validate question name
        if (!questionName) {
            isValid = false;
            $(`#name-error-${index}`).text('Please enter the question name.');
        }

        // Validate question mark (allow decimals between 1 and 5)
        if (!questionMark || isNaN(questionMark) || parseFloat(questionMark) < 1 || parseFloat(questionMark) > 5) {
            isValid = false;
            $(`#mark-error-${index}`).text('Please enter a valid mark between 1 and 5.');
        }
    });

    // If any question has missing fields or invalid marks, prevent form submission
    if (!isValid) {
        event.preventDefault();  // Prevent form submission
        alert('Please fill in all question details correctly before submitting the form.');
    }
});

    });
</script>

@include('layouts.admin.footer')
