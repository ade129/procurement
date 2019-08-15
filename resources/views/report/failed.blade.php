<section class="content-header">
  <h1>Report <small>Failed</small></h1>

  <ol class="breadcrumb">
    <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active"><i class="fa fa-area-chart"></i> Report</li>
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
      <form class="" action="{{url('/report')}}" method="GET">
          
    </div>

    <div class="box-body table-responsive">
      <table id="example1" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th><center>No</center></th>
          <th>Code </th>
          <th>Due Date</th>
          <th>Date Order</th>
          <th>description</th>
          <th>Created By</th>
          <th>Status</th>
          </tr>
        </thead>
        <tbody>
          @php
            $no = 1;
          @endphp
          @foreach ($orders as $order)
          <tr>
            <td><center>{{$no++}}</center></td>
            <td>{{$order->code}}</td>
            <td>{{ date('d M Y' ,strtotime($order->due_date))}}</td>
            <td>{{ date('d M Y' ,strtotime($order->date_orders))}}</td>
            <td>{{$order->description}}</td>
            <td>{{$order->users->name}}</td>
            <td>
              @if ($order->status == 'f')
                <span class="label label-danger">Failed</span>
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
