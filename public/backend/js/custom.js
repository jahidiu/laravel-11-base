
// "use strict";
$(".datepicker").flatpickr({ dateFormat: "d/m/Y" });

$(".timepicker").flatpickr({
    enableTime: true,
    noCalendar: true,
    dateFormat: "h:i K",
    time_24hr: false,
});


function textEditor(selector, height = 400) {
    if (!$().summernote) {
        console.warn('summernote is not loaded');
        return;
    }
    $(selector).summernote({
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link', 'picture', 'video']],
            ['view', ['fullscreen', 'codeview', 'help']]
        ],
        height: height,
    })
}

const deleteData = function (title, route, id) {
    Swal.fire({
        title: "Are you sure?",
        text: "You want to delete " + title,
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, Delete it!"
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: 'POST',
                url: route,
                data: {
                    _token: APP_TOKEN,
                    id: id,
                },
                success: function (response) {
                    Swal.fire({
                        title: "Success",
                        text: title + " Deleted",
                        icon: "success"
                    }).then((result) => {
                        // Check if the user clicked "OK"
                        if (result.isConfirmed) {
                            // Reload the page
                            location.reload();
                        }
                    });
                },
                error: function (error) {
                    console.error(error);
                }
            });
        }
    });
};
const approveData = function (title, route, id) {
    Swal.fire({
        title: "Are you sure?",
        text: "You want to approve " + title,
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, Approve It!"
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: 'POST',
                url: route,
                data: {
                    _token: APP_TOKEN,
                    id: id,
                },
                success: function (response) {
                    Swal.fire({
                        title: "Success",
                        text: title + " Approved",
                        icon: "success"
                    }).then((result) => {
                        // Check if the user clicked "OK"
                        if (result.isConfirmed) {
                            // Reload the page
                            location.reload();
                        }
                    });
                },
                error: function (error) {
                    console.error(error);
                }
            });
        }
    });
};

const approveMultipleData = function (title, route, approval) {
    var selectedLanguage = new Array();
    var rejectNote = new Array();
    if (approval == "reject" || approval == "query") {
        $('input[name="ids"]:checked').each(function () {
            selectedLanguage.push(this.value);
            rejectNote.push($('.' + this.value + '_comment').val());
            console.log($('.' + this.value + '_comment').val());
        });
    } else {
        $('input[name="ids"]:checked').each(function () {
            selectedLanguage.push(this.value);
        });
    }
    if (selectedLanguage.length > 0) {
        Swal.fire({
            title: "Are you sure?",
            text: "You want to " + approval + " " + title,
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes!"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'POST',
                    url: route,
                    data: {
                        _token: APP_TOKEN,
                        id: selectedLanguage,
                        rejection_comment: rejectNote,
                        approval: approval,
                    },
                    success: function (response) {
                        Swal.fire({
                            title: "Success",
                            text: title + " Approved",
                            icon: "success"
                        }).then((result) => {
                            // Check if the user clicked "OK"
                            if (result.isConfirmed) {
                                // Reload the page
                                location.reload();
                            }
                        });
                    },
                    error: function (error) {
                        console.error(error);
                    }
                });
            }
        });
    } else {
        toastr.error('Select Voucher First!');
    }
};
// Check when the page is loaded
document.addEventListener("DOMContentLoaded", function () {
    // Find all nav links that have the "active" class
    const activeLinks = document.querySelectorAll('.nav-link.active');

    // Iterate over each active link
    activeLinks.forEach(function (link) {
        let parentCollapse = link.closest('.collapse'); // Find the closest collapse parent

        // Loop through each parent collapse to open them all if necessary
        while (parentCollapse) {
            // Trigger the collapse to open
            const bootstrapCollapse = new bootstrap.Collapse(parentCollapse, {
                toggle: true
            });
            // Move to the next level up in the hierarchy
            parentCollapse = parentCollapse.closest('.collapse');
        }
    });
});

const approveMultipleStatusData = function (title, route, approval) {
    var selectedLanguage = new Array();
    var rejectNote = new Array();
    if (approval == "reject" || approval == "query") {
        $('input[name="ids"]:checked').each(function () {
            selectedLanguage.push(this.value);
            rejectNote.push($('.' + this.value + '_comment').val());
            console.log($('.' + this.value + '_comment').val());
        });
    } else {
        $('input[name="ids"]:checked').each(function () {
            selectedLanguage.push(this.value);
        });
    }
    if (selectedLanguage.length > 0) {
        Swal.fire({
            title: "Are you sure?",
            text: "You want to " + approval + " " + title,
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3852cd",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes!"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'POST',
                    url: route,
                    data: {
                        _token: APP_TOKEN,
                        id: selectedLanguage,
                        rejection_comment: rejectNote,
                        approval: approval,
                    },
                    success: function (response) {
                        Swal.fire({
                            title: "Success",
                            text: title + " Approved",
                            icon: "success"
                        }).then((result) => {
                            // Check if the user clicked "OK"
                            if (result.isConfirmed) {
                                // Reload the page
                                location.reload();
                            }
                        });
                    },
                    error: function (error) {
                        console.error(error);
                    }
                });
            }
        });
    } else {
        toastr.error('Select Minimum One Items First!');
    }
};
