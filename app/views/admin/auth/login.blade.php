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
    			<div class="logo">

    			</div>
    			<div class="content">
    				<!-- BEGIN LOGIN FORM -->

    					<form class="login-form"  method="post" action="{{ URL::route('admin.auth.doLogin') }}">
    						<h3 class="form-title">Sign In</h3>
    						 <?php if (isset($alert)) { ?>
    					        <div class="alert alert-<?php echo $alert['type'];?> alert-dismissibl fade in">
    					            <button type="button" class="close" data-dismiss="alert">
    					                <span aria-hidden="true">&times;</span>
    					                <span class="sr-only">Close</span>
    					            </button>
    					            <p>
    					                <?php echo $alert['msg'];?>
    					            </p>
    					        </div>
    					        <?php } ?>
    						<div class="form-group">
    							<!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
    							<label class="control-label visible-ie8 visible-ie9">Username</label>
    							<div class="input-group">
    								<input class="form-control form-control-solid placeholder-no-fix" type="text" autocomplete="off" placeholder="Username" name="username" id="username"/>
    									<span class="input-group-addon">
    										<i class="fa fa-user"></i>
    									</span>
    							</div>
    						</div>
    						<div class="form-group">
    							<label class="control-label visible-ie8 visible-ie9">Password</label>
    							<div class="input-group">
    								<input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="password" id="password"/>
    								<span class="input-group-addon">
    										<i class="fa fa-lock"></i>
    									</span>
    							</div>
    						</div>
    						<div class="form-actions">
    							<button type="submit" class="btn btn-success uppercase" >Login</button>
    						</div>
    						<div class="login-options" style="height:36px;">
    						</div>
    						<div class="create-account" style="height:67px">
    							<p>
    							</p>
    						</div>
    					</form>
    				<!-- END LOGIN FORM -->

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