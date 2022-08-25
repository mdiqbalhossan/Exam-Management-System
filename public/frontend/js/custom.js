$(document).ready(function() {
  // Preloader

  $(window).on("load", function() {
    $(".loadding-page").delay(1000).fadeOut(100);
    $(".cssload-box-loading").on("click", function() {
      $(".cssload-box-loading").fadeOut(100);
    });
  });

  // show Toast message function
  function showToast(heading, text, type) {
    $.toast({
      heading: heading,
      text: text,
      showHideTransition: "slide",
      icon: type,
      position: "top-right",
      hideAfter: 5000
    });
  }

  // Function Dialog Message Function
  function dialog(icon, title) {
    Swal.fire({
      position: "top-end",
      icon: icon,
      title: title,
      showConfirmButton: false,
      timer: 3000
    });
  }

  // User Register By Ajax Request
  $("#register_btn").click(function(e) {
    if ($("#register_form")[0].checkValidity()) {
      e.preventDefault();
      $("#register_btn").text("Please Wait...");
      if (
        $("#name").val() == "" &&
        $("#clg_name").val() == "" &&
        $("#contact_number").val() == "" &&
        $("#payment_number").val() == "" &&
        $("#batch_name").val() == "" &&
        $("#group_name").val() == ""
      ) {
        showToast(
          "Warning",
          "Every field must be required. Please don't anyone field empty",
          "warning"
        );
      } else {
        $.ajax({
          type: "POST",
          url: "../lib/action.php",
          data: $("#register_form").serialize() + "&action=register",
          success: function(response) {
            if (response == "user_exists") {
              $("#register_btn").text("Register");
              $("#error_alert").show();
              $("#error_msg").text("User Already Exists");
            } else if (response == "failed") {
              $("#register_btn").text("Register");
              $("#error_alert").show();
              $("#error_msg").text("Something went wrong");
            } else if (response == "register") {
              $("#register_btn").text("Register");
              $("#registration_form")[0].reset();
              showToast(
                "Success",
                "Registration Succsfully. Please wait a moment we will redirect you in dashboard",
                "success"
              );
              setTimeout(() => {
                window.location = "dashboard.php";
              }, 1000);
            }
          }
        });
      }
    }
  });

  // Member login ajax request

  $("#login_btn").click(function(e) {
    e.preventDefault();
    $("#login_btn").val("Please Wait...");
    if ($("#username").val() == "") {
      showToast(
        "Warning",
        "Username Or Password field doesn't empty",
        "warning"
      );
    } else {
      $.ajax({
        type: "POST",
        url: "lib/action.php",
        data: $("#login_form").serialize() + "&action=login",
        success: function(response) {
          if (response == "login") {
            $("#login_btn").val("Login");
            $("#login_form")[0].reset();
            $("#LoginModal").modal("hide");
            showToast(
              "Success",
              "Login Successfully. Please wait a second we will redirect you in dashboard",
              "success"
            );
            setTimeout(function() {
              window.location = "dashboard.php";
            }, 1000);
          } else if (response == "password_not_matched") {
            $("#login_btn").val("Login");
            $("#login_form")[0].reset();
            showToast(
              "Error",
              "Password didn't matched in your email. Please try again",
              "error"
            );
          } else if (response == "data_not_found") {
            $("#login_btn").val("Login");
            $("#login_form")[0].reset();
            showToast(
              "Error",
              "We didn't find your username in our database. Please try again",
              "error"
            );
          }
        }
      });
    }
  });

  // Member logout Ajax Request
  $("#logout").click(function(e) {
    e.preventDefault();
    $.ajax({
      type: "POST",
      url: "lib/action.php",
      data: {
        action: "logout"
      },
      success: function(response) {
        if (response == "logout") {
          window.location = "index.php";
        }
      }
    });
  });

  // Enroll Ajax Request
  $("#submit-enroll-btn").click(function(e) {
    e.preventDefault();
    $("#submit-enroll-btn").val("Please Wait...");
    if (
      $("#mobile").val() == "" ||
      $("#tr_id").val() == "" ||
      $("#user_id").val() == ""
    ) {
      showToast("Warning", "Every field must be required..!", "warning");
      $("#submit-enroll-btn").val("Submit");
    } else {
      $.ajax({
        type: "POST",
        url: "lib/action.php",
        data: $("#enroll-submit-form").serialize() + "&action=enroll_submit",
        success: function(response) {
          if (response == "not_found") {
            showToast(
              "Error",
              "User id is Wrong. Please type input correct user id",
              "error"
            );
          } else {
            $("#submit-enroll-btn").val("Submit");
            $("#enroll-submit-form")[0].reset();
            $("#EnrollModal1").modal("hide");
            showToast(
              "Success",
              "Exam batch Enrolled Success. Please wait our admin approve.",
              "success"
            );
          }
        }
      });
    }
  });

  // View Details Modal
  $("body").on("click", ".viewDetails", function(e) {
    e.preventDefault();
    id = $(this).attr("id");
    $.ajax({
      type: "POSt",
      url: "lib/action.php",
      data: {
        action: "viewDetails",
        id: id
      },
      success: function(response) {
        data = JSON.parse(response);
        $("#details_title").text(data.cat_name);
        $("#details_body").html(data.description);
        console.log(data);
      }
    });
  });

  // View Details Modal
  $("body").on("click", ".viewSyllabus", function(e) {
    e.preventDefault();
    id = $(this).attr("id");
    $.ajax({
      type: "POSt",
      url: "lib/action.php",
      data: {
        action: "viewDetails",
        id: id
      },
      success: function(response) {
        data = JSON.parse(response);
        $("#syllabus_title").text(data.cat_name);
        $("#syllabus_body").attr("src", "assets/img/" + data.syllabus);
        console.log(data);
      }
    });
  });

  //Add Free Exam Data
  $("#start_exam").click(function(e) {
    e.preventDefault();
    if (
      $("#name").val() == "" &&
      $("#clg_name").val() == "" &&
      $("#phone").val() == ""
    ) {
      dialog("error", "Every Field Must Be required. Please Fill all Field");
    } else {
      $.ajax({
        type: "POST",
        url: "lib/action.php",
        data: $("#add_free_exam_form").serialize() + "&action=add_free_exam",
        success: function(response) {
          if (response == "added") {
            window.location = "exam.php";
          } else {
            dialog("error", response);
          }
        }
      });
    }
  });

  // Question Submit
  $("#question_submit_btn").click(function(e) {
    e.preventDefault();
    $.ajax({
      type: "POST",
      url: "lib/action.php",
      data: $("#question_form").serialize() + "&action=submit_question",
      success: function(response) {
        dialog(
          "success",
          "ধন্যবাদ। রাত১০ টায় ওয়েবসাইট এ রেজাল্ট প্রকাশ করা হবে।"
        );

        setTimeout(() => {
          window.location = "index.php";
        }, 3000);

        console.log(response);
      }
    });
  });

  // Result Search Btn
  // $("#result_search_btn").click(function(e) {
  //   e.preventDefault();
  //   var number = $("#number").val();
  //   $.ajax({
  //     type: "POST",
  //     url: "lib/action.php",
  //     data: { number: number, action: "result_search" },
  //     success: function(response) {
  //       $("#result_body").html(response);
  //       console.log(response);
  //     }
  //   });
  // });

  // Result Search Btn
  // $("body").on("click", ".viewResult", function(e) {
  //   e.preventDefault();
  //   var id = $(this).attr("data-id");
  //   $.ajax({
  //     type: "POST",
  //     url: "lib/action.php",
  //     data: { id: id, action: "result_search" },
  //     success: function(response) {
  //       window.location = "result.php";
  //       $("#result_body").html(response);
  //     }
  //   });
  //   console.log(id);
  // });
  /************ END ***********/
});
