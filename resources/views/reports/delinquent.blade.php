@extends('layouts.app')
@section("breadcrumb")
<li class="breadcrumb-item"><a href="#">@lang('menu.reports')</a></li>
<li class="breadcrumb-item active">@lang('fleet.monthlyReport')</li>
@endsection
@section('content')

<div class="row">
  <div class="col-md-12">
    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title">@lang('fleet.monthlyReport')
        </h3>
      </div>
     
 
      <div class="card-body">
        {!! Form::open(['route' => 'reports.delinquent','method'=>'post','class'=>'form-inline']) !!}
        <div class="row">
         
          <div class="form-group" style="margin-right: 10px">
            {!! Form::label('month', __('fleet.month'), ['class' => 'form-label']) !!}
            <div class="form-group" style="margin-left:5px;">
            {!! Form::selectMonth('month',$month_select,['class'=>'form-control']) !!}</div>
          </div>
         
          <button type="submit" class="btn btn-info" style="margin-right: 10px">@lang('fleet.generate_report')</button>
        </div>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>
    

@if(isset($search))
<div class="row">
  <div class="col-md-12">
    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title">
          @lang('fleet.report')
        </h3>
      </div>
 <div class="card-body table-responsive">
           <table id="example" class="display nowrap table-bordered" style="width:100%">
        <thead>
            <tr>
                 <th>#</th>
                                
                                 <th>Vehicle No</th>
                                <th>Bill Report</th>
                                 <th>Download Report</th>
                               <th>No.of wheeler</th>
                                <th>Date of Alignment</th>
                              
                                
            </tr>
        </thead>
        <tbody>
            @php 
            $sno=1;
            @endphp
            @foreach($search as $value)
            
          
          
            
           <tr>
                <td>{{$sno++}}</td>
                 <td>{{$value->vehicle_no ?? 0}}</td>
                <td>{{$value->image ?? ''}}
                
                
                </td>
                
                <td>
                  
                    <a href="{{ asset('uploads/tyre/'.$value->image) }}" download>
  Download
</a>
                </td>
               <td>{{$value->odometer ?? 0}}</td>
              
              <td>{{$value->date ?? 0}}</td>
            </tr>
            
       
            @endforeach
         
        </tbody>
       
    </table>
          
       
      </div>
    </div>
  </div>
</div>
@endif

 

@endsection


@section("script")
<script type="text/javascript">
  $(document).ready(function() {
    $('#vehicle_id').select2();
      $('.myTable').DataTable({
        "paging":   false,
        "ordering": false,
        "searching": false,
        "info":     false,

        dom: 'Bfrtip',
        buttons: [{
             extend: 'collection',
                text: '@lang('fleet.Export')',
                buttons: [
                    'copy',
                    'excel',
                    'csv',
                    'pdf',
                ]}
        ],
        "language": {
                 "url": '{{ asset("assets/datatables/")."/".__("fleet.datatable_lang") }}',
              }
    });

    $('.expTable').DataTable({
      "ordering": false,
      "searching": false,
      "info":     false,
      "pageLength": 5,
      dom: 'Bfrtip',
      buttons: [{
           extend: 'collection',
              text: '@lang('fleet.Export')',
              buttons: [
                  'copy',
                  'excel',
                  'csv',
                  'pdf',
              ]}
      ],
      "language": {
               "url": '{{ asset("assets/datatables/")."/".__("fleet.datatable_lang") }}',
            }
    });
  });
</script>
@endsection