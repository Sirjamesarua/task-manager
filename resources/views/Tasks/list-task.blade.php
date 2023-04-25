<!DOCTYPE html>
<html>

<head>
  <title>Tasks List</title>
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

      <h3 class="text-center mb-4">Tasks List</h3>
      <a class="btn btn-primary float-right mb-4" href="{{ route('new-task') }}">New</a>
      <table id="table" class="table table-bordered">
        <thead>
          <tr>
            <th width="30px">#</th>
            <th>Name</th>
            <th>Priority</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody id="tablecontents">
          <!-- get all data from Table by Controller -->
          @foreach ($tasks as $task)
            <tr class="row1" data-id="{{ $task->id }}">
              <td class="pl-3"><i class="fa fa-sort"></i></td>
              <td>{{ $task->name }}</td>
              <td>{{ $task->priority }}</td>
              <td><a class="btn btn-primary" href="{{ route('task.edit', $task->id) }}">Edit</a>
                <a class="btn btn-danger" href="{{ route('delete-task', $task->id) }}">Delete</a>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
      <hr>
      <h5>Drag and Drop the table rows and <button class="btn btn-success btn-sm"
          onclick="window.location.reload()">REFRESH</button> </h5>
    </div>
  </div>

  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.12/datatables.min.js"></script>
  <script type="text/javascript">
    $(function() {
      $("#table").DataTable();
      // this is need to Move Ordera accordin user wish Arrangement
      $("#tablecontents").sortable({
        items: "tr",
        cursor: 'move',
        opacity: 0.6,
        update: function() {
          sendOrderToServer();
        }
      });

      function sendOrderToServer() {
        var order = [];
        var token = $('meta[name="csrf-token"]').attr('content');
        //   by this function User can Update hisOrders or Move to top or under
        $('tr.row1').each(function(index, element) {
          order.push({
            id: $(this).attr('data-id'),
            position: index + 1
          });
        });
        // the Ajax Post update 
        $.ajax({
          type: "POST",
          dataType: "json",
          url: "{{ url('Custom-sortable') }}",
          data: {
            order: order,
            _token: token
          },
          success: function(response) {
            if (response.status == "success") {
              console.log(response);
            } else {
              console.log(response);
            }
          }
        });
      }
    });
  </script>
</body>

</html>
