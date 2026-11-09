# LMS review — 21 September 2026

## Attempted exam error

The reported URL refers to saved attempt 20 (assignment 191, course 254, learner 1, exam 17). The attempt is marked Passed, but exam 17 is absent from `tbl_assignment_exams`. There are no questions for that exam and no answers for attempt 20. The controller previously dereferenced the missing exam.

The page now explains that the original exam is unavailable and displays the saved result (HTTP 410). Missing attempts return 404, malformed identifiers are validated, and these viewing/evaluation routes require login. Existing exam records continue to open the evaluation screen.

The database contains 848 non-deleted attempts whose local exam record is absent. Follow-up investigation found that `update_assessment_result` incorrectly duplicated external assessment results into `tbl_exam_attempts`, using an external quiz ID as `exam_id` and a course-document ID as `course_id`. These IDs do not identify local assignment exams and courses. Therefore the missing references do not, by themselves, establish data loss or a need for backup restoration.

Document 254 is an external assessment (type 6) for course 11. Assessment result records 314 and 671 exist for document 254, assignment 191, learner 1. These are separate from local assignment-exam questions and answers. Their timestamps do not establish an exact one-to-one match with historical attempt 20.

Removed the duplicate assignment-attempt write from the assessment callback. The admin assignment-exam listing now also matches the assignment's actual course ID, preventing these external-assessment rows from generating assignment-exam links. Historical rows remain unchanged; do not bulk-delete them without reconciling consumers and original results.

## Other fixes

- Corrected the exam-attempt answers relationship to use `exam_attendance_id`.
- Added evaluation input checks before writes, including matching the attempt identifiers, verifying answer ownership and maximum marks, and rejecting zero-total evaluations.
- Preserved saved partial marks when opening an evaluation and used each question's actual maximum.
- Prevented file-input JavaScript errors when canceling a selection or rejecting a file.
- Course start now returns 404 when its assignment or required related records are missing, instead of dereferencing null.
- Isolated the test application's base URL from the local `/lms_dev` deployment prefix.

## Validation and limits

- All 142 PHP files under app, routes, config, and database passed syntax checks.
- All Blade templates compiled.
- Read-only requests through Laravel's HTTP kernel confirmed the reported URL renders its explanation, and the admin dashboard, users, courses, masters, exam listing, and report listing return 200.
- Regression tests use an isolated in-memory database; they do not modify LMS records.

This is a code/runtime review and selected page smoke test, not a complete browser check of every role, upload, integration, or write workflow.

## Remaining findings

- `POST /assignCourseToUsernew` references a missing controller method. No caller was found in the application source. Confirm whether an external client still uses this legacy URL before removing it or defining its request contract.
- `GET /user_header` references a missing controller method. No caller was found in the application source. Confirm whether this legacy URL is needed.
- Evaluation routes now require authentication, but the existing application still needs a separate role/assigned-team authorization review before being exposed beyond its trusted local environment.

Reload the learner details page and use the assessment's View Result link for external assessments. The old attempted-exam URL remains safely handled. Backup restoration is relevant only if reconciliation confirms that actual local assignment-exam data was lost.

## New assignment submissions

`UserExamController::submitAnswers` now validates that the exam is active in the assigned course and that the submitted question IDs match the current exam. Text and uploaded-file inputs are both included. The attempt, all answer rows, and activity entry save in one database transaction. A write failure rolls back the database records and removes files uploaded by that failed submission. The most recent non-deleted course assignment is selected. Existing external assessment results continue to save through their separate callback.

The admin learner-details assignment-exam button requires a matching learner, assignment, actual course, and existing local exam. External-assessment duplicates are not eligible. These course rows are currently limited to completed assignments by the existing listing logic.

Validation after this update: 22 tests, 46 assertions pass, including successful assignment persistence, rejection of incomplete question sets, and rollback after a simulated second-answer database failure. No live learner submission was created during testing.

## Complete file manifest for this repair

Application files:

- `app/Http/Controllers/ExamController.php`
- `app/Http/Controllers/UserprofileController.php`
- `app/Http/Controllers/AdminRegistrationController.php`
- `app/Http/Controllers/UserExamController.php`
- `app/Models/ExamAttempt.php`
- `routes/web.php`
- `resources/views/admin/exams/examattempt_view.blade.php`
- `resources/views/admin/exams/exam_unavailable.blade.php` (new)
- `resources/views/user/exams/take.blade.php`

Tests and documentation:

- `tests/Feature/AttemptedExamTest.php` (new)
- `tests/Feature/AssignmentSubmissionTest.php` (new)
- `phpunit.xml`
- `LMS_REVIEW.md` (new)

`app/Models/Exam.php` and `app/Models/Question.php` were inspected but not edited. Generated Blade cache files and a route-audit log are not source changes.
