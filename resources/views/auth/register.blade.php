<div class="modal fade" id="registration-modal" tabindex="-1" role="dialog" aria-labelledby="modalLoginForm">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header auth-modal-header">
        <h4 class="modal-title">Signup to create your Edutube account</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="edutube-register-form" class="form-wrapper sign-in-wrap">
            {!! Form::open(['route' => 'register', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'POST'] ) !!}

                {{ csrf_field() }}

                <div class="form-group">
                <label class="input-label"> Full Name: </label>
                 <div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1">@</span>
  </div>
  <input type="text" class="form-control" placeholder="Username" name="name">
</div>
                </div>

                <div class="form-group">
                <label class="input-label"> Email: </label>
                <div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1">@</span>
  </div>
  <input type="text" class="form-control" placeholder="Email" name="email">
</div>
                </div>

                <div class="form-group">
                  <label for="user_remember_me">
                    <%= f.check_box :remember_me %>
                    Remember Me
                  </label>
                </div>

                <div class="form-group">
                  <%= f.submit 'Log In', class: 'btn-yellow' %>

                  <input type="button" class="btn-black btn-cancel" name="cancel" value="Cancel" data-dismiss="modal">
                </div>
                <div class="form-group others-link">
                  <a href="#forgot-password-form" class="toggle-links link-forgot-password" title="Forgot Password">
                    Lost Your Password?
                  </a>
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
    //$(function () {
      //  $('.toggle-links').click(function () {
        //    target = $(this).attr('href');
          //  $(this).parents('.form-wrapper').addClass('hidden');
          //  $(target).removeClass('hidden');
          //  return false;
        //});
    //});
</script>
