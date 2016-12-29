@extends('admin.layout')
    @section('body')
        <h3 class="page-title">Users Management</h3>
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
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="portlet box blue">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-globe"></i> Users Management
                            </div>
                            <div class="actions">
                                <a id="sample_editable_1_new" class="btn btn-default btn-sm" href='{{ URL::route('admin.user.create')}}' style="margin-right:10px">
                                        Add New <i class="fa fa-plus"></i>
                                </a>
                            </div>
                        </div>
                        <div class="portlet-body">
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
                            <table class="table table-striped table-bordered table-hover" id="sample_1">
                                <thead>
                                    <tr>
                                        <th class="table-checkbox">
                                            <input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes"/>
                                        </th>
                                        <th>User Name</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Group Name</th>
                                        <th>Active</th>
                                        <th class= "sorting_disabled">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $key => $value)
                                        <tr>
                                            <td><input type="checkbox" class="checkboxes" value="{{$value->id}}" id="chkChnnel"></td>
                                            <td>{{$value->username}}</td>
                                            <td>{{$value->first_name}}</td>
                                            <td>{{$value->last_name}}</td>
                                            <td>{{$value->userGroup->group_name}}</td>
                                            <td>
                                                @if($value->active == 1)
                                                    <?php echo "Yes";?>
                                                @else
                                                    <?php echo "No";?>
                                                @endif
                                             </td>
                                            <td>
                                                <a href="{{ URL::route('admin.user.edit',$value->id)}}"  class='btn btn-xs blue'>
                                                    <i class='fa fa-edit'></i>Edit
                                                </a>

                                                <form action="{{ URL::route('admin.user.suspend' , $value->id) }}" id="formTest" onsubmit = "return onSuspendConfirm(this)" style="display:inline-block">
                                                    @if($value->active == 1)
                                                        <button type="submit" class="btn btn-xs green" id="js-a-delete" >
                                                        <i class='fa fa-tasks'></i>
                                                        Suspend ?
                                                      @else
                                                        <button type="submit" class="btn btn-xs red" id="js-a-delete" >
                                                        <i class='fa fa-tasks'></i>
                                                         Suspended
                                                      @endif
                                                    </button>
                                                </form>
                                                 <form action="{{ URL::route('admin.user.delete' , $value->id) }}" id="formTest" onsubmit = "return onDeleteConfirm(this)" style="display:inline-block">
                                                    <button type="submit" class="btn btn-xs red" id="js-a-delete" >
                                                    <i class='fa fa-trash-o'></i> Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                         </div>
                     </div>
                </div>
            </div>
    @stop
    @section('custom-scripts')
    		<script type="text/javascript">
    			jQuery(document).ready(function() {
    				 initTable1();
    			});
    			function onDeleteConfirm( obj){
    				bootbox.confirm("Are you sure?", function(result) {

    					if ( result ) {

    						obj.submit();

    					}

    				});

    				return false;
    			}
    			function onSuspendConfirm(obj){
    			    bootbox.confirm("Are you sure?", function(result) {

                        if ( result ) {

                            obj.submit();

                        }

                    });
                    return false;
    			}
    		</script>
    	@stop
@stop
