$(document).ready(function() {
    $('#buttonFilter').click(function(e){
        var search = $('#search').val();
        var field = $('input[name=field]:checked').val();

        $.ajax({
            type: 'POST',
            url: '/car/search/filter',
            data: {search: search, field: field}
        })
        .done(function(response){
            $("#carsTable").empty();
            $("#carsTable").html(response);
        })
        .fail(function(){
            console.log('Error....');
        })
    });
});