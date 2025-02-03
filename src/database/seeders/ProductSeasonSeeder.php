<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeasonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $goodseason = [
            'キウイ' => ['秋', '冬'],
            'ストロベリー' => ['春'],
            'オレンジ' => ['冬'],
            'スイカ' => ['夏'],
            'ピーチ' => ['夏'],
            'シャインマスカット' => ['夏', '秋'],
            'パイナップル' => ['春', '夏'],
            'ブドウ' => ['夏', '秋'],
            'バナナ' => ['夏'],
            'メロン' => ['春', '夏']
        ];

        foreach ($goodseason as $productName => $seasons) {
            $product = DB::table('products')->where('name', $productName)->first();
            foreach ($seasons as $seasonName) {
                $season = DB::table('seasons')->where('name', $seasonName)->first();

                if (!$season) {
                    echo "Warning: Season '$seasonName' not found, skipping.\n";
                    continue;
                }

                DB::table('product_season')->insert([
                    'product_id' => $product->id,
                    'season_id' => $season->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
    

