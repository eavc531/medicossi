//Dashboard




$(document).ready(function(){
  $("#show").click(function(){
    // $("#dashboard").fadeToggle(200);
});
  ////me

  /////
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


// //shedule
// $(function() {
//     $("#scheduler").kendoScheduler({
//         date: new Date("2018/3/13"),
//         startTime: new Date("2018/3/13 07:00 AM"),
//         height: 600,
//         views: [
//         "day",
//         { type: "workWeek", selected: true },
//         "week",
//         { type: "timeline", eventHeight: 50}
//         ],
//         timezone: "Etc/UTC",
//         dataSource: {
//             batch: true,
//             transport: {
//                 read: {
//                     url: "https://demos.telerik.com/kendo-ui/service/tasks",
//                     dataType: "jsonp"
//                 },
//                 update: {
//                     url: "https://demos.telerik.com/kendo-ui/service/tasks/update",
//                     dataType: "jsonp"
//                 },
//                 create: {
//                     url: "https://demos.telerik.com/kendo-ui/service/tasks/create",
//                     dataType: "jsonp"
//                 },
//                 destroy: {
//                     url: "https://demos.telerik.com/kendo-ui/service/tasks/destroy",
//                     dataType: "jsonp"
//                 },
//                 parameterMap: function(options, operation) {
//                     if (operation !== "read" && options.models) {
//                         return {models: kendo.stringify(options.models)};
//                     }
//                 }
//             },
//             schema: {
//                 model: {
//                     id: "taskId",
//                     fields: {
//                         taskId: { from: "TaskID", type: "number" },
//                         title: { from: "Title", defaultValue: "No title", validation: { required: true } },
//                         start: { type: "date", from: "Start" },
//                         end: { type: "date", from: "End" },
//                         startTimezone: { from: "StartTimezone" },
//                         endTimezone: { from: "EndTimezone" },
//                         description: { from: "Description" },
//                         recurrenceId: { from: "RecurrenceID" },
//                         recurrenceRule: { from: "RecurrenceRule" },
//                         recurrenceException: { from: "RecurrenceException" },
//                         ownerId: { from: "OwnerID", defaultValue: 1 },
//                         isAllDay: { type: "boolean", from: "IsAllDay" }
//                     }
//                 }
//             },
//             filter: {
//                 logic: "or",
//                 filters: [
//                 { field: "ownerId", operator: "eq", value: 1 },
//                 { field: "ownerId", operator: "eq", value: 2 }
//                 ]
//             }
//         },
//         resources: [
//         {
//             field: "ownerId",
//             title: "Owner",
//             dataSource: [
//             { text: "Alex", value: 1, color: "#f8a398" },
//             { text: "Bob", value: 2, color: "#51a0ed" },
//             { text: "Charlie", value: 3, color: "#56ca85" }
//             ]
//         }
//         ]
//     });

//     $("#people :checkbox").change(function(e) {
//         var checked = $.map($("#people :checked"), function(checkbox) {
//             return parseInt($(checkbox).val());
//         });

//         var scheduler = $("#scheduler").data("kendoScheduler");

//         scheduler.dataSource.filter({
//             operator: function(task) {
//                 return $.inArray(task.ownerId, checked) >= 0;
//             }
//         });
//     });
// });
/* Checkbox panel professional */

$('.checkbox-wrapper').on('click', function() {

  $(this).toggleClass('checked');

  if ($(this).hasClass('checked')) {
    $('input[type="checkbox"]', this).prop('checked', true);
} else {
    $('input[type="checkbox"]', this).prop('checked', false);
}

})

/* textarea panel profesional general */

/* Add query */

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

$(document).ready(function(){
    $("#show-question7").click(function(){
        $("#test-laboratory").slideDown("fast");
    });
    $("#show-question6").click(function(){
        $("#test-laboratory").slideUp("fast");
    });
});

$(document).ready(function(){
    $("#show-question9").click(function(){
        $("#diagnosis").slideDown("fast");
    });
    $("#show-question8").click(function(){
        $("#diagnosis").slideUp("fast");
    });
});

$(document).ready(function(){
    $("#show-question2").click(function(){
        $("#panel-insurance").slideDown("fast");
    });
    $("#show-question1").click(function(){
        $("#panel-insurance").slideUp("fast");
    });
});

/* note emergencies */

$(document).ready(function(){
    $("#open2").click(function(){
        $("#open01").slideDown("fast");
    });
    $("#open1").click(function(){
        $("#open01").slideUp("fast");
    });
});

$(document).ready(function(){
    $("#open4").click(function(){
        $("#open02").slideDown("fast");
    });
    $("#open3").click(function(){
        $("#open02").slideUp("fast");
    });
});


$(document).ready(function(){
    $("#open6").click(function(){
        $("#open03").slideDown("fast");
    });
    $("#open5").click(function(){
        $("#open03").slideUp("fast");
    });
});

$(document).ready(function(){
    $("#open8").click(function(){
        $("#open04").slideDown("fast");
    });
    $("#open7").click(function(){
        $("#open04").slideUp("fast");
    });
});

$(document).ready(function(){
    $("#open10").click(function(){
        $("#open05").slideDown("fast");
    });
    $("#open9").click(function(){
        $("#open05").slideUp("fast");
    });
});

$(document).ready(function(){
    $("#open12").click(function(){
        $("#open06").slideDown("fast");
    });
    $("#open11").click(function(){
        $("#open06").slideUp("fast");
    });
});

$(document).ready(function(){
    $("#switch-on").click(function(){
        $("#open-check").slideDown("fast");
    });
    $("#switch-off").click(function(){
        $("#open-check").slideUp("fast");
    });
});

$(document).ready(function(){
    $("#switch-on1").click(function(){
        $("#open-check1").slideDown("fast");
    });
    $("#switch-off1").click(function(){
        $("#open-check1").slideUp("fast");
    });
});
