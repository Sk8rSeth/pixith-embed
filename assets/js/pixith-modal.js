// this file handles the interaction and construction of the frontend modal
// that displays the iframe code for the embed
jQuery(document).ready(function($) {
    $('.pixith-embed-modal').on('click', '.code', function(){
        copyToClipboard($(this));
        $(this).addClass('selected');
        $('.pixith-embed-modal .embed-copied').css('display', 'inline-block').animate({
            opacity: 1,
            top: '-35px'
        }, {
            duration: 300,
            complete: function(){
                $('.pixith-embed-modal .embed-copied').animate({
                    opacity: 0
                },{
                    duration: 1000  
                });

                $('.pixith-embed-modal .code.selected').animate({
                    'background': '#f9f9f9'
                },{
                    duration: 1000,
                    complete: function(){
                        $('.pixith-embed-modal .code.selected').removeClass('selected');
                    }
                });
                setTimeout(function(){
                    $('.pixith-embed-modal .embed-copied').css('top','0');
                }, 1000);
            }
        });
    });

    function copyToClipboard(element) {
        var $temp = $("<input>");
        $("body").append($temp);
        $temp.val($(element).text()).select();
        document.execCommand("copy");
        $temp.remove();
    }
});
