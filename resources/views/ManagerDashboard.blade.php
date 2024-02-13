<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="{{asset('css/styles.css')}}" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <form method="POST" action="/api/logout">
                    @csrf
                    
                    <li><a  class="dropdown-item"><button class="btn btn-danger" style="margin-left:15px;" type="submit">Logout</a></li>
                    </form>
                    
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <a class="nav-link" href="index.html">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <div class="sb-sidenav-menu-heading">Task Update</div>
                            
                            
                        </div>
                    </div>
                    
                    </nav>
                         </div>
                         <div id="layoutSidenav_content">
                         <main>
                            <div class="container-fluid px-4">
                                <h1 class="mt-4">Task Management System</h1>
                             <ol class="breadcrumb mb-4">
                                <li class="breadcrumb-item active"><div class="alert alert-primary" role="alert">Manager Login Successfully </div>
                                </ol>            
                              </div>
                              

   
                              @foreach($task as $t)
                             <div class="card border-dark mb-3" style="max-width: 18rem; margin-left: 20px; margin-top: 20px;">
                                <div class="card-header">{{$t->id}}</div>
                                <div class="card-body text-dark">
                                  <h5 class="card-title">{{$t->title}}</h5>
                                  <p class="card-text">{{$t->desp}}</p>
                                </div>

                                
                                <form method="GET" action="{{url('api/updateindex/'.$t->id)}}".>
                                    <button class="btn btn-success" style="margin: 10px;" type="submit">Update</button>
                                </form>
                            

                                </div>
                            @endforeach
                                
                                    <!-- Button trigger modal -->
                               
                                
{{-- 
                                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h5 class="modal-title" id="staticBackdropLabel">Update Task Here</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="Title" class="form-label">Task Title</label>
                                                <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Title">
                                              </div>
                                              <div class="mb-3">
                                                <label for="exampleFormControlTextarea1" class="form-label">Task Description</label>
                                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                                              </div>
                                              <select class="form-select" aria-label="Default select example">
                                                <option selected>Status</option>
                                                <option value="1">To DO</option>
                                                <option value="2">In Progress</option>
                                                <option value="3">Completed</option>
                                              </select>
                                            </div>
                                          <div class="modal-footer">
                                             <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-success">Update</button>
                                                </div>
                                                </div>
                                                 </div>
                                         </div> --}}
                              </div>
                            
                            
                            
                        </div>
                        

                        
                    </div>


                  


                    
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Task Management 2024</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="{{asset('js/scripts.js')}}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
</html>
