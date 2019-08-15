<section class="content-header">
  <h1>
    Items
    <small>Master</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{url('')}}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active"><i class="fa fa-database"></i> Master</a></li>
    <li><a href="{{url('items')}}"><i class="fa fa-inbox"></i> Items</a></li>
    <li class="active"><i class="fa fa-pencil"></i> Update</a></li>
  </ol>
</section>

<!-- Main content -->
<section class="content">

  <!-- Default box -->
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Update</h3>
      <div class="box-tools pull-right">
        <button class="btn btn-box-tool" data-toggle="modal" data-target="#modal-delete"><i class="fa fa-trash"></i> Delete</button>
      </div>
    </div>
    <div class="box-body">

      {{ Form::open(array('url' => 'items/update/'.$item->iditems, 'class' => 'form-horizontal')) }}

      <div class="form-group">
        <label class="col-sm-2 control-label">Code</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" placeholder="Code" name="code" value="{{$item->code}}" required>
        </div>
      </div>

      <div class="form-group">
         <label class="col-sm-2 control-label">Category</label>
         <div class="col-sm-10">
           <select class="form-control" name="idcategories">
             <option value="">-- select categories -- </option>
             @foreach ($categories as $cat)
               <option value="{{$cat->idcategories}}" @if ($cat->idcategories == $item->idcategories)
                 selected
               @endif>{{$cat->name}}</option>
             @endforeach
           </select>
         </div>
       </div>

      <div class="form-group">
        <label class="col-sm-2 control-label">Name</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" placeholder="Name" value="{{$item->name}}" name="name" required>
        </div>
      </div>

      <div class="form-group">
         <label class="col-sm-2 control-label">Unit</label>
         <div class="col-sm-10">
           <select class="form-control" name="unit">
             <option value="BOTOL" @if($item->unit == 'BOTOL')
               selected
             @endif>BOTOL</option>
             <option value="BOX" @if($item->unit == 'BOX')
               selected
             @endif>BOX</option>
             <option value="KARTON" @if($item->unit == 'KARTON')
               selected
             @endif>KARTON</option>
             <option value="KG" @if($item->unit == 'KG')
               selected
             @endif>KG</option>
             <option value="METER" @if($item->unit == 'METER')
               selected
             @endif>METER</option>
             <option value="PACK" @if($item->unit == 'PACK')
               selected
             @endif>PACK</option>
             <option value="PCS" @if($item->unit == 'PCS')
               selected
             @endif>PCS</option>
             <option value="RIM" @if($item->unit == 'RIM')
               selected
             @endif >RIM</option>
             <option value="ROLL" @if($item->unit == 'ROLL')
               selected
             @endif>ROLL</option>
             <option value="SET" @if($item->unit == 'SET')
               selected
             @endif>SET</option>
           </select>
         </div>
       </div>

      <div class="form-group">
        <label class="col-sm-2 control-label">Brand</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" placeholder="Brand" value="{{$item->brand}}" name="brand" required>
        </div>
      </div>

      <div class="form-group">
        <label class="col-sm-2 control-label">Status</label>
        <div class="col-sm-10">
          <div class="checkbox">
            <label>
              <input type="checkbox" name="active" checked> Active
            </label>
          </div>
        </div>
      </div>


      <div class="form-group">
        <label class="col-sm-2 control-label"></label>
        <div class="col-sm-10">
          <a href="{{url('items')}}" class="btn btn-warning pull-right">Back</a>
          <input type="submit" value="Save" class="btn btn-primary">
        </div>
      </div>
      {{ Form::close() }}
    </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->

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
        {{ Form::open(array('url' => 'items/delete/'.$item->iditems, 'method' => 'delete')) }}
        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
        <button type="submit" class="btn btn-danger">Yes</button>
        {{ Form::close() }}
      </div>
    </div>
  </div>
</div>
