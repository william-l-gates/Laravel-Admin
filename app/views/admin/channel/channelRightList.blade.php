@extends('admin.layout')
    @section('body')
         <h3 class="page-title">Channel Right List</h3>
          <h4 style="margin-bottom: 20px">Channel Rights cannot be edited by admin since they are directly tied to programable elements in the code and database. If you need another type of Channel RIghts, please contact your system developer.</h4>
          <div class="row">
              <div class="col-md-12">
                  <div class="portlet box blue">
                      <div class="portlet-title">
                          <div class="caption">
                              <i class="fa fa-globe"></i> Channel Right List
                          </div>
                      </div>
                      <div class="portlet-body">
                            <table class="table table-striped table-bordered table-hover" id="sample_1">
                                <thead>
                                    <tr>
                                        <th class="table-checkbox">
                                            <input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes"/>
                                        </th>
                                        <th>Right Name</th>
                                         <th>Short Description</th>
                                        <th class= "sorting_disabled">Active</th>
                                    </tr>
                                </thead>
                                <tbody>
                                     @foreach($channelRight as $key=>$value)
                                        <tr>
                                            <td><input type="checkbox" class="checkboxes" value="{{$value->id}}" id="chkChnnel"></td>
                                             <td>{{$value->channel_right_name}}</td>
                                             <td>{{$value->description}}</td>
                                             <td>
                                                @if($value->active == 1)
                                                    <?php echo "Yes";?>
                                                @else
                                                    <?php echo "No";?>
                                                @endif
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
        </script>
    @stop
@stop