<?php
namespace App\Actions;

use App\Models\Order;
use App\Models\Product;
use App\Models\TaxValue;
use App\Models\DeliveryFee;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class CreateOrderAction
{

    public function execute($request)
    {
        DB::beginTransaction();

        $all_products_prices = [];
        //Get product prices
        $products = json_decode($request->products);
        $number_of_product = json_decode($request->number_of_product);

        if (count($products) !== count($number_of_product)) {
            DB::rollback();
            throw ValidationException::withMessages(['products' => 'Products and number of product must hve the same length']);
        }

        foreach ($products as $product_id) {
            $product = Product::where("id", $product_id)->get(["regular_price", "sale_price"])->first();
            array_push($all_products_prices, !empty($product->sale_price) ? $product->sale_price : $product->regular_price);
        }

        //Multiply product prices by the number of products
        $amount = 0;
        foreach ($all_products_prices as $key => $price) {
            $amount += $price * $number_of_product[$key];
        }

        if ($request->delivery_fee_id) {
            $delivery_fee = DeliveryFee::select('amount')->find($request->delivery_fee_id);
            // dd($delivery_feet->amount);
            $amount += $delivery_fee->amount;
        }
        if ($request->tax_id) {
            $tax_id = TaxValue::select('amount')->find($request->tax_id);
            $present_value = ($amount / 100) * ($tax_id->amount);
            $amount += $present_value;
        }

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
