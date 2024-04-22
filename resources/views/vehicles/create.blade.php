@extends('layouts.app')
@section('extra_css')
<style type="text/css">
  .nav-tabs-custom>.nav-tabs>li.active {
    border-top-color: #00a65a !important;
  }

  /* The switch - the box around the slider */
  .switch {
    position: relative;
    display: inline-block;
    width: 60px;
    height: 34px;
  }

  /* Hide default HTML checkbox */
  .switch input {
    display: none;
  }

  /* The slider */
  .slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #ccc;
    -webkit-transition: .4s;
    transition: .4s;
  }

  .slider:before {
    position: absolute;
    content: "";
    height: 26px;
    width: 26px;
    left: 4px;
    bottom: 4px;
    background-color: white;
    -webkit-transition: .4s;
    transition: .4s;
  }

  input:checked+.slider {
    background-color: #2196F3;
  }

  input:focus+.slider {
    box-shadow: 0 0 1px #2196F3;
  }

  input:checked+.slider:before {
    -webkit-transform: translateX(26px);
    -ms-transform: translateX(26px);
    transform: translateX(26px);
  }

  /* Rounded sliders */
  .slider.round {
    border-radius: 34px;
  }

  .slider.round:before {
    border-radius: 50%;
  }

  .custom .nav-link.active {
    background-color: #21bc6c !important;
  }
</style>
<link rel="stylesheet" href="{{asset('assets/css/bootstrap-datepicker.min.css')}}">
@endsection
@section("breadcrumb")
<li class="breadcrumb-item"><a href="{{ route('vehicles.index')}}">@lang('fleet.vehicles')</a></li>
<li class="breadcrumb-item active">@lang('fleet.addVehicle')</li>


@endsection
@section('content')
<div class="row">
  <div class="col-md-12">
    @if (count($errors) > 0)
    <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
    @endif
    <div class="card card-success">
      <div class="card-header">
        <h3 class="card-title"> New Add Vehicle</h3>
      </div>

      <div class="card-body">
        <div class="tab-content">
          <div class="tab-pane active" id="info-tab">
            {!! Form::open(['route' => 'vehicles.store','files'=>true,
            'method'=>'post','class'=>'form-horizontal','id'=>'accountForm']) !!}
            {!! Form::hidden('user_id',Auth::user()->id) !!}
            <div class="row card-body">
              <div class="col-md-6">
            
               @if (session('success'))
                <div class="alert alert-success">
                      {{ session('success') }}
                          </div>
                             @endif

                <div class="form-group">
                  {!! Form::label('type_id', __('fleet.type'), ['class' => 'col-xs-5 control-label']) !!}

                  <div class="col-xs-6">
                    <select name="type_id" class="form-control" required id="type_id">
                      
                     
                      <option value="1">Truck</option>
                       <option value="2">Bus</option>
                     
                    </select>
                  </div>
                </div>
               

                <div class="form-group">
               
                 <label for="type_id" class="col-xs-5 control-label">Manufacturar</label>

                  <div class="col-xs-6">
                    {!! Form::text('manufacturar', null,['class' => 'form-control','required','id'=>'manufacturar']) !!}
                  </div>
                </div>

               

                
              

                <div class="form-group">
               

<label for="type_id" class="col-xs-5 control-label"> Adoption date</label>
                  <div class="col-xs-6">
                    <div class="input-group date">
                      <div class="input-group-prepend"><span class="input-group-text"><i
                            class="fa fa-calendar"></i></span></div>
                      {!! Form::date('date', null,['class' => 'form-control','required']) !!}
                    </div>
                  </div>
                </div>
                
              </div>

              <div class="col-md-6">
               
               

                <div class="form-group">
                 
                  <label for="type_id" class="col-xs-5 control-label">Vehicle no</label>
                  <div class="col-xs-6">
                    {!! Form::text('no', null,['class' => 'form-control','required']) !!}
                  </div>
                </div>

                <div class="form-group">
                
                   <label for="type_id" class="col-xs-5 control-label">odometer</label>
                  

                  <div class="col-xs-6">
                    {!! Form::text('odometer', null,['class' => 'form-control','required']) !!}
                  </div>
                </div>

            

                <div class="form-group">
                 
                   <label for="type_id" class="col-xs-5 control-label"> no.of wheeler</label>
                 

                  <div class="col-xs-6">
                    <div class="input-group date">
                      <div class="input-group-prepend"></div>
                      {!! Form::number('wheeler', null,['class' => 'form-control','required']) !!}
                    </div>
                  </div>
                </div>
              
                <hr>
                
                <div class="blank"></div>
              </div>
            </div>
            <div style=" margin-bottom: 20px;">
              <div class="form-group" style="margin-top: 15px;">
                <div class="col-xs-6 col-xs-offset-3">
                  {!! Form::submit(__('fleet.submit'), ['class' => 'btn btn-success']) !!}
                </div>
              </div>
            </div>
            {!! Form::close() !!}
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog" role="document">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">@lang('fleet.add_new_cat')</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <p>@lang('fleet.new_cat_text')</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">@lang('fleet.close')</button>
      </div>
    </div>
  </div>
</div>

<div id="myModal2" class="modal fade" role="dialog">
  <div class="modal-dialog" role="document">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">@lang('fleet.add_new_cat')</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <p>@lang('fleet.new_cat_text')</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">@lang('fleet.close')</button>
      </div>
    </div>
  </div>
</div>

<div id="myModal3" class="modal fade" role="dialog">
  <div class="modal-dialog" role="document">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">@lang('fleet.add_new_cat')</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <p>@lang('fleet.new_cat_text')</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">@lang('fleet.close')</button>
      </div>
    </div>
  </div>
</div>
@endsection

@section("script")
<script type="text/javascript">
  var udf_validation = "@lang('fleet.Enter_field_name')";
  $(".add_udf").click(function () {
    // alert($('#udf').val());
    var field = $('#udf1').val();
    if(field == "" || field == null){
      alert(udf_validation);
    }

    else{
      $(".blank").append('<div class="row"><div class="col-md-8">  <div class="form-group"> <label class="form-label">'+ field.toUpperCase() +'</label> <input type="text" name="udf['+ field +']" class="form-control" placeholder="Enter '+ field +'" required></div></div><div class="col-md-4"> <div class="form-group" style="margin-top: 30px"><button class="btn btn-danger" type="button" onclick="this.parentElement.parentElement.parentElement.remove();">Remove</button> </div></div></div>');
      $('#udf1').val("");
    }
  });

    $(document).ready(function() {
      $('#group_id').select2({placeholder: "@lang('fleet.selectGroup')"});
      $('#type_id').select2({placeholder:"@lang('fleet.type')"});
      $('#make_name').select2({placeholder:"@lang('fleet.SelectVehicleMake')",tags:true});
      $('#model_name').select2({placeholder:"@lang('fleet.SelectVehicleModel')",tags:true});
      $('#color_name').select2({placeholder:"@lang('fleet.SelectVehicleColor')",tags:true});
      $('#model_name').on('select2:select',()=>{
      selectionMade = true;
     
    });
    $('#make_name').on('select2:select',()=>{
      selectionMade = true;
     
    });
      $('#make_name').on('change',function(){
        // alert($(this).val());
        $.ajax({
          type: "GET",
          url: "{{url('admin/get-models')}}/"+$(this).val(),
          success: function(data){
            var models =  $.parseJSON(data);
              $('#model_name').empty();
              $('#model_name').append('<option value=""></option>');
              $.each( models, function( key, value ) {
                $('#model_name').append('<option value='+value.id+'>'+value.text+'</option>');
                $('#model_name').select2({placeholder:"@lang('fleet.SelectVehicleModel')",tags:true});
              });
          },
          dataType: "html"
    

        });
       
      });
      $('#start_date').datepicker({
          autoclose: true,
          format: 'yyyy-mm-dd'
        });
      $('#end_date').datepicker({
          autoclose: true,
          format: 'yyyy-mm-dd'
        });
      $('#exp_date').datepicker({
          autoclose: true,
          format: 'yyyy-mm-dd'
        });
      $('#lic_exp_date').datepicker({
          autoclose: true,
          format: 'yyyy-mm-dd'
        });
      $('#reg_exp_date').datepicker({
          autoclose: true,
          format: 'yyyy-mm-dd'
        });
      $('#issue_date').datepicker({
          autoclose: true,
          format: 'yyyy-mm-dd'
        });

      // Initialize Select2 on your select boxes
      // Listen for the select2:select event on the first select box

      $('#make_name').on('select2:select', function(e) {
        // Clear the contents of the second select box
        $('#model_name').val(null).trigger('change');
        $('#color_name').val(null).trigger('change');
      });

    //Flat green color scheme for iCheck
      // $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      //   checkboxClass: 'icheckbox_flat-green',
      //   radioClass   : 'iradio_flat-green'
      // });
    });

    $('#year').on('input', function(evt) {
    var inputVal = $(this).val();
    var cleanedVal = inputVal.replace(/[^0-9.]/g, '').replace(/^0+/, '');
    if (cleanedVal.length > 4) {
      cleanedVal = cleanedVal.slice(0, 4);
    }
    $(this).val(cleanedVal);
  }); 
</script>
@endsection