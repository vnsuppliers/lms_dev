<div class="tab-pane fade" id="session" role="tabpanel" aria-labelledby="session-tab">
    <div>
        <div class="p-2">
            <label class="mb-0 d-flex align-items-center font-weight-bold"><i class="fa-regular fa-clock headings-icon"></i>Session </label>
        </div>
        <div class="row mx-0">
            <div class="col-12 mb-2 px-2">
                <div class="card card-border border-top-0 shadow-none rounded-0">
                    <div class="card-body p-0 rounded-0 bg-transparent">
                        <div class="col-12 col-lg-12 py-2 bg-white rounded-3 mb-2">
                            <div class="form-group row pt-2">
                                <label class="col-sm-4 col-md-4 col-lg-3 col-form-label">Session Time-Out</label>
                                  <div class="col-sm-8 col-md-8 col-lg-9">
                                    <input type="number" class="form-control" id="sessionTimeout"
                                        name="sessionTimeout" placeholder="Enter time in minutes" min="1" max="120"
                                        value="">
                                    <small class="form-text text-muted" style="margin-top: 10px;">
                                        Select the session timeout duration in minutes.
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.getElementById('sessionTimeout').addEventListener('change', function() {
    const minutes = parseInt(this.value);
    if (!isNaN(minutes) && minutes > 0) {
        startSessionTimer(minutes * 60);
    }
});

let timer;

function startSessionTimer(duration) {
    clearInterval(timer);
    let timerDuration = duration;
    document.getElementById('sessionExpiredMessage').classList.add('d-none');

    timer = setInterval(function() {
        if (timerDuration <= 0) {
            clearInterval(timer);
            document.getElementById('sessionExpiredMessage').classList.remove('d-none'); 
            redirectToLogin();
        }
        timerDuration--;
    }, 1000);
}

// function redirectToLogin() {
//     setTimeout(function() {
//         window.location.href = 'login';
//     }, 3000);
// }

</script>