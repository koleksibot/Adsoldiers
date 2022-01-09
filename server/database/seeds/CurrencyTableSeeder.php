<?php

use App\Ads\Domain\Models\Currency;
use Illuminate\Database\Seeder;

class CurrencyTableSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		Currency::create([
			'currency_name' => 'ريال سعودى',
			'currency_name_en' => 'Saudi riyal',
			'ISO4217_ALPHA3' => 'SAR',
			'ISO4217_NUM3' => '682',
		]);
		Currency::create([
			'currency_name' => 'US Dollar',
			'currency_name_en' => 'US Dollar',
			'ISO4217_ALPHA3' => 'USD',
			'ISO4217_NUM3' => '840',
		]);
	}
}
