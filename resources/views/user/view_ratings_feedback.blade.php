@include('layouts.user.header')

<style>
    /* Interactive Star Rating (For new submissions) */
    .star-rating {
        direction: rtl;
        display: inline-flex;
        position: relative; 
    }
    
    .star-rating input[type="radio"] {
        position: absolute;
        opacity: 0;
        width: 1px;
        height: 1px;
        margin: 0;
        padding: 0;
        pointer-events: none;
    }
    
    .star-rating label {
        color: #e4e5e9;
        font-size: 2.2rem;
        cursor: pointer;
        transition: color 0.2s ease-in-out, transform 0.1s ease;
        margin: 0 2px;
        line-height: 1;
    }
    
    .star-rating label:hover,
    .star-rating label:hover ~ label,
    .star-rating input[type="radio"]:checked ~ label {
        color: #ffc107;
    }
    
    .star-rating label:active {
        transform: scale(0.9);
    }
</style>

<div class="container-fluid py-4 bg-light">
    <div class="row justify-content-center m-0">
        <div class="col-12 col-xl-8">

            <h4 class="mb-4 fw-bold text-dark">
                Feedback & Ratings
            </h4>

            <!-- ========================================== -->
            <!-- ADD THIS BLOCK FOR SUCCESS/ERROR MESSAGES  -->
            <!-- ========================================== -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show shadow-sm rounded-3 mb-4" role="alert">
                    <i class="fa-solid fa-circle-check me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show shadow-sm rounded-3 mb-4" role="alert">
                    <div class="d-flex align-items-center mb-2">
                        <i class="fa-solid fa-triangle-exclamation me-2"></i> <strong>Please fix the following errors:</strong>
                    </div>
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <!-- ========================================== -->

            @forelse($feedbackRatings as $ratingItem)
            
                
                @php
                    // Check if the user has already submitted this specific feedback
                    $existingRating = $employeeFeedbackRatings->get($ratingItem->id) ?? null;
                @endphp

                <div class="card border-0 shadow-sm rounded-4 mb-4">
                    <div class="card-body p-4 p-lg-5">
                        
                        <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom border-light">
                            <h5 class="fw-bold m-0 text-primary text-break">
                                {{ $ratingItem->name }}
                            </h5>
                            
                            @if($existingRating)
                                <span class="badge bg-success text-white rounded-pill px-3 py-2 fw-semibold">
                                    <i class="fa-solid fa-check-circle me-1"></i> Submitted
                                </span>
                            @endif
                        </div>

                        <form class="overallFeedbackRatingsForm" action="{{ url('submit-feedback') }}" method="POST">
                            @csrf
                            <input type="hidden" name="feedback_rating_setting_id" value="{{ $ratingItem->id }}">

                            <div class="row gy-4">
                                @if($ratingItem->rating_enabled)
                                    <div class="col-12 col-md-4">
                                        <label class="form-label fw-semibold text-dark mb-2">
                                            Rate your experience <span class="text-danger">*</span>
                                        </label>
                                        <div class="star-rating d-block">
                                            @for($star = 5; $star >= 1; $star--)
                                                <input type="radio" 
                                                       id="star{{ $star }}_{{ $ratingItem->id }}" 
                                                       name="rating" 
                                                       value="{{ $star }}" 
                                                       {{ ($existingRating && $existingRating->rating == $star) ? 'checked' : '' }} 
                                                       required />
                                                <label for="star{{ $star }}_{{ $ratingItem->id }}" title="{{ $star }} star{{ $star > 1 ? 's' : '' }}">&#9733;</label>
                                            @endfor
                                        </div>
                                    </div>
                                @endif

                                @if($ratingItem->feedback_enabled)
                                    <div class="col-12 {{ $ratingItem->rating_enabled ? 'col-md-4' : 'col-md-6' }}">
                                        <label for="feedback_{{ $ratingItem->id }}" class="form-label fw-semibold text-dark mb-2">
                                            <i class="fa-regular fa-comment-dots text-primary me-1"></i> Comments <span class="text-danger">*</span>
                                        </label>
                                        <textarea class="form-control bg-light border p-3 shadow-none"
                                                  style="border-radius: 12px;"
                                                  id="feedback_{{ $ratingItem->id }}"
                                                  name="feedback"
                                                  rows="3"
                                                  placeholder="Tell us about your experience..."
                                                  required>{{ old('feedback', $existingRating->feedback ?? '') }}</textarea>
                                    </div>

                                    <div class="col-12 {{ $ratingItem->rating_enabled ? 'col-md-4' : 'col-md-6' }}">
                                        <label for="suggestions_{{ $ratingItem->id }}" class="form-label fw-semibold text-dark mb-2">
                                            <i class="fa-regular fa-lightbulb text-warning me-1"></i> Suggestions (Optional)
                                        </label>
                                        <textarea class="form-control bg-light border p-3 shadow-none"
                                                  style="border-radius: 12px;"
                                                  id="suggestions_{{ $ratingItem->id }}"
                                                  name="suggestions"
                                                  rows="3"
                                                  placeholder="Any ideas or suggestions for improvement?">{{ old('suggestions', $existingRating->suggestions ?? '') }}</textarea>
                                    </div>
                                @endif
                            </div>

                            <div class="d-flex justify-content-end mt-4 pt-4 border-top">
                                <button type="submit" class="btn btn-primary rounded-pill px-5 py-2 fw-semibold shadow-sm">
                                    <i class="fa-solid {{ $existingRating ? 'fa-arrows-rotate' : 'fa-paper-plane' }} me-1"></i>
                                    {{ $existingRating ? 'Update Feedback' : 'Submit Feedback' }}
                                </button>
                            </div>
                        </form>

                    </div>
                </div>

            @empty
                <div class="text-center py-5 bg-white shadow-sm rounded-4">
                    <h5 class="text-muted m-0">
                        No feedback requests available at the moment.
                    </h5>
                </div>
            @endforelse

            <div class="d-flex justify-content-center mt-4">
                {{ $feedbackRatings->links() }}
            </div>

        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $(document).off('submit', '.overallFeedbackRatingsForm').on('submit', '.overallFeedbackRatingsForm', function(event) {
            event.preventDefault();
            const form = $(this);
            if (form.data('submitting')) {
                return false;
            }

            const submitButton = form.find('button[type="submit"]');
            const originalButtonHtml = submitButton.html();

            form.data('submitting', true);

            $.ajax({
                type: 'POST',
                url: form.attr('action'),
                data: form.serialize(),
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                beforeSend: function() {
                    submitButton.prop('disabled', true).html('<i class="fa-solid fa-spinner fa-spin me-1"></i> Saving...');
                },
                success: function(response) {
                    submitButton.html('<i class="fa-solid fa-arrows-rotate me-1"></i> Update Feedback');
                    let badge = form.closest('.card-body').find('.badge');
                    if (badge.length === 0) {
                        form.closest('.card-body').find('.border-bottom').append('<span class="badge bg-success text-white rounded-pill px-3 py-2 fw-semibold"><i class="fa-solid fa-check-circle me-1"></i> Submitted</span>');
                    }
                    if (typeof Swal !== 'undefined') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: response.message
                        });
                    } else {
                        alert(response.message);
                    }
                },
                error: function(xhr) {
                    submitButton.html(originalButtonHtml);
                    const errors = xhr.responseJSON && xhr.responseJSON.errors;
                    const message = xhr.responseJSON && xhr.responseJSON.message
                        ? xhr.responseJSON.message
                        : (errors ? Object.values(errors)[0][0] : 'Unable to save feedback and ratings.');
                    if (typeof Swal !== 'undefined') {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Notice',
                            text: message
                        });
                    } else {
                        alert(message);
                    }
                },
                complete: function() {
                    form.data('submitting', false);
                    submitButton.prop('disabled', false);
                }
            });
        });
    });
</script>

@include('layouts.user.footer')