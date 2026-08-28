<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>@yield('title', $content->com_name ?? 'Admin Panel') | {{ $content->com_name ?? 'Used Furniture Qatar' }}</title>
        <link rel="icon" type="image/png" href="{{ !empty($content->favicon) ? asset($content->favicon) : asset('images/no.png') }}" />
        <link href="{{ asset('css/style.css') }}" rel="stylesheet" />
        <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />

        <link href="{{ asset('css/toastr.min.css') }}" rel="stylesheet" />
        <!-- Sweetalert -->
        <script src="{{ asset('js/sweetalert.js') }}" type="text/javascript"></script>
        <link rel="stylesheet" href="{{ asset('css/sweetalert.css') }}" />
        @stack('admin-css')

        <link href="https://fonts.googleapis.com/css2?family=Aref+Ruqaa:wght@400;700&family=Cairo:wght@400;500;600;700;800&display=swap" rel="stylesheet">

        <style>
        
        body{
            font-family:'Cairo',sans-serif!important;
        }
        h1,h2,h3,h4,h5,h6,.card-header,.sb-sidenav .sb-sidenav-menu .nav-link{
            font-family:'Aref Ruqaa',serif!important;
            font-weight:700!important;
            letter-spacing:.3px;
        }
        .cke_notification_warning {
    background: #c83939;
    border: 1px solid #902b2b;
    display: none;
}
            
        /* ===== ADMIN RESPONSIVE ===== */
        /* ===== QATAR MAROON GRADIENT THEME ===== */
        .sb-topnav{background:linear-gradient(135deg,#6E0F2B 0%,#8A1538 45%,#A41E45 75%,#C22652 100%)!important}
        .sb-sidenav-dark{background:linear-gradient(180deg,#5E0C24 0%,#7A1231 40%,#8A1538 70%,#9E1B40 100%)!important}
        .sb-sidenav-dark .sb-sidenav-menu-nested{background:rgba(255,255,255,.05)}
        .sb-sidenav-dark .sb-sidenav-menu .nav-link.active{background:linear-gradient(90deg,#B51E47,#D23A66)}
        .sb-sidenav-dark .sb-sidenav-menu .nav-link:hover{background:linear-gradient(90deg,#B51E47,#D23A66)}
        /* ===== SIDEBAR BEAUTIFY ===== */
        .sb-sidenav{overflow-x:hidden}
        .sb-sidenav .sb-sidenav-menu{padding:.4rem 0 .8rem}
        .sb-sidenav .sb-sidenav-menu-heading{
            padding:1.05rem 1.3rem .3rem;
            font-size:10.5px;
            font-weight:700;
            text-transform:uppercase;
            letter-spacing:1.4px;
            color:#E8B54A;
            text-shadow:0 1px 2px rgba(0,0,0,.15);
        }
        .sb-sidenav .nav-link{
            display:flex;
            align-items:center;
            gap:11px;
            margin:2px 10px;
            padding:.68rem .9rem;
            border-radius:10px;
            border:1px solid transparent;
            border-left:3px solid transparent;
            font-size:14px;
            font-weight:500;
            color:rgba(255,255,255,.82);
            transition:all .2s ease;
            white-space:nowrap;
        }
        .sb-sidenav .nav-link .sb-nav-link-icon{
            font-size:16px;
            width:22px;
            text-align:center;
            color:#F0CBA0;
            transition:transform .2s ease;
        }
        .sb-sidenav .nav-link:hover{
            color:#fff;
            border-color:rgba(255,255,255,.08);
            border-left-color:#E8B54A;
            background:rgba(255,255,255,.08);
            transform:translateX(2px);
        }
        .sb-sidenav .nav-link:hover .sb-nav-link-icon{transform:scale(1.15);color:#E8B54A}
        .sb-sidenav .nav-link.active{
            color:#fff;
            border-left-color:#E8B54A;
            background:linear-gradient(90deg,rgba(232,181,74,.22),rgba(232,181,74,.04));
            box-shadow:inset 0 0 12px rgba(232,181,74,.08);
        }
        .sb-sidenav .nav-link.active .sb-nav-link-icon{color:#E8B54A}
        .sb-sidenav .sb-sidenav-collapse-arrow{color:rgba(255,255,255,.45);margin-left:auto;font-size:12px;transition:transform .25s ease}
        .sb-sidenav .nav-link[aria-expanded="true"] .sb-sidenav-collapse-arrow{transform:rotate(180deg)}
        .sb-sidenav .sb-sidenav-menu-nested{padding:2px 0;margin:0 10px;border-radius:10px;overflow:hidden}
        .sb-sidenav .sb-sidenav-menu-nested .nav-link{
            margin:1px 6px;
            padding:.5rem .85rem;
            border-radius:8px;
            font-size:13px;
            color:rgba(255,255,255,.72);
            border-left:none;
            transform:none;
        }
        .sb-sidenav .sb-sidenav-menu-nested .nav-link .sb-mini-icon{width:18px;font-size:11px;color:#E8B54A;opacity:.85}
        .sb-sidenav .sb-sidenav-menu-nested .nav-link:hover{
            color:#fff;
            border-left:none;
            background:rgba(255,255,255,.12);
            padding-left:.95rem;
        }
        .sb-sidenav .sb-sidenav-menu-nested .nav-link.active{border-left:none}
        .sb-sidenav-footer{
            background:rgba(0,0,0,.16)!important;
            border-top:1px solid rgba(255,255,255,.12);
            padding:.9rem 1.25rem;
        }
        .sb-sidenav-footer .small{font-size:11px;letter-spacing:.6px;color:#E8B54A!important;text-transform:uppercase;font-weight:600}
        .sb-sidenav-footer .fw-bold{color:#fff;font-size:14px;margin-top:2px}
        .sb-footer-logout{
            display:inline-flex;align-items:center;gap:6px;
            margin-top:10px;font-size:12.5px;font-weight:600;
            color:#fff;text-decoration:none;
            background:linear-gradient(135deg,#C22652,#D23A66);
            padding:6px 14px;border-radius:20px;
            transition:all .2s;
        }
        .sb-footer-logout:hover{color:#fff;background:linear-gradient(135deg,#A41E45,#C22652);transform:translateY(-1px)}
        .btn-primary{background:linear-gradient(135deg,#8A1538,#B51E47)!important;border-color:#8A1538!important}
        .btn-primary:hover,.btn-primary:focus,.btn-primary:active{background:linear-gradient(135deg,#6E0F2B,#8A1538)!important;border-color:#6E0F2B!important;box-shadow:none}
        .sb-topnav .btn-link{color:rgba(255,255,255,.9);font-size:19px;text-decoration:none;padding:0}
        .sb-topnav .btn-link:hover{color:#fff}
        .sb-topnav .dropdown-menu{min-width:210px;box-shadow:0 8px 24px rgba(0,0,0,.12)}

        /* ===== ADMIN INPUT FIELDS (smart + colorful) ===== */
        .form-group{margin-bottom:14px}
        .form-control,.form-select{
            height:auto;
            padding:.42rem .7rem;
            font-size:13px;
            color:#3f2a30;
            border:1px solid #ece0e4;
            border-left:3px solid #C9A2AE;
            border-radius:8px;
            background:#fdfafb;
            transition:border-color .2s,box-shadow .2s,background .2s;
        }
        .form-control:hover,.form-select:hover{border-color:#d9bcc5}
        .form-control:focus,.form-select:focus{
            background:#fff;
            border-color:#8A1538;
            border-left-color:#8A1538;
            box-shadow:0 0 0 3px rgba(138,21,56,.12);
        }
        .form-control::placeholder,.form-select::placeholder{color:#c8b6bc;font-size:12.5px}
        .form-group label,.form-label,.col-form-label{
            color:#7A1231;font-weight:600;font-size:12.5px;letter-spacing:.2px;margin-bottom:.35rem;
        }
        .form-group label span{color:#C22652}
        textarea.form-control{min-height:88px}
        select.form-select{color:#3f2a30}
        input[type="file"].form-control{padding:.28rem .5rem;color:#7A1231}
        /* CKEditor box */
        .cke{border:1px solid #ece0e4!important;border-left:3px solid #C9A2AE!important;border-radius:8px!important;overflow:hidden;box-shadow:none!important}
        .cke_focus{border-left-color:#8A1538!important;box-shadow:0 0 0 3px rgba(138,21,56,.12)!important}
        .cke_top{background:linear-gradient(135deg,#F9ECEF,#FBEFE2)!important;border-bottom:1px solid #F0D9DE!important}
        /* Search / filter inputs */
        .dataTable-input{border:1px solid #ece0e4!important;border-left:3px solid #C9A2AE!important;border-radius:8px!important;padding:.4rem .7rem!important;font-size:13px!important;background:#fdfafb!important}
        .dataTable-input:focus{border-color:#8A1538!important;border-left-color:#8A1538!important;box-shadow:0 0 0 3px rgba(138,21,56,.12)!important;background:#fff!important}

        /* ===== ADMIN BUTTONS (Qatar palette) ===== */
        .btn-success{background:linear-gradient(135deg,#8A1538,#B51E47)!important;border-color:#8A1538!important}
        .btn-success:hover{background:linear-gradient(135deg,#6E0F2B,#8A1538)!important;color:#fff!important}
        .btn-danger{background:linear-gradient(135deg,#C22652,#D23A66)!important;border-color:#C22652!important}
        .btn-danger:hover{background:linear-gradient(135deg,#A41E45,#C22652)!important;color:#fff!important}
        .btn-edit{background:linear-gradient(135deg,#C7831E,#E8B54A)!important;border-color:#C7831E!important;color:#fff!important}
        .btn-edit:hover{background:linear-gradient(135deg,#A86514,#C7831E)!important;color:#fff!important}
        .btn-delete{background:linear-gradient(135deg,#B51E47,#D23A66)!important;border-color:#B51E47!important;color:#fff!important}
        .btn-delete:hover{background:linear-gradient(135deg,#8A1538,#B51E47)!important;color:#fff!important}
        .btn-addnew{background:linear-gradient(135deg,#8A1538,#B51E47);border-color:#8A1538}
        .btn-addnew:hover{background:linear-gradient(135deg,#6E0F2B,#8A1538);border-color:#6E0F2B;color:#fff}
        @media (max-width: 991.98px) {
            .sb-topnav{height:56px;min-height:56px;padding:0 .8rem;gap:8px}
            .sb-topnav .navbar-brand{width:auto;max-width:none;flex:1 1 auto;min-width:0;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;font-size:15px;padding-left:4px!important;margin:0}
            .sb-topnav .navbar-nav{margin:0!important}
            .sb-topnav .common-text{display:none}
            .sb-topnav #sidebarToggle{display:inline-flex!important;margin:0 2px 0 0}

            /* Sidebar as mobile drawer */
            #layoutSidenav #layoutSidenav_nav{
                display:block;
                position:fixed;
                top:56px;
                bottom:0;
                left:0;
                width:262px;
                z-index:1037;
                transform:translateX(-262px);
                transition:transform .3s ease;
                box-shadow:0 0 30px rgba(0,0,0,.28);
                overflow-y:auto;
            }
            body.sidenav-toggled #layoutSidenav #layoutSidenav_nav{transform:translateX(0)}
            #layoutSidenav #layoutSidenav_content{margin-left:0!important;padding-left:8px!important}
            #layoutSidenav_content .container-fluid{padding-left:12px;padding-right:12px}
            #sidenavBackdrop{
                display:block;
                position:fixed;
                top:56px;
                left:0;
                right:0;
                bottom:0;
                z-index:1036;
                background:rgba(46,5,17,.5);
                opacity:0;
                visibility:hidden;
                transition:opacity .3s ease;
            }
            body.sidenav-toggled #sidenavBackdrop{opacity:1;visibility:visible}
        }
        @media (max-width: 575.98px) {
            .sb-nav-fixed #layoutSidenav #layoutSidenav_content{padding-left:8px;padding-right:8px}
            #layoutSidenav_content .container-fluid{padding-left:6px;padding-right:6px}
            .heading-title .heading{font-size:14px}
            .dashboard-logo img{height:70px!important}
            .card-body{padding:.9rem}
            .table{font-size:12.5px}
            .btn-sm,.btn{padding:.25rem .45rem;font-size:12px}
            .form-control,.form-select{font-size:13.5px}

            /* Stack admin form label/input rows on phones */
            .form-group.row>.col-sm-3,.form-group.row>.col-sm-9,
            .form-group.row>.col-md-3,.form-group.row>.col-md-9,
            .form-group.row>.col-lg-3,.form-group.row>.col-lg-9{flex:0 0 100%;max-width:100%}
            .form-group.row>.col-sm-3,.form-group.row>.col-md-3,.form-group.row>.col-lg-3{margin-bottom:.15rem}

            /* Datatable toolbar wraps on phones */
            .dataTable-top>div:first-child,.dataTable-top>div:last-child{float:none;width:100%}
            .dataTable-top .dataTable-selector,.dataTable-top .dataTable-input{width:100%;margin-bottom:.35rem}
        }
        </style>
    </head>
    <body class="sb-nav-fixed">
        
        @include('partials.navbar')

        <div id="layoutSidenav">
            
            @include('partials.sidebar')
            <div id="sidenavBackdrop"></div>

            <div id="layoutSidenav_content">

                @yield('main-content') 
                
                @include('partials.footer')

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Change Password</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <form action="{{ route('password.change') }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="modal-body">
                                <label for="">Old Password</label>
                                <input type="password" name="old_password" class="form-control mb-1 shadow-none" placeholder="Enter Old Password" required>
                                <label for="">New Password</label>
                                <input type="password" class="form-control shadow-none" name="password" placeholder="Enter New password" required>
                            </div>
                            <div class="modal-footer">
                                <button type="reset" class="btn btn-secondary">Reset</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
            </div>
        </div>
        <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
        <script src="{{ asset('js/scripts.js') }}"></script>
        <script src="{{ asset('js/bootstrap.bundle.min.js') }}" crossorigin="anonymous"></script>
        <script>
            $(document).on("click", "#sidenavBackdrop", function () {
                $("body").removeClass("sidenav-toggled");
            });
        </script>
        <script src=" {{ asset('js/all.min.js') }}" crossorigin="anonymous"></script>
        <script src="{{ asset('js/simple-datatables@latest.js') }}" crossorigin="anonymous"></script>
        <script src="{{ asset('js/datatables-simple-demo.js') }}"></script>
        <script src="//cdn.ckeditor.com/4.19.0/basic/ckeditor.js"></script>
        <script src="{{ asset('js/toastr.min.js') }}"></script>

        <script>
            @if (Session::has('message'))
                var type = "{{ Session::get('alert-type', 'info') }}"
                switch (type) {
                    case 'info':
                        toastr.info(" {{ Session::get('message') }} ");
                        break;
    
                    case 'success':
                        toastr.success(" {{ Session::get('message') }} ");
                        break;
    
                    case 'warning':
                        toastr.warning(" {{ Session::get('message') }} ");
                        break;
    
                    case 'error':
                        toastr.error(" {{ Session::get('message') }} ");
                        break;
                }
            @endif
        </script>

        {{-- Time --}}
        <script type="text/javascript">
            setInterval(function() {
                var currentTime = new Date();
                var currentHours = currentTime.getHours();
                var currentMinutes = currentTime.getMinutes();
                var currentSeconds = currentTime.getSeconds();
                currentMinutes = (currentMinutes < 10 ? "0" : "") + currentMinutes;
                currentSeconds = (currentSeconds < 10 ? "0" : "") + currentSeconds;
                var timeOfDay = currentHours < 12 ? "AM" : "PM";
                currentHours = currentHours > 12 ? currentHours - 12 : currentHours;
                currentHours = currentHours == 0 ? 12 : currentHours;
                var currentTimeString = currentHours + ":" + currentMinutes + ":" + currentSeconds + " " + timeOfDay;
                document.getElementById("timer").innerHTML = currentTimeString;
            }, 1000);
        </script>

        <!-- Sweet Alert Delete Post method -->
    <script type="text/javascript">
        $(document).ready(function() {

            $(document).on("click", "#delete", function(e) {
                e.preventDefault();

                var actionTo = $(this).attr("href");
                var token = $(this).attr("data-token");
                var id = $(this).attr("data-id");

                swal({
                        title: "Are You Sure?",
                        type: "success",
                        showCancelButton: true,
                        confirmButtonClass: "btn-success",
                        confirmButtonText: "Yes",
                        cancelButtonText: "No",
                        closeOnConfirm: false,
                        closeOnCancel: false,
                    },
                    function(isConfirm) {
                        if (isConfirm) {
                            $.ajax({
                                url: actionTo,
                                type: "post",
                                data: {
                                    id: id,
                                    _token: token
                                },
                                success: function(res) {
                                    // console.log(res);
                                    if (res.success) {
                                        swal({
                                                title: "Deleted!",
                                                type: "success",
                                            },
                                            function(isConfirm) {
                                                if (isConfirm) {
                                                    $("." + id).fadeOut();
                                                }
                                            }
                                        );

                                    }
                                },
                            });
                        } else {
                            swal("Cancelled", "", "error");
                        }
                    }
                );
                return false;
            });
        });
    </script>

        @stack('scripts')

    </body>
</html>
