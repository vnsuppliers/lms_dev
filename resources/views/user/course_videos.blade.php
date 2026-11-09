@include('layouts.user.header')
<link type="text/css" rel="stylesheet" href="https://unpkg.com/aksvideoplayer@1.0.0/dist/aksVideoPlayer.min.css">
 
<!-- HTML -->
<div class="" id="br" role="tabpanel" aria-labelledby="br-tab">
    <div class="row">
         @if(isset($videoId))
        <div class="col-12 p-5">
            <div class="col-md-4">
                <div id="video"></div>
                <!-- <div class="progress m-3">
                    <div id="progress-bar" class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                </div> -->
            </div>
        </div>
        @else
        <div class="col-12 p-5">
            No content video uploaded
        </div>
        @endif
    </div>
</div>

<!-- JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://unpkg.com/aksvideoplayer@1.0.0/dist/aksVideoPlayer.min.js"></script>
<script type="text/javascript">
    $("#video").aksVideoPlayer({
        file: [
            {
                file: "{{$videoId}}",
                label: "1080p"
            }
        ],
        width: 640,
        height: 360,
        poster: "",
        forward: true,
    });

    // $(document).ready(function(){
    //     var videoElement = document.getElementById('video').querySelector('video');
    //     var progressBar = document.getElementById('progress-bar');

    //     videoElement.addEventListener('timeupdate', function() {
    //         var currentTime = videoElement.currentTime;
    //         var duration = videoElement.duration;
    //         var progress = (currentTime / duration) * 100;
    //         progressBar.style.width = progress + '%';
    //     });
    // });

     // var url = "{{url('mycourse_videos')}}" + '?id=' + encodeURIComponent(course_id);
            // $('.start_from_beginning').attr('href', url).show();
            // $('.intro_show').attr('href', url).show();

    // var videoUrl;
            // if (intro_video_link.startsWith('http://') || intro_video_link.startsWith('https://')) {
            //     var videoId = intro_video_link.split('v=')[1];
            //     var embedUrl = 'https://www.youtube.com/embed/' + videoId;
            //     $('#video_container').html('<iframe width="560" height="315" src="' + embedUrl + '" frameborder="0" allowfullscreen></iframe>');
            // } else {
            //     videoUrl = 'http://localhost/repo_lms_sourcecode/storage/app/public/' + intro_video_link;
            //     $('#video_container').html('<video controls width="560" height="315"><source src="' + videoUrl + '" type="video/mp4">Your browser does not support the video tag.</video>');
            // }
</script>
