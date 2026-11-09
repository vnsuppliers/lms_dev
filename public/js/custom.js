
    let isPanelOpen = true; 

    function togglePanel() {
        const panel = $(".laft-syde-content");
        // Toggle the "open" state
        if (isPanelOpen) {
            panel.each(function(){
            $(this).removeClass("open");
            $(this).addClass("closed");
            isPanelOpen = false;
            $('body').find('.rite-syde-content').removeClass('col-lg-8');
            $('body').find('.rite-syde-content').addClass('col-lg-12');
            $('body').find('.togyle-btn').html('<i class="fa-solid fa-arrow-right-long"></i>');
        });
        } else {
            panel.each(function(){
            $(this).addClass("open");
            $(this).removeClass("closed");
            isPanelOpen = true;
             $('body').find('.rite-syde-content').removeClass('col-lg-12');
            $('body').find('.rite-syde-content').addClass('col-lg-8');
            $('body').find('.togyle-btn').html('<i class="fa-solid fa-bars-staggered"></i>');
            });
        }
    }
   
    // Get the panel elements as a jQuery collection.
    const panel = $(".laft-syde-content");

    // Add hover events to open/close the panel
    panel.on("mouseover", function () {
        if (!isPanelOpen) {
            $(this).addClass("open").removeClass("closed");
        }
    });
    panel.on("mouseleave", function () {
        if (!isPanelOpen) {
            $(this).removeClass("open").addClass("closed");
        }
    });

    $(document).ready(function () {
        $('#closeDropdownBtn').on('click', function () {
            $('.filterMenu').hide();
        });
    });
