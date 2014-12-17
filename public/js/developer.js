/**
 * Created by elmar on 12/14/14.
 */

(function ($) {

    'use strict';

    $(document).ready(function ($) {
        $('.form-delete-hours').submit(function (e) {
            if (!confirm('Are you sure?')) {
                e.preventDefault();
                return false;
            }
        });

        addHours();
        filter();
    });

    function addHours() {
        var $formHours = $('#form-add-hours');

        if ($formHours.length > 0) {

            var $elToken = $formHours.find('input[name=_token]'),
                $elDate = $formHours.find('input#hours_date'),
                $elProject = $formHours.find('select#hours_project'),
                $elTask = $formHours.find('select#hours_task'),
                $elCount = $formHours.find('input#hours_count'),
                $elDescription = $formHours.find('textarea#hours_description');

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
    }

    function filter() {
        var $submitBtn = $('#hours_search');

        if ($submitBtn.length > 0) {
            $submitBtn.on('click', function () {
                var params = {};

                var filterDateFrom = $('#filter-date-from').val();
                if (filterDateFrom) {
                    params.from = (new Date(filterDateFrom).getTime() / 1000);
                }

                var filterDateTo = $('#filter-date-to').val();
                if (filterDateTo) {
                    params.to = (new Date(filterDateTo).getTime() / 1000);
                }

                var filterProject = $('#filter-project').val();
                if (filterProject) {
                    params.project = filterProject;
                }

                var filterTask = $('#filter-task').val();
                if (filterTask) {
                    params.task = filterTask;
                }

                if ($.param(params).length > 0) {
                    window.location.href = '/?' + $.param(params);
                }
            });
        }
    }
})
(jQuery);
