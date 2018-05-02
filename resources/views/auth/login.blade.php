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
        <div id="edutube-register-form" class="form-wrapper sign-in-wrap">
            {!! Form::open(['route' => 'login', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'POST'] ) !!}

                {{ csrf_field() }}

                <div class="form-group">
                 <label class="input-label"> Email: </label>
                 <div class="group-input">
                  <span class='input-icon'> <i class='fa fa-user-o'></i></span>
                  <input type="email" class="input-inner" name="email">
                  </div>
                </div>

                <div class="form-group">
                 <label class="input-label"> 
                   Password: 
                   <span style='font-weight: normal;' class='hints pull-right'> Forgot password? </span>
                 </label>
                 <div class="group-input">
                  <span class='input-icon'> <i class='fa fa-lock'></i></span>
                  <input type="password" class="input-inner" name="password">
                  </div>
                </div>             

                <input type="submit" class="btn btn-block primary-btn" name="submit" value="Sign up">

                <div style="margin-top: 5px;">
                  <label for="remember-me">
                    <input type="checkbox" id='remember-me' name='remember_me' value='1'> 
                    <span class='hints'> Keep me signed in. </span> 
                  </label>
                </div>

                <div class='or-text'>
                </div>

                <div class="form-group">
                  <a href="#" class="btn btn-block facebook-btn">
                    <i class="fa fa-facebook-f icon"></i> Sign in with Facebook
                  </a>
                </div>

                <div class="form-groupx">
                  <a href="#" class="btn btn-block google-btn">
                    <i class="fa fa-google icon"></i> Sign in with Google
                  </a>
                </div>

            {!! Form::close() !!}
          </div>
      </div>
      <div class="modal-footer auth-modal-footer">
        Don not have an account? <a href="#"> Sign up </a>
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
