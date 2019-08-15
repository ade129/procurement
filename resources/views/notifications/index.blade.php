
<section class="content-header">
  <h1>Notifications</h1>
  <ol class="breadcrumb">
    <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active"><i class="fa fa-bell-o"></i> Notifications</li>
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
    {{-- <del>This line of text is meant to be treated as deleted text.</del> --}}
    <div class="box-body table-responsive">
      <table id="example1" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th>No</th>
          <th>Subject</th>
          <th>Code</th>
           <th>Description</th>
          <th></th>
        </tr>
        </thead>
        <tbody>
          @php
            $no = 1;
          @endphp
          @foreach ($notifications as $notif)
        
           <tr>
              <td>{{$no++}}</td>
              <td>{{$notif->subject}}</td>
              <td>{{$notif->orders->code}}</td>
              <td>{{$notif->orders->description}}</td>
            <td>
                <center>
                  @if ($notif->seen == False)
                    <a href="{{url('notifications/'.$notif->idnotifications.'/'.'1')}}" class="btn btn-danger btn-xs"> <i class="fa fa-bell-o" aria-hidden="true"></i> Read</a>
                  @endif
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
