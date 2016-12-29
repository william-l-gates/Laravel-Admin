@extends('admin.layout')
    @section('body')
         <h3 class="page-title">Order Items</h3>
           <div class="page-bar">
               <ul class="page-breadcrumb">
                   <li>
                       <i class="fa fa-home"></i>
                       <a href="{{URL::route('admin.dashboard')}}">Home</a>
                       <i class="fa fa-angle-right"></i>
                   </li>
                   <li>
                       <i class="fa fa-pencil"></i>
                       <a href="{{URL::route('admin.orderItems')}}">Order Items</a>
                   </li>
               </ul>
           </div>
          <div class="row">
              <div class="col-md-12">
                  <div class="portlet box blue">
                      <div class="portlet-title">
                          <div class="caption">
                              <i class="fa fa-globe"></i> Order Items List
                          </div>
                      </div>
                      <div class="portlet-body">
                            <table class="table table-striped table-bordered table-hover" id="sample_1">
                                    <thead>
                                        <tr>
                                            <th class="table-checkbox">
                                                <input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes"/>
                                            </th>
                                            <th>Item Name</th>
                                            <th>Item Description</th>
                                            <th>SKU</th>
                                            <th>Unit Weight</th>
                                            <th>Item Price</th>
                                             <th>Order Quantity</th>
                                              <th>Balance Quantity</th>
                                            <th class= "sorting_disabled">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($ordersItem as $key =>$value)
                                            <tr>
                                                <td><input type="checkbox" class="checkboxes" value="{{$value->id}}" id="chkChnnel"></td>
                                                <td>{{$value->ItemName}}</td>
                                                 <td>{{$value->ItemDescription}}</td>
                                                 <td>{{$value->SKU}}</td>
                                                 <td>{{$value->UnitWeight}}</td>
                                                 <td>{{$value->ItemPrice}}</td>
                                                 <td>{{$value->Order_Qty}}</td>
                                                 <td>{{$value->Balance_Qty}}</td>
                                                 <td>
                                                    <?php if($value->product_id == "") {?>
                                                        <a href="javascript:void(0)" onclick="onSendProduct({{$value->id}})"  class='btn btn-xs blue' style="margin-top:10px">
                                                             <i class='fa fa-edit'></i>Add  Product
                                                         </a>
                                                    <?php }?>
                                                    <a href="javascript:void(0)" onclick="onInventoryProduct({{$value->id}})"  class='btn btn-xs green'  style="margin-top:10px">
                                                         <i class='fa fa-edit'></i>Add Inventory
                                                     </a>
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
            function onSendProduct(id){
                var base_url = window.location.origin;
                $.ajax ({
                   url: base_url + '/order_items/setProduct',
                   type: 'POST',
                   data: {id: id},
                   cache: false,
                   dataType : "json",
                   success: function (data) {
                       if(data.result == "success"){
                            window.location.reload();
                         }
                      }
                });
            }
             function onInventoryProduct(id){
                var base_url = window.location.origin;
                $.ajax ({
                   url: base_url + '/order_items/setInventory',
                   type: 'POST',
                   data: {id: id},
                   cache: false,
                   dataType : "json",
                   success: function (data) {
                       if(data.result == "success"){
                            window.location.reload();
                         }else if(data.result == "failed"){
                            alert("You have to send message to customer");
                         }
                      }
                });
            }
        </script>
      @stop
@stop
