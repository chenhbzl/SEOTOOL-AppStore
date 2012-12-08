
jQuery(function() {
	
    function applyChange2() {
//        console.log('apply change');
        var singleValues = $("#select_country").val();
        console.log(singleValues);
        $(".item").hide();
        if (singleValues == '0') {
            $(".item").show();
        } else {
            var visible = '.country_' + singleValues;
            
            $(visible).show();
        }
    }
    applyChange2();
    $("select#select_country").change(function() {
//        console.log('click');
        applyChange2();
    });
});
