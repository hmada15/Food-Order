<?php
namespace App\Actions;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class CreateOrderAction
{

    public function execute($request)
    {
        DB::beginTransaction();

        $all_products_prices = [];
        //Get product prices
        $products = json_decode($request->products);

        foreach ($products as $product_id) {
            $product = Product::where("id", $product_id)->get(["regular_price", "sale_price"])->first();
            array_push($all_products_prices, !empty($product->sale_price) ? $product->sale_price : $product->regular_price);
        }

        $number_of_product = json_decode($request->number_of_product);

        // dd( $number_of_product);

        //Multiply product prices by the number of products
        foreach ($all_products_prices as $key => $price) {
            $total[] = $price * $number_of_product[$key];
        }

        //Get the total amount of order
        $amount = array_sum($total);

        $order = Order::create([
            "client_id" => auth()->id(),
            "address_id" => $request->address_id,
            "payment_method" => $request->payment_method,
            "tax_id" => $request->tax_id,
            "delivery_fee_id" => $request->delivery_fee_id,
            "status" => $request->status,
            "total_amount" => $amount,
            "note" => $request->note,
        ]);

        $order->products()->sync($products);

        $ids = json_decode(json_encode($order->products()->allRelatedIds()), true);

        $productss = array_combine($ids, $products);

        foreach ($productss as $id => $producte) {
            $order->products()->updateExistingPivot($id, ['number_of_product' => $producte]);
        }

        DB::commit();

        return $order;
    }
}
