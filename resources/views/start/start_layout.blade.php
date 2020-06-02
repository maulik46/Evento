<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>@yield('title') | Evento</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('assets/images/favicon.ico')}}">
    <link href="{{asset('assets/css/demopage.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/app.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/my-extra.css')}}" rel="stylesheet" type="text/css" />
    <style>
        body {
            background: #AAFFA9;
            background: -webkit-linear-gradient(to right, #11FFBD, #AAFFA9);
            background: linear-gradient(to right, #11FFBD, #AAFFA9);
        }

        ::placeholder {
            color: #000 !important;
        }
        .participate:hover span{
            color: var(--success)!important;
        }
        .dropdown-menu{
            min-width:0px!important;
            background-color:transparent!important;
        }
        .dropdown-menu.show {
            top: 100%!important;
            display: flex;
            left:5px!important;
        }
        a.login-btn{
            color: var(--danger);
        }
        a.login-btn:hover{
            color: #ec3b56;
        }
        @media(max-width:567px)
        {
            nav{
                background-color:#fff!important;
                box-shadow: 0 3px 6px -5px #777;
            }
            a.login-btn{
                background-color:var(--success)!important;
                color:#fff!important;
            }
            a.login-btn:hover{
                color:#ffffffc9!important;
            }
        }
    </style>
    @section('head-tag-links')
    
    @show
</head>

<body class="body-scroll">

    <main>
        <nav class="row justify-content-between align-items-center position-fixed" style="z-index: 999;width: 103%;top:0px;left:0px;">
            <a href="{{url('/')}}" class="mt-1 mt-sm-3 mx-4 mx-sm-4 navbar-brand  font-size-24 font-weight-bold text-dark">
                <img src="{{asset('assets/images/logo.png')}}" alt="" class="logo-dark" height="24" /> <span
                    class="text-dark">Evento</span>
            </a>
            <div class="btn-group">
                <a href="#"
                    class="login-btn bg-white btn badge-pill py-1 font-weight-bold font-size-15 mt-1 mt-sm-3 mx-2 mx-sm-5 dropdown-toggle pl-3 pr-2 new-shadow-sm"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Log in
                    <i data-feather="chevron-down" height="18px"></i>
                </a>
                <div class=" shadow-none dropdown-menu dropdown-menu-right mt-2 rounded-lg  flex-column align-items-center justify-content-center">
                <a class="text-red badge badge-pill bg-white my-1 p-2 new-shadow-2 hover-me-sm" href="{{url('index')}}" data-toggle="tooltip" data-placement="left" title="I'm Student">
                    <img src="{{asset('assets/images/svg-icons/student.svg')}}" height="30px" alt="">
                    <!-- I'm Student -->
                </a>
                <a class="text-blue badge badge-pill bg-white my-1 p-2 new-shadow-2 hover-me-sm" href="{{url('cindex')}}" data-toggle="tooltip" data-placement="left" title="I'm Co-ordinator">
                    <img src="{{asset('assets/images/svg-icons/cod.svg')}}" height="33px" alt="">
                    <!-- I'm Co-ordinator -->
                </a>
                <a class=" text-orange badge badge-pill bg-white my-1 p-2 new-shadow-2 hover-me-sm" href="{{url('sindex')}}" data-toggle="tooltip" data-placement="left" title="I'm Admin">
                    <img src="{{asset('assets/images/svg-icons/admin.svg')}}" height="30px" alt="">
                    <!-- I'm Admin -->
                </a>
                
            </div>
            </div>
        </nav>

        <div>
            <ul class="circles" style="z-index: -10;">
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
            </ul>
        </div>

        <div class="container position-relative" style="top:80px;left:0px;">
            @yield('my-content')
        </div>
        
    </main>
    <!-- Vendor js -->
    <script src="{{asset('assets/js/vendor.min.js')}}"></script>
    <!-- App js -->
    <script src="{{asset('assets/js/app.min.js')}}"></script>
    
    @section('extra-scripts')

    @show
</body>

</html>