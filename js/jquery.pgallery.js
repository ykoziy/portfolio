(function($){

    $.pGallery = function(selector, settings){
        //settings
        var config = {
            'delay': 2000,
            'fadeSpeed': 500
        };
        if (settings){$.extend(config, settings);}

        // code here
        var mainContainer = $(selector);
        var slides = mainContainer.children('ul');
        $(mainContainer).empty(); //remove list items

        $(mainContainer).append('<div id="gallery_container"></div>');
        $('#gallery_container').append('<div id="image panel"><img id="big_image" src="3d_img/big2.jpg" /></div>');
        $('#gallery_container').append('<div id="c_container"><div id="left_scroll"></div><div id="c_inner"></div><div id="right_scroll"></div></div>');
        $('#c_inner').append(slides);

        //maincode
        $('#thumbnails li:first').before($('#thumbnails li:last'));

        function nextPage(direction) {
            var indent = 0;
            var item_width = $('#thumbnails li').outerWidth() + 6;
            if (direction === 0) //move left
            {
                indent = parseInt($('#thumbnails').css('left')) + item_width;
                $('#thumbnails:not(:animated)').animate({'left' : indent},500,function(){
                    $('#thumbnails li:first').before($('#thumbnails li:last'));
                    $('#thumbnails').css({'left' : '-178px'});
                });
            }
            if (direction === 1) //move right
            {
                indent = parseInt($('#thumbnails').css('left')) - item_width;
                $('#thumbnails:not(:animated)').animate({'left' : indent},500,function(){
                    $('#thumbnails li:last').after($('#thumbnails li:first'));
                    $('#thumbnails').css({'left' : '-178px'});
                });
            }
        }

        //animation
        var animated = setInterval(function(){nextPage(1);}, config.delay);

        $('#c_container').hover(function(){
            clearInterval(animated)
        },function(){
            animated = setInterval(function(){nextPage(1);}, config.delay);
        });

        $('#right_scroll').click(function(){
            nextPage(1);
        });

        $('#left_scroll').click(function(){
            nextPage(0);
        });

        $('#thumbnails').delegate('img','click', function(){
            $('#big_image').attr('src',$(this).attr('src').replace('thumbs','big'));
            //$('#description').html($(this).attr('alt'));
        });
        return this;
    };

})(jQuery);