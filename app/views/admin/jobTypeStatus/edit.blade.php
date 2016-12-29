@extends('admin.layout')
	@section('body')
		<h3 class="page-title">Edit Job Type Status</h3>
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
						<a href="{{URL::route('admin.jobTypeStatus')}}">Job Type Status List</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="{{URL::route('admin.jobTypeStatus.edit',$jobTypeStatus->id)}}">Edit Job Type Status</a>
					</li>
				</ul>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="portlet box blue">
						<div class="portlet-title">
							<div class="caption">
								Edit Job Type Status
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
							<form  class="form-horizontal" id="addCategoryFiledForm" method="POST" action="{{URL::route('admin.jobTypeStatus.store')}}" enctype="multipart/form-data">
							    <input type="hidden" name="job_type_status_id" value="{{$jobTypeStatus->id}}">
							    <div class="form-body">
                                     @foreach ([
                                        'channel_id' =>'Channel Name',
                                        'job_type_id' => 'Job Type Name',
                                        'status_name' => 'Status Name',
                                        'start_status' => 'Start Status',
                                      ]as $key=> $value)
                                         @if ($key === 'job_type_id')
                                         <div class="form-group" id="countryname">
                                              <label class="col-md-3 col-sm-3 col-xs-12 control-label">{{ Form::label($key, $value) }}</label>
                                               <div class="col-md-6 col-sm-6 col-xs-12">
                                                  {{Form::select($key, $jobType->lists('job_type_name','id'), $jobTypeStatus->job_type_id,  array('class' =>'form-control')) }}
                                              </div>
                                          </div>
                                         @elseif($key === 'channel_id')
                                            <div class="form-group" id="countryname">
                                                 <label class="col-md-3 col-sm-3 col-xs-12 control-label">{{ Form::label($key, $value) }}</label>
                                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                                    {{Form::select($key, $channels->lists('channel_name','id'), $jobTypeStatus->channel_id,  array('class' =>'form-control')) }}
                                                 </div>
                                             </div>
                                         @elseif($key === 'start_status')
                                             <div class="form-group" id="countryname">
                                                  <label class="col-md-3 col-sm-3 col-xs-12 control-label">{{ Form::label($key, $value) }}</label>
                                                   <div class="col-md-6 col-sm-6 col-xs-12">
                                                     <input type="checkbox" name="start_status" value="1" <?php if($jobTypeStatus->start_status ==1) {echo "checked";}?>>
                                                  </div>
                                              </div>
                                         @else
                                            <div class="form-group" id="countryname">
                                                 <label class="col-md-3 col-sm-3 col-xs-12 control-label">{{ Form::label($key, $value) }}</label>
                                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                                      {{ Form::text($key, $jobTypeStatus->$key, ['class' => 'form-control','placeholder'=>$value]) }}
                                                 </div>
                                             </div>
                                         @endif
                                      @endforeach
							    </div>
								<div class="form-actions">
									<div class="row">
										<div class="col-md-offset-7 col-md-5">
											<button   class="btn  blue" type="submit" ><i class="fa fa-check-circle-o" style="margin-right:4px"></i>Save</button>
											<a class="btn  green" href="{{URL::route('admin.jobTypeStatus')}}"><i class="fa fa-repeat" style="margin-right:4px"></i>Cancel</a>
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
	@stop
@stop
