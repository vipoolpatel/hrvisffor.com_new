@extends('backend.layouts.app')
@section('style')
<style type="text/css">
   .interview-table tr td {
   padding-right: 10px;
   padding-top: 10px;
   padding-bottom: 10px;
   }
   .interview-table tr th {
   padding-right: 10px;
   }
</style>
@endsection
@section('content')
<div class="content  d-flex flex-column flex-column-fluid" id="kt_content">
   <!--begin::Subheader-->
  



<div class="subheader py-2 py-lg-12  subheader-transparent " id="kt_subheader">
   <div class=" container  d-flex  justify-content-between flex-wrap ">
      <h2 class="text-white font-weight-bold my-2 mr-5" style="margin-bottom: 20px !important;">{{__("invoice.Invoice")}} (@if($user->is_admin == 3) {{ $user->school_name }} @else {{ $user->name }} @endif)
      </h2>
      <a href="{{ url('admin/user/invoice/add/'.$user->id) }}" class="btn btn-transparent-white font-weight-bold  py-3 px-6 mr-2" style="margin-bottom: 15px;">
      <i class="flaticon2-plus-1"></i> {{__("invoice.Add")}}
      </a>
   </div>
</div>







   <div class="d-flex flex-column-fluid">
      <div class=" container ">
         @include('layouts._message')
        





@foreach($get_invoice as $value)


<div class="card card-custom overflow-hidden" style="margin-bottom: 20px;">
   <div class="card-body p-0">
      <!-- begin: Invoice-->
      <!-- begin: Invoice header-->
      <div class="row justify-content-center bgi-size-cover bgi-no-repeat py-8 px-8 py-md-27 px-md-0" style="background-image: url({{ url('assets/media/bg/bg-6.jpg') }});">
         <div class="col-md-9">
            <div class="d-flex justify-content-between pb-10 pb-md-20 flex-column flex-md-row">
               <h1 class="display-4 text-white font-weight-boldest mb-10">{{__("invoice.INVOICE")}}</h1>
               <div class="d-flex flex-column align-items-md-end px-0">
                  <!--begin::Logo-->
                  <h2 class="mb-5 text-white">
                  {{ $value->company_name }}
                  </h2>
                  <!--end::Logo-->
                  <span class="text-white d-flex flex-column align-items-md-end opacity-70">
                  <span>{{ $value->address }}, {{ $value->post_code }}</span>
                  <span>{{ $value->phone_number }}</span>
                  </span>
               </div>
            </div>
            <div class="border-bottom w-100 opacity-20"></div>
            <div class="d-flex justify-content-between text-white pt-6">
               <div class="d-flex flex-column flex-root">
                  <span class="font-weight-bolde mb-2r">{{__("invoice.DATE")}}</span>
                  <span class="opacity-70">{{ date('M d, Y',strtotime($value->invoice_date)) }}</span>
               </div>
               <div class="d-flex flex-column flex-root">
                  <span class="font-weight-bolder mb-2">{{__("invoice.INVOICE NO.")}}</span>
                  <span class="opacity-70">{{ $value->invoice_number }}</span>
               </div>
               <div class="d-flex flex-column flex-root">
                  <span class="font-weight-bolder mb-2">{{__("invoice.INVOICE TO.")}}</span>
                  <span class="opacity-70">{{ $value->invoice_to }}</span>
               </div>
            </div>
         </div>
      </div>
      <!-- end: Invoice header-->
      <!-- begin: Invoice body-->
      <div class="row justify-content-center py-8 px-8 py-md-10 px-md-0">
         <div class="col-md-9">
            <div class="table-responsive">
               <table class="table">
                  <thead>
                     <tr>
                        <th class="pl-0 font-weight-bold text-muted  text-uppercase">{{__("invoice.Description")}}</th>
                        <th class="text-left font-weight-bold text-muted text-uppercase">{{__("invoice.Type")}}</th>
                        <th width="20%" class="text-left pr-0 font-weight-bold text-muted text-uppercase">{{__("invoice.Amount")}}</th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach($value->item as $item)
                     <tr class="font-weight-boldest font-size-lg">
                        <td class="pl-0 pt-7">{{ $item->description }}</td>
                        <td class="text-left pt-7">{{ $item->type }}</td>
                        <td class="text-left pt-7">¥{{ number_format($item->amount,2) }}</td>
                        
                     </tr>
                     @endforeach
                  </tbody>
               </table>
            </div>
         </div>
      </div>
      <!-- end: Invoice body-->
      <!-- begin: Invoice footer-->
      <div class="row justify-content-center bg-gray-100 py-8 px-8 py-md-10 px-md-0">
         <div class="col-md-9">
            <div class="d-flex justify-content-between flex-column flex-md-row font-size-lg">
               <div class="d-flex flex-column mb-10 mb-md-0">
                  <div class="font-weight-bolder font-size-lg mb-3">{{__("invoice.BANK TRANSFER")}}</div>
                  <div class="d-flex justify-content-between mb-3">
                     <span class="mr-15 font-weight-bold">{{__("invoice.Account Name")}}:</span>
                     <span class="text-right">{{ $value->account_name }}</span>
                  </div>
                  <div class="d-flex justify-content-between mb-3">
                     <span class="mr-15 font-weight-bold">{{__("invoice.Account Number")}}:</span>
                     <span class="text-right">{{ $value->account_number }}</span>
                  </div>
                  <div class="d-flex justify-content-between">
                     <span class="mr-15 font-weight-bold">{{__("invoice.Tax No.")}}:</span>
                     <span class="text-right">{{ $value->tax_no }}</span>
                  </div>
               </div>
               <div class="d-flex flex-column text-md-right">
                  <span class="font-size-lg font-weight-bolder mb-1">{{__("invoice.TOTAL AMOUNT")}}</span>
                  <span class="font-size-h2 font-weight-boldest text-danger mb-1">${{ number_format($value->total,2) }}</span>
                  <span>{{__("invoice.Taxes Included")}}</span>
               </div>
            </div>
         </div>
      </div>
      <!-- end: Invoice footer-->
      <!-- begin: Invoice action-->
      <div class="row justify-content-center py-8 px-8 py-md-10 px-md-0">
         <div class="col-md-9">
            <div class="">
             
               <a href="{{ url('admin/user/invoice/edit/'.$value->id) }}" class="btn btn-icon btn-light btn-hover-primary btn-sm">
                  <i class="flaticon-edit-1"></i>
               </a>

               <a href="{{ url('admin/user/invoice/delete/'.$value->id) }}" onclick="return confirm('{{__("invoice.Are you sure you want to delete?")}}')" class="btn btn-icon btn-light btn-hover-primary btn-sm">
                  <i class="flaticon2-trash"></i>
               </a>

            </div>
         </div>
      </div>
      <!-- end: Invoice action-->
      <!-- end: Invoice-->
   </div>
</div>



@endforeach























        


   

           <div class="row col-md-12">
              <div class="d-flex justify-content-between align-items-center flex-wrap" style="margin: auto;">
                 <div class="d-flex flex-wrap mr-3">      
                      {!! $get_invoice->links() !!}
                 </div>
              </div>
            </div>



      </div>
   </div>
</div>


@endsection
@section('script')

<script type="text/javascript">

</script>

@endsection