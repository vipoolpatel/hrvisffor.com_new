@extends('backend.layouts.app')
@section('style')
<style type="text/css">
   .form-group {
     margin-bottom: 8px;
   }
   .required {
         color: red;
   }
   select {
       -moz-appearance:none; /* Firefox */
      -webkit-appearance:none; /* Safari and Chrome */
       appearance:none;
   }
</style>
@endsection
@section('content')
<div class="content  d-flex flex-column flex-column-fluid" id="kt_content">
   <div class="subheader py-2 py-lg-12  subheader-transparent " id="kt_subheader">
      <div class=" container  d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
         <div class="d-flex align-items-center flex-wrap mr-1">
            <button class="burger-icon burger-icon-left mr-4 d-inline-block d-lg-none" id="kt_subheader_mobile_toggle">
            <span></span>
            </button>
            <div class="d-flex flex-column">
               <h2 class="text-white font-weight-bold my-2 mr-5">
                  {{__("profile.Position View")}}
               </h2>
            </div>
         </div>
      </div>
   </div>
   <div class="d-flex flex-column-fluid">
      <div class=" container ">
         <div class="d-flex flex-row">
            @include('backend.layouts._sidebar_school')
            <div class="flex-row-fluid ml-lg-8">
               @include('layouts._message')
               <div class="card card-custom card-stretch">
                  <div class="card-header py-3">
                     <div class="card-title align-items-start flex-column">
                        <h3 class="card-label font-weight-bolder text-dark">{{__("profile.Position View")}}</h3>
                     </div>
                  </div>

                     <div class="card-body" style="padding-top: 15px;">
                      
                        <div class="datatable datatable-bordered datatable-head-custom" id="common_datatable"></div>

                     </div>

               </div>
            </div>
         </div>
      </div>
   </div>
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
                     url: '{{ url('school/profile-view') }}?_token={{ csrf_token() }}',
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
                  title: '{{__("profile.Teacher Name")}}',
                  template: function(row) {
                     return row.name;
                  }
               },
               {
                  field: 'teacher_id',
                  title: '{{__("profile.Teacher ID")}}',
                  template: function(row) {
                     return row.teacher_id;
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
