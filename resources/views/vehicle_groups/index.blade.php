@extends("layouts.app")
@section("breadcrumb")
<li class="breadcrumb-item active">Tyre Service</li>
@endsection
@section('extra_css')
<style type="text/css">
  .checkbox, #chk_all{
    width: 20px;
    height: 20px;
  }
</style>
@endsection
@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title">
       Tyre Service
        &nbsp;
        @can('VehicleGroup add')<a href="{{ route('vehicle_group.create')}}" class="btn btn-success" title="Add New"><i class="fa fa-plus"></i></a>@endcan</h3>
      </div>
      
      
      
      
     
      

      <div class="card-body table-responsive">
           <table id="example" class="display nowrap table-bordered" style="width:100%">
        <thead>
            <tr>
                 <th>#</th>
                             
                               <th>Color</th>
                                 <th>Vehicle Details</th>
                                <th>Image</th>
             
              <th>Serial No</th>
              <th>Date</th>
               <th>Type Service</th>
               <th>Review</th>
                 
                                                               <th>Supervisor</th>
             
                              
                                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @php 
            $sno=1;
            @endphp
            @foreach($data as $value)
            <tr>
                <td>{{$sno++}}</td>
                
                
               <td style="background-color:{{$value->color ?? ''}}">
                   
                    
                <!--</td>-->
                </td>
                <td>{{$value->vehicle_no}}</td>
<!--                <td><img src="{{ asset('uploads/tyre/'.$value->image) }}" style="width: 55px;-->
<!--"></td>-->

<td>
 <a href="{{ asset('uploads/tyre/'.$value->image) }}" download>
  Download1
</a>

@if(!empty($value->image2))
                   <a href="{{ asset('uploads/tyre/'.$value->image2) }}" download>
  Download 2
</a>
@else


@endif
<br>

@if(!empty($value->image3))
<a href="{{ asset('uploads/tyre/'.$value->image3) }}" download>
  Download 3
</a>
@else


@endif
  
</td>
                <td>{{$value->serial ?? 0}}</td>
               <td>{{date('d-m-Y', strtotime($value->date ?? ''))}}
                {{$value->time ?? 0}}</td>
                
               <td style="color: green;">{{$value->service ?? 0}}</td>
               
              <td>{{$value->review ?? ''}}</td>
              @php
                
                $userdetail=DB::table('users')->where('id',$value->user_id)->select('name')->first();
                
                @endphp
            
                <td>{{$userdetail->name ?? ''}}</td>
                  <td>
                    
                                     <a href="{{route('trye.delete',$value->id)}}"   onclick="return confirm('Are you sure you want to delete?');" class="btn btn-danger">Delete</a>
                </td>
            </tr>
            @endforeach
         
        </tbody>
       
    </table>
          
       
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div id="bulkModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">@lang('fleet.delete')</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        {!! Form::open(['url'=>'admin/delete-vehicle-groups','method'=>'POST','id'=>'form_delete']) !!}
        <div id="bulk_hidden"></div>
        <p>@lang('fleet.confirm_bulk_delete')</p>
      </div>
      <div class="modal-footer">
        <button id="bulk_action" class="btn btn-danger" type="submit" data-submit="">@lang('fleet.delete')</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">@lang('fleet.close')</button>
      </div>
        {!! Form::close() !!}
    </div>
  </div>
</div>
<!-- Modal -->

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">@lang('fleet.delete')</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <p>@lang('fleet.confirm_delete')</p>
      </div>
      <div class="modal-footer">
        <button id="del_btn" class="btn btn-danger" type="button" data-submit="">@lang('fleet.delete')</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">@lang('fleet.close')</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->

@endsection

@section('script')
<script type="text/javascript">
  $("#del_btn").on("click", function () {
    var id = $(this).data("submit");
    $("#form_" + id).submit();
  });

  $('#myModal').on('show.bs.modal', function (e) {
    var id = e.relatedTarget.dataset.id;
    $("#del_btn").attr("data-submit", id);
  });
  $(document).on('click', 'input[type="checkbox"]', function () {
    if (this.checked) {
      $('#bulk_delete').prop('disabled', false);

    } else {
      if ($("input[name='ids[]']:checked").length == 0) {
        $('#bulk_delete').prop('disabled', true);
      }
    }

  });
  $(function () {
    var table = $('#ajax_data_table').DataTable({
      "language": {
        "url": '{{ asset("assets/datatables/")."/".__("fleet.datatable_lang") }}',
      },
      processing: true,
      serverSide: true,
      ajax: {
        url: "{{ url('admin/vehicle-group-fetch') }}",
        type: 'POST',
        data: {}
      },
      columns: [
        { data: 'check', name: 'check', searchable: false, orderable: false },
        { data: 'name',name: 'name' },
        { data: 'description',name: 'description' },
        { data: 'vehicle_count',name: 'vehicle_count' },       
        { data: 'user_count',name: 'user_count' },       
        { data: 'action',name: 'action',searchable: false,orderable: false }
      ],
      order: [ [1, 'desc'] ],
      "initComplete": function () {
        table.columns().every(function () {
          var that = this;
          $('input', this.footer()).on('keyup change', function () {
            // console.log($(this).parent().index());
            that.search(this.value).draw();
          });
        });
      }
    });
  });
  

  $('#bulk_delete').on('click', function () {
    // console.log($( "input[name='ids[]']:checked" ).length);
    if ($("input[name='ids[]']:checked").length == 0) {
      $('#bulk_delete').prop('type', 'button');
      new PNotify({
        title: 'Failed!',
        text: "@lang('fleet.delete_error')",
        type: 'error'
      });
      $('#bulk_delete').attr('disabled', true);
    }
    if ($("input[name='ids[]']:checked").length > 0) {
      // var favorite = [];
      $.each($("input[name='ids[]']:checked"), function () {
        // favorite.push($(this).val());
        $("#bulk_hidden").append('<input type=hidden name=ids[] value=' + $(this).val() + '>');
      });
      // console.log(favorite);
    }
  });


  $('#chk_all').on('click', function () {
    if (this.checked) {
      $('.checkbox').each(function () {
        $('.checkbox').prop("checked", true);
      });
    } else {
      $('.checkbox').each(function () {
        $('.checkbox').prop("checked", false);
      });
      $('#bulk_delete').prop('disabled', true);
    }
  });


  $('#chk_all').on('click', function () {
    if (this.checked) {
      $('.checkbox').each(function () {
        $('.checkbox').prop("checked", true);
      });
    } else {
      $('.checkbox').each(function () {
        $('.checkbox').prop("checked", false);
      });
      $('#bulk_delete').prop('disabled', true);
    }
  });

  // Checkbox checked
  function checkcheckbox() {
    // Total checkboxes
    var length = $('.checkbox').length;
    // Total checked checkboxes
    var totalchecked = 0;
    $('.checkbox').each(function () {
      if ($(this).is(':checked')) {
        totalchecked += 1;
      }
    });
    // console.log(length+" "+totalchecked);
    // Checked unchecked checkbox
    if (totalchecked == length) {
      $("#chk_all").prop('checked', true);
    } else {
      $('#chk_all').prop('checked', false);
    }
  }
</script>
@endsection