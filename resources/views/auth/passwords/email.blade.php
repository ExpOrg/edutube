<div class="modal fade" id="forgot-password-modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header auth-modal-header">
        <h4 class="modal-title">Password assistance</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="edutube-forgot-password-form" class="form-wrapper sign-in-wrap">
            {!! Form::open(['route' => 'login', 'class' => 'form-horizontal edutube-auth-form', 'role' => 'form', 'method' => 'POST'] ) !!}

                {{ csrf_field() }}
                <p style="line-height: 20px;"> 
                  Insert the email address associated to your Edutube account 
                </p>
                <div class="form-group">
                 <label class="input-label"> Email: </label>
                 <div class="group-input">
                  <span class='input-icon'> <i class='fa fa-envelope-o'></i></span>
                  <input type="email" class="input-inner" name="email">
                  </div>
                </div>            

                <input type="submit" class="btn btn-block primary-btn btn-size-2x" name="submit" value="Submit">

            {!! Form::close() !!}
          </div>
      </div>
      <div class="modal-footer auth-modal-footer">
        <div class="forgot-password-hints">
        Has you email address changed? If you no longer use the email address associated with your Edutube account, you may contact <a href='#'> Customer Service </a> for help restoring access to your account.
        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
    $(function () {
       $('#forgot-password-modal').on('show.bs.modal', function (e) {
         $('#login-modal').modal('hide');
       });
    });
</script>
