/**
 * Created by elmar on 12/14/14.
 */

(function ($) {

    'use strict';

    $(document).ready(function ($) {
        var $formHours = $('#form-add-hours');

        if ($formHours.length > 0) {

            var $elToken = $formHours.find('input[name=_token]'),
                $elDate = $formHours.find('input#hours_date'),
                $elProject = $formHours.find('select#hours_project'),
                $elTask = $formHours.find('select#hours_task'),
                $elCount = $formHours.find('input#hours_count'),
                $elDescription = $formHours.find('textarea#hours_description');

            $elProject.change(function () {
                var $this = $(this);

                jQuery.ajax({
                    url       : '/tasks',
                    type      : 'POST',
                    data      : {
                        option: $this.val()
                    },
                    beforeSend: function () {
                        $elTask.prop("disabled", true);
                        $elTask.find('option').slice(1).remove();
                    },
                    success   : function (response) {

                        $.each(response, function (index, element) {
                            $elTask.append('<option value="' + index + '">' + element + '</option>');
                        });

                        $elTask.prop("disabled", false);
                        if (Object.keys(response).length == 1) {
                            $elTask.val(Object.keys(response)[0]);
                        }
                    }
                });
            });

            $formHours.on('submit', function () {
                var $form = $(this);

                jQuery.ajax({
                    url       : $form.prop('action'),
                    type      : 'POST',
                    dataType  : 'json',
                    data      : {
                        _token           : $elToken.val(),
                        hours_date       : $elDate.val(),
                        hours_project    : $elProject.val(),
                        hours_task       : $elTask.val(),
                        hours_count      : $elCount.val(),
                        hours_description: $elDescription.val()
                    },
                    beforeSend: function () {
                        $form.find('.form-error').html('');
                        $form.find('.form-group').removeClass('has-error').find('.help-block').html('');
                    },
                    success   : function (response) {
                        if (response.success) {
                            location.reload();
                        } else {
                            if (response.type == 'validation') {
                                $.each(response.errors, function (key, value) {
                                    $form
                                        .find('#' + key)
                                        .closest('.form-group')
                                        .addClass('has-error')
                                        .find('.help-block')
                                        .html(value.join('<br>'));
                                });
                            } else {
                                flashError(response.msg);
                                //$form.find('.form-error').html(response.msg);
                            }
                        }
                    }
                });

                return false;
            });

            $elDate.datetimepicker({
                pickTime: false,
                maxDate : new Date()
            });
        }

        $('.form-delete-hours').submit(function (e) {
            if (!confirm('Are you sure?')) {
                e.preventDefault();
                return false;
            }
        });

        $('.alert.alert-success').each(function () {
            flashSuccess($.trim($(this).html()));
        });

        $('.alert.alert-danger').each(function () {
            flashError($.trim($(this).html()));
        });

        $('.alert.alert-warning').each(function () {
            flashWarning($.trim($(this).html()));
        });
    });

    function flash(text, type) {
        noty({
            text      : text,
            type      : type,
            layout    : 'topRight',
            theme     : 'relax',
            maxVisible: 3,
            timeout   : 3000,
            animation : {
                open  : 'animated bounceInRight',
                close : 'animated bounceOutRight',
                easing: 'swing',
                speed : 500
            }
        })
    }

    function flashSuccess(text) {
        flash(text, 'success');
    }

    function flashError(text) {
        flash(text, 'error');
    }

    function flashWarning(text) {
        flash(text, 'warning');
    }
})(jQuery);
