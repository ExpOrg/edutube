$(function() {
  $('form.edutube-auth-form').submit(function(e) {
     e.preventDefault();
     form = $(this);
     $.ajax({
      url: form.attr('action'),
      type: 'post',
      dataType: 'JSON',
      data: getFormData(form),
      beforeSend: function() {
       $('.validation-error').remove();
      },
      success: function(response) {
        if(response.success) {
          window.location.href = response.intended;
        }
        else {
          if(response.errors) {
            errors = response.errors;
            for(var key in errors) {
             formatErrorMessage(form,  key, errors[key]); 
            }
          }
          else {
            alert(response.message);
          }
        }
      },
      error: function(e) {
        console.log(e.responseText);
      }
     });
  });
});

function getFormData(form) {
    var formData = {};
    var params = form.serializeArray();
    console.log(params);
    $.each(params, function (i, val) {
      console.log(val.name)
      formData[val.name] = val.value;
    });
    console.log(formData);
    return formData;
}

function formatErrorMessage(form, field, msg) {
  message = "<span class='validation-error'>" + msg + "</span>";
  form.find("input[name='" + field + "']").parent().after(message); 
}