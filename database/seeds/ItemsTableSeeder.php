<?php

use Illuminate\Database\Seeder;
use App\Models\Categories;
use App\Models\Items;

class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       
        $dataCats = [
        	[
        		'name' => 'Stock',
        	],
        	[
        		'name' => 'Non Stock',
        	]
        ];

        $codeItem = [
        	[
        		'code' => 'AAH',
        	],
        	[
        		'code' => 'AAZ',
        	]
        ];

        $nameItem  = [
        	[
        		'name' => 'Sapu Lidi',
        	],
        	[
        		'name' => 'Sapu Ijuk',
        	]
        ];

        $brandItem = [
        	[
        		'brand' => 'value plus',
        	],
        	[
        		'brand' => 'one plus',
        	]
        ];	

        for ($i=0; $i < count($dataCats); $i++) { 
        	$save_cat = new Categories;
        	$save_cat->name = implode(',', $dataCats[$i]);
        	$save_cat->save();	

        	$save_items = new Items;
        	$save_items->idcategories = $save_cat->idcategories;
        	$save_items->code = implode(',', $codeItem[$i]);
        	$save_items->name = implode(',', $nameItem[$i]);
        	$save_items->unit = 'PCS';
        	$save_items->brand = implode(',', $brandItem[$i]);
        	$save_items->active = TRUE;
        	$save_items->save();

        }
    }
}
