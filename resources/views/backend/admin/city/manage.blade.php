@extends('backend.layouts.app')
@section('style')
<style type="text/css">
   .required {
      color:  red;
   }
</style>
@endsection
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
                           {{ __('manage.Manage City Profile') }}                        
               </h2>
               <!--end::Title-->
            </div>
            <!--end::Heading-->
         </div>
         <!--end::Info-->
         <!--begin::Toolbar-->
         <!--end::Toolbar-->
      </div>
   </div>
   <!--end::Subheader-->
   <!--begin::Entry-->
   <div class="d-flex flex-column-fluid">
      <!--begin::Container-->
      <div class=" container ">
         <!--begin::Card-->
         @include('layouts._message')
         <div class="card card-custom">
            <!--begin::Card body-->
            <div class="card-header py-3">
               <div class="card-title align-items-start flex-column">
                  <h3 class="card-label font-weight-bolder text-dark">
                    {{ __('manage.Manage City Profile') }} </h3>
               </div>
            </div>

            <form action="" method="post" enctype="multipart/form-data">
               {{ csrf_field() }}
            <div class="card-body px-0" style="padding-top: 10PX;">
               <div class="card-body" style="padding-top: 0px;">

                 <div class="row">
                     <div class="col-md-12">
                        <div class="form-group">
                           <label class="col-form-label">{{ __('manage.Title') }} </label>
                           <input type="text" name="title" value="{{ !empty($profile_city->title) ? $profile_city->title : '' }}" placeholder="{{ __('manage.About Beijing') }}" class="form-control form-control-lg form-control-solid">
                        </div>
                     </div>
                  </div>

                  <div class="row">
                     <div class="col-md-12">
                        <div class="form-group">
                           <label class="col-form-label">{{ __('manage.About City') }} </label>
                           <textarea placeholder="{{ __('manage.About City') }}" name="about_city" class="form-control form-control-lg form-control-solid">{{ !empty($profile_city->about_city) ? $profile_city->about_city : '' }}</textarea>
                        </div>
                     </div>
                  </div>

                   <div class="row">
                       <div class="col-md-12">
                        <div class="form-group">
                           <label class="col-form-label">{{ __('manage.About City Video') }}</label>
                           <div class="uppy" id="kt_uppy_5">
                              <div class="uppy-wrapper">
                                 <div class="uppy-Root uppy-FileInput-container">
                                    <input class="uppy-FileInput-input uppy-input-control city_video" accept="video/*" type="file" name="city_video" id="kt_uppy_5_input_control">
                                    <label class="uppy-input-label btn btn-light-primary btn-sm btn-bold" for="kt_uppy_5_input_control">{{ __('manage.Select Video') }}</label>
                                 </div>
                              </div>
                               <p id="get_about_city_video"></p>
                               <p>
                                 @if(!empty($profile_city) && !empty($profile_city->getVideo()))
                                      <video width="200" height="200" controls><source src="{!! $profile_city->getVideo() !!}" type="video/mp4"></video>
                                 @endif
                               </p>
                           </div>
                        </div>
                     </div>
                  </div>

                  <hr/>

                  <div class="row">
                     <div class="col-md-12">
                        <div class="form-group">
                           <label class="col-form-label">{{ __('manage.More Info Title') }} </label>
                           <input type="text" value="{{ !empty($profile_city->info_title) ? $profile_city->info_title : '' }}" name="info_title" placeholder="{{ __('manage.More Info Title') }}" class="form-control form-control-lg form-control-solid">
                        </div>
                     </div>
                  </div>


                  <div class="row">
                     <div class="col-md-12">
                        <div class="form-group">
                           <label class="col-form-label">{{ __('manage.More Info City') }} </label>
                           <textarea placeholder="{{ __('manage.More Info City') }}" name="more_info_city" class="form-control form-control-lg form-control-solid">{{ !empty($profile_city->more_info_city) ? $profile_city->more_info_city : '' }}</textarea>
                        </div>
                     </div>
                  </div>

                   <div class="row">
                       <div class="col-md-12">
                        <div class="form-group">
                           <label class="col-form-label">{{ __('manage.About City Image') }}</label>
                           <div class="uppy" id="kt_uppy_5">
                              <div class="uppy-wrapper">
                                 <div class="uppy-Root uppy-FileInput-container">
                                    <input class="uppy-FileInput-input uppy-input-control city_image" accept="image/*" type="file" name="city_image" id="city_image">
                                    <label class="uppy-input-label btn btn-light-primary btn-sm btn-bold" for="city_image">Select Image</label>
                                 </div>
                              </div>
                               <p id="get_city_image_name"></p>
                               <p>
                                 @if(!empty($profile_city) && !empty($profile_city->getImage()))
                                    <img style="width: 100px;" src="{!! $profile_city->getImage() !!}">
                                 @endif
                               </p>

                           </div>
                        </div>
                     </div>
                  </div>

                  <hr/>

                  <div class="row">
                     <div class="col-md-12">
                        <div class="form-group">
                           <label class="col-form-label">{{ __('manage.Living Cost Title') }} </label>
                           <input type="text" value="{{ !empty($profile_city->living_cost_title) ? $profile_city->living_cost_title : '' }}" name="living_cost_title" placeholder="{{ __('manage.Living Cost Title') }}" class="form-control form-control-lg form-control-solid">
                        </div>
                     </div>
                  </div>


                  <div class="row">
                     <div class="col-md-12">
                        <div class="form-group">
                           <label class="col-form-label">{{ __('manage.Living Cost Info') }} </label>
                           <textarea placeholder="{{ __('manage.Living Cost Info') }}" name="living_cost_info" class="form-control form-control-lg form-control-solid">{{ !empty($profile_city->living_cost_info) ? $profile_city->living_cost_info : '' }}</textarea>
                        </div>
                     </div>
                  </div>

                  <div class="row">
                       <div class="col-md-12">

                        <table class="table table-head-custom table-vertical-center">
                           <thead>
                              <tr>
                                 <th>{{ __('manage.List') }}</th>
                                 <th>{{ __('manage.RMB') }}</th>
                              </tr>
                           </thead>
                           <tbody>
                              @foreach($get_living_cost as $value)

                              @if(!empty($profile_city) && !empty($profile_city->id))
                                 @php 
                                    $living_cost = App\Models\CityProfileLivingCostModel::living_cost($value->id, $profile_city->id);
                                 @endphp
                              @endif

                              <tr>
                                 <td>{{ $value->getName() }}</td>
                                 <td>
                                     <input type="hidden" value="{{ $value->id }}" name="living_cost_id[]" >

                                     <input type="text" value="{{ !empty($living_cost) ? $living_cost->rmb_name : '' }}" name="living_cost[]" placeholder="{{ __('manage.RMB') }}" class="form-control form-control-lg form-control-solid">
                                 
                                 </td>
                              </tr>
                              @endforeach
                           </tbody>
                        </table>

                       </div>
                 </div>

                  <hr/>


                  <div class="row">
                     <div class="col-md-12">
                        <div class="form-group">
                           <label class="col-form-label">{{ __('manage.Climate Title') }} </label>
                           <input type="text" value="{{ !empty($profile_city->climate_title) ? $profile_city->climate_title : '' }}" name="climate_title" placeholder="{{ __('manage.Climate in Beijing') }}" class="form-control form-control-lg form-control-solid">
                        </div>
                     </div>
                  </div>

                  <div class="row">
                       <div class="col-md-12">

                        <table class="table table-head-custom table-vertical-center">
                           <thead>
                              <tr>
                                 <th>{{ __('manage.Months') }}</th>
                                 <th>{{ __('manage.Low-High(C)') }}</th>
                                 <th>{{ __('manage.Rain') }}</th>
                                 <th>{{ __('manage.Strom') }}</th>
                              </tr>
                           </thead>
                           <tbody>
                              @foreach($get_climate as $value_c)

                                 @if(!empty($profile_city) && !empty($profile_city->id))
                                    @php 
                                       $climate_cost = App\Models\CityProfileClimateModel::climate($value_c->id, $profile_city->id);
                                    @endphp
                                 @endif

                              
                              <tr>
                                 <td>{{ $value_c->getName() }}</td>
                                 <td>
                                    <input type="hidden" value="{{ $value_c->id }}" name="climate_id[]" >
                                     <input type="text" value="{{ !empty($climate_cost->low_high) ? $climate_cost->low_high : '' }}" name="low_high[]" placeholder="{{ __('manage.-4C - 16 C') }}" class="form-control form-control-lg form-control-solid">
                                 </td>
                                 <td>
                                     <input type="text" value="{{ !empty($climate_cost->rain) ? $climate_cost->rain : '' }}" name="rain[]" placeholder="{{ __('manage.1 day') }}" class="form-control form-control-lg form-control-solid">
                                 </td>
                                 <td>
                                     <input type="text" value="{{ !empty($climate_cost->strom) ? $climate_cost->strom : '' }}" name="strom[]" placeholder="{{ __('manage.1 day') }}" class="form-control form-control-lg form-control-solid">
                                 </td>

                              </tr>
                              @endforeach
                           </tbody>
                        </table>

                       </div>
                 </div>

                    


                  <div class="row">
                     <div class="col-lg-12 col-xl-12 text-right">
                        <br />
                        <button type="submit" class="btn btn-success mr-2">{{ __('manage.Save') }}</button>
                     </div>
                  </div>
               </div>
            </div>

            </form>
            <!--begin::Card body-->
         </div>
      </div>
   </div>
</div>
@endsection


@section('script')
   <script type="text/javascript">

      $('.city_video'). change(function(e){
            var fileName = e. target. files[0]. name;
            $('#get_about_city_video').html(fileName);
      });

      $('.city_image'). change(function(e){
            var fileName = e. target. files[0]. name;
            $('#get_city_image_name').html(fileName);
      });

   </script>

@endsection

