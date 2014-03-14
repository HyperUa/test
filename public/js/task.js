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
                var options = $('.options');

                options.find('> i').off()
                    .on('click', function(){
                        var el = $(this).parent();
                        var list = el.find('.options-list');

                        if(el.hasClass('active')){
                            list.fadeOut(100);
                            el.removeClass('active');
                        }else{
                            options.removeClass('active');
                            options.find('.options-list').hide();

                            list.fadeIn(300);
                            el.addClass('active');
                        }
                    });
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
        },

        Modal:{

            confirmDelete: function(elements){
                elements.confirm({
                    title: 'Удаление',
                    text: 'Вы действительно хотите удалить?',
                    confirmButton: "Удалить",
                    cancelButton: "Не удалять"
                });
            }
        },


        init: function(){
            Task.Modal.confirmDelete($("a.use_modal_confirm"));
        }
    }


})(jQuery);