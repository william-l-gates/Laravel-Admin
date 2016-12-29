@extends('main')
	@section('title')
		ADMIN|FFD
	@stop
	
	@section('styles')
		{{HTML::style('//fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all')}}
		{{ HTML::style('/assets/css/font-awesome.min.css') }}
        {{ HTML::style('/assets/css/simple-line-icons.css') }}
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
		{{ HTML::style('/assets/css/dataTables.bootstrap.css') }}
		{{ HTML::style('/assets/css/forestChange.css') }}

	@stop		
	@section('content')
<body class="page-boxed page-header-fixed page-sidebar-closed-hide-logo page-container-bg-solid page-sidebar-closed-hide-logo">
<!------------------------------------------- Header start  ---------------------------->
	<div class="page-header navbar navbar-fixed-top">
		<!-- BEGIN HEADER INNER -->
		<div class="page-header-inner">
			<!-- BEGIN PAGE TOP -->
			<div class="page-logo">
			    <div class="menu-toggler sidebar-toggler">
                    <!-- DOC: Remove the above "hide" to enable the sidebar toggler button on header -->
                </div>
			</div>
			<a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"></a>
			
			<div class="page-top">
				<!-- BEGIN HEADER SEARCH BOX -->
			
				<!-- BEGIN TOP NAVIGATION MENU -->
				<div class="top-menu">
					<ul class="nav navbar-nav pull-right">
						<!-- BEGIN NOTIFICATION DROPDOWN -->
						
						<!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
						<li class="dropdown dropdown-user">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
									<img alt="" class="img-circle" src="/assets/img/User_Avatar-512.png" style="display: none"/>
								
							<span class="username username-hide-on-mobile loginTopColor">
								Account
							 </span>
							<i class="fa fa-angle-down loginTopColor"></i>
							</a>
							<ul class="dropdown-menu dropdown-menu-default loginTopColor">
								<li>
									<a href="{{URL::route('admin.profile')}}" class="loginTopColor">
									<i class="icon-user"></i> My Profile </a>
								</li>
								
								<li>
									<a href="{{URL::route('admin.auth.logout')}}" class="loginTopColor">
									<i class="icon-key"></i> Log Out </a>
								</li>
							</ul>
						</li>
						<!-- END USER LOGIN DROPDOWN -->
					</ul>
				</div>
				<!-- END TOP NAVIGATION MENU -->
			</div>
			<!-- END PAGE TOP -->
		</div>
		<!-- END HEADER INNER -->
	</div>
<!------------------------------------------- Header end  ---------------------------->
	<div class="clearfix"></div>
	<div class="page-container">
		<div class="page-sidebar-wrapper">
			<div class="page-sidebar navbar-collapse collapse">
                <ul class="page-sidebar-menu page-sidebar-menu-hover-submenu " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
                    <li class="start <?php if($pageNo == 1) {echo ' active';}?>">
                        <a href="{{ URL::route('admin.dashboard') }}">
                        <i class="fa fa-tachometer"></i>
                        <span class="title">Dashboard</span>
                        <span class="selected"></span>
                        </a>
                    </li>
                    <li class="start <?php if($pageNo == 11) {echo ' active';}?>">
                        <a href="{{ URL::route('admin.channel') }}">
                        <i class="icon-home"></i>
                        <span class="title">Channel</span>
                        <span class="selected"></span>
                        </a>
                    </li>
                    <li class="start <?php if($pageNo == 14) {echo ' active';}?>">
                        <a href="{{ URL::route('admin.channel.rightList') }}">
                        <i class="fa fa-tasks"></i>
                        <span class="title">Channel Right</span>
                        <span class="selected"></span>
                        </a>
                    </li>
                    <li class="start <?php if($pageNo == 12) {echo ' active';}?>">
                            <a href="{{ URL::route('admin.jobType') }}">
                            <i class="icon-handbag"></i>
                            <span class="title">Job Type</span>
                            <span class="selected"></span>
                            </a>
                     </li>
                      <li class="start <?php if($pageNo == 17) {echo ' active';}?>">
                             <a href="{{ URL::route('admin.jobTypeRight') }}">
                             <i class="fa fa-bank"></i>
                             <span class="title">Job Type Right</span>
                             <span class="selected"></span>
                             </a>
                       </li>
                       <li class="start <?php if($pageNo == 18) {echo ' active';}?>">
                            <a href="{{ URL::route('admin.jobTypeStatus') }}">
                            <i class="fa  fa-paper-plane"></i>
                            <span class="title">Job Type Status</span>
                            <span class="selected"></span>
                            </a>
                      </li>
                      <li class="start <?php if($pageNo == 19) {echo ' active';}?>">
                              <a href="{{ URL::route('admin.jobTypeStatusFlow') }}">
                              <i class="fa   fa-recycle"></i>
                              <span class="title">Job Type Status Flow</span>
                              <span class="selected"></span>
                              </a>
                        </li>
                    <li class="start <?php if($pageNo == 16) {echo ' active';}?>">
                        <a href="{{ URL::route('admin.warehouses') }}">
                        <i class="fa fa-database"></i>
                        <span class="title">Warehouse</span>
                        <span class="selected"></span>
                        </a>
                    </li>
                    <li class="start <?php if($pageNo == 13) {echo ' active';}?>">
                        <a href="{{ URL::route('admin.warehouseRight') }}">
                        <i class="fa fa-building-o"></i>
                        <span class="title">Warehouses Right</span>
                        <span class="selected"></span>
                        </a>
                    </li>
                    <li class="start <?php if($pageNo == 15) {echo ' active';}?>">
                        <a href="{{ URL::route('admin.user') }}">
                        <i class="fa fa-user"></i>
                        <span class="title">Users</span>
                        <span class="selected"></span>
                        </a>
                    </li>
                    <li class="start <?php if($pageNo == 20) {echo ' active';}?>">
                        <a href="{{ URL::route('admin.userGroup') }}">
                        <i class="fa fa-users"></i>
                        <span class="title">User Group</span>
                        <span class="selected"></span>
                        </a>
                    </li>
                    <li class="start <?php if($pageNo == 21) {echo ' active';}?>">
                        <a href="{{ URL::route('admin.orderItems') }}">
                        <i class="fa  fa-reorder"></i>
                        <span class="title">Order Items</span>
                        <span class="selected"></span>
                        </a>
                    </li>
                   <li>
                        &nbsp;
                   </li>
                </ul>
			</div>
		</div>
		<div class = "page-content-wrapper min-height-1000">
			<div class="page-content min-height-1000">
				@yield('body')
			</div>
		</div>
	</div>
<!------------------------------------------- body start  ---------------------------->
	
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
 		 {{ HTML::script('/assets/js/jquery.validate.js') }}
 		 {{ HTML::script('/assets/js/jquery.backstretch.min.js') }}
 		 {{ HTML::script('/assets/js/select2.min.js') }}
 		 {{ HTML::script('/assets/js/metronic.js') }}
 		 {{ HTML::script('/assets/js/layout.js') }}
 		 {{ HTML::script('/assets/js/layout2/layout.js') }}
 		 {{ HTML::script('/assets/js/layout2/demo.js') }}
 		 {{ HTML::script('/assets/js/index.js') }}
 		 {{ HTML::script('/assets/js/tasks.js') }}
 		 {{ HTML::script('/assets/js/jquery.dataTables.min.js') }}
 		 {{ HTML::script('/assets/js/dataTables.bootstrap.js') }}
 		 {{ HTML::script('/assets/js/professions.js') }}
 		 {{ HTML::script('/assets/js/bootbox.js') }}
 		 {{ HTML::script('/assets/js/jquery.form.js') }}
	 		<script type="text/javascript">
		 		jQuery(document).ready(function() {    
				   Metronic.init(); // init metronic core componets
				   Layout.init(); // init layout
				   Demo.init(); // init demo features 
				});
		 	</script>
 	@stop
 	
@stop