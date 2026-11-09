<div class="row">
    <div class="col-md-12">

        <h4 class="mb-3">Courses</h4>

        <div class="courses-settings-list">

            @foreach($courses as $key => $course)
                @php
                    $courseAssessments = $assessments[$course->id] ?? collect();
                    $isCourseExpired = $course->expiration_date && \Carbon\Carbon::parse($course->expiration_date)->isPast();
                @endphp

                <div class="course-card mb-3">

                    <div class="course-card-header d-flex align-items-center justify-content-between p-3">

                        <div class="d-flex align-items-center gap-3">
                            @if($courseAssessments->count())
                                <button type="button" class="btn btn-sm btn-light toggle-assessments" data-target="#assessments-{{ $course->id }}">
                                    <i class="fa-solid fa-chevron-right"></i>
                                </button>
                            @else
                                <span style="width:30px; display:inline-block;"></span>
                            @endif

                            <div>
                                <div class="fw-bold">{{ $course->course_name ?? '' }}</div>
                                <div class="text-muted small">Code: {{ $course->course_code ?? '' }}</div>
                            </div>
                        </div>

                        <div class="d-flex align-items-center gap-4">

                            <div class="d-flex align-items-center gap-2 due-date-cell" data-type="course" data-id="{{ $course->id }}">
                                <div class="text-end">
                                    <div class="text-muted small mb-1">Due Date</div>
                                    <span class="due-date-display fw-semibold">
                                        {{ !empty($course->expiration_date) ? \Carbon\Carbon::parse($course->expiration_date)->format('d M Y') : '—' }}
                                    </span>
                                    <input type="date"
                                           class="form-control form-control-sm due-date-input d-none"
                                           style="width:150px;"
                                           value="{{ !empty($course->expiration_date) ? \Carbon\Carbon::parse($course->expiration_date)->format('Y-m-d') : '' }}">
                                </div>

                                <button type="button" class="btn btn-sm btn-light edit-due-date" title="Edit due date">
                                    <i class="fa-solid fa-pen"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-success save-due-date d-none">
                                    <i class="fa-solid fa-check"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-secondary cancel-due-date d-none">
                                    <i class="fa-solid fa-xmark"></i>
                                </button>
                            </div>

                            <span class="badge status-badge {{ $isCourseExpired ? 'bg-danger' : 'bg-success' }}" style="min-width:70px;">
                                {{ $isCourseExpired ? 'Expired' : 'Active' }}
                            </span>

                        </div>

                    </div>

                    @if($courseAssessments->count())
                    <div class="course-card-assessments d-none" id="assessments-{{ $course->id }}">
                        <div class="px-3 pb-3 pt-2">

                            <div class="text-muted small fw-semibold mb-2 ps-1">
                                <i class="fa-solid fa-list-check me-1"></i> Assessments ({{ $courseAssessments->count() }})
                            </div>

                            @foreach($courseAssessments as $aKey => $doc)
                                @php
                                    $isAssessmentExpired = $doc->expiration_date && \Carbon\Carbon::parse($doc->expiration_date)->isPast();
                                @endphp

                                <div class="assessment-row d-flex align-items-center justify-content-between p-2 mb-1">

                                    <div class="d-flex align-items-center gap-2">
                                        <i class="fa-solid fa-file-lines text-muted"></i>
                                        <div>
                                            <div>{{ $doc->file_name ?? $doc->org_file_name ?? 'Assessment' }}</div>
                                            <div class="text-muted small">Code: {{ basename(dirname($doc->file_path)) }}</div>
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-center gap-3">

                                        <div class="d-flex align-items-center gap-2 due-date-cell" data-type="assessment" data-id="{{ $doc->id }}">
                                            <span class="due-date-display small">
                                                {{ !empty($doc->expiration_date) ? \Carbon\Carbon::parse($doc->expiration_date)->format('d M Y') : '—' }}
                                            </span>
                                            <input type="date"
                                                   class="form-control form-control-sm due-date-input d-none"
                                                   style="width:140px;"
                                                   value="{{ !empty($doc->expiration_date) ? \Carbon\Carbon::parse($doc->expiration_date)->format('Y-m-d') : '' }}">

                                            <button type="button" class="btn btn-sm btn-light edit-due-date py-0 px-2" title="Edit due date">
                                                <i class="fa-solid fa-pen"></i>
                                            </button>
                                            <button type="button" class="btn btn-sm btn-success save-due-date d-none py-0 px-2">
                                                <i class="fa-solid fa-check"></i>
                                            </button>
                                            <button type="button" class="btn btn-sm btn-secondary cancel-due-date d-none py-0 px-2">
                                                <i class="fa-solid fa-xmark"></i>
                                            </button>
                                        </div>

                                        <span class="badge status-badge {{ $isAssessmentExpired ? 'bg-danger' : 'bg-success' }}" style="min-width:70px;">
                                            {{ $isAssessmentExpired ? 'Expired' : 'Active' }}
                                        </span>

                                    </div>

                                </div>
                            @endforeach

                        </div>
                    </div>
                    @endif

                </div>

            @endforeach

        </div>

    </div>
</div>

<style>
.course-card {
    background: #fff;
    border: 1px solid #e5e7eb;
    border-radius: 10px;
    overflow: hidden;
}
.course-card-header {
    background: #fff;
}
.course-card-assessments {
    background: #f8f9fb;
    border-top: 1px solid #e5e7eb;
}
.assessment-row {
    background: #fff;
    border: 1px solid #edf0f3;
    border-radius: 8px;
}
.toggle-assessments i {
    transition: transform 0.2s ease;
}
.toggle-assessments.rotated i {
    transform: rotate(90deg);
}
</style>

<script>
$(document).off('click', '.toggle-assessments').on('click', '.toggle-assessments', function () {
    var target = $($(this).data('target'));
    target.toggleClass('d-none');
    $(this).toggleClass('rotated');
});

$(document).off('click', '.edit-due-date').on('click', '.edit-due-date', function () {
    var cell = $(this).closest('.due-date-cell');
    cell.find('.due-date-display').addClass('d-none');
    cell.find('.due-date-input').removeClass('d-none');
    cell.find('.edit-due-date').addClass('d-none');
    cell.find('.save-due-date, .cancel-due-date').removeClass('d-none');
});

$(document).off('click', '.cancel-due-date').on('click', '.cancel-due-date', function () {
    var cell = $(this).closest('.due-date-cell');
    cell.find('.due-date-display').removeClass('d-none');
    cell.find('.due-date-input').addClass('d-none');
    cell.find('.edit-due-date').removeClass('d-none');
    cell.find('.save-due-date, .cancel-due-date').addClass('d-none');
});

$(document).off('click', '.save-due-date').on('click', '.save-due-date', function () {
    var btn = $(this);
    var cell = btn.closest('.due-date-cell');
    var type = cell.data('type');
    var id = cell.data('id');
    var newDate = cell.find('.due-date-input').val();

    if (!newDate) {
        $.toast({ heading: 'warning', text: 'Please select a date.', position: 'bottom-right', icon: 'warning' });
        return;
    }

    btn.prop('disabled', true);

    $.ajax({
        url: "{{ url('update_due_date') }}",
        type: "POST",
        data: {
            _token: '{{ csrf_token() }}',
            type: type,
            id: id,
            due_date: newDate
        },
        success: function (response) {
            btn.prop('disabled', false);

            if (response.success) {
                var formatted = moment(newDate).format('DD MMM YYYY');
                cell.find('.due-date-display').text(formatted);

                var badge = cell.closest(type === 'course' ? '.course-card-header' : '.assessment-row').find('.status-badge');
                var isExpired = moment(newDate).isBefore(moment(), 'day');
                badge.removeClass('bg-success bg-danger')
                     .addClass(isExpired ? 'bg-danger' : 'bg-success')
                     .text(isExpired ? 'Expired' : 'Active');

                cell.find('.due-date-display').removeClass('d-none');
                cell.find('.due-date-input').addClass('d-none');
                cell.find('.edit-due-date').removeClass('d-none');
                cell.find('.save-due-date, .cancel-due-date').addClass('d-none');

                $.toast({ heading: 'Success', text: 'Due date updated successfully.', position: 'bottom-right', icon: 'success' });
            } else {
                $.toast({ heading: 'warning', text: response.message || 'Update failed.', position: 'bottom-right', icon: 'warning' });
            }
        },
        error: function () {
            btn.prop('disabled', false);
            $.toast({ heading: 'error', text: 'Something went wrong. Please try again.', position: 'bottom-right', icon: 'error' });
        }
    });
});
</script>