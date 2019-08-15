<br>
  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Profile</h3>
    </div>
      {{Auth::user()}}
  </div>
</div> --}}
<section class="content">
  <div class="row">
     <div class="col-md-6">
       <div class="box box-primary">
         <div class="box-header with-border">
            <h3 class="box-title">User Profile</h3>
          </div>
          <div class="box-body">
           <div class="row">
             <div class="col-md-6">
               <div class="form-group">
                 <label>User ID</label><br>
                 <span>{{Auth::user()->idusers}}</span>
              </div>
              <div class="form-group">
                <label>User Name</label><br>
                <span>{{Auth::user()->name}}</span>
             </div>
             <div class="form-group">
               <label>User Email</label><br>
               <span>{{Auth::user()->email}}</span>
            </div>
             </div>
           </div>
         </div>
       </div>
     </div>
  </div>
</section>
