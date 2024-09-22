@extends('backend.layouts.app')

@section('styles')
<style type="text/css">
  .listImg{
    width:50px;
    height: 50px;
  }
</style>
@endsection

@section('content')
<!-- BEGIN: Subheader -->
<div class="m-subheader">
  <div class="mr-auto">
    <h3 class="m-subheader__title m-subheader__title--separator">Pricing Plan</h3>           
    <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
      <li class="m-nav__item m-nav__item--home">
        <a href="{{route('backend.')}}" class="m-nav__link m-nav__link--icon">
         <i class="m-nav__link-icon la la-home"></i>
       </a>
     </li>
     <li class="m-nav__separator">-</li>
     <li class="m-nav__item">
      <a href="{{route('backend.plan.index')}}" class="m-nav__link">
        <span class="m-nav__link-text">Plan
        </span>
      </a>
    </li>
    <li class="m-nav__separator">-</li>
    <li class="m-nav__item">
      <a href="{{route('backend.plan.index')}}" class="m-nav__link">
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
                Pricing Plan List
              </h3>
            </div>
          </div>

          <div class="m-portlet__head-tools">
            <ul class="m-portlet__nav">
              <li class="m-portlet__nav-item">
                <a href="{{route('backend.plan.create')}}" class="btn btn-info m-btn m-btn--custom m-btn--icon m-btn--air">
                  <span>
                    <i class="la la-plus"></i>
                    <span>Add Plan</span>
                  </span>
                </a>
              </li>
              <li class="m-portlet__nav-item"></li>
            </ul>
          </div>
          
        </div>
        <!--    <div class="data-table-block"> -->
         <div class="m-portlet__body">


          <!--begin: Datatable -->
          <div id="m_table_1_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
            <div class="row">

              <div class="col-sm-12">
               <table class="table table-striped- table-bordered table-hover table-checkable" id="m_table_plan">
                <thead>
                  <tr role="row">
                   <th>No</th>
                   <th>Name</th>
                   <th>Storage Space</th>
                   <th>File Size</th>
                   <th>File Duration</th>
                   <th>Price</th>
                   <th>Interval</th>
                   <th>Created Date</th>
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

    var table = $('#m_table_plan').DataTable({

      processing: true,

      serverSide: true,

      ajax: "{{ route('backend.plan.index') }}",

      columns: [

      {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},

      {data: 'name', name: 'name'},

      {data: 'storage_space', name: 'storage_space'},

      {data: 'size_per_file', name: 'size_per_file'},

      {data: 'file_expired_in', name: 'file_expired_in'},

      {data: 'price', name: 'price'},

      {data: 'interval', name: 'interval'},

      {data: 'created_at', name: 'created_at'},

      {data: 'action', name: 'action', orderable: false, searchable: false},

      ],
      
    });


    $(document).on('click','.deleteRecord',function(){
      var id = $(this).data("id");
      
      swal({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, deleted it!'

      }).then(function(result) {
        if (result.value) {

          mApp.blockPage({
            overlayColor: '#000000',
            type: 'loader',
            state: 'primary',
            message: 'Processing...'
          });

          setTimeout(function() {
            mApp.unblockPage();
          }, 2000);

          var url = "{{URL('backend/plan')}}";
          var dltUrl = url+"/"+id;

          $.ajax({
            type: 'POST',
            dataType: 'json',
            data: {
             id: id,
             _method: 'DELETE',
             _token:'{{ csrf_token() }}'
           },
           url: dltUrl,
           success: function (data){
            if(data.status=='success'){
              table.draw();
              toastr.success(data.message);
            }else{
             toastr.error(data.message);
           }
         }
       });
        }else if (result.dismiss === 'cancel') {
          swal(
            'Cancelled',
            'Your record is safe :)',
            'error'
            )
        }
      });
    });

  });
</script>
@endsection