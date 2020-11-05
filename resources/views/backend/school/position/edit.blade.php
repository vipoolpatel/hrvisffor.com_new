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
                           {{ __('position.Edit Position') }}
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
                                    <h3 class="card-label font-weight-bolder text-dark">{{ __('position.Edit Position') }}</h3>
                                </div>
                            </div>

                              @include('backend.school.position._form')          

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection
@section('script')
    <script type="text/javascript">
      
        $('body').delegate('.StateChange','change',function(){
            var id = $(this).attr('id');
            var state_id = $(this).val();
            $.ajax({
                url: "{{ url('common/getStateCity') }}",
                type: "POST",
                data:{
                    "_token": "{{ csrf_token() }}",
                    state_id:state_id,
                },
                dataType:"json",
                success:function(response){
                    $('#getCity'+id).html(response.html);
                },
            });
        });

    </script>
@endsection
