jQuery(function($){

    var formfield = '';

    $('.dw-edit-tag-upload').on('click',function(e){
        event.preventDefault();
        formfield = $(this).data('field');
        tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');

    });

    window.send_to_editor = function(html) {
        var url = $('img',html).attr('src');
        if( formfield.length > 0 ) {
            $(formfield).val( url );
        }
        tb_remove();
    }


    $('#TB_iframeContent').contents().ready(function($) {
        $('.describe-toggle-on').on('click',function(event){
            var item = $(this).closest('.media-item');
            item.find('.savesend [type="submit"]').val('Use this image');
        });
    });

});