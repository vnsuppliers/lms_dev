<script>
(function() {
    @auth
        // Cache user ID locally so Incognito storage loss doesn't wipe it out on close
        localStorage.setItem('active_tracker_user_id', '{{ auth()->id() }}');
    @else
        localStorage.removeItem('active_tracker_user_id');
        return;
    @endauth

    var userId = localStorage.getItem('active_tracker_user_id');
    if (!userId) return;

    var csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
    var isInternalNav = false;
    var beaconSent = false;

    // Tab-scoped token (sessionStorage survives a same-tab reload but is
    // gone for good once the tab actually closes) so a reload can only ever
    // undo the close record it itself just caused, never another tab's.
    var tabToken = sessionStorage.getItem('tab_close_token');
    if (!tabToken) {
        tabToken = (window.crypto && crypto.randomUUID) ? crypto.randomUUID() : (Date.now() + '-' + Math.random().toString(36).slice(2));
        sessionStorage.setItem('tab_close_token', tabToken);
    }

    document.addEventListener('click', function(e) {
        var link = e.target.closest('a');
        if (link && link.getAttribute('href')) {
            var href = link.getAttribute('href');
            if (href.startsWith('#') || href.startsWith('javascript') || link.target === '_blank') {
                return;
            }
            isInternalNav = true;
        }
    });

    document.addEventListener('submit', function() {
        isInternalNav = true;
    });

    // If this load followed straight from another page of this same site in
    // the SAME tab - a reload, back/forward, a clicked link, a submitted
    // form, or a page navigating itself via JS (e.g. a filter dropdown doing
    // window.location.href=...) - undo any "browser closed" record the
    // previous document's pagehide may have just fired. A pagehide can't
    // tell a real close from any of these at unload time, only the next
    // page load (if one ever happens) can prove it wasn't a close.
    (function undoFalsePositiveOnReload() {
        try {
            var entries = performance.getEntriesByType('navigation');
            var navType = entries.length ? entries[0].type : null;
            var cameFromSameSite = document.referrer && document.referrer.indexOf(location.origin + '/') === 0;
            if (navType === 'reload' || navType === 'back_forward' || cameFromSameSite) {
                fetch('{{ url("/session-resume") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({ user_id: userId, tab_token: tabToken }),
                    credentials: 'same-origin'
                }).catch(function() {});
            }
        } catch (e) {}
    })();

    function sendClosedBeacon() {
        if (beaconSent || isInternalNav) return;
        beaconSent = true;

        var formData = new FormData();
        formData.append('user_id', userId);
        formData.append('_token', csrfToken);
        formData.append('tab_token', tabToken);

        var sent = false;
        if (navigator.sendBeacon) {
            sent = navigator.sendBeacon('{{ url("/browser-closed") }}', formData);
        }

        // Fallback for browsers where sendBeacon is unavailable or rejects the payload
        if (!sent) {
            fetch('{{ url("/browser-closed") }}', {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': csrfToken },
                body: formData,
                credentials: 'same-origin',
                keepalive: true
            }).catch(function() {});
        }
    }

    // pagehide covers real tab/browser close, in-tab URL changes and refreshes
    // across desktop and mobile browsers (including Incognito) without
    // breaking the back/forward cache the way 'unload' does.
    window.addEventListener('pagehide', sendClosedBeacon);

    // Reset per-page state when a page is restored from bfcache so a later
    // close on the restored page is tracked again.
    window.addEventListener('pageshow', function(e) {
        if (e.persisted) {
            isInternalNav = false;
            beaconSent = false;
        }
    });
})();
</script>
