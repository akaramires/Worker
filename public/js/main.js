/**
 * Created by elmar on 12/14/14.
 */

(function ($) {
    'use strict';

    $(document).ready(function ($) {
        alert2flash();
        initProjectSelects();
        initFilterRow();
        initDatePickers();
    });

    function alert2flash() {
        $('.alert.alert-success').each(function () {
            flashSuccess($.trim($(this).html()));
        });

        $('.alert.alert-danger').each(function () {
            flashError($.trim($(this).html()));
        });

        $('.alert.alert-warning').each(function () {
            flashWarning($.trim($(this).html()));
        });
    }

    function initProjectSelects() {
        var pageLoaded = true;

        var $projectID = $('[name=projectDDownId]');
        var $taskID = $('[name=taskDDownId]');

        var $ddProject = $('.filter-row .project-dropdown');

        if ($ddProject.length > 0) {

            $ddProject.change(function () {
                var $this = $(this);
                var $ddTask = $('.task-dropdown-' + $this.data('destination'));

                if ($ddTask.length > 0) {
                    jQuery.ajax({
                        url       : '/projects/childs',
                        type      : 'POST',
                        data      : {
                            option: $this.val()
                        },
                        beforeSend: function () {
                            $ddTask.prop("disabled", true).find('option').remove();

                            if (!$this.val()) {
                                return false;
                            }
                        },
                        success   : function (response) {
                            $.each(response, function (index, element) {
                                $ddTask.append('<option value="' + index + '">' + element + '</option>');
                            });

                            $ddTask.prop("disabled", false);

                            if (pageLoaded) {
                                if ($taskID.val()) {
                                    $ddTask.val($taskID.val());
                                }

                                pageLoaded = false;
                            }
                        }
                    });
                }
            });

            if ($projectID.val()) {
                $ddProject.val($projectID.val()).trigger('change');
            }
        }
    }

    function initFilterRow() {
        var $btn = $('#filter_run');

        if ($btn.length > 0) {
            $btn.on('click', function (e) {
                var $this = $(this);
                var $form = $this.closest('form');

                var params = {};

                var filterDateFrom = $form.find('#filter-date-from').val();
                if (filterDateFrom) {
                    params.from = (new Date(filterDateFrom).getTime() / 1000);
                }

                var filterDateTo = $form.find('#filter-date-to').val();
                if (filterDateTo) {
                    params.to = (new Date(filterDateTo).getTime() / 1000);
                }

                var filterProject = $form.find('#filter-project').val();
                if (filterProject) {
                    params.project = filterProject;
                }

                var filterTask = $form.find('#filter-task').val();
                if (filterTask) {
                    params.task = filterTask;
                }

                var filterDev = $form.find('#filter-dev').val();
                if (filterDev) {
                    params.dev = filterDev;
                }

                if ($.param(params).length > 0) {
                    window.location.href = '?' + $.param(params);
                }
            });
        }
    }

    function initDatePickers() {
        var filterDateFrom = $('#filter-date-from');
        var filterDateTo = $('#filter-date-to');

        if (filterDateFrom.length > 0 && filterDateTo.length > 0) {
            filterDateFrom.datetimepicker({
                pickTime: false
            });

            filterDateTo.datetimepicker({
                pickTime: false
            })

            filterDateFrom.on("dp.hide", function (e) {
                if (!e.date.hasOwnProperty('_strict') && !filterDateTo.val()) {
                    filterDateTo.data("DateTimePicker").setDate(e.date);
                    filterDateTo.trigger('focus')
                }
            });

            filterDateFrom.on("dp.change", function (e) {
                filterDateTo.data("DateTimePicker").setMinDate(e.date);
            });

            filterDateTo.on("dp.change", function (e) {
                filterDateFrom.data("DateTimePicker").setMaxDate(e.date);
            });
        }
    }

})(jQuery);

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
