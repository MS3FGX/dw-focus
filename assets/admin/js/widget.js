jQuery(function($) {
    var dw_sortable = function(dwWidgetSortable){
        dwWidgetSortable.sortable({
            placeholder: 'widget-placeholder',
            items: '> .widget',
            handle: '> .widget-top > .widget-title',
            cursor: 'move',
            distance: 2,
            containment: 'document',
            start: function(e,ui) {
                ui.item.children('.widget-inside').hide();
                ui.item.css({margin:'', 'width':''});
            },
            receive: function(e, ui) {
                var sender = $(ui.sender);

                if ( !$(this).is(':visible') || this.id.indexOf('orphaned_widgets') != -1 )
                    sender.sortable('cancel');

                if ( sender.attr('id').indexOf('orphaned_widgets') != -1 && !sender.children('.widget').length ) {
                    sender.parents('.orphan-sidebar').slideUp(400, function(){ $(this).remove(); });
                }
            },
            stop: function(e,ui) {
                if ( ui.item.hasClass('ui-draggable') && ui.item.data('draggable') )
                    ui.item.draggable('destroy');

                if ( ui.item.hasClass('deleting') ) {
                    dwSaveWidget(ui.item);
                    ui.item.remove();
                    return;
                }


                var add = ui.item.find('input.add_new').val(),
                    n = ui.item.find('input.multi_number').val(),
                    id = 'rb-__i__',
                    sb = $(this).attr('id');

                ui.item.css({margin:'', 'width':''});   

                if ( add ) {
                    var matches = 0, 
                        id_base = ui.item.find('.id_base').val();
                    $(this).find(":input.id_base").each(function(i, val) {
                      if ($(this).val() == id_base ) {
                        matches++;
                      }
                    });

                    var widget_id = id_base + '-dw-widget-' + matches;
                    ui.item.find('.widget-id').val( widget_id );
                    if ( 'multi' == add ) {
                        ui.item.html( ui.item.html().replace(/<[^<>]+>/g, function(m){ return m.replace(/__i__|%i%/g, n); }) );
                        ui.item.attr( 'id', id.replace('__i__', n) );
                        n++;
                        $('div#' + id).find('input.multi_number').val(n);
                    } else if ( 'single' == add ) {
                        ui.item.attr( 'id', 'new-' + id );
                        rem = 'div#' + id;
                    }

                    dwSaveWidget(ui.item);
                    ui.item.find('input.add_new').val('');
                    ui.item.find('a.widget-action').click();
                    return;
                }

                dwSaveWidget(ui.item);
            }
        });
    }
    $('.dw_news_datepicker').datepicker();

    $('.dw_focus_category_checklist li label').live('click',function(e){
        var t = $(this);

        t.closest('.dw_focus_category_checklist').find('li label').each(function(e){
            $(this).removeClass('active');
        });
        t.addClass('active'); 
    });
    
    $('.dw-focus-category-display-type').live('click',function(e){
        var t = $(this);
        var cat_extends = t.closest('.widget-content').find('.categories_extend');

        if( t.val() == 'full' ){
            cat_extends.hide();
        }else{
            cat_extends.slideDown(300);
        }
    });

    $('#widget-list').children('.widget').draggable( "option", 'connectToSortable', 'div.widgets-sortables,div.dw-focus-widget-extends' );

    dw_sortable( $('#widgets-right .dw-focus-widget-extends') );

    $('div.widgets-sortables').on('sortstop',function(event, ui){


    });
    

    //Override saveOrder of global wpWidgets, just add sortable for .dw-focus-widget-extends item 
    wpWidgets.saveOrder = function (sb) {
        if ( sb )
            $('#' + sb).closest('div.widgets-holder-wrap').find('.spinner').css('display', 'inline-block');

        var a = {
            action: 'widgets-order',
            savewidgets: $('#_wpnonce_widgets').val(),
            sidebars: []
        };

        $('div.widgets-sortables').each( function() {
            if ( $(this).sortable )
                a['sidebars[' + $(this).attr('id') + ']'] = $(this).sortable('toArray').join(',');
        });

        //DW Focus: Resortable for div.dw-focus-widget-extends
        $('div.widget-liquid-right div.dw-focus-widget-extends').each( function(){
                dw_sortable( $(this) );
        });//End DW Focus Custom

        $.post( ajaxurl, a, function() {
            $('.spinner').hide();
        });

        this.resize();
    }

    function dwSaveWidget(widget){
        var container = widget.closest('.dw-focus-widget-extends');
        
        dwSaveWidgetForContainer(container);
    }

    function dwSaveWidgetForContainer(container){
        
        var field = container.data('setting'), data =  new Array();
        if( container.find('div.widget').length > 0 ){
            container.find('div.widget').each(
                function(i){
                    if( $(this).hasClass('deleting') ) return;
                    if( i != 0 ){
                        data += ':dw-data:';
                    }
                    $(this).find(':input').each(function(index, el){
                        if( $(this).val() ) {
                            if( el.type == 'checkbox' || el.type == 'radio' ){
                                if( $(this).is(':checked') ){
                                    data += $(this).attr('name')+'='+$(this).val()+'&';
                                }
                            }else{
                                data += $(this).attr('name')+'='+$(this).val()+'&';
                            }
                        }
                    });
                }
            );

            $('#'+field).val(data);
        }else{
            $('#'+field).val('');
        }
    }

    var isRTL = !! ( 'undefined' != typeof isRtl && isRtl ),
            margin = ( isRtl ? 'marginRight' : 'marginLeft' ), the_id;
    $(document.body).unbind('click.widgets-toggle');
    $(document.body).bind('click.widgets-toggle', function(e){
        var target = $(e.target), css = {}, widget, inside, w;

        if ( target.parents('.widget-top').length && ! target.parents('#available-widgets').length ) {
            widget = target.closest('div.widget');
            inside = widget.children('.widget-inside');
            w = parseInt( widget.find('input.widget-width').val(), 10 );

            if ( inside.is(':hidden') ) {
                if ( w > 250 && inside.closest('div.widgets-sortables').length ) {
                    css['width'] = w + 30 + 'px';
                    if ( inside.closest('div.widget-liquid-right').length )
                        css[margin] = 235 - w + 'px';
                    widget.css(css);
                }
                wpWidgets.fixLabels(widget);
                inside.slideDown('fast');
            } else {
                inside.slideUp('fast', function() {
                    widget.css({'width':'', margin:''});
                });
            }
            e.preventDefault();
        } else if ( target.hasClass('widget-control-save') ) {

            var widget = target.closest('div.widget');

            if( widget.parent().hasClass('dw-focus-widget-extends') ) {
                dwSaveWidget(widget);
                wpWidgets.save( widget.parent().closest('div.widget'), 0, 1, 0 );
            }else{
                var container = widget.find('.dw-focus-widget-extends');
                container.find(':input').attr('disabled','disabled');
                dwSaveWidgetForContainer( container );
                wpWidgets.save( widget, 0, 1, 0 );
                container.find(':input').removeAttr('disabled');
            }
            setTimeout(function(){
                //DW Focus: Resortable for div.dw-focus-widget-extends
                $('div.widget-liquid-right div.dw-focus-widget-extends').each( function(){
                    dw_sortable( $(this) );
                });//End DW Focus Custom
            },1000);
            e.preventDefault();
        } else if ( target.hasClass('widget-control-remove') ) {
            var widget = target.closest('div.widget');
            if( widget.parent().hasClass('dw-focus-widget-extends') ) {
                var parent = widget.parent();
                target.closest('div.widget').remove();
                dwSaveWidgetForContainer( parent );
                wpWidgets.save( parent.closest('div.widget'), 0, 0, 1 );
            }else{
                wpWidgets.save( widget, 1, 1, 0 );
            }
            e.preventDefault();
        } else if ( target.hasClass('widget-control-close') ) {
            wpWidgets.close( target.closest('div.widget') );
            e.preventDefault();
        }
    });
    
    $('.recent-post-meta-info').live( 'click', function(e){

        var t = $(this), container = t.closest('div.meta-info');
        if( t.is(':checked') ) {
           container.find('.submeta-info').removeAttr('disabled');
        }else{

           container.find('.submeta-info').attr('disabled','disabled');
        }
    });
    

    // Poll widget
    $('.dw-focus-poll').delegate('.addmore-choice','click',function(event){
        event.preventDefault();
        var choices_box = $(this).closest('.dw-focus-poll').find('.poll-choices'),
            origin = choices_box.find('p:last-child');

        var clone = origin.clone(),
            number = $('.dw-focus-poll .dw-focus-choice').length;

        clone.find('input').attr('id', number).val('');

        choices_box.append(clone);
    });

    $('.dw-focus-poll').delegate('.remove-link a','click',function(event){
        event.preventDefault();
        var choice = $(this).closest('p');

        choice.remove();
    });

    $('.dw-focus-poll').delegate('.reset-results','click',function(event){
        event.preventDefault();
        $('.dw-focus-poll').find('.poll-result').val(0);
        $('.dw-focus-poll').closest('.widget').find('.widget-control-save').trigger('click');
    });
    // End custom widget for DW Poll
    $('.category-pseudo-select').live('click',function(event){
        $(this).closest('.categories-checklist-container').find('.categories-checklist').slideToggle(300);
    });
});

