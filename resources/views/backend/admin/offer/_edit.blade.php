 <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">{{__("offer.Edit Offer")}}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <i aria-hidden="true" class="ki ki-close"></i>
            </button>
         </div>

        <form action="{{ url('admin/offer/update') }}" method="post">
           {{ csrf_field() }}
           <input type="hidden" name="id"  value="{{ $offer->id }}">
         <div class="modal-body">
            <div class="row">
               <div class="col-md-6">
                  <div class="form-group">
                     <label><span class="text-success"><b>{{__("offer.School ID")}}</b></span> {{ $user->school_id }}</label>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-6">
                  <div class="form-group">
                     <label>{{__("offer.Salary (Monthly) (¥)")}} <span class="required">*</span></label>
                     <input type="text" name="salary" value="{{ $offer->salary }}" required placeholder="{{__("offer.Salary (Monthly) (¥)")}}" class="form-control form-control-lg form-control-solid">
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="form-group">
                     <label>{{__("offer.Tax(Salary)")}} <span class="required">*</span></label>
                     <select name="tax_salary_id" required class="form-control form-control-lg form-control-solid">
                        @foreach($get_tax_salary as $tax_salary)
                          <option {{ ($offer->tax_salary_id == $tax_salary->id) ? 'selected' : '' }} value="{{ $tax_salary->id }}">{{ $tax_salary->getName() }}</option>
                        @endforeach
                     </select>
                  </div>
               </div>
            </div>

            <div class="row">
               <div class="col-md-12">
                  <div class="form-group">
                     <label>{{__("offer.Holidays")}} </label>
                     <textarea class="form-control form-control-lg form-control-solid" name="holiday" placeholder="{{__("offer.Holidays")}}">{{ $offer->holiday }}</textarea>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-6">
                  <div class="form-group">
                     <label>{{__("offer.Flights")}}</label>
                     <input type="text" name="flights" value="{{ $offer->flights }}"  placeholder="{{__("offer.Flights")}}" class="form-control form-control-lg form-control-solid">
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="form-group">
                     <label>{{__("offer.Contract Length")}} <span class="required">*</span></label>
                     <input type="text" name="contract_length"  value="{{ $offer->contract_length }}" required placeholder="{{__("offer.Contract Length")}}" class="form-control form-control-lg form-control-solid">
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-6">
                  <div class="form-group">
                     <label>{{__("offer.Insurance")}}</label>
                     <input type="text" name="insurance" value="{{ $offer->insurance }}"  placeholder="{{__("offer.Insurance")}}" class="form-control form-control-lg form-control-solid">
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="form-group">
                     <label>{{__("offer.Start Date")}} <span class="required">*</span></label>
                     <input type="date" name="start_date" value="{{ $offer->start_date }}" required placeholder="{{__("offer.Start Date")}}" class="form-control form-control-lg form-control-solid">
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-6">
                  <div class="form-group">
                     <label>{{__("offer.Apartment")}}</label>
                     <input type="text" name="apartment" value="{{ $offer->apartment }}" placeholder="{{__("offer.Apartment")}}" class="form-control form-control-lg form-control-solid">
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="form-group">
                     <label>{{__("offer.Bonus")}}</label>
                     <input type="text" name="bonus" value="{{ $offer->bonus }}" placeholder="{{__("offer.Bonus")}}" class="form-control form-control-lg form-control-solid">
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-6">
                  <div class="form-group">
                     <label>{{__("offer.Offer Expired Date")}} <span class="required">*</span></label>
                     <input type="date" name="expired_date" value="{{ $offer->expired_date }}" required placeholder="v" class="form-control form-control-lg form-control-solid">
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-12">
                  <div class="form-group">
                     <label>{{__("offer.Notes")}}</label>
                     <textarea class="form-control form-control-lg form-control-solid" name="note" placeholder="{{__("offer.Notes")}}">{{ $offer->note }}</textarea>
                  </div>
               </div>
            </div>
         </div>
         <div class="modal-footer">
            <button type="submit" class="btn btn-success font-weight-bold">{{__("offer.Update")}}</button>
         </div>

       </form>

      </div>
   </div>