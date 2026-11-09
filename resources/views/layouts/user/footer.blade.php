</div></div>
        <!-- content-wrapper ends -->

        <!-- partial:../../partials/_footer.html -->
        <!-- <footer class="footer">
          <div class="w-100 clearfix">
            <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © 2023-24 <a href="" target="_blank">Digicat.ai</a>. All rights reserved.</span>
          </div>
        </footer> -->
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="{{asset('public/vendors/js/vendor.bundle.base.js')}}"></script>
  <script src="{{asset('public/vendors/js/vendor.bundle.addons.js')}}"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script> -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="{{asset('public/js/off-canvas.js')}}"></script>
  <script src="{{asset('public/js/hoverable-collapse.js')}}"></script>
  <script src="{{asset('public/js/template.js')}}"></script>
  <script src="{{asset('public/js/settings.js')}}"></script>
  <script src="{{asset('public/js/todolist.js')}}"></script>
  <script src="{{asset('public/js/jquery.toast.js')}}"></script>
  <script src="https://code.jquery.com/ui/1.13.3/jquery-ui.js"></script>

  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="{{asset('public/js/profile-demo.js')}}"></script>
  <!-- End custom js for this page-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/js/all.min.js" integrity="sha512-u3fPA7V8qQmhBPNT5quvaXVa1mnnLSXUep5PS1qo5NRzHwG19aHmNJnj1Q8hpA/nBWZtZD4r4AX6YOt5ynLN2g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    $(document).ready(function() {

    
var readURL = function(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('.profile-pic').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}


$(".file-upload").on('change', function(){
    readURL(this);
});

$(".upload-button").on('click', function() {
   $(".file-upload").click();
});
});

$(document).ready(function () {
        $('#role-select').change(function () {
            var selectedOption = $(this).val();
            window.location.href = '/' + selectedOption; // Redirect to the selected route
        });
        $('body').on('click','.viewed_notification',function(){
            //alert();
             $.ajax({
            url: "{{url('update_notification_count')}}",
            type: 'GET',
            dataType: 'html',
            success: function(response) {

                $('body').find('.notification-count').text('0');
            }
        });
        });
    });
  </script>

  <script>
    $(document).ready(function() {
        const $filterBtn = $("body").find('.filterBtn');
        const $filterMenu = $("body").find('.filterMenu');
        const $submitBtn = $("body").find('.submitBtn');

        // Toggle the dropdown when clicking the filter button
        $("body").on('click','.filterBtn', function(event) { 
            event.stopPropagation(); // Prevent the event from bubbling up and causing the dropdown to close

            // Toggle the visibility of the dropdown menu
            $(this).parents('form').find('.filterMenu').toggle();
        });

        // Close the dropdown when clicking the submit button inside the dropdown
        $("body").on('click','.submitBtn', function() {
            $(this).parents('form').find('.filterMenu').hide();
        });

        // Prevent the dropdown from closing when clicking inside it
        $("body").on('click','.filterMenu', function(event) {
            event.stopPropagation(); // Prevents closing the dropdown when clicking inside it
        });

        // Close the dropdown when clicking anywhere outside
        $(document).on('click', function(event) { 
            $("body").find('.filterMenu').each(function(){
                if (!$(this).is(event.target) && !$(this).has(event.target).length && !$(this).parents('form').find('.filterBtn').is(event.target)) {
                     $("body").find('.filterMenu').hide();
                }
            });
        });
    });
</script>
<script>
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl)
    })
</script>
@include('layouts.partials.browser-close-tracker')
</body>

</html>