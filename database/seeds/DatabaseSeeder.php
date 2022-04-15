<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        DB::table('supplier_typies')->insert([
            [
                'name' => 'Main Supplier',
                'description' => 'Main Supplier',
                'created_by' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Reseller',
                'description' => 'Reseller like local supplier',
                'created_by' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]
        ]);

        DB::table('customer_typies')->insert([
            [
                'name' => 'Permanent Customer',
                'description' => 'Main Supplier',
                'created_by' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Walking / Temporary Customer',
                'description' => 'Walking / Temporary Customer',
                'created_by' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]
        ]);

        DB::table('discount_typies')->insert([
            [
                'name' => 'Fixed',
                'description' => 'Fixed',
                'created_by' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Percentage',
                'description' => 'Percentage',
                'created_by' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]
        ]);

        DB::table('commissions_typies')->insert([
            [
                'name' => 'Fixed',
                'description' => 'Fixed',
                'created_by' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Percentage',
                'description' => 'Percentage',
                'created_by' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]
        ]);

        DB::table('liability_typies')->insert([
            [
                'name' => 'Warranty',
                'description' => 'Warranty',
                'created_by' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Guarantee',
                'description' => 'Guarantee',
                'created_by' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]
        ]);

        DB::table('price_typies')->insert([
            [
                'name' => 'mrp_price',
                'label' => 'MRP Price',
                'description' => 'MRP Price',
                'created_by' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'sell_price',
                'label' => 'Sell Price',
                'description' => 'Regular Sell Price',
                'created_by' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],[
                'name' => 'whole_sell_price',
                'label' => 'Whole Sell Price',
                'description' => 'Whole Sell Price',
                'created_by' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],[
                'name' => 'offer_price',
                'label' => 'Offer Price',
                'description' => 'Offer Sell Price',
                'created_by' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],[
                'name' => 'purchase_price',
                'label' => 'Purchase Price',
                'description' => 'Purchase Price',
                'created_by' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]
        ]);

        DB::table('stock_typies')->insert([
            [
                'name' => 'regular_stock',
                'label' => 'Regular Stock',
                'description' => 'Regular Stock',
                'created_by' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'low_stock',
                'label' => 'Low Stock',
                'description' => 'Low Stock',
                'created_by' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],[
                'name' => 'high_stock',
                'label' => 'High Stock',
                'description' => 'High Stock',
                'created_by' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],[
                'name' => 'offer_stock',
                'label' => 'Offer Stock',
                'description' => 'Offer Stock',
                'created_by' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],[
                'name' => 'reseller_stock',
                'label' => 'Reseller Stock',
                'description' => 'Reseller Stock',
                'created_by' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]
        ]);

        DB::table('units')->insert([
            [
                'full_name' => 'Piece',
                'short_name' => 'Piece',
                'parent_id' => 0,
                'parent_cal_result' => NULL,
                'calculation_value' => 1.000,
                'calculation_result' =>  1.000,
                'base_unit_id' => 1,
                'description' => 'Piece',
                'created_by' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'full_name' => 'Inch',
                'short_name' => 'Inch',
                'parent_id' => 0,
                'parent_cal_result' => NULL,
                'calculation_value' => 1.000,
                'calculation_result' =>  1.000,
                'base_unit_id' => 2,
                'description' => 'Inch',
                'created_by' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],[
                'full_name' => 'Fit',
                'short_name' => 'Fit',
                'parent_id' => 2,
                'parent_cal_result' => 1.000,
                'calculation_value' => 12.000,
                'calculation_result' =>  12.000,
                'base_unit_id' => 2,
                'description' => 'Fit',
                'created_by' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],[
                'full_name' => 'Liter',
                'short_name' => 'Liter',
                'parent_id' => 0,
                'parent_cal_result' => NULL,
                'calculation_value' => 1.000,
                'calculation_result' =>  1.000,
                'base_unit_id' => 4,
                'description' => 'Liter',
                'created_by' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],[
                'full_name' => 'Gram',
                'short_name' => 'gm',
                'parent_id' => 0,
                'parent_cal_result' => NULL,
                'calculation_value' => 1.000,
                'calculation_result' =>  1.000,
                'base_unit_id' => 5,
                'description' => 'Gram',
                'created_by' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],[
                'full_name' => 'Kilogram',
                'short_name' => 'kg',
                'parent_id' => 5,
                'parent_cal_result' => 1.000,
                'calculation_value' => 1000.000,
                'calculation_result' =>  1000.000,
                'base_unit_id' => 5,
                'description' => 'Kilogram',
                'created_by' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]
        ]);

        DB::table('stock_changing_typies')->insert([
            [
                'name' => 'increase_stock_when_product_add',
                'label' => 'product inserted time - initial stock added here',
                'changing_sign' => '+',
                'description' => 'When product inserted, initial stock added here',
                'created_by' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'decrease_stock_when_transfer_regular',
                'label' => 'Stock Transfer :Regular',
                'changing_sign' => '-',
                'description' => 'When Stock Transfer to another stock :-its regular process',
                'created_by' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],[
                'name' => 'increase_stock_when_received_transfered_stock_regular',
                'label' => 'Received Transfered Stock :Regular',
                'changing_sign' => '+',
                'description' => 'Received Transfered Stock when another stock transfer :-its regular process',
                'created_by' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],[
                'name' => 'decrease_stock_regular',
                'label' => 'Decrease Stock :Regular selling time',
                'changing_sign' => '-',
                'description' => 'Stock reduced When sell product :-its regular process',
                'created_by' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],[
                'name' => 'increase_stock_received_buy_product_regular',
                'label' => 'Received buy product Stock :Regular buying product time',
                'changing_sign' => '+',
                'description' => 'Received buy product Stock when product buy and received :-its regular process',
                'created_by' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],[
                'name' => 'stock_re_increase_when_selling_return_regular',
                'label' => 'Stock increase :Regular selling return time',
                'changing_sign' => '+',
                'description' => 'Stock increase :Regular selling return :-its regular process',
                'created_by' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],[
                'name' => 'decrease_stock_when_buy_product_return_regular',
                'label' => 'Stock Decrease/Reduce :Regular Bue return time',
                'changing_sign' => '-',
                'description' => 'Stock Decrease/Reduce :Regular Bue return :-its regular process',
                'created_by' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ]);

    }


}
