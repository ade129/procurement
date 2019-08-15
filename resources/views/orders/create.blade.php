<section class="content-header">
  <h1>
    Orders
    <small></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active"><i class="fa fa-first-order"></i> Orders</li>
    <li class="active"><i class="fa fa-plus"></i> Create New</a></li>
  </ol>
</section>

<!-- Main content -->
<section class="content">

  <!-- Default box -->
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Create New</h3>
    </div>
    <div class="box-body">
      {{ Form::open(array('url' => 'orders/create-new', 'class' => 'form-horizontal')) }}

      <div class="form-group">
        <div class="col-sm-2 control-label">
          <label class="">Code</label>
        </div>
        <div class="col-sm-6">
          <input type="text" value="AUTO" class="form-control" readonly>
        </div>
      </div>

      <div class="form-group">
        <div class="col-sm-2 control-label">
          <label class="">Due Date</label>
        </div>
        <div class="col-sm-6">
          <div class="input-group date">
            <div class="input-group-addon">
              <i class="fa fa-calendar"></i>
            </div>
            <input type="text" class="form-control datepicker pull-right" name="due_date" id="date" data-date-format='yyyy-mm-dd' value="{{date('Y-m-d')}}" autocomplete="off">
          </div>
        </div>
      </div>

      <div class="form-group">
        <div class="col-sm-2 control-label">
          <label class="">Description</label>
        </div>
        <div class="col-sm-6">
          <textarea name="description" rows="3"  class="form-control" required></textarea>
          <br>
          <a class="pull-right btn btn-primary btn-xs" id="addRow"> <i class="fa fa-plus"></i> Add</a>
        </div>
      </div>

      <div class="form-group">
        <div class="col-sm-7 col-sm-offset-1">
          <div class="table-responsive">
            <table class="table table-bordered " style="border: 2px solid #d2d6de !important;" id="table">
              <tbody>
              <tr>
                  <td style="border: 1px solid #d2d6de !important; text-align:center ">
                    <label>1</label>
                  </td>
                  <td  style="border: 1px solid #d2d6de !important; ">
                    <small><strong>Items</strong></small>
                    <select class="form-control select2" name="iditems[]" id="iditems_1">
                      <option>- select items -</option>
                      @foreach($items as $item)
                      <option value="{{$item->iditems}}">{{$item->name}}</option>
                     @endforeach
                    </select>
                  </td>
                  <td  style="border: 1px solid #d2d6de !important; ">
                    <small><strong>Quantity</strong></small>
                    <input type="number" name="quantity[]" class="form-control"  id="quantity_1">
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <div class="form-group">
        <label class="col-sm-1 control-label"></label>
        <div class="col-sm-2 col-sm-offset-6">
          <input type="submit" id="btn-save" value="Save" class="btn btn-success" >
        </div>
      </div>
      {{ Form::close() }}
    </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->
    <input type="hidden" id="appendindex" value="2">

  </section>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

  <script type="text/javascript">
    var iditems = '';
    @foreach ($items as $item)
      iditems += "<option value='{{$item->iditems}}'>{{$item->name}}</option>";
    @endforeach

    //delete row
    $('#table').on('click', '.del' ,function(){
      $(this).closest('tr').remove();
    });

    $('#addRow').on('click', function(){
      var ais = $('#appendindex').val();
      $('#appendindex').val(parseInt(ais)+1);

      //add row
      $('#table').append('<tr>'
          +'<td style="border: 1px solid #d2d6de !important; text-align:center">'
            +'<label>'+ais+'</label><br>'
            +'<a class="btn btn-xs del"><i class="fa fa-trash" aria-hidden="true"></i></a>'
          +'</td style="border: 1px solid #d2d6de !important; ">'
          +'<td style="border: 1px solid #d2d6de !important; ">'
            +'<small><strong>Items</strong></small>'
            +'<select class="form-control select2" name="iditems[]" id="iditems_'+ais+'"> <option>- select items -</option>'+iditems+
            +'</select>'
          +'</td>'
          +'<td style="border: 1px solid #d2d6de !important; ">'
            +'<small><strong>Quantity</strong></small>'
            +'<input type="number" name="quantity[]" class="form-control"  id="quantity_'+ais+'">'
          +'</td>'
        +'</tr>'
        );

    })
  </script>
{{-- <script type="text/javascript">
  $(document).ready(function() {
   $('.datepicker').datepicker();
  });
</script> --}}
