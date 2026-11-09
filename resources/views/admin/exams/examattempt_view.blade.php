@if(Request::get('type')=="lead")
@include('layouts.user.header')
@else
@include('layouts.admin.header')
@endif
<style>
    ::marker {
        font-weight: bold;
    }
    .exam-attempt-view-wrapper {
        padding-top: 25px;
        padding-bottom: 40px;
    }
    @media (min-width: 992px) {
        .exam-attempt-view-wrapper {
            padding-top: 30px;
        }
    }
</style>
<div class="container-fluid exam-attempt-view-wrapper">
    <div class="row">
        <div class="col-12 col-lg-10 offset-lg-1 my-2">
            <div class="bg-white rounded p-3 p-md-4 shadow-sm border">
                <div class="mb-3 border-bottom pb-2">
                    <label class="font-weight-bold d-flex align-items-center mb-2 fs-5">
                        Assignment Exam Evaluation: <span class="font-weight-bold text-secondary ms-2">{{ $exam->name }}</span>
                    </label>
                </div>

                <div class="mb-4 bg-light p-3 rounded">
                    <div class="mb-2">
                        <label class="mb-0">
                            <b class="text-blue">Learner Name:</b> <span class="text-black">{{ $examAttempt->user_details->first_name??'' }} {{ $examAttempt->user_details->last_name??'' }} @if(!empty($examAttempt->user_details->emp_id)) - {{ $examAttempt->user_details->emp_id }} @endif</span>
                        </label>
                    </div>
                    <div>
                        <label class="mb-0">
                            <b class="text-blue">Exam Completed Date:</b> <span class="text-black">{{ !empty($examAttempt->exam_attend_date) ? \Carbon\Carbon::parse($examAttempt->exam_attend_date)->format('F j, Y, g:i A') : 'N/A' }}</span>
                        </label>
                    </div>
                </div>

    <form action="{{ route('exam_attempt.save_results') }}" method="POST" class="p-3 rounded-3" enctype="multipart/form-data">
        <div class="row">
            <div class="col-12">
                @csrf
                <input type="hidden" name="exam_attempt_id" value="{{ $examAttempt->id }}">
                <input type="hidden" name="assigned_id" value="{{ $examAttempt->assigned_id }}">
                <input type="hidden" name="exam_code" value="{{ $exam->exam_code }}">
                <input type="hidden" name="exam_user_id" value="{{ $examAttempt->user_id }}">
                <input type="hidden" name="exam_course_id" value="{{ $examAttempt->course_id }}">
                <input type="hidden" name="user_type" value="{{ Request::get('type') }}">

            <ol>
              <?php $i=1; ?>
                @foreach($questions as $question)
                <li>
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="font-weight-bold fs-6">{{ $question->question_name }}</div>
                                <div class="font-weight-bold fs-6 marks_for_question" id="marks_for_question_{{ $question->id }}" data-question-mark="{{ $question->question_mark }}">
    Marks For Question : {{ $question->question_mark }}
</div>
                            </div>
                            @if($question->question_file)
                            <div class="col-md-12">
                                <a href="{{ url('storage/app/public/' . $question->question_file) }}" class="btn btn web-btn btn-sm" target="_blank">Question File</a>
                            </div>
                            @endif
                        </div>

                        @php
                            $answer = $answers->get($question->id);
                        @endphp

                        <div class="row">
                            <div class="col-md-12">
                                <label for="answer_text_{{ $question->id }}">Answer:</label>
                                <input type="text" name="answers[{{ $question->id }}][answer_text]" id="answer_text_{{ $question->id }}" value="{{ $answer->answer_text ?? '' }}" class="form-control">
                            </div>
                            @if($answer && $answer->answer_file)
                            <div class="col-md-12 mt-3">
                                <a href="{{ url('storage/app/public/' . $answer->answer_file) }}" class="btn web-btn btn-sm" target="_blank">Answer File</a>
                            </div>
                                @endif
                        </div>

                        <div class="row mt-2">
    <div class="col-md-12">
        <div class="form-check form-check-inline">
            <input type="radio" name="answers[{{ $question->id }}][result]" value="pass" {{ $answer && $answer->answer_result == 'pass' ? 'checked' : '' }} class="form-check-input" id="result_{{ $question->id }}_pass">
            <label class="form-check-label" for="result_{{ $question->id }}_pass">Correct</label>
        </div>
        <div class="form-check form-check-inline">
            <input type="radio" name="answers[{{ $question->id }}][result]" value="fail" {{ $answer && $answer->answer_result == 'fail' ? 'checked' : '' }} class="form-check-input" id="result_{{ $question->id }}_fail">
            <label class="form-check-label" for="result_{{ $question->id }}_fail">Wrong</label>
        </div>
    </div>
</div>

<div class="row mt-3">
    <div class="col-md-6">
        <label for="marks_{{ $question->id }}">Answer Marks for this Question:</label>
        <input type="number" name="answers[{{ $question->id }}][marks]" id="marks_{{ $question->id }}" step="0.1" value="{{ $answer->answer_marks ?? 0 }}" class="form-control" min="0" @if(!empty($question->question_mark) && $question->question_mark > 0) max="{{ $question->question_mark }}" @endif {{ $answer && $answer->answer_result == 'fail' ? 'readonly' : '' }}>
    </div>
</div>


                        <div class="row">
                            <div class="col-md-6">
                                <label for="answer_file_{{ $question->id }}">Solution Document <span class="text-danger">(File size must not exceed 2 MB, Allowed file types are: pdf, jpeg, jpg, png)</span></label>
                                <input type="file" name="answers[{{ $question->id }}][correct_answer_file]" id="correct_answer_file_{{ $question->id }}" class="form-control py-2 pl-3" style="line-height: 22px;">
                            </div>

                           <div class="col-md-6 text-end">
                                @if($answer && $answer->correct_answer_file)
                                    <a href="{{ url('storage/app/public/' . $answer->correct_answer_file) }}" class="btn btn-info btn-sm" target="_blank">Correct Answer</a>
                                @endif
                            </div> 

                        </div>

                         <div class="row mt-3">
                            <div class="col-md-6">
                                <label for="correct_answer_text_{{ $question->id }}">Correct Answer (Optional) :</label>
                                <input type="text" name="answers[{{ $question->id }}][correct_answer_text]" id="correct_answer_text_{{ $question->id }}"  value="{{ $answer->correct_answer_text ?? '' }}" class="form-control" rows="5">
                            </div>
                        </div>
                    </div>
                    <hr>
                </li>
                @endforeach

            </ol>
            </div>
            <div class="mt-4 pt-3 border-top">
                <button type="submit" class="btn btn-primary px-4 py-2">Submit Evaluation</button>
            </div>
        </form>
            </div>
        </div>
    </div>
</div>
@if(Request::get('type')=="lead")
@include('layouts.user.footer')
@else
@include('layouts.admin.footer')
@endif




 <script type="text/javascript">
    // When the radio buttons are selected
$('input[type=radio][name^="answers["]').change(function() {
    var questionId = $(this).attr('name').match(/\d+/)[0]; // Extract question ID from the radio button name
    var marksInput = $('#marks_' + questionId); // Get the input field for marks
    var selectedResult = $(this).val(); // Get the selected result ("pass" or "fail")
    var questionMarks = $('#marks_for_question_' + questionId).data('question-mark'); // Get the question marks from the data attribute

    if (selectedResult == 'pass') {
        if (questionMarks && parseFloat(questionMarks) > 0) {
            marksInput.val(questionMarks); // Set marks to the question's marks dynamically
        }
        marksInput.prop('readonly', false); // Allow editing of marks
        
        // Ensure the entered marks do not exceed the question's marks
        marksInput.off('input').on('input', function() {
            var enteredMarks = parseFloat(marksInput.val());
            if (questionMarks && parseFloat(questionMarks) > 0 && enteredMarks > parseFloat(questionMarks)) {
                marksInput.val(questionMarks); // Limit marks to question's marks
                alert('Marks cannot exceed the maximum marks for this question.');
            }
        });
    } 
    // If "Wrong" is selected
    else if (selectedResult == 'fail') {
        marksInput.val(0); // Reset marks to 0
        marksInput.prop('readonly', true); // Make the marks field readonly
    }
});



    // File validation (already present)
    $('input[type=file]').change(function(){
        if (!this.files.length) return;
        var ext = $(this).val().split('.').pop().toLowerCase();
        if($.inArray(ext, ['pdf','png','jpg','jpeg']) == -1) {
            $(this).val('');
            alert('Invalid file format!');
            return;
        }
        if(this.files[0].size >= 2097152){
             $(this).val('');
            alert('File must be less than 2MB!');
        }
    });
</script>
