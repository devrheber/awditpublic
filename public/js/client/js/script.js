$(document).ready(function() {
    // $('.slide_tgl_btn').click(function() {
    //   $(this).parent().parent().next().slideToggle('slow');
    //     return false;
    //  });

    $(".question_name").click(function() {
        $(this)
            .parents(".fld_list")
            .next()
            .slideToggle("slow");
        return false;
    });

    $(".file_input").change(function() {
        filename = $(this).val();
        if (filename.substring(3, 11) == "fakepath") {
            filename = filename.substring(12);
        } // For Remove fakepath
        $(this)
            .prev()
            .text(filename);
    });
});

$(".add_fold_btn").click(function() {
    $(".add_fold_bx").slideToggle("slow");
    return false;
});
$(".dot_btn").click(function() {
    $(this)
        .next()
        .slideToggle("slow");
    return false;
});

$(document).click(function(e) {
    if (!$(e.target).closest(".add_fold_bx").length) {
        $(".add_fold_bx").slideUp();
    }
});
$(document).click(function(e) {
    if (!$(e.target).closest(".dot_pop_bx").length) {
        $(".dot_pop_bx").slideUp();
    }
});

$(".new_popup_opt_btn").click(function() {
    $(this)
        .next()
        .slideToggle("slow");
    return false;
});

$(document).click(function(e) {
    if (!$(e.target).closest(".opt_nw_bx").length) {
        $(".opt_nw_bx").slideUp();
    }
});

// $('.slide_down_btn').click(function() {
//     $(this).parent().parent().next().slideDown('slow');
//     $(this).parent().parent().next().children('div').slideDown('slow');
// });
// $('.slide_up_btn').click(function() {
//     $(this).parent().parent().slideUp('slow');
// });

// $('.plus_icon').click(function() {
//     $('.bottom_sec').slideToggle('slow');
// });

$(function() {
    $("#datepicker_spl").datepicker({
        timeFormat: "hh:mm tt z",
        changeMonth: true,
        changeYear: true,
        showWeek: true,
        firstDay: 1,
        showAnim: "slideDown",
        dateFormat: "yy-mm-dd",
        minDate: 0
    });
});

// select2

$(".select2_pp").select2({});

$("#choose_folder").select2({
    selectOnClose: true,
    placeholder: "Choose folder"
});

$("#search_drp3").select2({
    selectOnClose: true,
    placeholder: "Loc. Size"
});
$("#search_drp4").select2({
    selectOnClose: true,
    placeholder: "Loc. Madurity level"
});
$("#search_drp5").select2({
    selectOnClose: true,
    placeholder: "Category"
});
$("#search_drp6").select2({
    selectOnClose: true,
    placeholder: "Security dep."
});

$("#search_drp1").select2({
    selectOnClose: true,
    placeholder: "MoSMif"
});

$("#search_drp2").select2({
    selectOnClose: true,
    placeholder: "MoSMif level"
});

// $("#with_search_drp").select2({
//     // placeholder: "Supplier"
// });

$("#country_drp").select2({
    placeholder: "Country"
});
$("#city_drp").select2({
    placeholder: "City"
});

// supplier page
function hideProfileDetails() {
    if ($(".side-bar-profile").hasClass("d-none")) {
        $(".side-bar-profile").removeClass("d-none");
    } else {
        $(".side-bar-profile").addClass("d-none");
    }
}
////////////sidebar////////////////
$("#menu-action").click(function() {
    const logo = document.querySelector(".show-logo-2");

    $(".sidebar").toggleClass("active");
    $(".main").toggleClass("active");
    $(this).toggleClass("active");

    if ($(".sidebar").hasClass("active")) {
        $(".show-hide").removeClass("d-none");
        $(".show-logo-2").css("opacity", "0");
        $(this)
        .find("i")
        .addClass("fa-close")
        .removeClass("fa-bars");
        $(".header #menu-action")
        .addClass("d-flex justify-content-between")
        .css("padding", "0 10px 0 10px");
        $(".profile-btn").removeClass("d-none");
        $(".profile_drp_img").addClass("profile-drp-img-active");
        $(".profile_drp_img").removeClass("profile-drp-img-deactive");
        $(".side-bar-profile").addClass("d-none");
    } else {
        $(".show-hide").addClass("d-none");
        $(".show-logo-2").css("opacity", "1");
        $(this)
        .find("i")
        .addClass("fa-bars")
            .removeClass("fa-close");
        $(".header #menu-action")
            .removeClass("d-flex justify-content-between")
            .css("padding", "0");
            $(".profile-btn").addClass("d-none");
            $(".profile_drp_img").addClass("profile-drp-img-deactive");
            $(".profile_drp_img").removeClass("profile-drp-img-active");
            $(".side-bar-profile").addClass("d-none");
    }
});
$("#profile-button-action").on("click", function() {
    hideProfileDetails();
});

///////////////Suppliers: Total VS New//////////////////

//////////////////MF: Total VS new///////////////////////

/////////////add row////////////////

(function($, window, document, undefined) {
    var pluginName = "editable",
        defaults = {
            keyboard: true,
            dblclick: true,
            button: true,
            buttonSelector: ".edit",
            maintainWidth: true,
            dropdowns: {},
            edit: function() {},
            save: function() {},
            cancel: function() {}
        };

    function editable(element, options) {
        this.element = element;
        this.options = $.extend({}, defaults, options);

        this._defaults = defaults;
        this._name = pluginName;

        this.init();
    }

    editable.prototype = {
        init: function() {
            this.editing = false;

            if (this.options.dblclick) {
                $(this.element)
                    .css("cursor", "pointer")
                    .bind("dblclick", this.toggle.bind(this));
            }

            if (this.options.button) {
                $(this.options.buttonSelector, this.element).bind(
                    "click",
                    this.toggle.bind(this)
                );
            }
        },

        toggle: function(e) {
            e.preventDefault();

            this.editing = !this.editing;

            if (this.editing) {
                this.edit();
            } else {
                this.save();
            }
        },

        edit: function() {
            var instance = this,
                values = {};

            $("td[data-field]", this.element).each(function() {
                var input,
                    field = $(this).data("field"),
                    value = $(this).text(),
                    width = $(this).width();

                values[field] = value;

                $(this).empty();

                if (instance.options.maintainWidth) {
                    $(this).width(width);
                }

                if (field in instance.options.dropdowns) {
                    input = $("<select></select>");

                    for (
                        var i = 0;
                        i < instance.options.dropdowns[field].length;
                        i++
                    ) {
                        $("<option></option>")
                            .text(instance.options.dropdowns[field][i])
                            .appendTo(input);
                    }

                    input
                        .val(value)
                        .data("old-value", value)
                        .dblclick(instance._captureEvent);
                } else {
                    input = $('<input type="text" />')
                        .val(value)
                        .data("old-value", value)
                        .dblclick(instance._captureEvent);
                }

                input.appendTo(this);

                if (instance.options.keyboard) {
                    input.keydown(instance._captureKey.bind(instance));
                }
            });

            this.options.edit.bind(this.element)(values);
        },

        save: function() {
            var instance = this,
                values = {};

            $("td[data-field]", this.element).each(function() {
                var value = $(":input", this).val();

                values[$(this).data("field")] = value;

                $(this)
                    .empty()
                    .text(value);
            });

            this.options.save.bind(this.element)(values);
        },

        cancel: function() {
            var instance = this,
                values = {};

            $("td[data-field]", this.element).each(function() {
                var value = $(":input", this).data("old-value");

                values[$(this).data("field")] = value;

                $(this)
                    .empty()
                    .text(value);
            });

            this.options.cancel.bind(this.element)(values);
        },

        _captureEvent: function(e) {
            e.stopPropagation();
        },

        _captureKey: function(e) {
            if (e.which === 13) {
                this.editing = false;
                this.save();
            } else if (e.which === 27) {
                this.editing = false;
                this.cancel();
            }
        }
    };

    $.fn[pluginName] = function(options) {
        return this.each(function() {
            if (!$.data(this, "plugin_" + pluginName)) {
                $.data(
                    this,
                    "plugin_" + pluginName,
                    new editable(this, options)
                );
            }
        });
    };
})(jQuery, window, document);

editTable();

//custome editable starts
function editTable() {
    $(function() {
        var pickers = {};

        $("table tr").editable({
            dropdowns: {
                sex: ["Male", "Female"]
            },
            edit: function(values) {
                $(".edit i", this)
                    .removeClass("fa-pencil")
                    .addClass("fa-save")
                    .attr("title", "Save");

                pickers[this] = new Pikaday({
                    field: $("td[data-field=birthday] input", this)[0],
                    format: "MMM D, YYYY"
                });
            },
            save: function(values) {
                $(".edit i", this)
                    .removeClass("fa-save")
                    .addClass("fa-pencil")
                    .attr("title", "Edit");

                if (this in pickers) {
                    pickers[this].destroy();
                    delete pickers[this];
                }
            },
            cancel: function(values) {
                $(".edit i", this)
                    .removeClass("fa-save")
                    .addClass("fa-pencil")
                    .attr("title", "Edit");

                if (this in pickers) {
                    pickers[this].destroy();
                    delete pickers[this];
                }
            }
        });
    });
}

$(".add-row").click(function() {
    $("#editableTable")
        .find("tbody tr:first")
        .before(
            "<tr><td data-field='name'></td><td data-field='name'></td><td data-field='name'></td><td data-field='name'></td><td><a class='button button-small edit' title='Edit'><i class='fa fa-pencil'></i></a> <a class='button button-small' title='Delete'><i class='fa fa-trash'></i></a></td></tr>"
        );
    editTable();
    setTimeout(function() {
        $("#editableTable")
            .find("tbody tr:first td:last a[title='Edit']")
            .click();
    }, 200);

    setTimeout(function() {
        $("#editableTable")
            .find("tbody tr:first td:first input[type='text']")
            .focus();
    }, 300);

    $("#editableTable")
        .find("a[title='Delete']")
        .unbind("click")
        .click(function(e) {
            $(this)
                .closest("tr")
                .remove();
        });
});

function myFunction() {}

$("#editableTable")
    .find("a[title='Delete']")
    .click(function(e) {
        var x;
        if (confirm("Are you sure you want to delete entire row?") == true) {
            $(this)
                .closest("tr")
                .remove();
        } else {
        }
    });

////////////////supplier location graph////////////////

//   var data = {
//   labels: ["Big", "Medium", "Small", "Micro", "Security Dep."],
//   datasets: [{
//     label: "Dataset #1",
//     backgroundColor: [
//     'rgba(255, 99, 132, 0.2)',
//   'rgba(54, 162, 235, 0.2)',
//   'rgba(255, 206, 86, 0.2)',
//   'rgba(75, 192, 192, 0.2)',
//   'rgba(153, 102, 255, 0.2)'
//     ],
//     borderColor: [
//     'rgba(255,99,132,1)',
//   'rgba(54, 162, 235, 1)',
//   'rgba(255, 206, 86, 1)',
//   'rgba(75, 192, 192, 1)',
//   'rgba(153, 102, 255, 1)'
//     ],
//     borderWidth: 4,
//     hoverBackgroundColor: "#2D2A78",
//     hoverBorderColor: "rgba(255,99,132,1)",
//     data: [60, 50, 20, 30, 20],
//   }]
// };

// var options = {
//   maintainAspectRatio: false,
//   scales: {
//     yAxes: [{
//       stacked: true,
//       gridLines: {
//         display: true,
//         color: "#deebec"
//       }
//     }],
//     xAxes: [{
//       gridLines: {
//         display: false
//       }
//     }]
//   }
// };

// Chart.Bar('chart1', {
//   options: options,
//   data: data
// });
