<div class="d-flex flex-column-fluid">
   <!--begin::Container-->
   <div class=" container ">
      <!-- begin::Card-->
      <div class="card card-custom overflow-hidden">
         <div class="card-body p-0">
            
         <form action="" method="post">
             {{ csrf_field() }}

            <div class="row justify-content-center bgi-size-cover bgi-no-repeat py-8 px-8 py-md-27 px-md-0" style="background-image: url({{url('assets/media/bg/bg-6.jpg')}});">
               <div class="col-md-9">

                  <div class="d-flex justify-content-between pb-10 pb-md-20 flex-column flex-md-row">
                     <h1 class="display-4 text-white font-weight-boldest mb-10">{{__("invoice.INVOICE")}}</h1>
                     <div class="d-flex flex-column align-items-md-end px-0">
                        <!--begin::Logo-->
                        <a href="javascript:;" class="mb-5">
                        <input type="text" name="company_name" value="{{ !empty($invoice) ? $invoice->company_name : '' }}" required placeholder="{{__("invoice.My Company Name")}}" class="form-control">
                        </a>
                        <!--end::Logo-->
                        <span class="text-white d-flex flex-column align-items-md-end ">
                        <span><input type="text" required name="address" value="{{ !empty($invoice) ? $invoice->address : '' }}" placeholder="{{__("invoice.Address")}}" class="form-control"></span>
                        <span><input type="text" required name="post_code" value="{{ !empty($invoice) ? $invoice->post_code : '' }}" placeholder="{{__("invoice.Post Code")}}" class="form-control"></span>
                        <span><input type="text" required name="phone_number" value="{{ !empty($invoice) ? $invoice->phone_number : '' }}" placeholder="{{__("invoice.Phone number")}}" class="form-control"></span>
                        </span>
                     </div>
                  </div>

                  <div class="border-bottom w-100 opacity-20"></div>

                  <div class="d-flex justify-content-between text-white pt-6">
                     <div class="d-flex flex-column flex-root">
                        <span class="font-weight-bolde mb-2r">{{__("invoice.DATE")}}</span>
                        <span class="">
                        <input type="date" name="invoice_date" value="{{ !empty($invoice) ? $invoice->invoice_date : '' }}" required style="width: 200px" placeholder="{{__("invoice.DATE")}}" class="form-control">
                        </span>
                     </div>
                     <div class="d-flex flex-column flex-root">
                        <span class="font-weight-bolder mb-2">{{__("invoice.INVOICE NO.")}}</span>
                        <span><input type="text" name="invoice_number" value="{{ !empty($invoice) ? $invoice->invoice_number : '' }}" style="width: 200px" required placeholder="{{__("invoice.INVOICE NO.")}}" class="form-control"></span>
                     </div>
                     <div class="d-flex flex-column flex-root">
                        <span class="font-weight-bolder mb-2">{{__("invoice.INVOICE TO.")}}</span>
                        <span>
                        <textarea class="form-control" name="invoice_to" placeholder="{{__("invoice.INVOICE TO.")}}" required="">{{ !empty($invoice) ? $invoice->invoice_to : '' }}</textarea>
                        </span>
                     </div>
                  </div>

               </div>
            </div>
           
            <div class="row justify-content-center py-8 px-8 py-md-10 px-md-0">

               <div class="col-md-9">
                  <div class="table-responsive">
                     <table class="table">
                        <thead>
                           <tr>
                              <th class="pl-0 font-weight-bold text-muted  text-uppercase">{{__("invoice.Description")}}</th>
                              <th class="text-left font-weight-bold text-muted text-uppercase">{{__("invoice.Type")}}</th>
                              <th width="20%" class="text-left pr-0 font-weight-bold text-muted text-uppercase">{{__("invoice.Amount")}}</th>
                              <th class="text-left pr-0 font-weight-bold text-muted text-uppercase">{{__("invoice.Action")}}</th>
                           </tr>
                        </thead>
                        <tbody id="getNewRow">

                            @if(!empty($invoice))
                              @forelse($invoice->item as $item)
                                 <tr class="font-weight-boldest font-size-lg">
                                    <td class="pl-0 pt-7">
                                       <input type="hidden" value="{{ $item->id }}" name="row[{{ $item->id }}][id]" class="form-control">

                                       <input type="text" placeholder="{{__("invoice.Description")}}" value="{{ $item->description }}" required name="row[{{ $item->id }}][description]" class="form-control">
                                    </td>
                                    <td class="text-right pt-7">
                                       <input type="text" placeholder="{{__("invoice.Type")}}" required value="{{ $item->type }}" name="row[{{ $item->id }}][type]"  class="form-control">
                                    </td>
                                    <td class="text-danger pr-0 pt-7 text-right">
                                       <input type="text" placeholder="{{__("invoice.Amount")}}" required value="{{ $item->amount }}" name="row[{{ $item->id }}][amount]"  class="form-control getAmount">
                                    </td>
                                    <td class="text-danger pr-0 pt-7 text-right">
                                       <a onclick="return confirm('{{__("invoice.Are you sure you want to delete?")}}')" href="{{ url('admin/user/invoice/item_delete/'.$item->id) }}" class="btn btn-danger btn-sm">{{__("invoice.Delete")}}</a>
                                    </td>
                                 </tr>
                              @empty
                              @endforelse

                              <tr class="font-weight-boldest font-size-lg">
                                 <td class="pl-0 pt-7">
                                    <input type="text" placeholder="{{__("invoice.Description")}}"  name="row[0][description]" class="form-control">
                                 </td>
                                 <td class="text-right pt-7">
                                    <input type="text" placeholder="{{__("invoice.Type")}}"  name="row[0][type]"  class="form-control">
                                 </td>
                                 <td class="text-danger pr-0 pt-7 text-right">
                                    <input type="text" placeholder="{{__("invoice.Amount")}}"  name="row[0][amount]"  class="form-control getAmount">
                                 </td>
                                 <td class="text-danger pr-0 pt-7 text-right">
                                    <button type="button" id="addNewRow" class="btn btn-success btn-sm">{{__("invoice.Add")}}</button>
                                 </td>
                              </tr>


                           @else

                              <tr class="font-weight-boldest font-size-lg">
                                 <td class="pl-0 pt-7">
                                    <input type="text" placeholder="{{__("invoice.Description")}}" required name="row[0][description]" class="form-control">
                                 </td>
                                 <td class="text-right pt-7">
                                    <input type="text" placeholder="{{__("invoice.Type")}}" required name="row[0][type]"  class="form-control">
                                 </td>
                                 <td class="text-danger pr-0 pt-7 text-right">
                                    <input type="text" placeholder="{{__("invoice.Amount")}}" required name="row[0][amount]"  class="form-control getAmount">
                                 </td>
                                 <td class="text-danger pr-0 pt-7 text-right">
                                    <button type="button" id="addNewRow" class="btn btn-success btn-sm">{{__("invoice.Add")}}</button>
                                 </td>
                              </tr>

                           @endif


                          

                        </tbody>
                     </table>
                  </div>
               </div>

            </div>


            <div class="row justify-content-center bg-gray-100 py-8 px-8 py-md-10 px-md-0">
               <div class="col-md-9">
                  <div class="d-flex justify-content-between flex-column flex-md-row font-size-lg">
                     <div class="d-flex flex-column mb-10 mb-md-0">
                        <div class="font-weight-bolder font-size-lg mb-3">{{__("invoice.BANK TRANSFER")}}</div>
                        <div class="d-flex justify-content-between mb-3">
                           <span class="mr-15 font-weight-bold">{{__("invoice.Account Name")}}:</span>
                           <span class="text-right"><input type="text" value="{{ !empty($invoice) ? $invoice->account_name : '' }}" placeholder="{{__("invoice.Account Name")}}" required name="account_name" style="width: 200px" class="form-control"></span>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                           <span class="mr-15 font-weight-bold">{{__("invoice.Account Number")}}:</span>
                           <span class="text-right"><input type="text" value="{{ !empty($invoice) ? $invoice->account_number : '' }}" placeholder="{{__("invoice.Account Number")}}" required name="account_number" style="width: 200px" class="form-control"></span>
                        </div>
                        <div class="d-flex justify-content-between">
                           <span class="mr-15 font-weight-bold">{{__("invoice.Tax No.")}}:</span>
                           <span class="text-right"><input type="text" value="{{ !empty($invoice) ? $invoice->tax_no : '' }}" placeholder="{{__("invoice.Tax No.")}}" name="tax_no" style="width: 200px" class="form-control"></span>
                        </div>
                     </div>
                     <div class="d-flex flex-column text-md-right">
                        <span class="font-size-lg font-weight-bolder mb-1">{{__("invoice.TOTAL AMOUNT")}}</span>
                        <span class="font-size-h2 font-weight-boldest text-danger mb-1">¥<span id="getTotal">{{ !empty($invoice) ? $invoice->total : 0 }}</span></span>
                        <span>{{__("invoice.Taxes Included")}}</span>
                        <input type="hidden" value="{{ !empty($invoice) ? $invoice->total : 0 }}" name="total" id="getFinalTotal">
                     </div>
                  </div>
               </div>
            </div>


            
            <div class="row justify-content-center py-8 px-8 py-md-10 px-md-0">
               <div class="col-md-9">
                  <div class="d-flex justify-content-between">
                     <button type="submit" class="btn btn-success font-weight-bold" >{{__("invoice.Save")}}</button>
                  </div>
               </div>
            </div>

         </form>

            
         </div>
      </div>
      <!-- end::Card-->
   </div>
   <!--end::Container-->
</div>


@section('script')
<script type="text/javascript">
   var i = 50000;
$('body').delegate('#addNewRow','click',function(){

         var html = '<tr id="deleteRow'+i+'" class="font-weight-boldest font-size-lg">\n\
                  <td class="pl-0 pt-7">\n\
                     <input type="text" placeholder="{{__("invoice.Description")}}" required name="row['+i+'][description]" class="form-control">\n\
                  </td>\n\
                  <td class="text-right pt-7">\n\
                     <input type="text" placeholder="{{__("invoice.Type")}}" required name="row['+i+'][type]" class="form-control">\n\
                  </td>\n\
                  <td class="text-danger pr-0 pt-7 text-right">\n\
                     <input type="text" placeholder="{{__("invoice.Amount")}}" required name="row['+i+'][amount]" class="form-control getAmount">\n\
                  </td>\n\
                  <td class="text-danger pr-0 pt-7 text-right">\n\
                     <button type="button"  id="'+i+'" class="btn btn-danger btn-sm deleteNewRow">{{__("invoice.Delete")}}</button>\n\
                  </td>\n\
              </tr>';
        i++;

     $('#getNewRow').append(html);
});

$('body').delegate('.deleteNewRow','click',function(){
      var id = $(this).attr('id');
      $('#deleteRow'+id).remove();
});


$('body').delegate('.getAmount','keyup change blur',function(){
   var amount = 0;

   $('.getAmount').each(function(){
      var total = $(this).val();
      if(total != '') {
         amount = parseFloat(amount) + parseFloat(total);
      }
   });

   $('#getTotal').html(amount);
   $('#getFinalTotal').val(amount);


});

</script>
@endsection