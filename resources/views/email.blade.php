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
    <body>
        <h1 class="display-1 text-center">
            Task Update
        </h1>
        <p class="text-secondary">
            Peace be upon you! {{$mailData['title']}}, A new task has been assigned to the following email <span class="fw-bolder text-info">
                {{$mailData['assigned']}}
            </span>
            The datails are as follows:
            <p class="text-secondary">
                {{$mailData['desp']}}
            </p>
        </p>
    </body>
</html>
