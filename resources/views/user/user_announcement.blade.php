@include('layouts.user.header')
<div class="container-fluid">
    <div class="row">
        <div class="col-12 col-lg-10 offset-lg-1 mt-2 px-0">
            <div class="d-flex align-items-center">
                <div>
                    <label class="mb-0 d-flex align-items-center font-weight-bold"><i class="fa fa-bullhorn headings-icon"></i>My Announcements </label>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-10 offset-lg-1 bg-white rounded p-3 my-3">
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Date</th>
                                    <th scope="col">From</th>
                                    <th scope="col">Description</th>
                                </tr>
                            </thead>
                            <tbody id="announcementTableBody">
                                @foreach($announcement as $ancment)
                                <tr>
                                    <td>{{ $ancment->created_at->format('Y-m-d') }}</td>
                                    <td>{{ $ancment->announcement_from }}</td>
                                    <td>{!! Str::limit($ancment->announcement, 200) !!}</td>
                                    
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>  
                </div>
            </div>
        </div>

        @foreach($announcement as $ancment)
        <div class="modal fade" id="announcementModal{{ $ancment->id }}" tabindex="-1"
            aria-labelledby="announcementModalLabel{{ $ancment->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="announcementModalLabel{{ $ancment->id }}">Announcement</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>{!! $ancment->announcement !!}</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@include('layouts.user.footer')