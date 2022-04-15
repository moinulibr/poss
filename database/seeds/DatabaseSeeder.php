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

    }


}
