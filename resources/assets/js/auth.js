$(function() {
  $('form.edutube-auth-form').submit(function(e) {
     e.preventDefault();
     form = $(this);
     $.ajax({
      url: form.attr('action'),
      type: 'post',
      dataType: 'JSON',
      data: getFormData(form),
      success: function(response) {
        if(response.auth) {
          alert("Success");
        }
        else {
          alert("Invalid email or password");
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