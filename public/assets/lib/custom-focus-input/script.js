var FOCUS; // focus element

$(document).ready(function() {
    $('.site-wrapper').prepend('<div id="focus"></div>');
    FOCUS = $("#focus");
});

// function for positioning the div
function position(e) {
// get position
    var props = {
        top: e.offset().top,
        left: e.offset().left,
        width: e.outerWidth(),
        height: e.outerHeight(),
        radius: parseInt(e.css("border-radius"))
    };
    
    // set position
    FOCUS.css({
        top: props.top,
        left: props.left,
        width: props.width,
        height: props.height,
        "border-radius": props.radius
    });
    
    FOCUS.fadeIn(200);
}

$('form input[type="text"], form input[type="number"], form input[type="date"], form select, form textarea').each(function(i) {
    $(this).focus(function() {
        el = $(this);
        position(el);
    });
});

$('form input').on("focusout", function(e) {
    setTimeout(function() {
        if (!(document.activeElement instanceof HTMLInputElement || 
              document.activeElement instanceof HTMLTextAreaElement ||
              document.activeElement instanceof HTMLSelectElement
        )) {
            FOCUS.fadeOut(200);
        }
    }, 0);
});