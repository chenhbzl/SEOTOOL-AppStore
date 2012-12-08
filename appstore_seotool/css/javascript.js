$(document).ready(function() {
	
    function applyChange2() {
        console.log('apply change');
        var singleValues = $("#country_selection").val();
        console.log(singleValues);
        $(".item").hide();
        if (singleValues == 'all') {
            $(".item").show();
        } else {
            var visible = '.' + singleValues;
            $(visible).show();
        }
    }

    $("select#country_selection").change(function() {
        console.log('click');
        applyChange2();
    });
    
    var len = 480;
    var summary = $("#summary").text();
    if(summary.length > len)
    {
        var shortSum = summary.substr(0, len);
    
        $('#summary').html(shortSum + "<br /><a id='more'>More...</a>");
    
        $("#more").click(function(){
            $("#summary").html(summary);
        });
       
    
    }
});