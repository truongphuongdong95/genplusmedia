(function ($) {
  "use strict";
  var plupload_attachment;

  var toggleMenuMobile = function () {
    $(".nav-mobile-button").on("click", function () {
      $(".main-navigation-mobile").toggleClass("expand");
    });
  };

  var handleModalPopup = function () {
    var modal = $(".modal");
    var btn = $(
      ".site-header .site-branding-container .site-branding .main-navigation .btn-apply-now, .site-header .main-navigation-mobile .btn-apply-now, .article-container .btn-apply"
    );
    var span = $(".close, .btn-close");

    btn.on("click", function () {
      modal.fadeIn(300);
      uploadFileAttachments();
      validateSaveCandidateForm();
      handleSaveCandidateAjax();
    });

    span.on("click", function () {
      modal.fadeOut(300);
    });

    $(window).on("click", function (e) {
      if ($(e.target).is(".modal")) {
        modal.fadeOut(300);
      }
    });
  };

  var uploadFileAttachments = function () {
    /* initialize plupload */
    plupload_attachment = new plupload.Uploader({
      browse_button: "choose_attachment_files",
      file_data_name: "file_attachments_name",
      container: "attachment_plupload_container",
      drop_element: "attachment_plupload_container",
      multi_selection: false,
      url: variables.ajax_url_upload_file,
      filters: {
        mime_types: [
          {
            title: variables.file_type_title,
            extensions: variables.attachment_file_type,
          },
        ],
        max_file_size: variables.attachment_max_file_size,
        prevent_duplicates: true,
      },
    });

    plupload_attachment.init();

    plupload_attachment.bind("FilesAdded", function (up, files) {
      var candidateAttachment = "";
      var maxFiles = variables.max_candidate_attachments;
      var totalFiles = up.files.length;
      if (totalFiles > maxFiles) {
        alert("Only upload max " + maxFiles + " file(s)");
        return;
      }
      plupload.each(files, function (file) {
        candidateAttachment +=
          '<div id="file-' + file.id + '" class="file-attachment-wrap"></div>';
      });
      document.getElementById("attachment_plupload_container").innerHTML +=
        candidateAttachment;
      up.refresh();
      up.start();
    });

    plupload_attachment.bind("UploadProgress", function (up, file) {
      document.getElementById("file-" + file.id).innerHTML =
        '<span class="loader"></span>';
    });

    plupload_attachment.bind("Error", function (up, err) {
      document.getElementById("attachment_errors").innerHTML +=
        "<br/>" + "Error #" + err.code + ": " + err.message;
    });

    plupload_attachment.bind(
      "FileUploaded",
      function (up, file, ajax_response) {
        var response = $.parseJSON(ajax_response.response);
        var fileType = response.file_name.split(".");
        var thumbUrl =
          variables.theme_url +
          "/assets/images/attachment/attach-" +
          fileType[1] +
          ".png";
        if (response.success) {
          var $html =
            '<div class="file-attachment-wrap __thumb">' +
            '<figure class="attachment-file">' +
            '<img loading="lazy" src="' +
            thumbUrl +
            '"/>' +
            '<a href="' +
            response.url +
            '">' +
            response.file_name +
            "</a>" +
            "</figure>" +
            "</div>";
          document.getElementById("file-" + file.id).innerHTML = $html;
          document.getElementById("attachment_id").value =
            response.attachment_id;
        }
      }
    );
  };

  var handleSaveCandidateAjax = function () {
    $(".btn-submit").on("click", function (event) {
      event.preventDefault();
      var form = $("#apply-form");
      var formData = form.serialize();
      if (form.valid()) {
        $.ajax({
          type: "POST",
          url: variables.ajax_url,
          datatype: "JSON",
          data:
            formData +
            "&action=handle_save_candidate&nonce=" +
            variables.save_candidate_nonce,
          beforeSend: function () {
            form
              .find(".message")
              .empty()
              .append('<span class="loader"></span>');
          },
          success: function (res) {
            if (res.status) {
              $(".modal-wrapper")
                .empty()
                .append(
                  '<h2 class="heading">Bạn đã ứng tuyển thành công!</h2>'
                );
              setTimeout(() => {
                window.location.reload();
              }, 1000);
            } else {
              form
                .find(".message")
                .empty()
                .append('<div class="error">' + res.message + "</div>");
            }
          },
          error: function (error) {
            console.log(error);
          },
        });
        form.find(".message").empty();
      } else {
        form.find(".message").empty().append('<div class="error">Error!</div>');
      }
      return false;
    });
  };

  var validateSaveCandidateForm = function () {
    var formParent = $("#apply-form");
    formParent.validate({
      ignore: ":hidden:not(.do-not-ignore)", // any children of hidden desc are ignored
      errorElement: "div", // wrap error elements in span not label
      invalidHandler: function (event, validator) {
        // add aria-invalid to el with error
        $.each(validator.errorList, function (idx, item) {
          if (idx === 0) {
            $(item.element).focus(); // send focus to first el with error
          }
          $(item.element).attr("aria-invalid", true); // add invalid aria
          $(item.element).addClass("is-invalid");
        });
      },
      highlight: function (element, errorClass, validClass) {
        var elem = $(element);
        elem.addClass(errorClass).removeClass(validClass);
        elem.addClass("is-invalid").removeClass("is-valid");
      },
      unhighlight: function (element, errorClass, validClass) {
        var elem = $(element);
        elem.removeClass(errorClass).addClass(validClass);
        elem.removeClass("is-invalid").addClass("is-valid");
      },
      rules: {
        full_name: {
          required: true,
        },
        email: {
          required: true,
          email: true,
        },
        phone: {
          required: true,
          number: true,
        },
        position: {
          min: 1,
        },
        attachment_id: {
          required: true,
        },
      },
      messages: {
        full_name: "Trường này là bắt buộc",
        email: "Trường này là bắt buộc",
        phone: "Trường này là bắt buộc",
        position: "Trường này là bắt buộc",
        attachment_id: "Trường này là bắt buộc",
      },
      submitHandler: function (form) {
        form.submit();
      },
    });
  };

  var handleBackToTop = function () { 
    $(window).scroll(function () {
      if ($(this).scrollTop()) {
        $(".back-to-top").fadeIn(500);
      } else {
        $(".back-to-top").fadeOut(500);
      }
    });
  
    $(".back-to-top").click(function () {
      $("html, body").animate({ scrollTop: 0 }, 300);
    });
  }

  $(document).ready(function () {
    $(".preloader").fadeOut(100, function () {
      $("body").fadeIn(100);
    });
    handleBackToTop();
    toggleMenuMobile();
    handleModalPopup();
  });
})(jQuery);
