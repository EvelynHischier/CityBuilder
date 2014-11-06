jQuery(function($) {
	 
    var popup_state = false;
 
    $("#button_turn,.zone").click(function() {
 
        if(popup_state == false) {
            //$("#popup").fadeIn("normal");
            $("#background").css("opacity", "0.7");
            $("#background").fadeIn("normal");
            popup_state = true;
        }
 
    return false;
    });
 
    $(".popupButton").click(function() {
 
        if(popup_state == true) {
            //$("#popup").fadeOut("normal");
            $("#background").fadeOut("normal");
            popup_state = false;
        }
 
    });
 
});