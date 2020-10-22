document.addEventListener('DOMContentLoaded', function () {
    jQuery('#searchModal').on('hidden.bs.modal', function (e) {
        var modal = e.target;
        modal.querySelector('form input').value = "";
    })

    jQuery('#searchModal').on('shown.bs.modal', function (e) {
        var modal = e.target;
        modal.querySelector('form input').focus();
    })

    jQuery('.leadership-details').on('click', '.close', function(e) {
        var leadershipContainer = jQuery('.leadership--container');
        leadershipContainer.removeClass('leadership--container--details-active')
    })

    jQuery('.leadership-details').on('show.bs.modal', function (e) {
        jQuery('body').css('overflow-y', "auto");

        var currentModal = jQuery(this);
        var nextModal = currentModal.closest("div[id^='MyModal']").nextAll("div[id^='MyModal']").first();
        var prevModal = currentModal.closest("div[id^='MyModal']").prevAll("div[id^='MyModal']").first();
        var allPrev = currentModal.closest("div[id^='MyModal']").prevAll("div[id^='MyModal']").length
        var allNext = currentModal.closest("div[id^='MyModal']").nextAll("div[id^='MyModal']").length
        var leadershipContainer = jQuery('.leadership--container');

        
        if (allNext === 0) {
            currentModal.find('.btn-next').hide();
        }
        if (allPrev === 0) {
            currentModal.find('.btn-prev').hide();
        }

        //click next
        currentModal.find('.btn-next').click(function(){
            if (allNext !== 0) {
                leadershipContainer.addClass('leadership--container--details-active');
                currentModal.find('.btn-next').show();
                currentModal.modal('hide');
                nextModal.first().modal('show'); 
            } else {
                currentModal.find('.btn-next').hide();
            }
        });
        
        //click prev
        currentModal.find('.btn-prev').click(function(){
            if (allPrev !== 0) {
                leadershipContainer.addClass('leadership--container--details-active');
                currentModal.find('.btn-prev').show();
                currentModal.modal('hide');
                prevModal.first().modal('show'); 
            } else {
                currentModal.find('.btn-prev').hide();
            }
        });
          
    }).on('hide.bs.modal', function (e) {
        jQuery('body').removeClass("white-backdrop");
    })

    jQuery("#searchModal").click(function(e){
        if(e.target != this) return;
        jQuery('#searchModal').modal('hide');
    });
})