<div class="tab-pane fade" id="announcements" role="tabpanel" aria-labelledby="announcements-tab">
    <div>
        <div class="pt-1 px-2 pb-2">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <label class="mb-0 d-flex align-items-center font-weight-bold"><i class="fa-solid fa-bullhorn headings-icon"></i>View Announcements </label>
                </div>

                <div>
                    <button id="addAnnouncementBtn" class="btn web-btn"><i class="fa-solid fa-plus btnn-icon"></i>Add Announcements</button>
                </div>
            </div>
        </div>

        <div class="row mx-0">
            <div class="col-12 mb-2 px-2">
                <div class="card border-top border-0 shadow-none rounded-0">
                    <div class="card-body card-border p-2 rounded-3">
                        <table class="table ">
                            <thead>
                                <tr>
                                    <th scope="col">Date</th>
                                    <th scope="col">From</th>
                                    <th scope="col">Announcements</th>
                                    <th scope="col" class="text-center">Action</th>
                                </tr>
                            </thead>

                            <tbody id="announcementTableBody">
                                <?php $i = 1 ?>
                                @foreach($announcement as $ancment)
                                <tr>
                                    <td>{{ $ancment->created_at->format('Y-m-d') }}</td>
                                    <td>{{ $ancment->announcement_from }}</td>

                                    <td>{!! Str::limit($ancment->announcement, 200) !!}</td>
                                    <td class="text-center">
                                        <div class="dropdown text-center">
                                            <button class="btn btn-transparent vm-toggle dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="fa-solid fa-ellipsis-vertical"></i>
                                            </button>
                                            <ul class="dropdown-menu vm-menu" aria-labelledby="dropdownMenuButton1">
                                                <li>
                                                    <a class="dropdown-item editAnnouncementBtn" data-id="{{ $ancment->id }}" data-announcement="{{ $ancment->announcement }}" data-announcement-from="{{ $ancment->announcement_from }}"><i class="fa-solid fa-pen-to-square pr-2 cursor-pointer"></i> Edit</a>
                                                </li> 
                                                <!-- onclick="openSidepop()" -->
                                                <li>
                                                    <a class="dropdown-item" href="{{ url('delete_settings?id='.$ancment->id??'') }}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this announcement?')"><i class="fa-solid fa-trash" style="padding-right: 13px;"></i>Delete</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <!-- <button class="btn btn-primary editAnnouncementBtn" data-id="{{ $ancment->id }}"
                                            data-announcement="{{ $ancment->announcement }}"
                                            data-announcement-from="{{ $ancment->announcement_from }}">Edit</button>

                                        <a href="{{ url('delete_settings?id='.$ancment->id??'') }}"
                                            class="btn btn-danger"
                                            onclick="return confirm('Are you sure you want to delete this announcement?')">Delete</a> -->
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addAnnouncementModal" tabindex="-1" aria-labelledby="addAnnouncementModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addAnnouncementModalLabel">Add Announcement</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addAnnouncementForm" action="{{ url('settings') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="announcementContent" class="form-label">Announcement</label>
                        <textarea class="form-control" id="announcementContent" rows="3" name="announcement"
                            ></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="announcementFrom" class="form-label">From</label>
                        <textarea class="form-control" id="announcementFrom" name="announcement_from"
                            ></textarea>
                    </div>
                    <button type="submit" class="btn sbmt-btn mr-2">Save</button>
                    <button type="button" class="btn cancel-btn" data-bs-dismiss="modal">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editAnnouncementModal" tabindex="-1" aria-labelledby="editAnnouncementModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editAnnouncementModalLabel">Edit Announcement</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editAnnouncementForm" action="{{ url('settings') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="editAnnouncementId" name="id">
                    <div class="mb-3">
                        <label for="editAnnouncementContent" class="form-label">Announcement</label>
                        <textarea class="form-control" id="editAnnouncementContent" rows="3"
                            name="announcement"></textarea>
                        <div class="mb-3">
                            <label for="editAnnouncementFrom" class="form-label">From</label>
                            <textarea class="form-control" id="editAnnouncementFrom"
                                name="announcement_from"></textarea>
                        </div>

                    </div>
                    <button type="submit" class="btn sbmt-btn mr-2">Save</button>
                    <button type="button" class="btn cancel-btn" data-bs-dismiss="modal">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="{{asset('public/plugins/ckeditor/ckeditor.js')}}"></script>
<script src="{{asset('public/plugins/ckfinder/ckfinder.js')}}"></script>

<script>



    CKEDITOR.replace('announcementContent');
    CKEDITOR.replace('editAnnouncementContent');
document.addEventListener('DOMContentLoaded', function() {


    document.getElementById('addAnnouncementBtn').addEventListener('click', function() {
        var myModal = new bootstrap.Modal(document.getElementById('addAnnouncementModal'));
        myModal.show();
    });

    document.querySelectorAll('.editAnnouncementBtn').forEach(button => {
        button.addEventListener('click', function() {
            var id = this.getAttribute('data-id');
            var announcement = this.getAttribute('data-announcement');
            var announcementFrom = this.getAttribute('data-announcement-from');

            document.getElementById('editAnnouncementId').value = id;
            CKEDITOR.instances.editAnnouncementContent.setData(announcement);
            document.getElementById('editAnnouncementFrom').value = announcementFrom;

            var myModal = new bootstrap.Modal(document.getElementById('editAnnouncementModal'));
            myModal.show();
        });
    });

});
</script>