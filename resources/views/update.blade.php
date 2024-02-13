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
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link href="{{asset('css/styles.css')}}" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
   


    
</head>
<body>
  <nav class="navbar navbar-light bg-light">
    <div class="container-fluid">
      <a class="navbar-brand"><h2>Task Management System</h2></a>
      <form class="d-flex">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </nav>



{{-- <div class="" id="staticBackdropopen" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true"> --}}    <div class="container-sm">
                            <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Update Task Here</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                
                               
                                <form style="margin:10px 10px 10px 10px;" method="POST" action="{{url('api/update-data/'.$data->id)}}}">
                                    @csrf
                                    
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="Title" class="form-label">Task Title</label>
                                        <input type="text" class="form-control" name="title" id="exampleFormControlInput1" value="{{$data->title}}" />
                                      </div>
                                      <div class="mb-3">
                                        <label for="exampleFormControlTextarea1" class="form-label">Task Description</label>
                                        <textarea class="form-control" id="exampleFormControlTextarea1" name="desp" rows="3">{{ $data->desp }}</textarea>
                                      </div>
                                      <select class="form-select" aria-label="Default select example" name="status">
                                        <option selected>Assigned To</option>
                                        @foreach($task as $t)
                                        <option value="{{$t->id}}">{{$t->name}}</option>
                                        @endforeach
                                      </select>
                                      <select class="form-select" style="margin-top:10px;" aria-label="Default select example" name="assigned">
                                        <option selected>Status</option>
                                        <option value="1">In Progress</option>
                                        <option value="2">Completed</option>
                                      </select>
                                    </div>
                                  <div class="modal-footer">
                                     {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> --}}
                                    <button type="submit" class="btn btn-primary" style="margin: 10px;">Submit</button>
                                        </div>
                                        </div>
                                         </div>
                                 
                                 </form>
                                </div>

                                 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
                                 
    
                                 
</body>
</html>