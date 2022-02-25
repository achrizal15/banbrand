@extends('template.blank')
@section('content')
<div class="login-box">
   <div class="login-logo">
     <a href="../../index2.html"><b>Banbrand</b></a>
   </div>
   <!-- /.login-logo -->
   <div class="card">
     <div class="card-body login-card-body">
       <p class="login-box-msg">Sign in to start your session</p>
 
       <form action="../../index3.html" method="post">
         <div class="input-group mb-3">
           <input type="email" class="form-control" placeholder="Email">
           <div class="input-group-append">
             <div class="input-group-text">
               <span class="fas fa-envelope"></span>
             </div>
           </div>
         </div>
         <div class="input-group mb-3">
           <input type="password" class="form-control" placeholder="Password">
           <div class="input-group-append">
             <div class="input-group-text">
               <span class="fas fa-lock"></span>
             </div>
           </div>
         </div>
         <div class="row justify-content-end">
           <!-- /.col -->
           <div class="col-4 ">
             <button type="submit" class="btn btn-primary btn-block">Sign In</button>
           </div>
           <!-- /.col -->
         </div>
       </form>

       {{-- <p class="mb-1">
         <a href="forgot-password.html">I forgot my password</a>
       </p> --}}
       <p class="mb-0">
         <a href="{{ route("register","sellers") }}" class="text-center">Register</a>
       </p>
     </div>
     <!-- /.login-card-body -->
   </div>
 </div>
@endsection
