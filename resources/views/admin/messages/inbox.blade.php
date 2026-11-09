<div class="" id="msgs" role="tabpanel" aria-labelledby="msgs-tab">
    <div class="row">
        <div class="col-12 col-sm-4 col-md-3 col-lg-1p5 pr-0">
            <div>
                <div class="nav sidenav sidemenu flex-column nav-pills py-0" id="v-pills-tab" role="tablist" aria-orientation="vertical" style="border-bottom: 0px !important;">
                    <a class="nav-link nav-s active border-0 text-center align-items-center icon-img" id="v-pills-tab-ones" data-toggle="pill" href="#inbox" role="tab" aria-controls="inbox" aria-selected="true">
                        <div><img src="{{asset('public/images/icons/inbox.png')}}" class="mx-auto d-block mb-2" alt=""></div>
                        <span>Inbox</span>
                    </a>
                    <a class="nav-link nav-s border-0 text-center align-items-center icon-img" id="v-pills-tab-twos" data-toggle="pill" href="#sent" role="tab" aria-controls="sent" aria-selected="false">
                        <div><img src="{{asset('public/images/icons/sent.png')}}" class="mx-auto d-block mb-2" alt=""></div>
                        <span>Sent</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-8 col-md-9 col-lg-10p5">
            <div class="tab-content py-2 border-0" id="v-pills-tabContent">
                <div class="tab-pane fade show active" id="inbox" role="tabpanel" aria-labelledby="inbox">
                    <div>
                        <nav>
                            <div class="nav nav-tabs font-smallsize" id="nav-tab" role="tablist">
                                <button class="nav-link active" style="border-bottom: 0px !important;" id="inbox-data-tab" data-bs-toggle="tab" data-bs-target="#inbox-data" type="button" role="tab" aria-controls="inbox-data" aria-selected="true">Inbox</button>
                            </div>
                        </nav>
                        <div class="tab-content border-0 p-0" id="myTabContent">
                            <div class="tab-pane border p-2 fade show active" id="inbox-data" role="tabpanel" aria-labelledby="inbox-data-tab">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">From</th>
                                                <th scope="col">Subject</th>
                                                <th scope="col" class="text-center">Date</th>
                                                <th scope="col" class="text-center">Options</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td scope="row">Arun</td>
                                                <td>send a mail</td>
                                                <td class="text-center">11/10/2023</td>
                                                <td class="text-center">...</td>
                                            </tr>
                                            <tr>
                                                <td scope="row">Arun</td>
                                                <td>send a mail</td>
                                                <td class="text-center">11/10/2023</td>
                                                <td class="text-center">...</td>
                                            </tr>
                                            <tr>
                                                <td scope="row">Arun</td>
                                                <td>send a mail</td>
                                                <td class="text-center">11/10/2023</td>
                                                <td class="text-center">...</td>
                                            </tr>
                                            <tr>
                                                <td scope="row">Arun</td>
                                                <td>send a mail</td>
                                                <td class="text-center">11/10/2023</td>
                                                <td class="text-center">...</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>