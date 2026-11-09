@include('layouts.user.header')
<div class="tab-pane fade show" id="ui" role="tabpanel" aria-labelledby="ui-tab">
    <div class="row px-4">
        <div class=" d-flex border-cls pt-3">
            <div class="box-width font-size-lg text-center py-2">
                <div class="">12</div>
                <span>Courses in Progress</span>
            </div>
            <div class="box-width font-size-lg text-center py-2">
                <div class="">9h 47m</div>
                <span>Training Time</span>
            </div>
            <div class="box-width font-size-lg text-center py-2">
                <div class="">4</div>
                <span>Badgets</span>
            </div>
            <div class="box-width font-size-lg text-center py-2">
                <div class="">3875</div>
                <span>Points</span>
            </div>
            <div class="box-width font-size-lg text-center py-2">
                <div class="">2nd</div>
                <span>Level</span>
            </div>
        </div>

        <div class="px-3 my-3 py-0">
            <div class="font-weight-500 py-3">Activity</div>
            <div class="font-big">2 <span class="font-small">logins last week.</span> 13<span class="font-small"> logins last month. </span><span class="font-small">last login:</span>A few months ago</div>
            <div class="pt-3">
                <div class="btn-group " role="group" aria-label="Basic example">
                    <button type="button" class="btn btn-secondary btn-change">Today</button>
                    <button type="button" class="btn btn-secondary btn-change">Yesterday</button>
                    <button type="button" class="btn btn-secondary btn-change">Week</button>
                    <button type="button" class="btn btn-secondary btn-change">Month</button>
                    <button type="button" class="btn btn-secondary btn-change">Year</button>
                    <button type="button" class="btn btn-secondary btn-change">Period</button>
                </div>
            </div>
        </div>
    </div>
</div>
@include('layouts.user.footer')