
@if(request()->has('user_id'))
    @include('layouts.admin.header')
@else
    @include('layouts.user.header')
@endif

<div class="container">
    <div class="row">
        <div class="col-12 px-0 my-2">
    <label class="font-weight-bold d-flex align-items-center mb-2">
        <!-- <i class="fa-solid fa-file-pen headings-icon fs-6"></i>  -->
        Exam: <span class="font-weight-bold text-secondary">&nbsp;{{ $exam->name }}</span></label>

        <label class="font-weight-bold d-flex align-items-center mb-2">
        <!-- <i class="fa-solid fa-file-pen headings-icon fs-6"></i>  -->
        Due Date: <span class="text-black font-weight-normal">&nbsp;{{ $exam->name }}</span></label>

        <label class="font-weight-bold d-flex align-items-center mb-2">
        <!-- <i class="fa-solid fa-file-pen headings-icon fs-6"></i>  -->
        Attempt Date: <span class="text-black font-weight-normal">{{ \Carbon\Carbon::parse($examAttempt->exam_attend_date)->format('F j, Y') }}</span></label>
    </div>
    <!-- <p>Due Date: {{ \Carbon\Carbon::parse($exam->due_date)->format('F j, Y') }}</p>
    <p>Attempt Date: {{ \Carbon\Carbon::parse($examAttempt->exam_attend_date)->format('F j, Y') }}</p> -->
  <div class="col-12 bg-white p-3 rounded-3 mb-3">
    <?php 
        $i = 1;
        $totalQuestionMarks = 0; // To store total marks for questions
        $totalAnswerMarks = 0;   // To store total marks obtained by the user
    ?>
    @foreach($questions as $question)

        <div class="mb-4 border p-3 rounded">
            <div class="row">
                <div class="col-12 col-md-9 col-lg-10">
                    <h4>{{ $i++ }}. Question: {{ $question->question_name }}</h4>
                </div>
                <div class="col-12 col-md-3 col-lg-2 text-end mt-2 mt-md-0">

                    @if($question->question_file)
                        <a href="{{ url('storage/app/public/' . $question->question_file) }}" class="btn btn-primary btn-sm" target="_blank">Question File</a>
                    @endif
                </div>
            </div>

            @php
                $answer = $answers->get($question->id);
                $questionMarks = $question->question_mark; // Marks for this question
                $totalQuestionMarks += $questionMarks; // Add to total question marks
                $answerMarks = $answer ? $answer->answer_marks : 0; // Marks obtained by the user for this question
                $totalAnswerMarks += $answerMarks; // Add to total answer marks
            @endphp

            <div class="row mt-3">
                <div class="col-12 col-md-9 col-lg-10">
                    <label for="answer_text_{{ $question->id }}">Answer:</label>
                    <input type="text" name="answers[{{ $question->id }}][answer_text]" id="answer_text_{{ $question->id }}" value="{{ $answer->answer_text ?? '' }}" class="form-control" readonly>
                </div>
                <div class="col-12 col-md-3 col-lg-2 text-end mt-2 my-md-auto">
                    <label class="invisible d-block">Answer:</label>
                    @if($answer && $answer->answer_file)
                        <a href="{{ url('storage/app/public/' . $answer->answer_file) }}" class="btn btn-primary btn-sm" target="_blank">Answer File</a>
                    @endif
                </div>

            </div>

            <div class="row mt-3">
                <div class="col-md-6">
                    <div class="form-check form-check-inline">
                        <label for="answer_result_{{ $question->id }}">Result:</label>

                    @if(isset($answer->answer_result))
                        @if($answer->answer_result === 'pass')
                            <span class="text-success">Correct</span>
                        @elseif($answer->answer_result === 'fail')
                            <span class="text-danger">Wrong </span>
                        @else
                            <span class="text-warning">Pending</span>
                        @endif
                    @endif
                    </div>
                </div>
                <div class="col-md-6 text-end">
                    <div class="form-check form-check-inline mr-0">
                        <label for="answer_result_{{ $question->id }}">Marks For Answer:</label>

                    @if(isset($answer->answer_marks))
                        <span class="text-success">{{ $answer->answer_marks ?? '' }}</span>
                    @else
                        <span class="text-warning">Not Graded</span>
                    @endif
                    </div>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-12">
                    @if($answer && $answer->correct_answer_file)
                        <label for="answer_file_{{ $question->id }}">Correct Answer:</label>
                        <a href="{{ url('storage/app/public/' . $answer->correct_answer_file) }}" class="btn btn-primary btn-sm" target="_blank">Correct Answer</a>
                    @endif
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-12">
                    @if($answer && $answer->correct_answer_text)
                        <label for="correct_answer_text_{{ $question->id }}">Correct Answer:</label>
                        <input type="text" name="correct_answer_text[{{ $question->id }}][correct_answer_text]" id="correct_answer_text_{{ $question->id }}" value="{{ $answer->correct_answer_text ?? '' }}" class="form-control" readonly>
                    @endif
                </div>
            </div>
        </div>
    @endforeach

    <div class="row mt-4">
        <div class="col-md-4">
            <h4>Total Marks for Questions: {{ $totalQuestionMarks }}</h4>
        </div>
        <div class="col-md-4 text-end">
            <h4>Total Marks Obtained: {{ $totalAnswerMarks }}</h4>
        </div>
        <div class="col-md-4 text-end">
            @php
                // Calculate percentage
                $percentage = $totalQuestionMarks > 0 ? ($totalAnswerMarks / $totalQuestionMarks) * 100 : 0;
            @endphp
            <h4>Percentage: {{ number_format($percentage, 2) }}%</h4>
        </div>
    </div>
</div>
</div>

</div>


@if(request()->has('user_id'))
    @include('layouts.admin.footer')
@else
    @include('layouts.user.footer')
@endif
