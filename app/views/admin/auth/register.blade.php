@extends('main')
    @section('title')
    		ADMIN|FFD
    @stop
    @section('styles')
    		{{HTML::style('//fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all')}}
    		{{ HTML::style('/assets/css/font-awesome.min.css') }}
    		{{ HTML::style('/assets/css/simple-line-icons.min.css') }}
    		{{ HTML::style('/assets/css/bootstrap.min.css') }}
    		{{ HTML::style('/assets/css/uniform.default.css') }}
    		{{ HTML::style('/assets/css/bootstrap-switch.min.css') }}
    		{{ HTML::style('/assets/css/bootstrap-wysihtml5.css') }}
    		{{ HTML::style('/assets/css/jquery.fancybox.css') }}
    		{{ HTML::style('/assets/css/jquery.fileupload.css') }}
    		{{ HTML::style('/assets/css/jquery.fileupload-ui.css') }}
    		{{ HTML::style('/assets/css/blueimp-gallery.min.css') }}
    		{{ HTML::style('/assets/css/inbox.css') }}
    		{{ HTML::style('/assets/css/daterangepicker-bs3.css') }}
    		{{ HTML::style('/assets/css/fullcalendar.min.css') }}
    		{{ HTML::style('/assets/css/jqvmap.css') }}
    		{{ HTML::style('/assets/css/tasks.css') }}
    		{{ HTML::style('/assets/css/forestChange.css') }}
    		{{ HTML::style('/assets/css/select2.css') }}
    		{{ HTML::style('/assets/css/components.css') }}
    		{{ HTML::style('/assets/css/plugins.css') }}
    		{{ HTML::style('/assets/css/layout.css') }}
    		{{ HTML::style('/assets/css/default.css') }}
    		{{ HTML::style('/assets/css/custom.css') }}
    	@stop
    	@section ('custom-styles')
    		{{ HTML::style('/assets/css/login.css') }}
    	@stop
    	@section ('content')
    		<body class="login">
    			<div class="menu-toggler sidebar-toggler">
    				</div>
    			<div class="content">
    				<!-- Register Form Start -->
                    <form class="register-form" action="{{URL::route('admin.auth.store')}}" method="post">
                            <h3>Sign Up</h3>
                            @if ($errors->has())
                                <div class="alert alert-danger alert-dismissibl fade in">
                                    <button type="button" class="close" data-dismiss="alert">
                                        <span aria-hidden="true">&times;</span>
                                        <span class="sr-only">Close</span>
                                    </button>
                                    @foreach ($errors->all() as $error)
                                        <p>{{ $error }}</p>
                                    @endforeach
                                </div>
                            @endif

                            <p class="hint">
                                 Enter your account details below:
                            </p>
                            <div class="form-group">
                                <label class="control-label visible-ie8 visible-ie9">First Name</label>
                                <input class="form-control placeholder-no-fix" type="text" autocomplete="off" id="register_password" placeholder="First Name" name="first_name"/>
                            </div>
                            <div class="form-group">
                                <label class="control-label visible-ie8 visible-ie9">Last Name</label>
                                <input class="form-control placeholder-no-fix" type="text" autocomplete="off" id="register_password" placeholder="Last Name" name="last_name"/>
                            </div>
                            <div class="form-group">
                                <label class="control-label visible-ie8 visible-ie9">Email</label>
                                <input class="form-control placeholder-no-fix" type="text" autocomplete="off" id="register_password" placeholder="Email" name="email"/>
                            </div>

                            <div class="form-group">
                                <label class="control-label visible-ie8 visible-ie9">Username</label>
                                <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Username" name="username"/>
                            </div>
                            <div class="form-group">
                                <label class="control-label visible-ie8 visible-ie9">Password</label>
                                <input class="form-control placeholder-no-fix" type="password" autocomplete="off" id="register_password" placeholder="Password" name="password"/>
                            </div>

                            <div class="form-group">
                                <label class="control-label visible-ie8 visible-ie9">Re-type Your Password</label>
                                <input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Re-type Your Password" name="password_confirmation"/>
                            </div>
                            <div class="form-group">
                                <label class="control-label visible-ie8 visible-ie9">User Group</label>
                                {{Form::select('group', $userGroup->lists('group_name','id'), null,  array('class' =>'form-control')) }}
                            </div>
                            <div class="form-group margin-top-20 margin-bottom-20">
                                <label class="check">
                                <input type="checkbox" name="tnc"/> I agree to the <a href="#">
                                Terms of Service </a>
                                & <a href="#">
                                Privacy Policy </a>
                                </label>
                                <div id="register_tnc_error">
                                </div>
                            </div>
                            <div class="form-actions">
                                <a href="{{URL::route('admin.home')}}" id="register-back-btn" class="btn btn-default">Back</a>
                                <button type="submit" id="register-submit-btn" class="btn btn-success uppercase pull-right">Submit</button>
                            </div>
                        </form>
    			</div>

    			<!-- END LOGIN -->
    			<!-- BEGIN COPYRIGHT -->
    			<div class="copyright">
    				 2015 &copy; Marc Schuler - Admin Dashboard.
    			</div>

    			</body>
    	@stop
    	@section ('scripts')
     		 {{ HTML::script('/assets/js/jquery.min.js') }}
     		 {{ HTML::script('/assets/js/jquery-migrate.min.js') }}
     		 {{ HTML::script('/assets/js/jquery-ui-1.10.3.custom.min.js') }}
     		 {{ HTML::script('/assets/js/bootstrap-hover-dropdown.min.js') }}
     		 {{ HTML::script('/assets/js/bootstrap.min.js') }}
     		 {{ HTML::script('/assets/js/jquery.slimscroll.min.js') }}
     		 {{ HTML::script('/assets/js/jquery.blockui.min.js') }}
     		 {{ HTML::script('/assets/js/jquery.uniform.min.js') }}
     		 {{ HTML::script('/assets/js/bootstrap-switch.min.js') }}
     		 {{ HTML::script('/assets/js/jquery.pulsate.min.js') }}
     		 {{ HTML::script('/assets/js/moment.min.js') }}
     		 {{ HTML::script('/assets/js/daterangepicker.js') }}
     		 {{ HTML::script('/assets/js/jquery.easypiechart.min.js') }}
     		 {{ HTML::script('/assets/js/jquery.sparkline.min.js') }}
     		 {{ HTML::script('/assets/js/jquery.validate.min.js') }}
     		 {{ HTML::script('/assets/js/jquery.backstretch.min.js') }}
     		 {{ HTML::script('/assets/js/select2.min.js') }}
     		 {{ HTML::script('/assets/js/metronic.js') }}
     		 {{ HTML::script('/assets/js/layout.js') }}
     		 {{ HTML::script('/assets/js/layout2/layout.js') }}
     		 {{ HTML::script('/assets/js/layout2/demo.js') }}
     		 {{ HTML::script('/assets/js/index.js') }}
     		 {{ HTML::script('/assets/js/tasks.js') }}
     	@stop
     	@section ('custom-scripts')
     		{{ HTML::script('/assets/js/login-check.js') }}
     	@stop
     @stop