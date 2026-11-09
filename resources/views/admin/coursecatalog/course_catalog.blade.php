@include('layouts.admin.header')
@include('admin.coursecatalog.addcourse')
@include('admin.coursecatalog.viewcourse')
@include('admin.coursecatalog.addcategory')
@include('admin.coursecatalog.viewcategory')
@include('admin.coursecatalog.addsubcategory')
@include('admin.coursecatalog.viewsubcategory')
@include('layouts.admin.footer')

<script>
    (function () {
        function lockAdminCatalogHistory() {
            if (window.history && window.history.pushState) {
                window.history.pushState({ lms_admin_guard: true }, document.title, window.location.href);
            }
        }

        lockAdminCatalogHistory();
        window.addEventListener('pageshow', lockAdminCatalogHistory);

        window.addEventListener('popstate', function (event) {
            lockAdminCatalogHistory();
            window.location.replace("{{ url('coursecatalog') }}");
        });
    })();
</script>