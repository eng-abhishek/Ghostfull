@extends('backend.layouts.app')

@section('styles')
<style type="text/css">
  #logo{
    width:50px;
    height: 50px;
  }
  .switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

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

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}
</style>
@endsection

@section('content')
<!-- BEGIN: Subheader -->
<div class="m-subheader">
  <div class="mr-auto">
    <h3 class="m-subheader__title m-subheader__title--separator">Payment Gateway Setting</h3>           
    <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
      <li class="m-nav__item m-nav__item--home">
        <a href="{{route('backend.')}}" class="m-nav__link m-nav__link--icon">
         <i class="m-nav__link-icon la la-home"></i>
       </a>
     </li>
     <li class="m-nav__separator">-</li>
     <li class="m-nav__item">
      <a href="javascript:void(0)" class="m-nav__link">
        <span class="m-nav__link-text">Setting
        </span>
      </a>
    </li>
    <li class="m-nav__separator">-</li>
    <li class="m-nav__item">
      <a href="{{route('backend.setting.payment-gateway.index')}}" class="m-nav__link">
        <span class="m-nav__link-text">Payment Gateway
        </span>
      </a>
    </li>
    <li class="m-nav__separator">-</li>
    <li class="m-nav__item">
      <a href="{{route('backend.setting.payment-gateway.index')}}" class="m-nav__link">
        <span class="m-nav__link-text">List</span>
      </a>
    </li>
  </ul>
</div>
</div>
<!-- END: Subheader -->
<div class="m-content">
	@include('frontend.layouts.partials.alert-messages')
  <div class="row">
    <div class="col-sm-12">
      <div class="m-portlet m-portlet--mobile">

        <div class="m-portlet__head">
          <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
              <h3 class="m-portlet__head-text">
                Payment Gateway List
              </h3>
            </div>
          </div>
        </div>
        <!--    <div class="data-table-block"> -->
         <div class="m-portlet__body">


          <!--begin: Datatable -->
          <div id="m_table_1_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
            <div class="row">

              <div class="col-sm-12">
               <table class="table table-striped- table-bordered table-hover table-checkable" id="m_table_1">
                <thead>
                  <tr role="row">
                   <th>No</th>
                   <th>Name</th>
                   <th>Logo</th>
                   <th>Fees</th>
                   <th>Status</th>
                   <th>Last Update</th>
                   <th>Action</th>
                 </tr>
               </thead>
               <tbody>

               </tbody>
             </table>
           </div>
         </div>
       </div>
     </div>
   </div>
 </div>
</div>
</div>
@endsection

@section('scripts')
<script>

  $(function () {

    var table = $('#m_table_1').DataTable({

      processing: true,

      serverSide: true,

      ajax: "{{ route('backend.setting.payment-gateway.index') }}",

      columns: [

      {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},

      {data: 'name', name: 'name'},

      {data: 'logo', name: 'logo'},

      {data: 'fees', name: 'fees'},

      {data: 'status', name: 'status'},
      
      {data: 'updated_at', name: 'updated_at'},

      {data: 'action', name: 'action', orderable: false, searchable: false},

      ],
      
    });

    $(document).on( 'click', '#updateStatus', function () {

      mApp.blockPage({
        overlayColor: '#000000',
        type: 'loader',
        state: 'primary',
        message: 'Processing...'
      });

      setTimeout(function() {
        mApp.unblockPage();
      }, 2000);

      var id = $(this).attr("data-id");
      var is_active;  
      if($('.is_active'+id).is(":checked")){
        is_active='Y';
      }else{
        is_active='N';  
      }

      swal({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, changed it!'

      }).then(function(result) {
        if (result.value) {

          $.ajax({
            url:"{{route('backend.setting.payment-gateway.change-status')}}",
            method:'post',
            data:{is_active:is_active,id:id,"_token":'{{ csrf_token() }}'},  
            success:function(data){
              if(data.status=='success'){
                toastr.success(data.message);
                table.draw();  
              }else{
                $('.is_active'+id).prop("checked",false);
                toastr.error(data.message);
              }

            }
          });
        }else if (result.dismiss === 'cancel'){

          if($('.is_active'+id).is(":checked")){

            $('.is_active'+id).prop("checked",false);
          }else{
            $('.is_active'+id).prop("checked",true);
          }
          swal(
            'Cancelled',
            'Your status do not change:)',
            'error'
            )
        }
      })
    });


  });
</script>
@endsection