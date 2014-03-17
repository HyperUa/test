(function($) {

    window.Task = {

        Message: {

            options: {
                delay: 5000,
                block: '#messanger'
            },

            showMessages: function(){
                var block = $(this.options.block);

                block.removeClass('hide');
                setTimeout(function(){
                    block.addClass('hide');
                }, Task.Message.options.delay);
            },

            addMessage: function(message){
                var template = '<p><i class="icon-large icon-exclamation-sign"></i><span>'+message+'</span></p>';
                $('#messanger .messages').html(template);

                this.showMessages();
            }
        },

        Form: {
            initFormStyler: function(){
                $('input, select').styler();
            },

            setFilePath: function(path, id){
                $('#'+id+'-styler .jq-'+id+'__name').html(path);
            },

            Book: {

                genre:{
                    button: '#add_genre_button',
                    title : 'Добавление нового жанра',
                    text_block: '#add_genre_text'
                },
                author:{
                    button: '#add_author_button',
                    title : 'Добавление нового автора',
                    text_block: '#add_author_text'
                },

                init: function(){
                    this.bindAddGenre();
                    this.bindAddAuthor();
                },

                bindAddGenre: function(button, titile, text, callback){
                    var _this = this;

                    $(_this.genre.button).confirm({
                        title: _this.genre.title,
                        text:  $(_this.genre.text_block).html(),
                        confirmButton: "Добавить",
                        cancelButton: "Не добавлять",

                        confirm: function(button) {
                            var input = $('.modal #add_new_genre');
                            var new_genre = input.val();

                            _this.addGenre(new_genre);
                        },
                        cancel: function(button) {
                            var input = $(_this.genre.text_block).find('input');
                            input.val('');
                        }
                    });
                },

                bindAddAuthor: function(){
                    var _this = this;

                },

                addGenre: function(genre_new){
                    console.log('add');
                    var genre_list = $("#genres");
                    var option_by_text = genre_list.find("option").filter(function(index) {
                        return genre_new === $(this).text();
                    });

                    console.log();

                    if(genre_new == ''){
                        Task.Message.addMessage('Жанр не может быть пустым');
                    }else if(option_by_text.length != 0){
                        Task.Message.addMessage('Жанр не может быть пустым');
                    }else{


                        genre_list.append('<option>'+genre_new+'</option>');
                        genre_list.trigger('refresh')
                    }
                }

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