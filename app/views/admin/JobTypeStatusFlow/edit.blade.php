@extends('admin.layout')
	@section('body')
		<h3 class="page-title">Edit Job Type Status Flow</h3>
			<!-- page layout -->
			<div class="page-bar">
				<ul class="page-breadcrumb">
					<li>
						<i class="fa fa-home"></i>
						<a href="{{URL::route('admin.dashboard')}}">Home</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<i class="fa fa-pencil"></i>
						<a href="{{URL::route('admin.jobTypeStatusFlow')}}">Job Type Status Flow List</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="{{URL::route('admin.jobTypeStatusFlow.edit',$jobTypeStatusFlow->id)}}">Edit Job Type Status Flow</a>
					</li>
				</ul>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="portlet box blue">
						<div class="portlet-title">
							<div class="caption">
								Edit Job Type Status Flow
							</div>
						</div>
							<div class="portlet-body form">
							@if ($errors->has())
							<div class="alert alert-danger alert-dismissibl fade in">
							    <button type="button" class="close" data-dismiss="alert">
							        <span aria-hidden="true">&times;</span>
							        <span class="sr-only">Close</span>
							    </button>
							    @foreach ($errors->all() as $error)
									{{ $error }}		
								@endforeach
							</div>
							@endif
							<form  class="form-horizontal" id="addCategoryFiledForm" method="POST" action="{{URL::route('admin.jobTypeStatusFlow.store')}}" enctype="multipart/form-data">
							    <input type="hidden" name="job_type_status_flow_id" value="{{$jobTypeStatusFlow->id}}">
							    <div class="form-body">
                                     @foreach ([
                                        'channel_id' =>'Channel Name',
                                        'job_type_id' => 'Job Type Name',
                                        'from_status_id' => 'From Status Name',
                                        'to_status_id' => 'To Status Name',
                                      ]as $key=> $value)
                                         @if ($key === 'job_type_id')
                                         <div class="form-group" id="countryname">
                                              <label class="col-md-3 col-sm-3 col-xs-12 control-label">{{ Form::label($key, $value) }}</label>
                                               <div class="col-md-6 col-sm-6 col-xs-12">
                                                  {{Form::select($key, $jobType->lists('job_type_name','id'), $jobTypeStatusFlow->job_type_id,  array('class' =>'form-control','onchange'=>'OnChangeJobType()','id'=>'jobTypeSelect')) }}
                                              </div>
                                          </div>
                                         @elseif($key === 'channel_id')
                                            <div class="form-group" id="countryname">
                                                 <label class="col-md-3 col-sm-3 col-xs-12 control-label">{{ Form::label($key, $value) }}</label>
                                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                                    {{Form::select($key, $channels->lists('channel_name','id'), $jobTypeStatusFlow->channel_id, array('class' =>'form-control','onchange'=>"onChangeChannel()",'id'=>'channelSelect')) }}
                                                 </div>
                                             </div>
                                         @elseif($key === 'from_status_id' || $key ==='to_status_id')
                                             <div class="form-group" id="countryname">
                                                  <label class="col-md-3 col-sm-3 col-xs-12 control-label">{{ Form::label($key, $value) }}</label>
                                                   <div class="col-md-6 col-sm-6 col-xs-12">
                                                    {{Form::select($key, $jobTypeStatus->lists('status_name','id'), $jobTypeStatusFlow->$key,  array('class' =>'form-control','id'=>$key."select")) }}
                                                  </div>
                                              </div>
                                         @endif
                                      @endforeach
							    </div>
								<div class="form-actions">
									<div class="row">
										<div class="col-md-offset-7 col-md-5">
											<button   class="btn  blue" type="submit" ><i class="fa fa-check-circle-o" style="margin-right:4px"></i>Edit</button>
											<a class="btn  green" href="{{URL::route('admin.jobTypeStatusFlow')}}"><i class="fa fa-repeat" style="margin-right:4px"></i>Cancel</a>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
	@stop
	@section('custom-scripts')
	<script type="text/javascript">
                function OnChangeJobType(){
                    onGetValue();
                }
                function onChangeChannel(){
                    onGetValue();
                }
                function onGetValue(){
                    var channelSelect = $("#channelSelect").val();
                    var jobTypeSelect = $("#jobTypeSelect").val();
                    if(channelSelect != "" && jobTypeSelect !=""){
                        var base_url = window.location.origin;
                        $.ajax ({
                           url: base_url + '/job_type_status_flow/getStatus',
                           type: 'POST',
                           data: {channelSelect: channelSelect, jobTypeSelect: jobTypeSelect },
                           cache: false,
                           dataType : "json",
                           success: function (data) {
                               if(data.result == "success"){
                                   $("#from_status_idselect").html(data.list);
                                   $("#to_status_idselect").html(data.list);
                               }else{
                                    $("#to_status_idselect").find("option").remove();
                                     $("#from_status_idselect").find("option").remove();
                               }
                            }
                            });
                    }else{
                        bootbox.alert("Please select correct channel and job type");
                    }
                }
    	    </script>
	@stop
@stop
