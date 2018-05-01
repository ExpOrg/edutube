<div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="modalLoginForm">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header auth-modal-header">
        <h4 class="modal-title">Signin to your Edutube account</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="edutube-login-form" class="form-wrapper sign-in-wrap">
            {!! Form::open(['route' => 'login', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'POST'] ) !!}

                {{ csrf_field() }}

                <div class="form-group">
                <label class="input-label"> Email: </label>
                 <div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1">@</span>
  </div>
  <input type="text" class="form-control" placeholder="Username" name="name">
</div>
                </div>

                <div class="form-group">
                <label class="input-label"> Password: </label>
                <div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1">@</span>
  </div>
  <input type="text" class="form-control" placeholder="Username" name="name">
</div>
                </div>

                <div class="form-group">
                  <label for="user_remember_me">
                    <input type="checkbox"> Remember me. 
                  </label>
                </div>

                <div class="form-group">
                  <input type="submit" class="btn btn-black btn-block btn-warning" value="SignIn">
                </div>
            {!! Form::close() !!}
          </div>
      </div>
      <div class="modal-footer auth-modal-footer">
        Don't have an account? <a href="#"> Sign up </a>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
    $(function () {
       $('#edutube-login-form').submit(function(e) {
         e.preventDefault();
         $.ajax({
          url: '/login',
          type: 'post',
          dataType: 'JSON',
          data: {email: 'nazrulku07@gmail.com', Password: '1234', _token: '{{csrf_token()}}'},
          success: function(response) {
            console.log(response);
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
         })
       });
    });
</script>
