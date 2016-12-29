@extends('admin.layout')
    @section('body')
        <h3 class="page-title">User Group Detail</h3>
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
                    <a href="{{URL::route('admin.userGroup')}}">User Group List</a>
                    <i class="fa fa-angle-right"></i>
                </li>
                <li>
                    <a href="{{URL::route('admin.userGroup.detail',$userGroup->id)}}">User Group Detail</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12 margin-bottom-20">
                <div class="portlet light ">
                    <div class="portlet-body">
                        <div class="row">
                            <form class="form-horizontal" action="{{URL::route('admin.userGroup.ajaxStore')}}" id="userGroupForm" method="post">
                                <input type="hidden" name="user_group_id" value="{{$userGroup->id}}">
                                <div class="form-group">
                                    <label class="col-lg-3 col-md-3 col-sm-3 col-xs-4 control-label">
                                        User Group Name
                                    </label>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                        <input type="text" name="group_name" value="{{$userGroup->group_name}}" class="form-control" id="group_name">
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-2">
                                        <input type="button" value="save" class="btn blue " onclick="onSaveUserGroup()">
                                    </div>
                                </div>
                            </form>
                         </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 margin-bottom-25">
                <div class="portlet light">
                    <div class="portlet-body">
                    <!--sub menu start -->
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a href="#tab_1_1" data-toggle="tab">Users </a>
                            </li>
                            <li>
                                <a href="#tab_1_2" data-toggle="tab">Channel Rights</a>
                            </li>
                            <li>
                                <a href="#tab_1_3" data-toggle="tab">Warehouse Rights </a>
                            </li>
                            <li>
                                <a href="#tab_1_4" data-toggle="tab">Job Type Status Rights </a>
                            </li>
                        </ul>
                         <!--sub menu end -->
                         <!--sub menu result start-->
                         <div class="tab-content">
                         <!-- Users --->
                                <div class="tab-pane fade active in" id="tab_1_1">
                                    <h4>User Group -User List</h4>
                                    <p class="margin-bottom-20">For Simplicity a user can only belong to one group at any given time. To change the group of a user please go to the "User" screen to do so.</p>
                                    <table class="table table-striped table-bordered table-hover" id="sample_1">
                                        <thead>
                                            <tr>
                                                <th class="table-checkbox">
                                                    No
                                                </th>
                                                <th>User Name</th>
                                                <th>User First Name</th>
                                                <th>User Last Name</th>
                                                <th>User Email</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($user as $key => $value)
                                                <tr>
                                                    <td>{{$key+1;}}</td>
                                                    <td><a href="{{URL::route('admin.user.edit', array($value->id))}}">{{$value->username}}</a></td>
                                                    <td><a href="{{URL::route('admin.user.edit', array($value->id))}}">{{$value->first_name}}</a></td>
                                                    <td><a href="{{URL::route('admin.user.edit', array($value->id))}}">{{$value->last_name}}</a></td>
                                                    <td><a href="{{URL::route('admin.user.edit', array($value->id))}}">{{$value->email}}</a></td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <!--- users end -->
                                <div class="tab-pane fade" id="tab_1_2">
                                      <h4 class="margin-bottom-25">User Group - Channel Rights</h4>
                                       <form action="{{URL::route('admin.userGroup.ajaxChannelStore')}}" method="post" class="form-horizontal margin-bottom-20" id="userGroupChannelRightForm">
                                            <div class="row">
                                                <div class="col-md-4 col-sm-4">
                                                    <div class="form-group">
                                                        <div class="col-md-12">
                                                             {{Form::select('channel', $channels->lists('channel_name','id'), null,  array('class' =>'form-control')) }}
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-sm-4">
                                                    <div class="form-group">
                                                        <div class="col-md-12" id="channel_right_select">
                                                            {{$userChannelRightSelect}}
                                                         </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-sm-4">
                                                        <div class="form-group">
                                                            <div class="col-md-12">
                                                                <input type="hidden" name="userGroupID" value="{{$userGroup->id}}">
                                                                <input type="button" class=" btn blue" value="Save" onclick="onSaveUserChannelRight()">
                                                            </div>
                                                        </div>
                                                </div>
                                            </div>
                                       </form>
                                        <table class="table table-striped table-bordered table-hover" id="sample_1">
                                            <thead>
                                                <tr>
                                                    <th class="table-checkbox">
                                                        No
                                                    </th>
                                                    <th>Channel Name</th>
                                                    <th>Right Name</th>
                                                    <th>Short Description</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody id="channelRightFormBody">
                                                {{$userChannelRightFromBody}}
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="tab-pane fade" id="tab_1_3">
                                        <h4 class="margin-bottom-20">User Group - Warehose Rights</h4>
                                        <form action="{{URL::route('admin.userGroup.ajaxWarehouseStore')}}" method="post" class="form-horizontal margin-bottom-20" id="userGroupWarehouseRightForm">
                                            <div class="row">
                                                <div class="col-md-4 col-sm-4">
                                                    <div class="form-group">
                                                        <div class="col-md-12">
                                                             {{Form::select('warehouse', $warehouse->lists('warehouse_name','id'), null,  array('class' =>'form-control')) }}
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-sm-4">
                                                    <div class="form-group">
                                                        <div class="col-md-12" id="warehouse_right_select">
                                                            {{$userWarehouseRightSelect}}
                                                         </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-sm-4">
                                                        <div class="form-group">
                                                            <div class="col-md-12">
                                                                <input type="hidden" name="userGroupID" value="{{$userGroup->id}}">
                                                                <input type="button" class=" btn blue" value="Save" onclick="onSaveUserWarehouseRight()">
                                                            </div>
                                                        </div>
                                                </div>
                                            </div>
                                       </form>
                                       <table class="table table-striped table-bordered table-hover" id="sample_1">
                                           <thead>
                                               <tr>
                                                   <th class="table-checkbox">
                                                       No
                                                   </th>
                                                   <th>Warehouse Name</th>
                                                   <th>Right Name</th>
                                                   <th>Short Description</th>
                                                   <th>Action</th>
                                               </tr>
                                           </thead>
                                           <tbody id="warehouseRightFormBody">
                                               {{$userWarehouseRightFormBody}}
                                           </tbody>
                                       </table>
                                    </div>
                                    <div class="tab-pane fade" id="tab_1_4">
                                         <h4 class="margin-bottom-20"> User Group - Job Type Status Rights</h4>
                                         <form action="{{URL::route('admin.userGroup.ajaxJobTypeRightStore')}}" method="post" class="form-horizontal margin-bottom-20" id="userGroupJobStatusRightForm">
                                             <div class="row">
                                                 <div class="col-md-2 col-sm-2">
                                                     <div class="form-group">
                                                         <div class="col-md-12">
                                                              {{Form::select('channel',[null=>'Channel Name']+$channels->lists('channel_name','id'), null,  array('class' =>'form-control','id' =>'channelSelect','onChange'=>"OnChangeChannelName()")) }}
                                                         </div>
                                                     </div>
                                                 </div>
                                                  <div class="col-md-2 col-sm-2">
                                                     <div class="form-group">
                                                         <div class="col-md-12" id="warehouse_right_select" style="display: none">
                                                             {{Form::select('job_type', [null=>'Job Type Name']+$jobType->lists('job_type_name','id'), null,  array('class' =>'form-control','id' =>'jobTypeSelect','onChange'=>"OnChangeJobTypeName()")) }}
                                                          </div>
                                                     </div>
                                                 </div>
                                                 <div class="col-md-2 col-sm-2">
                                                      <div class="form-group">
                                                          <div class="col-md-12" id="job_type_status">

                                                           </div>
                                                      </div>
                                                  </div>
                                                  <div class="col-md-2 col-sm-2">
                                                       <div class="form-group">
                                                           <div class="col-md-12" id="job_type_right">

                                                            </div>
                                                       </div>
                                                   </div>
                                                 <div class="col-md-2 col-sm-2">
                                                         <div class="form-group">
                                                             <div class="col-md-12" id="save" style="display: none">
                                                                 <input type="hidden" name="userGroupID" value="{{$userGroup->id}}">
                                                                 <input type="button" class=" btn blue" value="Save" onclick="onSaveUserJobTypeRight()">
                                                             </div>
                                                         </div>
                                                 </div>
                                             </div>
                                        </form>
                                        <table class="table table-striped table-bordered table-hover" id="sample_1">
                                           <thead>
                                               <tr>
                                                   <th class="table-checkbox">
                                                       No
                                                   </th>
                                                   <th>Channel Name</th>
                                                   <th>Job Type</th>
                                                   <th>Status Name</th>
                                                    <th>Right Name</th>
                                                   <th>Action</th>
                                               </tr>
                                           </thead>
                                           <tbody id="jobTypeStatusRightFormBody">
                                               {{$userJobTypeRight}}
                                           </tbody>
                                       </table>
                                    </div>
                                </div>
                          </div>
                         <!--sub menu result end -->
                    </div>
                </div>
            </div>
        </div>
    @stop
    @section('custom-scripts')
        <script type="text/javascript">
            function onSaveUserGroup(){
                $("#userGroupForm").ajaxForm({
                    success:function(data){
                        if(data.result == "success"){
                            bootbox.alert("User group  has been updated successfully");
                           $("#userGroupForm").find("#group_name").val(data.name);
                        }else if(data.result == "failed"){
                            var arr = data.error;
                            var errorList = '';
                           $.each(arr, function(index, value)
                           {
                               if (value.length != 0)
                               {
                                   errorList = errorList + value;
                               }
                           });
                           $("#countResultDiv").remove();
                             bootbox.alert(errorList);
                        }
                    }
                }).submit();
            }
            /******group channelright*****/
            function onSaveUserChannelRight(){
                $("#userGroupChannelRightForm").ajaxForm({
                    success:function(data){
                        if(data.result == "success"){
                            bootbox.alert("User group channel right has been saved successfully");
                            $("#channelRightFormBody").html(data.list);
                            $("#userGroupChannelRightForm").find("#channel_right_select").html(data.channel_right_select);
                        }else if(data.result == "failed"){
                            var arr = data.error;
                            var errorList = '';
                           $.each(arr, function(index, value)
                           {
                               if (value.length != 0)
                               {
                                   errorList = errorList + value;
                               }
                           });
                             bootbox.alert(errorList);
                        }
                    }
                }).submit();
            }

          function onRemoveUserGroupChannelRight(obj){
                 $(obj).parent('form').eq(0).ajaxForm({
                     success:function(data){
                         if(data.result == "success"){
                             bootbox.alert("User group channel right has been removed successfully");
                             $("#channelRightFormBody").html(data.list);
                             $("#userGroupChannelRightForm").find("#channel_right_select").html(data.channel_right_select);
                         }
                     }
                 }).submit();
             }
           /****channel end*****/
             function onSaveUserWarehouseRight(){
                 $("#userGroupWarehouseRightForm").ajaxForm({
                        success:function(data){
                            if(data.result == "success"){
                                bootbox.alert("User group warehouse right has been saved successfully");
                                $("#warehouseRightFormBody").html(data.list);
                                $("#userGroupWarehouseRightForm").find("#warehouse_right_select").html(data.channel_right_select);
                            }else if(data.result == "failed"){
                                var arr = data.error;
                                var errorList = '';
                               $.each(arr, function(index, value)
                               {
                                   if (value.length != 0)
                                   {
                                       errorList = errorList + value;
                                   }
                               });
                                 bootbox.alert(errorList);
                            }
                        }
                    }).submit();
             }
             function onRemoveUserGroupWarehousesRight(obj){
                  $(obj).parent('form').eq(0).ajaxForm({
                      success:function(data){
                          if(data.result == "success"){
                              bootbox.alert("User group warehouse right has been removed successfully");
                              $("#warehouseRightFormBody").html(data.list);
                              $("#userGroupWarehouseRightForm").find("#warehouse_right_select").html(data.channel_right_select);
                          }
                      }
                  }).submit();
              }
/************************************/
             function onSaveUserJobTypeRight(){
                $("#userGroupJobStatusRightForm").ajaxForm({
                    success:function(data){
                        if(data.result == "success"){
                            bootbox.alert("User group job type right has been saved successfully");
                            $("#jobTypeStatusRightFormBody").html(data.list);
                            $("#userGroupJobStatusRightForm").find("#channelSelect").val('');
                            OnChangeChannelName();
                            //$("#userGroupWarehouseRightForm").find("#warehouse_right_select").html(data.channel_right_select);
                        }else if(data.result == "failed"){
                            var arr = data.error;
                            var errorList = '';
                           $.each(arr, function(index, value)
                           {
                               if (value.length != 0)
                               {
                                   errorList = errorList + value;
                               }
                           });
                             bootbox.alert(errorList);
                        }else if(data.result =="exist"){
                            bootbox.alert("User group job type right exist");
                             $("#userGroupJobStatusRightForm").find("#channelSelect").val('');
                             OnChangeChannelName();
                        }
                    }
                }).submit();
             }
             function onRemoveUserGroupWarehousesRight(obj){
                   $(obj).parent('form').eq(0).ajaxForm({
                        success:function(data){
                            if(data.result == "success"){
                                bootbox.alert("User group job type right has been removed successfully");
                                $("#jobTypeStatusRightFormBody").html(data.list);
                            }
                        }
                    }).submit();
             }
              function OnChangeChannelName(){
                if($("#channelSelect").val()!= ""){
                       $("#userGroupJobStatusRightForm").find("#jobTypeSelect").val("");
                       $("#userGroupJobStatusRightForm").find("#warehouse_right_select").show();
                       $("#userGroupJobStatusRightForm").find("#job_type_status").hide();
                       $("#userGroupJobStatusRightForm").find("#job_type_right").hide();
                       $("#userGroupJobStatusRightForm").find("#save").hide();
                }else{
                    $("#userGroupJobStatusRightForm").find("#warehouse_right_select").hide();
                    $("#userGroupJobStatusRightForm").find("#job_type_right").hide();
                    $("#userGroupJobStatusRightForm").find("#job_type_status").hide();
                    $("#userGroupJobStatusRightForm").find("#save").hide();
                }
              }

              function onChangeJobTypeStatus(){
                if($("#userGroupJobStatusRightForm").find("#jobTypeStatusSelect").val() !=""){
                     $("#userGroupJobStatusRightForm").find("#job_type_right").show();
                }else{
                   $("#userGroupJobStatusRightForm").find("#job_type_right").hide();
                }
              }
              function onChangeJobTypeRight(){
                if($("#userGroupJobStatusRightForm").find("#jobTypeStatusRightSelect").val() !=""){
                    $("#userGroupJobStatusRightForm").find("#save").show();
                }else{
                    $("#userGroupJobStatusRightForm").find("#save").hide();
                }
              }
              function OnChangeJobTypeName(){
              var jobTypeSelect = $("#userGroupJobStatusRightForm").find("#jobTypeSelect").val();
              var channel = $("#userGroupJobStatusRightForm").find("#channelSelect").val();
               $("#userGroupJobStatusRightForm").find("#job_type_status").hide();
                if(channel !="" && jobTypeSelect !=""){
                    var base_url = window.location.origin;
                        $.ajax ({
                           url: base_url + '/user_group/getJobTypeStatus',
                           type: 'POST',
                           data: {channel: channel, jobTypeSelect: jobTypeSelect },
                           cache: false,
                           dataType : "json",
                           success: function (data) {
                               if(data.result == "success"){
                                   $("#userGroupJobStatusRightForm").find("#job_type_status").html(data.list);
                                   $("#userGroupJobStatusRightForm").find("#job_type_right").html(data.right);
                                   $("#userGroupJobStatusRightForm").find("#job_type_status").show();
                                    $("#userGroupJobStatusRightForm").find("#job_type_right").hide();
                                   $("#userGroupJobStatusRightForm").find("#save").hide();
                               }
                           }
                      });
                }else{
                        $("#userGroupJobStatusRightForm").find("#job_type_status").hide();
                        $("#userGroupJobStatusRightForm").find("#job_type_right").hide();
                        $("#userGroupJobStatusRightForm").find("#save").hide();
                }
              }
        </script>
    @stop
@stop