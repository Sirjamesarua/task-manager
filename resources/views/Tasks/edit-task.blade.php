<!DOCTYPE html>
<html>

<head>
  <title>Edit {{ $task->name }}</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <!-- this is for drop and drog in this arrange of wish order (need) -->
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.12/datatables.min.css" />
  <link rel="stylesheet" type="text/css"
    href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
</head>

<body>
  <div class="row mt-5">
    <div class="col-md-10 offset-md-1">

      <h3 class="text-center mb-4">Edit {{ $task->name }}</h3>
      <form method="POST" action="{{ route('update-task', $task->id) }}">
        @csrf
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Name</label>
          <input type="text" class="form-control" name="name" placeholder="{{ $task->name }}">

        </div>
        {{-- <div class="mb-3">
          <label for="exampleInputPassword1" class="form-label">Priority</label>
          <input type="number" class="form-control" name="priority" placeholder="">
        </div> --}}
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>

      <hr>

    </div>
  </div>

  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.12/datatables.min.js"></script>

</body>

</html>
