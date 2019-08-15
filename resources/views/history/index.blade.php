<section class="content-header">
  <h1>Details Orders</h1>
  <ol class="breadcrumb">
    <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active"><i class="glyphicon glyphicon-repeat"></i> Detail Order</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">

  <!-- Default box -->
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Index</h3>
      <div class="box-tools pull-right">
      </div>
    </div>
    <div class="box-body table-responsive">
      <table id="example1" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th>No</th>
          <th>Code</th>
          <th>Due Date</th>
          <th>Date Order</th>
          <th>Created By</th>
          <th>Received By</th>
          <th>Accepted By</th>
          <th>
            <center>Action</center>
          </th>
          <th></th>
        </tr>
        </thead>
        <tbody>
            @php
              $no =1;
            @endphp
            @foreach ($users as $user)
              @foreach ($user->orders as $order)
              <tr>
                <td><center>{{$no++}}</center></td>
                <td>{{$order->code}}</td>
                <td>{{date('d M Y', strtotime($order->due_date))}}</td>
                <td>{{date('d M Y', strtotime($order->date_orders))}}</td>
                <td>
                  <center>{{$user->name}}</center>
                </td>
                <td>
                  <center>
                    @if (isset($order->received))
                      {{$order->received->users->name}}
                    @else
                      -  
                    @endif
                  </center>
                </td>
                <td>
                  <center>
                    @if (isset($order->accepted))
                      {{$order->accepted->users->name}}
                    @else
                      - 
                    @endif
                  </center>
                </td>
                <td>
                  <center>
                    @if (isset($order->broken))
                      {{$order->broken->users->name}}
                    @else
                      - 
                    @endif
                  </center>
                </td>

                <td>
                  <center>
                    @if ($order->status == 'p')
                      <span class="label label-default">Pending</span>
                    @elseif($order->status == 'w')
                      <span class="label label-warning">Wait</span>
                    @elseif($order->status == 'a')
                      <span class="label label-success">Accepted</span>
                    @elseif($order->status == 'f')
                      <span class="label label-danger">Failed</span>
                    @elseif($order->status == 'h')
                      <span class="label label-info">Broken</span>
                    @endif
                  </center>
                </td>
                <td>
                  <a href="{{url('/history/update/'.$order->idorders)}}" ><i class="fa fa-pencil-square-o"></i></a>
                </td>
              </tr>
              @endforeach
            @endforeach
        </tbody>
      </table>
    </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->

</section>
