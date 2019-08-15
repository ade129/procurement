<section class="content-header">
  <h1>Items</h1>
  <ol class="breadcrumb">
    <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active"><i class="fa fa-inbox"></i> Items</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">

  <!-- Default box -->
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Index</h3>
      <div class="box-tools pull-right">
        <a href="{{url('items/create-new')}}" class="btn btn-box-tool" title="Create New"><i class="fa fa-plus"></i> Create New</a>
      </div>
    </div>
    <div class="box-body table-responsive">
      <table id="example1" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th>No</th>
          <th>Code</th>
          <th>Categories / Items</th>
          <th>Unit</th>
          <th>Brand</th>
          {{-- <th>Created_at</th> --}}
          <th>Status</th>

          <th></th>
        </tr>
        </thead>
        <tbody>
     @foreach($items as $item)
        <tr>
          <td>{{$item->iditems}}</td>
          <td>{{$item->code}}</td>
          <td>{{$item->categories->name  }} <i class="fa fa-fw fa-caret-right"></i> {{$item->name}}</td>
          <td>{{$item->unit}}</td>
          <td>{{$item->brand}}</td>
          {{-- <td>{{$item->users->name}}</td> --}}
          <td>
            <center>
             @if($item->active)
               <span class="label label-success">Active</span>
             @else
               <span class="label label-danger">Inactive</span>
             @endif
           </center>

          </td>

          <td>
            <center>
              <a href="{{url('/items/update/'.$item->iditems)}}" ><i class="fa fa-pencil-square-o"></i></a>
            </center>
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
