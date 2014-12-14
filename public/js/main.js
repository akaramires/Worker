/**
 * Created by elmar on 12/14/14.
 */

(function ($) {

    'use strict';

    jQuery(document).ready(function ($) {
        if ($('select#hours_project').length > 0) {
            $('select#hours_project').change(function () {
                jQuery.ajax({
                    url       : '/tasks',
                    type      : 'POST',
                    data      : {
                        option: $(this).val()
                    },
                    beforeSend: function () {
                        $('select#hours_task').prop("disabled", true);
                        $('select#hours_task option').slice(1).remove();
                    },
                    success   : function (response) {

                        $.each(response, function (index, element) {
                            $('select#hours_task').append('<option value="' + index + '">' + element + '</option>');
                        });

                        $('select#hours_task').prop("disabled", false);
                    }
                });
            });

            $('#form-add-hours').on('submit', function () {
                var $form = $(this);
                jQuery.ajax({
                    url       : $form.prop('action'),
                    type      : 'POST',
                    dataType  : 'json',
                    data      : {
                        _token           : $form.find('input[name=_token]').val(),
                        hours_date       : $form.find('[name=hours_date]').val(),
                        hours_project    : $form.find('[name=hours_project]').val(),
                        hours_task       : $form.find('[name=hours_task]').val(),
                        hours_count      : $form.find('[name=hours_count]').val(),
                        hours_description: $form.find('[name=hours_description]').val()
                    },
                    beforeSend: function () {
                        $form.find('.form-error').html('');
                        $form.find('.form-group').removeClass('has-error').find('.help-block').html('');
                    },
                    success   : function (response) {
                        if (response.success) {

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
                                $form.find('.form-error').html(response.msg);
                            }
                        }
                    }
                });

                return false;
            });
        }
    });

})(jQuery);