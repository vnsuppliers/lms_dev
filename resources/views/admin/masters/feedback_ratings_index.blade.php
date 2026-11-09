<style>
    #feedbackRatingsTable {
        width: 100% !important;
    }

    #feedbackRatingsTable_wrapper {
        width: 100% !important;
    }

    .table-responsive {
        width: 100%;
    }

    .dataTables_wrapper {
        width: 100% !important;
    }
</style>
<div class="tab-pane fade {{ request()->query('tab') == 8 ? 'show active' : '' }}"
     id="ratings-feedback"
     role="tabpanel"
     aria-labelledby="ratings-feedback-tab">

    <div class="row">
        <div class="col-12">
        <div class="d-flex justify-content-between align-items-center py-2 flex-wrap">
            <label class="mb-0 d-flex align-items-center font-weight-bold">
                <i class="fa-solid fa-star headings-icon mr-2"></i>Ratings & Feedback Settings
            </label>
            <button type="button" class="btn web-btn mt-2 mt-md-0" data-bs-toggle="modal" data-bs-target="#feedbackRatingsModal" id="addFeedbackRatings">
                <i class="fa-solid fa-plus btnn-icon mr-1"></i>Add New
            </button>
        </div>

        @if(session('success'))
            <script>
                $.toast({
                    heading: 'Success',
                    text: @json(session('success')),
                    position: 'bottom-right',
                    stack: false,
                    icon: 'success'
                });
            </script>
        @endif
        @if(session('error') || $errors->any())
            <script>
                $.toast({
                    heading: 'Error',
                    text: @json(session('error') ?: $errors->first()),
                    position: 'bottom-right',
                    stack: false,
                    icon: 'error'
                });
            </script>
        @endif

        <div class="table-responsive w-100">
            <table id="feedbackRatingsTable"
            class="table table-bordered table-striped mb-0 w-100"
            style="width:100%;">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Category Name</th>
                        <th>Course Name</th>
                        <th>Feedback Name</th>
                        <th>Type</th>
                        <th>Status</th>
                        <th>Rating Enabled</th>
                        <th>Feedback Enabled</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($feedbackRatings as $rating)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $rating->category->category_name ?? '--' }}</td>
                            <td>{{ $rating->course->course_name ?? '--' }}</td>

                            <td class="text-break" style="max-width: 400px;">
                                {{ $rating->name }}
                            </td>

                            <td>
                                {{ $rating->type == 1 ? 'Overall' : 'Category' }}
                            </td>

                            <td>
                                {{ $rating->is_active ? 'Active' : 'Inactive' }}
                            </td>

                            <td>
                                {{ $rating->rating_enabled ? 'Yes' : 'No' }}
                            </td>

                            <td>
                                {{ $rating->feedback_enabled ? 'Yes' : 'No' }}
                            </td>

                            <td>
                                <button type="button"
                                    class="btn btn-sm btn-primary editFeedbackRatings"
                                    data-bs-toggle="modal"
                                    data-bs-target="#feedbackRatingsModal"
                                    data-id="{{ $rating->id }}"
                                    data-name="{{ $rating->name }}"
                                    data-type="{{ $rating->type }}"
                                    data-category="{{ $rating->category_id }}"
                                    data-course="{{ $rating->course_id }}"
                                    data-active="{{ $rating->is_active }}"
                                    data-rating="{{ $rating->rating_enabled }}"
                                    data-feedback="{{ $rating->feedback_enabled }}">
                                    <i class="fa-solid fa-pen"></i> Edit
                                </button>

                                <button type="button"
                                    class="btn btn-sm btn-danger deleteFeedbackRatings"
                                    data-bs-toggle="modal"
                                    data-bs-target="#deleteFeedbackRatingsModal"
                                    data-name="{{ $rating->name }}"
                                    data-url="{{ route('delete.ratings.feedback', $rating->id) }}">
                                    <i class="fa-solid fa-trash"></i> Delete
                                </button>
                                <a href="{{ url('masters/feedback_overview/'. $rating->id??'') }}"
                                    class="btn btn-sm btn-primary">
                                    <i class="fa-solid fa-eye"></i> Feedback overview
                                </a>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>

@include('admin.masters.feedback_ratings_modals.add_ratings_feedback')
@include('admin.masters.feedback_ratings_modals.delete_feedback_ratings')

<script>
    document.addEventListener('DOMContentLoaded', function () {

        const form = document.getElementById('feedbackRatingsForm');
        const title = document.getElementById('feedbackRatingsModalLabel');

        const typeSelect = document.getElementById('feedback_setting_type');

        const categoryWrapper = document.getElementById('feedback_category_wrapper');
        const categorySelect = document.getElementById('feedback_category');

        const courseWrapper = document.getElementById('feedback_course_wrapper');
        const courseSelect = document.getElementById('feedback_course');


        // ==========================================
        // SHOW / HIDE CATEGORY + COURSE
        // ==========================================
        function toggleCategoryCourse() {

            if (typeSelect && typeSelect.value == '2') {

                // Category
                categoryWrapper.style.display = 'block';
                categorySelect.required = true;

                // Course
                courseWrapper.style.display = 'block';
                courseSelect.required = true;

            } else {

                // Category
                categoryWrapper.style.display = 'none';
                categorySelect.required = false;
                categorySelect.value = '';

                // Course
                courseWrapper.style.display = 'none';
                courseSelect.required = false;
                courseSelect.value = '';
            }
        }


        // Type change
        if (typeSelect) {
            typeSelect.addEventListener('change', function () {
                toggleCategoryCourse();
            });
        }


        // ==========================================
        // ADD NEW
        // ==========================================
        const addBtn = document.getElementById('addFeedbackRatings');

        if (addBtn) {

            addBtn.addEventListener('click', function () {

                form.reset();

                form.querySelector('[name="id"]').value = '';

                title.textContent = 'Add Ratings & Feedback Settings';

                typeSelect.value = '';

                categorySelect.value = '';
                courseSelect.value = '';

                toggleCategoryCourse();

                // Default radio values
                const ratingYes = form.querySelector(
                    '[name="rating_enabled"][value="1"]'
                );

                const feedbackYes = form.querySelector(
                    '[name="feedback_enabled"][value="1"]'
                );

                if (ratingYes) {
                    ratingYes.checked = true;
                }

                if (feedbackYes) {
                    feedbackYes.checked = true;
                }
            });
        }


        // ==========================================
        // EDIT
        // ==========================================
        document.querySelectorAll('.editFeedbackRatings').forEach(function (button) {

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


                // ==========================================
                // CATEGORY
                // ==========================================
                if (type == '2') {

                    categoryWrapper.style.display = 'block';
                    categorySelect.required = true;

                    categorySelect.value = category || '';


                    // ==========================================
                    // COURSE
                    // ==========================================
                    courseWrapper.style.display = 'block';
                    courseSelect.required = true;

                    courseSelect.value = course || '';

                } else {

                    categoryWrapper.style.display = 'none';
                    categorySelect.required = false;
                    categorySelect.value = '';

                    courseWrapper.style.display = 'none';
                    courseSelect.required = false;
                    courseSelect.value = '';
                }


                // ==========================================
                // RATING
                // ==========================================
                form.querySelectorAll(
                    '[name="rating_enabled"]'
                ).forEach(function (radio) {

                    radio.checked = (
                        radio.value == rating
                    );

                });


                // ==========================================
                // FEEDBACK
                // ==========================================
                form.querySelectorAll(
                    '[name="feedback_enabled"]'
                ).forEach(function (radio) {

                    radio.checked = (
                        radio.value == feedback
                    );

                });


                // Modal title
                title.textContent =
                    'Edit Ratings & Feedback Settings';

            });

        });


        // ==========================================
        // DELETE
        // ==========================================
        document.querySelectorAll('.deleteFeedbackRatings').forEach(function (button) {

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

<script>
    $(document).ready(function () {

        let feedbackRatingsTable = $('#feedbackRatingsTable').DataTable({

            pageLength: 10,

            lengthMenu: [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, 'All']
            ],

            ordering: true,
            searching: true,
            info: true,
            paging: true,

            responsive: false,

            autoWidth: false,

            language: {
                emptyTable: "No Ratings & Feedback settings found."
            },

            columnDefs: [
                {
                    orderable: false,
                    searchable: false,
                    targets: 8
                }
            ],

            dom:
                "<'row align-items-center mb-3'" +
                    "<'col-12 col-xl-3 mb-2 mb-xl-0'l>" +
                    "<'col-12 col-xl-9 d-flex flex-wrap justify-content-xl-end justify-content-start align-items-center custom-filter-container'f>" +
                ">" +

                "<'row'" +
                    "<'col-12'tr>" +
                ">" +

                "<'row mt-3'" +
                    "<'col-12 col-md-5'i>" +
                    "<'col-12 col-md-7 d-flex justify-content-md-end justify-content-center'p>" +
                ">",

            initComplete: function () {

                const api = this.api();

                let filterHtml = `
                    <div class="d-flex align-items-center mr-3 me-3 mb-2 mb-md-0">
                        <label for="feedbackTypeFilter"
                            class="font-weight-bold mb-0 mr-2 me-2">
                            Type
                        </label>

                        <select id="feedbackTypeFilter"
                                class="form-control form-control-sm"
                                style="width: auto;">
                            <option value="">All Types</option>
                            <option value="Overall">Overall</option>
                            <option value="Category">Category</option>
                        </select>
                    </div>

                    <div class="d-flex align-items-center mr-3 me-3 mb-2 mb-md-0">
                        <label for="feedbackStatusFilter"
                            class="font-weight-bold mb-0 mr-2 me-2">
                            Status
                        </label>

                        <select id="feedbackStatusFilter"
                                class="form-control form-control-sm"
                                style="width: auto;">
                            <option value="">All Status</option>
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                        </select>
                    </div>
                `;

                $('.custom-filter-container').prepend(filterHtml);

                $('.dataTables_filter')
                    .addClass('d-flex align-items-center mb-2 mb-md-0');

                $('.dataTables_filter label')
                    .addClass('d-flex align-items-center mb-0 font-weight-bold');

                $('.dataTables_filter input')
                    .addClass('ml-2 ms-2 form-control form-control-sm');


                // TYPE FILTER (Column 4)
                $('#feedbackTypeFilter').on('change', function () {

                    const type = $(this).val();

                    api
                        .column(4)
                        .search(type)
                        .draw();
                });


                // STATUS FILTER (Column 5)
                $('#feedbackStatusFilter').on('change', function () {

                    const status = $(this).val();

                    api
                        .column(5)
                        .search(
                            status
                                ? '^' + status + '$'
                                : '',
                            true,
                            false
                        )
                        .draw();
                });


                // Fix table width after DataTable initialization
                api.columns.adjust().draw(false);
            }
        });

    });
</script>