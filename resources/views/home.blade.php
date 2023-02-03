@extends('layouts.master')
@section('content')

<div class="container-fluid">
<script type="text/javascript" src="js/md5.js"></script>
        <script type="text/javascript">
                        function doLogin() {
                                        <?php if(strlen($chapid) < 1) echo "return true;\n"; ?>
                                        document.sendin.username.value = document.login.username.value;
                                        document.sendin.password.value = hexMD5('\011\373\054\364\002\233\266\263\270\373\173\323\234\313\365\337\356');
                                        document.sendin.submit();
                                        return false;
                        }
        </script>
        <script type="text/javascript">
                function formAutoSubmit () {
                        var frm = document.getElementById("login");
                        document.getElementById("login").submit();
                        frm.submit();
        }
        window.onload = formAutoSubmit;
        </script>

        <form id="login" method="post" action="<?php echo $linkloginonly; ?>" onSubmit="return doLogin()">
            <input name="dst" type="hidden" value="<?php echo $linkorig; ?>" />
            <input name="popup" type="hidden" value="false" />
            <input name="username" type="hidden" value="<?php echo $username; ?>"/>
            <input name="password" type="hidden" value="admin"/>
        </form>

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h7 class="h3 mb-0 text-gray-800">Selamat Datang</h7>
       <!--<a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>-->
    </div>

    <!-- Content Row -->
    <div class="row">
    
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">IP Address
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                  @if ($currentUserInfo)
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"> {{ $currentUserInfo->ip }} </div>
                                </div>
                                <div class="col-auto">
                                  <i class="fa fa-address-card-o  fa-2x text-black-300" aria-hidden="true"></i>
                                </div>
                               @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        

        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Location Now
                                </div>
                                 @if($currentUserInfo)
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $currentUserInfo->countryName }}, {{ $currentUserInfo->regionName }}</div>
                              <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $currentUserInfo->cityName }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fa fa-map-marker  fa-2x text-black-300" aria-hidden="true"></i>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

            

    </div>
    

    <!-- Content Row -->

   

    <!-- Content Row -->
    <div class="row">

        <!-- Content Column -->
    {{-- <div class="col-lg-6 mb-4">
            <div class="card-header">{{ __('KODE OTP HOTSPOT') }}</div>

           
            <a href = "http://hotspot.thamrinlab.my.id/subscription" class=" btn btn-sm btn-primary">Dapatkan User dan Pass</a>
         

        <table class=" table table-striped">
             <thead> 
               <tr>
                    <th> Username </th>
                    <th> Password </th>
                    <th> Status </th>
               </tr>
             </thead>
               <tbody>
                    @forelse ($subs as $sub)
                    <tr>
                        <td> {{ $sub->username }} </td>
                        <td> {{ $sub->password }}</td>                    
                        @if($sub->status ==1)
                             <td><a href="#" class=" btn btn-sm btn-success">Sedang Aktif</a></td>                  
                        @else
                             <td><a href="#" class=" btn btn-sm btn-danger">Kadaluarsa</a></td>                     
                        @endif
                    </tr>  
                     @empty

                    @endforelse    
               </tbody>
         </table> 
                    <a href = "http://hot.thamrin.xyz/login" target="iframe_a" class=" btn btn-sm btn-primary">Connect ke Hotspot Wifi</a>
        
    </div>    --}}
                
           
        
    
</div>
@endsection
