<section class="content-header">
  <h1>
    View History
    <small>Order</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{url('')}}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active"><a href="{{url('/orders')}}"><span class="glyphicon glyphicon-tasks"></span> View History</a></li>
    <li class="active"><i class="fa fa-pencil"></i> Update</a></li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
 @php
    if ($order->status == 'f' || $order->status == 'a')
      $disabled = 'disabled';
    else
      $disabled = '';  
  @endphp
  <!-- Default box -->
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Update</h3>
      <div class="box-tools pull-right">
        <button class="btn btn-box-tool" data-toggle="modal" data-target="#modal-delete"><i class="fa fa-trash"></i> Delete</button>
      </div>
    </div>
    <div class="box-body">

      {{ Form::open(array('url' => 'orders/update/'.$order->idorders, 'class' => 'form-horizontal')) }}

      <div class="form-group">
        <label class="col-sm-2 control-label">Code</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" value="{{$order->code}}" readonly>
        </div>
      </div>

      <div class="form-group">
        <label class="col-sm-2 control-label">Due Date</label>
        <div class="col-sm-10">
          <div class="input-group date">
            <div class="input-group-addon">
              <i class="fa fa-calendar"></i>
            </div>
            <input type="text" class="form-control datepicker pull-right" name="due_date" id="date" data-date-format='yyyy-mm-dd' value="{{$order->due_date}}" autocomplete="off" {{$disabled}}>
          </div>
        </div>
      </div>

      <div class="form-group">
        <label class="col-sm-2 control-label">Date Order</label>
        <div class="col-sm-10">
          <div class="input-group date">
            <div class="input-group-addon">
              <i class="fa fa-calendar"></i>
            </div>
            <input type="text" class="form-control datepicker pull-right" name="date_orders" id="date" data-date-format='yyyy-mm-dd' value="{{$order->date_orders}}" autocomplete="off" {{$disabled}}>
          </div>
        </div>
      </div>

      <div class="form-group">
         <label class="col-sm-2 control-label">Description</label>
         <div class="col-sm-10">
           <textarea  rows="3" class="form-control" name="description" {{$disabled}}>{{$order->description}}</textarea>
           <br>
           <a class="pull-right btn btn-primary btn-xs {{$disabled}}" id="addRow"> <i class="fa fa-plus"></i> Add</a>
         </div>
       </div>

       <div class="form-group">
         <div class="col-sm-10 col-sm-offset-2">
           <div class="table-responsive">
             <table class="table table-bordered " style="border: 2px solid #d2d6de !important;" id="table">
               <tbody>
                 @php
                   $no = 1;
                 @endphp
                 @foreach ($order->orders_details as $odkey => $od)
                   <tr>
                     <td style="border: 1px solid #d2d6de !important; text-align:center ">
                       <label style="display:block;">{{$no++}}</label>
                       <input type="hidden" name="idordersdetails[]" value="{{$od->idordersdetails}}">
                        <a  class="btn btn-xs del {{$disabled}}" id="count" onclick="del_ordet({{$od->idordersdetails}})"><i class="fa fa-trash"></i></a>
                     </td>
                     <td  style="border: 1px solid #d2d6de !important; ">
                       <small><strong>Items</strong></small>
                       <select class="form-control select2" name="iditems[]" id="iditems_{{$odkey+1}}" {{$disabled}}>
                         <option>-- select items --</option>
                         @foreach($items as $item)
                           <option value="{{$item->iditems}}" @if ($item->iditems == $od->iditems)
                             selected
                           @endif>{{$item->name}}</option>
                         @endforeach
                       </select>
                     </td>
                     <td  style="border: 1px solid #d2d6de !important; ">
                       <small><strong>Quantity</strong></small>
                       <input type="number" name="quantity[]" class="form-control" value="{{$od->quantity}}" id="quantity_{{$odkey+1}}" {{$disabled}}>
                     </td>
                   </tr>
                 @endforeach
               </tbody>
             </table>
           </div>
         </div>
       </div>

      <div class="form-group">
        <label class="col-sm-2 control-label"></label>
        <div class="col-sm-10">
          <a href="{{url('orders')}}" class="btn btn-warning pull-right">Back</a>
          <input type="submit" value="Save" class="btn btn-primary" id="btn_save" {{$disabled}}>
        </div>
      </div>
      <input type="hidden" id="deleteindex" name="deleteindex">
      {{ Form::close() }}
    </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->
<input type="hidden" id="appendindex" value="{{$order->orders_details->count()+1}}">
</section>


<!-- modal delete confirmation -->
<div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">Warning</h4>
      </div>
      <div class="modal-body">
        <center>Sure to delete this user ?</center>
      </div>
      <div class="modal-footer">
        {{ Form::open(array('url' => 'orders/delete/'.$order->idorders, 'method' => 'delete')) }}
        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
        <button type="submit" class="btn btn-danger">Yes</button>
        {{ Form::close() }}
      </div>
    </div>
  </div>
</div>

<script src="//ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script type="text/javascript">

  var items = '';
  @foreach ($items as $item)
    items += "<option value='{{$item->iditems}}'>{{$item->name}}</option>";
  @endforeach

    $('#table').on('click', '.del' ,function(){
        $(this).closest('tr').remove();
        if ($('#count').length-1) {
           $('#btn_save').prop("disabled", 'disabled');
         }
    });
  // console.log(items);
  $('#addRow').on('click',function(){
      var ais = $('#appendindex').val();
      $('#appendindex').val(parseInt(ais)+1);
      $('#table').append('<tr>'
          +'<td style="border: 1px solid #d2d6de !important; text-align:center">'
            +'<label style="display:block">'+ais+'</label>'
            +'<a class="btn btn-xs del" id="count"><i class="fa fa-trash" aria-hidden="true"></i></a>'
            +'<input type="hidden" name="idordersdetails[]" value="new">'
          +'</td>'
          +'<td style="border: 1px solid #d2d6de !important;">'
            +'<small><strong>Items</strong></small><br>'
            +'<select class="form-control" name="iditems[]" id="iditems_'+ais+'"><option value="0">- select items -</option>'+items+'</select>'
          +'</td>'
          +'<td style="border: 1px solid #d2d6de !important;">'
            +'<small><strong>Quantity</strong></small><br>'
            +'<input type="number" name="quantity[]" class="form-control"  id="quantity_'+ais+'">'
          +'</td>'
        +'</tr>'
      );
    })

    function del_ordet(idod) {
      	var order_detail = $('#deleteindex').val();
      	$('#deleteindex').val( order_detail+','+idod);
      }
</script>
