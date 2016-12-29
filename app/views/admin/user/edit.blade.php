@extends('admin.layout')
	@section('body')
		<h3 class="page-title">Edit User</h3>
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
						<a href="{{URL::route('admin.user')}}">Users</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="{{URL::route('admin.user.edit',$user->id)}}">Edit User</a>
					</li>
				</ul>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="portlet box blue">
						<div class="portlet-title">
							<div class="caption">
								Edit User
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
							<form  class="form-horizontal" id="addCategoryFiledForm" method="POST" action="{{URL::route('admin.user.store')}}" enctype="multipart/form-data">
							    <input type="hidden" name="user_id" value="{{$user->id}}">
							    <?php  echo Form::token(); ?>
							    <div class="form-body">
                                     @foreach ([
                                        'first_name' => 'First Name',
                                        'last_name' => 'Last Name',
                                        'email' => 'Email',
                                        'password' => 'Password',
                                        'password_confirmation' =>'Re-Type Password',
                                        'username' => 'User Name',
                                        'userGroupID' =>'User Group',
                                      ] as $key=> $value)
                                         @if ($key === 'userGroupID')
                                            <div class="form-group" id="countryname">
                                                 <label class="col-md-3 col-sm-3 col-xs-12 control-label">{{ Form::label($key, $value) }}</label>
                                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                                    {{Form::select($key, $userGroup->lists('group_name','id'), $user->$key,  array('class' =>'form-control')) }}
                                                 </div>
                                             </div>
                                          @elseif($key ==='password' || $key === 'password_confirmation')
                                              <div class="form-group" id="countryname">
                                                   <label class="col-md-3 col-sm-3 col-xs-12 control-label">{{ Form::label($key, $value) }}</label>
                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                      {{ Form::password ($key, ['class' => 'form-control','placeholder'=>$value]) }}
                                                   </div>
                                               </div>
                                         @else
                                             <div class="form-group" id="countryname">
                                                  <label class="col-md-3 col-sm-3 col-xs-12 control-label">{{ Form::label($key, $value) }}</label>
                                                   <div class="col-md-6 col-sm-6 col-xs-12">
                                                     @if($key === 'username'  || $key === 'email')
                                                        {{ Form::text($key, $user->$key, ['class' => 'form-control','placeholder'=>$value,'readonly'=>true]) }}
                                                     @else
                                                        {{ Form::text($key, $user->$key, ['class' => 'form-control','placeholder'=>$value]) }}
                                                     @endif
                                                  </div>
                                              </div>
                                         @endif
                                      @endforeach
							    </div>
								<div class="form-actions">
									<div class="row">
										<div class="col-md-offset-7 col-md-5">
											<button   class="btn  blue" type="submit" ><i class="fa fa-check-circle-o" style="margin-right:4px"></i>Edit</button>
											<a class="btn  green" href="{{URL::route('admin.user')}}"><i class="fa fa-repeat" style="margin-right:4px"></i>Cancel</a>
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
