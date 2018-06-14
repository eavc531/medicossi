//Dashboard

$(document).ready(function(){
  $("#show").click(function(){
    $("#dashboard").fadeToggle(200);
  });
  $("#filter").click(function(){
   $("#panel").slideToggle(200);
 });

});


$(document).on('click', '.browse', function(){
  var file = $(this).parent().parent().parent().find('.file');
  file.trigger('click');
});


$(document).on('change', '.file', function(){
  $(this).parent().find('.form-control').val($(this).val().replace(/C:\\fakepath\\/i, ''));
});

//tooltip

$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip(); 
});

// Star raiting
$(
  function () {
    $('.li-config').on('click', function() {
      var selectedCssClass = 'selected';
      var $this = $(this);
      $this.siblings('.' + selectedCssClass).removeClass(selectedCssClass);
      $this
      .addClass(selectedCssClass)
      .parent().addClass('vote-cast');
    });
  }
  );

// Flip card 

$(document).ready(function () {
  $('.flipButton').bind("click", function() {
    $(this).next().toggleClass('hover');
  })
});


//shedule
 $(function() {
    $("#scheduler").kendoScheduler({
        date: new Date("2018/3/13"),
        startTime: new Date("2018/3/13 07:00 AM"),
        height: 600,
        views: [
            "day",
            { type: "workWeek", selected: true },
            "week",
            { type: "timeline", eventHeight: 50}
        ],
        timezone: "Etc/UTC",
        dataSource: {
            batch: true,
            transport: {
                read: {
                    url: "https://demos.telerik.com/kendo-ui/service/tasks",
                    dataType: "jsonp"
                },
                update: {
                    url: "https://demos.telerik.com/kendo-ui/service/tasks/update",
                    dataType: "jsonp"
                },
                create: {
                    url: "https://demos.telerik.com/kendo-ui/service/tasks/create",
                    dataType: "jsonp"
                },
                destroy: {
                    url: "https://demos.telerik.com/kendo-ui/service/tasks/destroy",
                    dataType: "jsonp"
                },
                parameterMap: function(options, operation) {
                    if (operation !== "read" && options.models) {
                        return {models: kendo.stringify(options.models)};
                    }
                }
            },
            schema: {
                model: {
                    id: "taskId",
                    fields: {
                        taskId: { from: "TaskID", type: "number" },
                        title: { from: "Title", defaultValue: "No title", validation: { required: true } },
                        start: { type: "date", from: "Start" },
                        end: { type: "date", from: "End" },
                        startTimezone: { from: "StartTimezone" },
                        endTimezone: { from: "EndTimezone" },
                        description: { from: "Description" },
                        recurrenceId: { from: "RecurrenceID" },
                        recurrenceRule: { from: "RecurrenceRule" },
                        recurrenceException: { from: "RecurrenceException" },
                        ownerId: { from: "OwnerID", defaultValue: 1 },
                        isAllDay: { type: "boolean", from: "IsAllDay" }
                    }
                }
            },
            filter: {
                logic: "or",
                filters: [
                    { field: "ownerId", operator: "eq", value: 1 },
                    { field: "ownerId", operator: "eq", value: 2 }
                ]
            }
        },
        resources: [
            {
                field: "ownerId",
                title: "Owner",
                dataSource: [
                    { text: "Alex", value: 1, color: "#f8a398" },
                    { text: "Bob", value: 2, color: "#51a0ed" },
                    { text: "Charlie", value: 3, color: "#56ca85" }
                ]
            }
        ]
    });

    $("#people :checkbox").change(function(e) {
        var checked = $.map($("#people :checked"), function(checkbox) {
            return parseInt($(checkbox).val());
        });

        var scheduler = $("#scheduler").data("kendoScheduler");

        scheduler.dataSource.filter({
            operator: function(task) {
                return $.inArray(task.ownerId, checked) >= 0;
            }
        });
    });
});
/* Checkbox panel professional */

$('.checkbox-wrapper').on('click', function() {

  $(this).toggleClass('checked');

  if ($(this).hasClass('checked')) {
    $('input[type="checkbox"]', this).prop('checked', true);
  } else {
    $('input[type="checkbox"]', this).prop('checked', false);
  }

})

/* textarea panel profesional add query */

$(document).ready(function(){
    $("#show-textarea").click(function(){
        $("#textarea-edit").slideDown("fast");
    });
        $("#show-textarea1").click(function(){
        $("#textarea-edit").slideUp("fast");
    });
});


$(document).ready(function(){
    $("#show-question3").click(function(){
        $("#show-question").slideDown("fast");
    });
        $("#show-question2").click(function(){
        $("#show-question").slideUp("fast");
    });
});

