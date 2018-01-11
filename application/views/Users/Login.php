<!-- Modal Login -->
          <div class="modal fade login" id="loginModal">
            <div class="modal-dialog login animated">
              <div class="modal-content">
               <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Login with</h4>
              </div>
              <div class="modal-body">  
                <div class="box">
                 <div class="content">
                  <div class="social">
                    <a class="circle github" href="/auth/github">
                      <i class="fa fa-github fa-fw"></i>
                    </a>
                    <a id="google_login" class="circle google" href="/auth/google_oauth2">
                      <i class="fa fa-google-plus fa-fw"></i>
                    </a>
                    <a id="facebook_login" class="circle facebook" href="/auth/facebook">
                      <i class="fa fa-facebook fa-fw"></i>
                    </a>
                  </div>
                  <div class="division">
                    <div class="line l"></div>
                    <span>or</span>
                    <div class="line r"></div>
                  </div>
                  <div class="error"></div>
                  <div class="form loginBox">
                    <form method="post" action="<?php echo base_url();?>Users/Login" accept-charset="UTF-8">
                      <input id="username" class="form-control" type="text" placeholder="Username" name="username" required="">
                      <input id="password" class="form-control" type="password" placeholder="Password" name="password" required="">
                      <button class="btn-login" type="submit">Login</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <div class="forgot login-footer">
                <span>Looking to 
                  <a href="#" data-toggle="modal" data-target="#registerModal">create an account</a>?</span>
                </div>
              </div>        
            </div>
          </div>
        </div>
        <!-- Modal Register -->
        <div class="modal fade login" id="registerModal">
          <div class="modal-dialog login animated">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Register</h4>
              </div>
              <div class="modal-body">  
                <div class="box">
                  <div class="content registerBox">
                    <div class="social">
                      <a class="circle github" href="/auth/github">
                        <i class="fa fa-github fa-fw"></i>
                      </a>
                      <a id="google_login" class="circle google" href="/auth/google_oauth2">
                        <i class="fa fa-google-plus fa-fw"></i>
                      </a>
                      <a id="facebook_login" class="circle facebook" href="/auth/facebook">
                        <i class="fa fa-facebook fa-fw"></i>
                      </a>
                    </div>
                    <div class="division">
                      <div class="line l"></div>
                      <span>or</span>
                      <div class="line r"></div>
                    </div>
                    <div class="error"></div>
                    <div class="form">
                      <form method="post" action="<?php echo base_url();?>Users/Register" accept-charset="UTF-8">
                        <input class="form-control" type="text" placeholder="Email" name="username" required="">
                        <input id="password" class="form-control" type="password" placeholder="Password" name="password" required="">
                        <input id="password_confirmation" class="form-control" type="password" placeholder="Repeat Password" name="password_confirmation" required="">
                        <button class="btn-register" type="submit">Register</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
               <div class="forgot register-footer">
                 <span>Already have an account?</span>
                 <a href="#" data-toggle="modal" data-target="#loginModal #registerModal">Login</a>
               </div>
             </div>        
           </div>
         </div>
       </div>
       