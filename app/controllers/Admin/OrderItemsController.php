<?php namespace Admin;

use Illuminate\Routing\Controllers\Controller;
use View, Input, Redirect, Session, Validator,Response;
use OrderItems  as OrderItemsModel, Orders as  OrdersModel, Jobs as JobsModel, Products as ProductsModel,InventoryItems as InventoryItemsModel, InventoryItemLog as InventoryItemLogModel;
class OrderItemsController extends \BaseController
{
    public function __construct()
    {
        $this->beforeFilter(function () {
            if (!Session::has('user_id')) {
                return Redirect::route('admin.auth.login');
            }
        });
    }
    public function index(){
        $param['pageNo']= 21;
        if ($alert = Session::get('alert')) {
            $param['alert'] = $alert;
        }
        $ordersItem = OrderItemsModel::whereRaw('order_item = 0')->get();
        $param['ordersItem'] = $ordersItem;

        return View::make('admin.order.index')->with($param);
    }
    public function setProduct(){
        $id = Input::get('id');
        $orderItems = OrderItemsModel::find($id);
        if(count($orderItems)>0){
            $orders = OrdersModel::find($orderItems->Order_Id);
            if(count($orders)>0){
                $jobs = JobsModel::find($orders->Job_Id);
                $channel_id = $jobs->Channel_Id;
                $product = new ProductsModel;
                $product->Channel_Id = $channel_id;
                $product->Product_Name = $orderItems->ItemName;
                $product->Product_Description = $orderItems->ItemDescription;
                $product->Price = $orderItems->ItemPrice;
                $product->Image_URL = 1;
                $product->Catelog_Id = 1;
                $product->RefItemId = $orderItems->ItemRefId;
                $product->SKU = $orderItems->SKU;
                $product->UnitWeight = $orderItems->UnitWeight;
                $product->Active =1 ;
                $product->save();
            }
        }
        $orderItems->product_id = $product->id;
        $orderItems->save();
        return Response::json(['result' =>"success"]);
    }


    public function setInventory(){
        $id = Input::get('id');
        $orderItems = OrderItemsModel::find($id);
        if(count($orderItems)>0) {
            $orders = OrdersModel::find($orderItems->Order_Id);
            if (count($orders) > 0) {
                $jobs = JobsModel::find($orders->Job_Id);
                $channel_Id = $jobs->Channel_Id;
                $job_Id = $jobs->id;
            }
        }
        if($orderItems->product_id != "") {
            $product_id= $orderItems->product_id;
        }else{
            $product = new ProductsModel;
            $product->Channel_Id = $channel_Id;
            $product->Product_Name = $orderItems->ItemName;
            $product->Product_Description = $orderItems->ItemDescription;
            $product->Price = $orderItems->ItemPrice;
            $product->Image_URL = 1;
            $product->Catelog_Id = 1;
            $product->RefItemId = $orderItems->ItemRefId;
            $product->SKU = $orderItems->SKU;
            $product->UnitWeight = $orderItems->UnitWeight;
            $product->Active =1 ;
            $product->save();
            $product_id = $product->id;
        }
        $orderItemList = OrderItemsModel::whereRaw('Order_Id=? and Order_Item != 0',array($orderItems->Order_Id))->first();
        if(count($orderItemList)>0){
            $inventoryItemList = InventoryItemsModel::find($orderItemList->Order_Item);
            $warehouse_Id = $inventoryItemList->Warehouse_Id;
            $inventoryItem = new InventoryItemsModel;
            $inventoryItem->Product_Id = $product_id;
            $inventoryItem->Warehouse_Id = $warehouse_Id;
            $inventoryItem->Channel_Id = $channel_Id;
            $inventoryItem->Stock_Count = $orderItems->Order_Qty;
            $inventoryItem->Re_Order_Level = "0";
            $inventoryItem->Notes =$orderItems->ItemDescription;
            $inventoryItem->Active =1;
            $inventoryItem->save();

            $inventoryID = $inventoryItem->id;
            $orderItems->Order_Item = $product_id;
            $orderItems->product_id = $product_id;
            $orderItems->save();

            $InventoryLog = new InventoryItemLogModel;
            $InventoryLog->InventoryItem_Id = $inventoryID;
            $InventoryLog->Job_Id = $job_Id;
            $InventoryLog->Product_Id = $product_id;
            $InventoryLog->Warehouse_Id = $warehouse_Id;
            $InventoryLog->Channel_Id = $channel_Id;
            $InventoryLog->Stock_Count =$orderItems->Order_Qty;
            $InventoryLog->Active = 1;
            $InventoryLog->save();
            return Response::json(['result' =>"success"]);
            exit;
        }else{
            return Response::json(['result' =>"failed"]);
            exit;
        }

    }
}