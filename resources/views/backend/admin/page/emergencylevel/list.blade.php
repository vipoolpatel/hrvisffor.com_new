@extends('backend.layouts.app')
@section('content')
<div class="content  d-flex flex-column flex-column-fluid" id="kt_content">
   <!--begin::Subheader-->
   <div class="subheader py-2 py-lg-12  subheader-transparent " id="kt_subheader">
      <div class=" container  d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
         <!--begin::Info-->
         <div class="d-flex align-items-center flex-wrap mr-1">
            <!--begin::Heading-->
            <div class="d-flex flex-column">
               <!--begin::Title-->
               <h2 class="text-white font-weight-bold my-2 mr-5">
                   {{ __('manage.Emergency Level') }}                                
               </h2>
               <!--end::Title-->
               <!--begin::Breadcrumb-->
               <div class="d-flex align-items-center font-weight-bold my-2">
                  <a href="" class="text-white text-hover-white opacity-75 hover-opacity-100">  {{ __('manage.Emergency Level') }}                                </a>
                  <span class="label label-dot label-sm bg-white opacity-75 mx-3"></span>
                  <a href="" class="text-white text-hover-white opacity-75 hover-opacity-100">
                    {{ __('manage.List') }}                                </a>
                  <!--end::Item-->
               </div>
               <!--end::Breadcrumb-->
            </div>
            <!--end::Heading-->
         </div>
         <!--end::Info-->
      </div>
   </div>
   <!--end::Subheader-->
   <!--begin::Entry-->
   <div class="d-flex flex-column-fluid">
      <!--begin::Container-->
      <div class=" container ">
         @include('layouts._message')
         <!--begin::Card-->
         <div class="card card-custom">
            <!--begin::Header-->
            <div class="card-header flex-wrap border-0 pt-6 pb-0">
               <div class="card-title">
                  <h3 class="card-label">
                     
                     {{ __('manage.Emergency Level List') }}    
                  </h3>
               </div>
               <div class="card-toolbar">
                  <!--begin::Button-->
                  <a href="{{ url('admin/emergencylevel/add') }}" class="btn btn-primary font-weight-bolder">
                     <i class="flaticon2-plus-1"></i>    {{ __('manage.Add') }} 
                  </a>
                  <!--end::Button-->
               </div>
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body">
               <!--begin: Datatable-->
               <div class="datatable datatable-bordered datatable-head-custom" id="common_datatable"></div>
               <!--end: Datatable-->
            </div>
            <!--end::Body-->
         </div>
         <!--end::Card-->
      </div>
      <!--end::Container-->
   </div>
   <!--end::Entry-->
</div>
@endsection

@section('script')



<script type="text/javascript">    

   var KTAppsUsersListDatatable = function() {
      // Private functions

      // basic demo
      var _demo = function() {
             var datatable = $('#common_datatable').KTDatatable({
            // datasource definition
            data: {
               type: 'remote',
               source: {
                  read: {
                     url: '{{ url('admin/emergencylevel/get_emergencylevel_list') }}?_token={{ csrf_token() }}',
                  },
               },
               pageSize: 20, // display 20 records per page
               serverPaging: true,
               serverFiltering: true,
               serverSorting: true,
            },
            // column sorting
            sortable: false,
            pagination: true,
            // columns definition
            columns: [
               {
                  field: 'id',
                  title: '#',
                  width: 40,
                  textAlign: 'left',
                  template: function(data) {
                     return '<span class="font-weight-bolder">' + data.id + '</span>';
                  }
               },
               {
                  field: 'name',
                  title: '{{ __('manage.name') }}',
                  template: function(row) {
                     return row.name;
                  }
               },          
               {
                  field: 'ch_name',
                  title: '{{ __('manage.china name') }}',
                  template: function(row) {
                     return row.ch_name;
                  }
               },
                 {
                  field: 'action',
                  title: '{{ __('manage.Action') }}',
                  template: function(row) {
                     return row.action;
                  }
               }
               ],
         });

        
      };

      return {
         init: function() {
            _demo();
         },
      };
   }();

   jQuery(document).ready(function() {
      KTAppsUsersListDatatable.init();
   });

</script>


@endsection
