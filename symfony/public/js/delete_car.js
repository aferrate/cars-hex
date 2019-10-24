$(document).ready(function() {
    $('.delete_car').click(function(e){
        e.preventDefault();
        var carid = $(this).attr('data-car-id');
        var parent = $(this).parent("td").parent("tr");
        bootbox.dialog({
            message: "Are you sure you want to Delete car with id " + carid + "?",
            buttons: {
                success: {
                    label: "No",
                    className: "btn-success",
                    callback: function() {
                        $('.bootbox').modal('hide');
                    }
                },
                danger: {
                    label: "Delete!",
                    className: "btn-danger",
                    callback: function() {
                        $.ajax({
                            type: 'POST',
                            url: '/admin/car/delete',
                            data: {carid: carid}
                        })
                            .done(function(response){
                                bootbox.alert(response);
                                parent.fadeOut('slow');
                            })
                            .fail(function(){
                                bootbox.alert('Error....');
                            })
                    }
                }
            }
        });
    });
});