(function($) {

    window.Task = {

        Message: {

            options: {
                delay: 5000
            },

            showMessages: function(block){

                var block = $(block);

                block.removeClass('hide');

                setTimeout(function(){
                    block.addClass('hide');
                }, Task.Message.options.delay);
            }
        },

        Form: {
            initFormStyler: function(){
                $('input, select').styler();
            },

            setFilePath: function(path, id){
                $('#'+id+'-styler .jq-'+id+'__name').html(path);
            }
        },

        Events:{

            init: function(){
                this.options();
            },

            options: function(){

                $('.options').off()
                    .on('mouseover', function(){
                        el = $(this);
                        el.addClass('active');
                    })
                    .on('mouseout', function(){
                        el = $(this);
                        el.removeClass('active');
                    })
            }
        },

        Paginator:{

            initAjax: function(content){

                var content = $(content + ':first');

                $('.pagerfanta a').off().on('click', function(){
                    var a = $(this);
                    content.css('opacity', 0.6);

                    $.post(a.attr('href'), function( data ) {
                        content.html(data);
                        content.css('opacity', 1);
                    });

                    return false;
                })
            }
        }
    }


})(jQuery);