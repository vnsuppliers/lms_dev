<div class="modal fade" id="feedbackRatingsModal" tabindex="-1"
     aria-labelledby="feedbackRatingsModalLabel" aria-hidden="true">

    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="feedbackRatingsModalLabel">
                    Add Ratings & Feedback Settings
                </h5>

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>

            <form id="feedbackRatingsForm"
                  action="{{ route('update.create.ratings.feedback') }}"
                  method="POST">

                @csrf

                <input type="hidden" name="id">

                <div class="modal-body">
                    <div class="row">

                        {{-- Type --}}
                        <div class="col-md-12 mb-3">
                            <label for="feedback_setting_type" class="font-weight-bold">
                                Type <span class="text-danger">*</span>
                            </label>

                            <select class="form-control"
                                    id="feedback_setting_type"
                                    name="type"
                                    required>

                                <option value="">Select Type</option>
                                <option value="1">Overall</option>
                                <option value="2">Category</option>

                            </select>
                        </div>


                        {{-- Category --}}
                        <div class="col-md-6 mb-3"
                             id="feedback_category_wrapper"
                             style="display: none;">

                            <label for="feedback_category" class="font-weight-bold">
                                Category <span class="text-danger">*</span>
                            </label>

                            <select class="form-control"
                                    id="feedback_category"
                                    name="category_id">

                                <option value="">Select Category</option>

                                @foreach($category_list as $category)
                                    <option value="{{ $category->id }}">
                                        {{ $category->category_name }}
                                    </option>
                                @endforeach

                            </select>

                        </div>


                        {{-- Course --}}
                        <div class="col-md-6 mb-3"
                             id="feedback_course_wrapper"
                             style="display: none;">

                            <label for="feedback_course" class="font-weight-bold">
                                Course <span class="text-danger">*</span>
                            </label>


                            <select class="form-control"
                                id="feedback_course"
                                name="course_id">

                                <option value="">Select Course</option>

                                @foreach($courses as $course)
                                
                                {{-- {{ dd($course) }} --}}

                                    <option value="{{ $course->id }}" data-category-id="{{ $course->category_id }}">
                                        {{ $course->course_name }}
                                    </option>

                                @endforeach

                            </select>


                        </div>


                        {{-- Setting Name --}}
                        <div class="col-md-6 mb-3">

                            <label for="feedback_setting_name"
                                   class="font-weight-bold">

                                Feedback Name <span class="text-danger">*</span>

                            </label>

                            <textarea class="form-control"
                                      id="feedback_setting_name"
                                      name="name"
                                      required></textarea>

                        </div>


                        {{-- Status --}}
                        <div class="col-md-6 mb-3">

                            <label for="feedback_setting_status"
                                   class="font-weight-bold">

                                Status <span class="text-danger">*</span>

                            </label>

                            <select class="form-control"
                                    id="feedback_setting_status"
                                    name="is_active"
                                    required>

                                <option value="1">Active</option>
                                <option value="0">Inactive</option>

                            </select>

                        </div>


                        {{-- Rating --}}
                        <div class="col-md-6 mb-3">

                            <label class="font-weight-bold d-block">
                                Enable Rating
                                <span class="text-danger">*</span>
                            </label>

                            <div class="custom-control custom-radio custom-control-inline">

                                <input type="radio"
                                       id="modal_rating_yes"
                                       name="rating_enabled"
                                       class="custom-control-input"
                                       value="1"
                                       checked>

                                <label class="custom-control-label"
                                       for="modal_rating_yes">
                                    Yes
                                </label>

                            </div>

                            <div class="custom-control custom-radio custom-control-inline">

                                <input type="radio"
                                       id="modal_rating_no"
                                       name="rating_enabled"
                                       class="custom-control-input"
                                       value="0">

                                <label class="custom-control-label"
                                       for="modal_rating_no">
                                    No
                                </label>

                            </div>

                        </div>


                        {{-- Feedback --}}
                        <div class="col-md-6 mb-3">

                            <label class="font-weight-bold d-block">
                                Enable Feedback
                                <span class="text-danger">*</span>
                            </label>

                            <div class="custom-control custom-radio custom-control-inline">

                                <input type="radio"
                                       id="modal_feedback_yes"
                                       name="feedback_enabled"
                                       class="custom-control-input"
                                       value="1"
                                       checked>

                                <label class="custom-control-label"
                                       for="modal_feedback_yes">
                                    Yes
                                </label>

                            </div>

                            <div class="custom-control custom-radio custom-control-inline">

                                <input type="radio"
                                       id="modal_feedback_no"
                                       name="feedback_enabled"
                                       class="custom-control-input"
                                       value="0">

                                <label class="custom-control-label"
                                       for="modal_feedback_no">
                                    No
                                </label>

                            </div>

                        </div>

                    </div>
                </div>


                <div class="modal-footer">

                    <button type="button"
                            class="btn btn-secondary px-3 py-2"
                            style="min-width: 100px;"
                            data-bs-dismiss="modal">

                        Cancel

                    </button>

                    <button type="submit"
                            class="btn sbmt-btn px-3 py-2"
                            style="min-width: 100px;">

                        <i class="fa-solid fa-save mr-1"></i>
                        Save

                    </button>

                </div>

            </form>

        </div>
    </div>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function () {

        const form = document.getElementById('feedbackRatingsForm');
        const title = document.getElementById('feedbackRatingsModalLabel');

        const typeSelect =
            document.getElementById('feedback_setting_type');

        const categoryWrapper =
            document.getElementById('feedback_category_wrapper');

        const categorySelect =
            document.getElementById('feedback_category');

        const courseWrapper =
            document.getElementById('feedback_course_wrapper');

        const courseSelect =
            document.getElementById('feedback_course');

        const addButton =
            document.getElementById('addFeedbackRatings');

        const allCourseOptions = Array.from(courseSelect.querySelectorAll('option[data-category-id]'))
            .map(function (option) {
                return option.cloneNode(true);
            });

        function loadCategoryCourses(categoryId, selectedCourseId = '') {
            courseSelect.innerHTML = '<option value="">Select Course</option>';

            allCourseOptions.forEach(function (option) {
                if (String(option.dataset.categoryId) === String(categoryId)) {
                    courseSelect.appendChild(option.cloneNode(true));
                }
            });

            courseSelect.value = selectedCourseId ? String(selectedCourseId) : '';
        }

        categorySelect.addEventListener('change', function () {
            loadCategoryCourses(this.value);
        });


        // =========================================================
        // TYPE CHANGE
        // =========================================================

        typeSelect.addEventListener('change', function () {

            if (this.value === '2') {

                // Category
                categoryWrapper.style.display = 'block';
                categorySelect.required = true;

                // Course
                courseWrapper.style.display = 'block';
                courseSelect.required = true;

            } else {

                categoryWrapper.style.display = 'none';
                categorySelect.required = false;
                categorySelect.value = '';

                courseWrapper.style.display = 'none';
                courseSelect.required = false;
                loadCategoryCourses('');

            }

        });


        // =========================================================
        // ADD
        // =========================================================

        if (addButton) {

            addButton.addEventListener('click', function () {

                form.reset();

                form.querySelector('[name="id"]').value = '';

                title.textContent =
                    'Add Ratings & Feedback Settings';

                categoryWrapper.style.display = 'none';
                courseWrapper.style.display = 'none';

                categorySelect.required = false;
                courseSelect.required = false;
                loadCategoryCourses('');

            });

        }


        // =========================================================
        // EDIT
        // =========================================================


        document.querySelectorAll('.editFeedbackRatings')
        .forEach(function (button) {

            button.addEventListener('click', function () {

                const id = this.dataset.id;
                const name = this.dataset.name;
                const type = this.dataset.type;
                const category = this.dataset.category;
                const course = this.dataset.course;
                const active = this.dataset.active;
                const rating = this.dataset.rating;
                const feedback = this.dataset.feedback;

                // ID
                form.querySelector('[name="id"]').value = id;

                // Name
                form.querySelector('[name="name"]').value = name;

                // Type
                typeSelect.value = type;

                // Status
                form.querySelector('[name="is_active"]').value = active;

                // Rating
                form.querySelectorAll('[name="rating_enabled"]').forEach(function (radio) {
                    radio.checked = radio.value == rating;
                });

                // Feedback
                form.querySelectorAll('[name="feedback_enabled"]').forEach(function (radio) {
                    radio.checked = radio.value == feedback;
                });

                // Category + Course
                if (type == '2') {

                    categoryWrapper.style.display = 'block';
                    courseWrapper.style.display = 'block';

                    categorySelect.required = true;
                    courseSelect.required = true;

                    categorySelect.value = category;
                    loadCategoryCourses(category, course);

                } else {

                    categoryWrapper.style.display = 'none';
                    courseWrapper.style.display = 'none';

                    categorySelect.required = false;
                    courseSelect.required = false;

                    categorySelect.value = '';
                    loadCategoryCourses('');
                }

                // Modal title
                title.textContent = 'Edit Ratings & Feedback Settings';

            });

        });


        // =========================================================
        // DELETE
        // =========================================================

        document.querySelectorAll('.deleteFeedbackRatings')
            .forEach(function (button) {

                button.addEventListener('click', function () {

                    document.getElementById(
                        'deleteFeedbackRatingsForm'
                    ).action = this.dataset.url;

                    document.getElementById(
                        'deleteFeedbackRatingsName'
                    ).textContent = this.dataset.name;

                });

            });

    });
</script>
