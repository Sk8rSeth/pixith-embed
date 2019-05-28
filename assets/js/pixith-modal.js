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

    $('.pixith-width-form').on('submit', function(e){
        e.preventDefault();
        var input = $('#width-input').val();
        if (input) {
            // console.log($('#width-input').val());
            adjustWidth(input);
        }
    });

    $('.pixith-width-form input').on('focusout', function(e){
        e.preventDefault();
        var input = $(this).val();
        if (input) {
            // console.log($(this).val());
            adjustWidth(input);
        }
    });

    function copyToClipboard(element) {
        var $temp = $("<input>");
        $("body").append($temp);
        $temp.val($(element).text()).select();
        document.execCommand("copy");
        $temp.remove();
    }

    function adjustWidth(input) {
        var element = $('.pixith-embed-modal .code');
        if ($.isNumeric(input)) {
            var myRegexp = /width:(.*);/;
            var match = myRegexp.exec(element[0].innerText);
            var newText = element.text().replace(match[1], input);
            $('.pixith-embed-modal .code').text(newText);
        }
    }
});
