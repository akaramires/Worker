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
                        if (Object.keys(response).length == 1) {
                            $('select#hours_task').val(Object.keys(response)[0]);
                        }
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
                            $('.table-hours tbody tr:first-of-type').before('<tr>' +
                            '<td class="text-center">' + $form.find('[name=hours_date]').val() + '</td>' +
                            '<td class="text-center">' + $form.find('[name=hours_count]').val() + '</td>' +
                            '<td class="col-project">' + $form.find('[name=hours_project] option:selected').text() + '</td>' +
                            '<td class="col-project">' + $form.find('[name=hours_task] option:selected').text() + '</td>' +
                            '<td>' + $form.find('[name=hours_description]').val() + '</td>' +
                            '<td class="text-center">' +
                            '<div class="btn-group">' +
                            '<button type="button" class="btn btn-warning btn-sm">Edit</button>' +
                            '<button type="button" class="btn btn-danger btn-sm">Delete</button>' +
                            '</div>' +
                            '</td>' +
                            '</tr>');
                            $form.find('[name=hours_date]').val('');
                            $form.find('[name=hours_count]').val('');
                            $form.find('[name=hours_project]').val('');
                            $form.find('[name=hours_task]').val('');
                            $form.find('[name=hours_description]').val('');
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

            $('#hours_date').datetimepicker({
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
    });

})(jQuery);