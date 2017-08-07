'use strict';

var selectedSPAN;

function showCommentForm(node) {
    selectedSPAN = node;
    if (selectedSPAN.className !== 'add-a-comment') { return; }
    if(selectedSPAN.nextElementSibling.style.display === "none") {
        selectedSPAN.nextElementSibling.style.display = "block";
        selectedSPAN.innerHTML = "Hide comments";
    } else {
        selectedSPAN.nextElementSibling.style.display = "none";
        selectedSPAN.innerHTML = "Show comments";
    }
}

document.body.onclick = function (event) {
    var target = event.target || event.srcElement;
    showCommentForm(target);
};


////////////////////////////////////////////////////////

jQuery(document).ready(function ($){
    $(function ajaxComments() {

        $(function () {
            $('.comment-form').each(function () {
                // Объявляем переменные (форма и кнопка отправки)
                var form = $(this),
                    btn = form.find('.submit');

                // Добавляем каждому проверяемому полю, указание что поле пустое
                form.find('.required').addClass('empty_field');

                // Функция проверки полей формы
                function checkInput() {
                    form.find('.required').each(function () {
                        if ($(this).val() != '') {
                            // Если поле не пустое удаляем класс-указание
                            $(this).removeClass('empty_field');
                        } else {
                            // Если поле пустое добавляем класс-указание
                            $(this).addClass('empty_field');
                        }
                    });
                }

                // Функция подсветки незаполненных полей
                function lightEmpty() {
                    form.find('.empty_field').css({'border-color': '#d8512d'});
                    // Через полсекунды удаляем подсветку
                    setTimeout(function () {
                        form.find('.empty_field').removeAttr('style');
                    }, 500);
                }

                // Проверка в режиме реального времени
                setInterval(function () {
                    // Запускаем функцию проверки полей на заполненность
                    checkInput();
                    // Считаем к-во незаполненных полей
                    var sizeEmpty = form.find('.empty_field').size();
                    // Вешаем условие-тригер на кнопку отправки формы
                    if (sizeEmpty > 0) {
                        if (btn.hasClass('disabled')) {
                            return false
                        } else {
                            btn.addClass('disabled')
                        }
                    } else {
                        btn.removeClass('disabled')
                    }
                }, 500);

                // Событие клика по кнопке отправить
                btn.click(function () {
                    if ($(this).hasClass('disabled')) {
                        // подсвечиваем незаполненные поля и форму не отправляем, если есть незаполненные поля
                        lightEmpty();
                        return false;
                    }
                });
            });
        });


////////////////////////////////////////////////////////////////////////////
        $(function () {
            $('body').on('submit', '.comment-form', function (e) {
                // Stop the default form behavior
                e.preventDefault();
                var target = $(e.target);
                var targetParent = target.parents('.comment_form');
                var commentform = $(this);
                var action = commentform.attr('action');
                var inputs = commentform.serializeArray();
                var submitting_comment = target.find('.submitting-comment');

                // Submitting comment
                commentform.ajaxSubmit({
                    beforeSend: function () {
                        // Display the loading state
                        commentform.find('p').slideUp();
                        submitting_comment.show();
                    },
                    success: function (responseText, statusText, xhr, form) {
                        // Switch the existing comment area with the comment area returned from AJAX call
                        var cancel = $("#cancel-comment-reply-link");
                        if (cancel) {
                            cancel.click();
                        }

                        var page = $(responseText);
                        var comments = page.find('.commentlist');
                        targetParent.find('.commentlist').replaceWith(comments);

                        commentform.find('p').slideDown();
                        submitting_comment.hide();
                    },
                    error: function (xhr, textStatus, errorThrown) {
                        // Translates the error code status into understandable error message
                        if (textStatus == 'error') {
                            var error_code = xhr.status;
                            if (error_code == 409) {
                                commentform.prepend('<div id="comment-status" >Duplicate comment detected; it looks as though you have already said that!</div>');
                            }
                            if (error_code == 429) {
                                commentform.prepend('<div id="comment-status" style="font-size: 12px;" >You are posting comments too quickly. Slow down.</div>');
                            }
                        }
                        // Unloading state
                        commentform.find('p').slideDown();
                        submitting_comment.hide();
                    },
                    clearForm: true,
                    url: action,
                    data: inputs
                });
                return false;
            })
        });
    });
});
///////////////////////////////////////////////////////