<section class="content-header">
  <h1>View History </h1>
  <ol class="breadcrumb">
    <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active"><span class="glyphicon glyphicon-tasks"></span> View History</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">

  <!-- Default box -->
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Index</h3>
      <div class="box-tools pull-right">
        {{-- <a href="{{url('orders/create-new')}}" class="btn btn-box-tool" title="Create New"><i class="fa fa-plus"></i> Create New</a> --}}
      </div>
    </div>
    <div class="box-body table-responsive">
      <table id="example1" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th>Code</th>
          <th>Due Date</th>
          <th>Date Order</th>
          <th>Created By</th>
          <th>Received By</th>
          <th>Accepted By</th>
          <th>Status</th>
          @if (Auth::user()->role_type == 'GA' || Auth::user()->role_type == 'RO')
            <th><center>Action</center> </th>
          @endif
          <th></th>
        </tr>
        </thead>
        <tbody>
          @foreach ($orders as $order)
            <tr>
              <td>{{$order->code}}</td>
              <td>{{date('d M Y' , strtotime($order->due_date))}}</td>
              <td>{{date('d M Y' , strtotime($order->date_orders))}}</td>
              <td><center>{{$order->users->name}}</center></td>
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
                @if ($order->status == 'p')
                  <center>
                    <span class="label label-default">Pending</span>
                  <center>
                @elseif($order->status == 'w')
                  <center>
                    <span class="label label-warning">Wait</span>
                  </center>
                @elseif($order->status == 'a')
                  <center>
                    <span class="label label-success">Accepted</span>
                  </center>
                @elseif($order->status == 'f')
                  <center><span class="label label-danger">Failed</span></center>
                @elseif($order->status == 'h')
                  <center><span class="label label-info">Broken</span></center>
                @endif
              </td>
              @if (Auth::user()->role_type == 'GA' || Auth::user()->role_type == 'RO')
                <td>
                  @if ($order->status == 'p')
                    @if (Auth::user()->role_type == 'RO')
                    <center>
                     <a href="{{url('orders/action/'.$order->idorders.'/'.'w')}}" class="btn btn-info btn-xs">Received</a>
                    </center>
                    @endif
                  @elseif($order->status == 'w')
                    @if (Auth::user()->role_type == 'GA')
                      <center>
                        <a href="{{url('orders/action/'.$order->idorders.'/'.'a')}}" class="btn btn-success btn-xs">Accepted</a>
                        <a href="{{url('orders/action/'.$order->idorders.'/'.'f')}}" class="btn btn-danger btn-xs">Failed</a>
                        <a href="{{url('orders/action/'.$order->idorders.'/'.'h')}}" class="btn btn-info btn-xs">Broken</a>
                      </center>
                    @else
                      <center>
                        <i class="fa fa-minus-square" aria-hidden="true"></i>
                      </center>
                    @endif
                  @elseif($order->status == 'a')  
                    <center><i class="fa fa-check-square" aria-hidden="true"></i></center>
                  @elseif($order->status == 'f')
                    <center>
                      <i class="fa fa-times-circle" aria-hidden="true"></i>
                    </center>
                  @elseif($order->status == 'h')
                    <center>
                      <i class="fa fa-times-circle" aria-hidden="true"></i>
                    </center>
                  @endif
                </td>
              @endif
              <td>
                <a href="{{url('/orders/view/'.$order->idorders)}}" ><i class="fa fa-eye"></i></a>
                @if (Auth::user()->role_type == 'GA' || Auth::user()->role_type == 'RO')
                  <a href="{{url('/orders/update/'.$order->idorders)}}" ><i class="fa fa-pencil-square-o"></i></a>
                @endif
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->

</section>
