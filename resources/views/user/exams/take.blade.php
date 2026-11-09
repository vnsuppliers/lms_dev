@include('layouts.user.header')
<style>
    ::marker {
        font-weight: bold;
    }
</style>
    <div class="col-12 offset-0 col-lg-10 offset-lg-1 my-3">
        <label class="font-weight-bold d-flex align-items-center mb-3"><i class="fa-solid fa-file-pen headings-icon fs-6"></i> Assignment Exam : <span class="font-weight-bold text-black">&nbsp;{{ $exam->name }}</span></label>

        
        <form action="{{ route('exams.submit', $exam) }}" method="POST" class="p-3 rounded-3" enctype="multipart/form-data">
            <div class="row">
                <div class="col-12">
                    @csrf
                    <input type="hidden" name="course_id" value="{{ request()->query('course_id') }}">

                    <?php $i=1; ?>
                    

                    <ol>
                    @foreach($questions as $question)
                        <li>
                    <div class="question mb-3">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="font-weight-bold fs-6">{{ $question->question_name }}</div>
                            </div>
                            <div class="col-md-12">
                                <div class="font-weight-bold fs-6">Marks for Question : {{ $question->question_mark ?? '1'}}</div>
                            </div>
                            <div class="col-12 mt-2">
                                @if($question->question_file && !empty($question->question_file))
                                    <a href="{{ url('storage/app/public/' . $question->question_file) }}" class="btn btn-warning view-que-file-btn" target="_blank">View Question File</a>
                                @endif
                            </div>
                        </div>

                        <div class="form-group mt-4">
                            <label for="answer_text_{{ $question->id }}">Answer</label>
                             <textarea class="form-control" id="answer_text_{{ $question->id }}" name="questions[{{ $question->id }}][answer_text]" placeholder="Your answer text" rows="5"> </textarea>
                        </div>

                        <div class="form-group mt-4">
                            <label for="answer_file_{{ $question->id }}">Answer Document <span class="text-danger">(File size must not exceed 2 MB, Allowed file types are: pdf, jpeg, jpg, png)</span></label>
                            <input type="file" class="form-control choose-file-input" id="answer_file_{{ $question->id }}" name="questions[{{ $question->id }}][answer_file]">
                        </div>

                        <hr>
                    </div>
                    </li>
            
                    @endforeach
                    </ol>
                

                    <button type="submit" class="btn btn-primary">Submit Answers</button>
                </div>
            </div> 
        </form>
    </div>
@include('layouts.user.footer')
<script type="text/javascript">
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
            alert('File must be less than 2MB !');
        }
    });

</script>
