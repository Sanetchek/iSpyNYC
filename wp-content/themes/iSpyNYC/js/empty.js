////////////////////////////////////////////////////////////////////////////
jQuery('document').ready(function($){

    // Get the comment form
    var commentform = $('#commentform');
    // Add a Comment Status message
    commentform.prepend('<div id="comment-status" ></div>');
    // Defining the Status message element
    var statusdiv = $('#comment-status');
    commentform.submit(function(){
        // Serialize and store form data
        //Add a status message
        statusdiv.html('<p class="ajax-placeholder">Processing...</p>');
        //Extract action URL from commentform
        //Post Form with data
        $.ajax({
            type: 'post',
            url: commentform.attr( 'action' ),
            data: $(this).serialize(),
            error: function(XMLHttpRequest, textStatus, errorThrown){
                statusdiv.html('<p class="ajax-error" >You might have left one of the fields blank, or be posting too quickly</p>');

            },
            success: function(data, textStatus){
                if(data == "success")
                    statusdiv.html('<p class="ajax-success" >Thanks for your comment. We appreciate your response.</p>');
                else
                    statusdiv.html('<p class="ajax-error" >Please wait a while before posting your next comment</p>');
                commentform.find('textarea[name=comment]').val('');
            }
        });
        return false;
    });
});

////////////////////////////////////////////////////////////////////////////
jQuery(document).ready(function($){
    $('body').on('submit', function(event){
        // Stop the default form behavior
        event.preventDefault();
        var el = $(this);
        el.prop('disabled', true);

        var target              = $(event.target);
        var targetParent        = target.parents('.comment_form');
        var commentform 		= $('.comment-form');
        var action 				= commentform.attr( 'action' );
        var inputs 				= commentform.serializeArray();
        var submitting_comment 	= target.find('.submitting-comment');

        // Submitting comment
        commentform.ajaxSubmit({
            beforeSend: function () {
                // Display the loading state
                commentform.find('p').slideUp();
                submitting_comment.show();
            },
            success: function (responseText, statusText, xhr, form) {
                // Switch the existing comment area with the comment area returned from AJAX call
                var page = $(responseText);
                var comments = page.find('.commentlist');
                targetParent.find('.commentlist').replaceWith(comments);
            },
            error: function( xhr, textStatus, errorThrown ){
                // Translates the error code status into understandable error message
                if( textStatus == 'error' ){
                    var error_code = xhr.status;
                    if(error_code == 409) {
                        commentform.prepend('<div id="comment-status" >Duplicate comment detected; it looks as though you have already said that!</div>').fadeIn("slow");
                    }
                    if(error_code == 429) {
                        setInterval(function() {
                        commentform.prepend('<div id="comment-status" >You are posting comments too quickly. Slow down.</div>');
                        }, 5000);
                    }
                }
                // Unloading state
                $('#comment').val('');
                commentform.find('p').slideDown();
                submitting_comment.slideUp();
            },
            type: 'POST',
            url: action,
            data: inputs
        });
        return false;
    })
});
//////////////////////////////////////////////////////////////////////////// 
jQuery(document).ready(function($){
    $('#commentform').submit(function(e){
        // Stop the default form behavior
        e.preventDefault();
        var target              = $(e.target);
        var targetParent        = target.parents('.comment_form');
        var commentform 		= $(this);
        var action 				= commentform.attr( 'action' );
        var inputs 				= commentform.serialize();
        var submitting_comment 	= target.find('.submitting-comment');

        // Submitting comment
        commentform.ajaxSubmit({
            beforeSend: function () {
                // Display the loading state
                commentform.find('p').slideUp();
                submitting_comment.show();
            },
            success: function (responseText, statusText, xhr, form) {
                // Switch the existing comment area with the comment area returned from AJAX call
                var page = $(responseText);
                var comments = page.find('.commentlist');
                targetParent.find('.commentlist').replaceWith(comments);
            },
            error: function( xhr, textStatus, errorThrown ){
                // Translates the error code status into understandable error message
                if( textStatus == 'error' ){
                    var error_code = xhr.status;
                    if(error_code == 409) {
                        console.log('Duplicate comment detected; it looks as though you have already said that!');
                    }
                    if(error_code == 429) {
                        console.log('You are posting comments too quickly. Slow down.');
                    }
                }
                // Unloading state
                commentform.find('p').slideDown();
                submitting_comment.slideUp();
            },
            type: 'POST',
            url: action,
            data: inputs
        });
        return false;
    })
});


//////////////////////////////////////////////////////////////////////////// 
jQuery(function($){
    $('#commentform').submit(function(){
        // может такое случиться, что пользователь залогинен - нужно это проверить, иначе валидация не пройдет
        if($("#author").length) var author = $("#author").checka();
        if($("#email").length) var email = $("#email").checke();
        var comment = $("#comment").checka();
        // небольшое условие для того, чтобы исключить двойные нажатия на кнопку отправки
        // в это условие также входит валидация полей
        if (!$('#submit').hasClass('loadingform') && !$("#author").hasClass('error') && !$("#email").hasClass('error') && !$("#comment").hasClass('error')){
            $.ajax({
                type : 'POST',
                url : 'http://' + location.host + '/wp-admin/admin-ajax.php',
                data: $(this).serialize() + '&action=ajaxcomments',
                beforeSend: function(xhr){
                    // действие при отправке формы, сразу после нажатия на кнопку #submit
                    $('#submit').addClass('loadingform').val('Load...');
                },
                error: function (request, status, error) {
                    if(status==500){
                        alert('Error adding comment');
                    } else if(status=='timeout'){
                        alert('Error: The server is not responding, try more.');
                    } else {
                        // ворпдрессовские ошибочки, не уверен, что это самый оптимальный вариант
                        // если знаете способ получше - поделитесь
                        var errormsg = request.responseText;
                        var string1 = errormsg.split("<p>");
                        var string2 = string1[1].split("</p>");
                        alert(string2[0]);
                    }
                },
                success: function (newComment) {
                    // Если уже есть какие-то комментарии
                    if($('.commentlist').length > 0){
                        // Если текущий комментарий является ответом
                        if($('#respond').parent().hasClass('comment')){
                            // Если уже есть какие-то ответы
                            if($('#respond').parent().children('.children').length){
                                $('#respond').parent().children('.children').append(newComment);
                            } else {
                                // Если нет, то добавляем  <ul class="children">
                                newComment = '<ul class="children">'+newComment+'</ul>';
                                $('#respond').parent().append(newComment);
                            }
                            // закрываем форму ответа
                            $("#cancel-comment-reply-link").trigger("click");
                        } else {
                            // обычный коммент
                            $('.commentlist').append(newComment);
                        }
                    }else{
                        // если комментов пока ещё нет, тогда
                        newComment = '<ul class="commentlist">'+newComment+'</ol>';
                        $('#respond').before($(newComment));
                    }
                    // очищаем поле textarea
                    $('#comment').val('');
                },
                complete: function(){
                    // действие, после того, как комментарий был добавлен
                    $('#submit').removeClass('loadingform').val('Publish');
                }
            });
        }
        return false;
    });
});
