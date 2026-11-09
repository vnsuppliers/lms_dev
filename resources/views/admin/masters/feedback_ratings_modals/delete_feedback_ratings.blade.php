<div class="modal fade" id="deleteFeedbackRatingsModal" tabindex="-1" aria-labelledby="deleteFeedbackRatingsModalLabel" aria-hidden="true">
    <!-- Removed 'modal-sm' here to make the modal wider -->
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteFeedbackRatingsModalLabel">Delete Setting</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <div class="modal-body text-center text-break">
                Are you sure you want to delete<br>
                <strong id="deleteFeedbackRatingsName"></strong>?
            </div>
            
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-secondary px-3 py-2" style="min-width: 100px;" data-bs-dismiss="modal">Cancel</button>
                <form id="deleteFeedbackRatingsForm" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger px-3 py-2" style="min-width: 100px;">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>