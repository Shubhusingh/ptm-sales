@extends('layouts.app')
@section("breadcrumb")
<li class="breadcrumb-item"><a href="{{ route('vendors.index')}}"> Fitter </a></li>
<li class="breadcrumb-item active">Fitter</li>
@endsection
@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card card-success">
      <div class="card-header">
        <h3 class="card-title">Fitter</h3>
      </div>

      <div class="card-body">
        @if (count($errors) > 0)
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
        @endif

        {!! Form::open(['route' => 'vendors.store','files'=>true,'method'=>'post']) !!}
        {!! Form::hidden('user_id',Auth::user()->id)!!}
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              {!! Form::label('photo', __('Addhar card photo'), ['class' => 'form-label']) !!}
              <br>
              {!! Form::file('photo',null,['class' => 'form-control','required']) !!}
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              {!! Form::label('name',__('Name'), ['class' => 'form-label']) !!}
              {!! Form::text('name',null,['class'=>'form-control','required']) !!}
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              {!! Form::label('phone',__('fleet.phone'), ['class' => 'form-label']) !!}
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa fa-phone"></i></span>
                </div>
                {!! Form::number('phone',null,['class'=>'form-control','required']) !!}
              </div>
            </div>
          </div>

         

          <div class="col-md-6">
            <div class="form-group">
              {!! Form::label('type', __('Roll'), ['class' => 'form-label']) !!}
              <div id="nothing">
                <select class="form-control" required onchange="select_type()" id="type" name="type">
                 <option>Fitter</option>
                </select>
              </div>
            </div>
          </div>

        

        

         

          <div class="col-md-6">
            <div class="form-group">
              {!! Form::label('city',__('Date of joining'), ['class' => 'form-label']) !!}
              {!! Form::date('city',null,['class'=>'form-control','required']) !!}
            </div>
          
            </div>
          </div>
         
        </div>
        <hr>
      
        <div class="blank"></div>
        <div class="row">
          <div class="col-md-12">
            {!! Form::submit(__('Save'), ['class' => 'btn btn-success']) !!}
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

@section("script")
<script>
  function select_type(val){
    var type=$("#type option:selected").text();
    if(type=="Add New"){
      $("#nothing").empty();
      $("#nothing").html('{!! Form::text('type',null,['class' => 'form-control','required']) !!}');
    }
  }

  $('#postal_code').on('input', function(evt) {
    var inputVal = $(this).val();
    var cleanedVal = inputVal.replace(/[^0-9.]/g, '').replace(/^0+/, '');
    if (cleanedVal.length > 10) {
      cleanedVal = cleanedVal.slice(0, 10);
    }
    $(this).val(cleanedVal);
  }); 
</script>
<script type="text/javascript">
  $(".add_udf").click(function () {
    // alert($('#udf').val());
    var field = $('#udf1').val();
    if(field == "" || field == null){
      alert('Enter field name');
    }
    else{
      $(".blank").append('<div class="row"><div class="col-md-8">  <div class="form-group"> <label class="form-label">'+ field.toUpperCase() +'</label> <input type="text" name="udf['+ field +']" class="form-control" placeholder="Enter '+ field +'" required></div></div><div class="col-md-4"> <div class="form-group" style="margin-top: 30px"><button class="btn btn-danger" type="button" onclick="this.parentElement.parentElement.parentElement.remove();">Remove</button> </div></div></div>');
      $('#udf1').val("");
    }
  });
</script>
@endsection