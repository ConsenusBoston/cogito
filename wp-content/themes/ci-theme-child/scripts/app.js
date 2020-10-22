document.addEventListener('DOMContentLoaded', function () {
    jQuery('#searchModal').on('hidden.bs.modal', function (e) {
        var modal = e.target;
        modal.querySelector('form input').value = "";
    })

    jQuery('#searchModal').on('shown.bs.modal', function (e) {
        var modal = e.target;
        modal.querySelector('form input').focus();
    })

    jQuery("#searchModal").click(function(e){
        if(e.target != this) return;
        jQuery('#searchModal').modal('hide');
      });
})