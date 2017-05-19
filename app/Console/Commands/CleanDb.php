<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CleanDb extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'clean:db';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clean database';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        \DB::statement("TRUNCATE TABLE coupon");
        \DB::statement("TRUNCATE TABLE customers");
        \DB::statement("TRUNCATE TABLE data");
        \DB::statement("TRUNCATE TABLE frames");
        \DB::statement("TRUNCATE TABLE inventory");
        \DB::statement("TRUNCATE TABLE `orders`");
        \DB::statement("TRUNCATE TABLE order_details");
        \DB::statement("TRUNCATE TABLE order_details_product_in_stock");
        \DB::statement("TRUNCATE TABLE order_processing");
        \DB::statement("TRUNCATE TABLE pages");
        \DB::statement("TRUNCATE TABLE post_categories");
        \DB::statement("TRUNCATE TABLE product");
        \DB::statement("TRUNCATE TABLE product_group");
        \DB::statement("TRUNCATE TABLE product_images");
        \DB::statement("TRUNCATE TABLE product_properties");
        \DB::statement("TRUNCATE TABLE properties");
        \DB::statement("TRUNCATE TABLE properties_value");
        \DB::statement("TRUNCATE TABLE purchases_ph");
        \DB::statement("TRUNCATE TABLE purchases_ph_details");
        \DB::statement("TRUNCATE TABLE setting_website");
        \DB::statement("TRUNCATE TABLE shop_pages");
        \DB::statement("TRUNCATE TABLE shop_posts");
        \DB::statement("TRUNCATE TABLE shop_post_categories");
        \DB::statement("TRUNCATE TABLE sites");
        \DB::statement("TRUNCATE TABLE store");
        \DB::statement("TRUNCATE TABLE supplier");
        \DB::statement("TRUNCATE TABLE units");
        \DB::statement("TRUNCATE TABLE variant_values");
        \DB::statement("TRUNCATE TABLE warehouse");
        \DB::statement("TRUNCATE TABLE warehouse_inventory");
    }
}
