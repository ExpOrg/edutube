<div class="modal fade" id="reset-password-modal" tabindex="-1" role="dialog" aria-labelledby="modalLoginForm">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header auth-modal-header">
        <h4 class="modal-title">Reset password</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="edutube-reset-password-form" class="form-wrapper sign-in-wrap">
            {!! Form::open(['route' => 'login', 'class' => 'form-horizontal edutube-auth-form', 'role' => 'form', 'method' => 'POST'] ) !!}

                {{ csrf_field() }}

                <div class="form-group">
                 <label class="input-label"> 
                   New Password:
                 </label>
                 <div class="group-input">
                  <span class='input-icon'> <i class='fa fa-lock'></i></span>
                  <input type="password" class="input-inner" name="password">
                  </div>
                </div>

                <div class="form-group">
                 <label class="input-label"> 
                   Confirm Password:
                 </label>
                 <div class="group-input">
                  <span class='input-icon'> <i class='fa fa-lock'></i></span>
                  <input type="password" class="input-inner" name="confirm_password">
                  </div>
                </div>             

                <input type="submit" class="btn btn-block primary-btn" name="submit" value="Submit">

            {!! Form::close() !!}
          </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
    
</script>
