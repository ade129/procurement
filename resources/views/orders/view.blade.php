<section class="content-header">
  <h1>Details  </h1>
  <ol class="breadcrumb">
    <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active"><a href="{{url('/orders')}}"><span class="glyphicon glyphicon-tasks"></span> View History</a></li>
    <li class="active"><i class="fa fa-eye"></i> Details</li>

  </ol>
</section>

<!-- Main content -->
<section class="content">

  <!-- Default box -->
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Details</h3>
      <small>Index</small>
    </div>
    <!--box body-->
    <div class="box-body">

        <div class="form-group">
          <div class="col-sm-2 control-label">
            <label class="">Code</label>
          </div>
          <div class="col-sm-10">
            <label class="">: {{$order->code}}</label>
          </div>
        </div>

        <div class="form-group">
          <div class="col-sm-2 control-label">
            <label class="">Due Date</label>
          </div>
          <div class="col-sm-10">
            <label class="">: {{ date('d M Y', strtotime($order->due_date))}}</label>
          </div>
        </div>

        <div class="form-group">
          <div class="col-sm-2 control-label">
            <label class="">Date Order</label>
          </div>
          <div class="col-sm-10">
            <label class="">: {{ date('d M Y', strtotime($order->date_orders))}}</label>
          </div>
        </div>

        <div class="form-group">
          <div class="col-sm-2 control-label">
            <label class="">Description</label>
          </div>
          <div class="col-sm-10">
            <label class="">: {{$order->description}}</label>
          </div>
        </div>

        <div class="form-group">
          <div class="col-sm-2 control-label">
            <label class="">Received</label>
          </div>
          <div class="col-sm-10">
            <label class="">:
              @if (isset($order->received))
                 {{$order->received->users->name}}
              @else
              -  
              @endif
              </label>
          </div>
        </div>

        <div class="form-group">
          <div class="col-sm-2 control-label">
            <label class="">Accepted</label>
          </div>
          <div class="col-sm-10">
            <label class="">: 
            @if (isset($order->accepted))
              {{$order->accepted->users->name}}
            @else
              -
            @endif
            </label>
          </div>
        </div>

        <div class="form-group">
          <div class="col-sm-2 control-label">
            <label class="">Status</label>
          </div>
          <div class="col-sm-10">
              @if ($order->status == 'p')
                <label for="">:</label> <span class="label label-default">Pending</span>
              @elseif($order->status == 'w')
                <label for="">:</label> <span class="label label-warning">Wait</span>
              @elseif($order->status == 'a')
                <label for="">:</label> <span class="label label-success">Accepted</span>
              @elseif($order->status == 'f')
                <label for="">:</label> <span class="label label-danger">Failed</span>
              @elseif($order->status == 'h')
                <label for="">:</label> <span class="label label-info">Broken</span>
              @endif
          </div>
        </div>

        <div class="col-sm-10">
          <div class="table-responsive">
              <table class="table table-bordered" style="border: 2px solid #d2d6de !important;" >
                <thead>
                  <tr>
                    <th style="border: 1px solid #d2d6de !important; ">Categories</th>
                    <th style="border: 1px solid #d2d6de !important; ">Item</th>
                    <th style="border: 1px solid #d2d6de !important; ">Quantity</th>

                  </tr>
                </thead>
                <tbody>
                  @foreach ($order->orders_details as $od)
                    <tr>
                      <td style="border: 1px solid #d2d6de !important; ">{{$od->items->categories->name}}</td>
                      <td style="border: 1px solid #d2d6de !important; ">{{$od->items->name}}</td>
                      <td style="border: 1px solid #d2d6de !important; ">{{$od->quantity}}</td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
          </div>
        </div>



    </div>
    <!--box body-->

  </div>
  </section>
