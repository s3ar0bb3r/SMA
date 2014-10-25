<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeedMenus extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        DB::table('menus')->insert(
            array(
                array(
                    'title' => "Product",
                    'nav_menu' => 'sells',
                    'ui_class' => 'glyphicon glyphicon-briefcase',
                    'tab_id' => 'product',
                    'min_weight' => 4
                ),
                array(
                    'title' => "Category",
                    'nav_menu' => 'sells',
                    'ui_class' => 'glyphicon glyphicon-adjust',
                    'tab_id' => 'category',
                    'min_weight' => 4
                ),
                array(
                    'title' => "Package Product",
                    'nav_menu' => 'sells',
                    'ui_class' => 'icon-large icon-gift',
                    'tab_id' => 'package',
                    'min_weight' => 4
                ),
                array(
                    'title' => "Sells",
                    'nav_menu' => 'sells',
                    'ui_class' => 'glyphicon-barcode',
                    'tab_id' => 'sells',
                    'min_weight' => 4
                ),
                array(
                    'title' => "Admission",
                    'nav_menu' => 'admission',
                    'ui_class' => 'glyphicon glyphicon-user',
                    'tab_id' => 'admission',
                    'min_weight' => 4
                ),
                array(
                    'title' => "User",
                    'nav_menu' => 'administrator',
                    'ui_class' => 'icon-large  icon-group',
                    'tab_id' => 'user',
                    'min_weight' => 5
                ),
                array(
                    'title' => "Income Types",
                    'nav_menu' => 'administrator',
                    'ui_class' => 'glyphicon glyphicon-plus-sign',
                    'tab_id' => 'income',
                    'min_weight' => 1
                ),
                array(
                    'title' => "Expense Types",
                    'nav_menu' => 'administrator',
                    'ui_class' => 'glyphicon glyphicon-minus-sign',
                    'tab_id' => 'expense',
                    'min_weight' => 1
                ),
                array(
                    'title' => "Income Entry",
                    'nav_menu' => 'administrator',
                    'ui_class' => 'glyphicon glyphicon-import',
                    'tab_id' => 'income_entry',
                    'min_weight' => 1
                ),
                array(
                    'title' => "Expense Entry",
                    'nav_menu' => 'administrator',
                    'ui_class' => 'glyphicon glyphicon-export',
                    'tab_id' => 'expense_entry',
                    'min_weight' => 1
                ),
                array(
                    'title' => "Tuition Fee",
                    'nav_menu' => 'administrator',
                    'ui_class' => 'icon-large icon-calendar',
                    'tab_id' => 'tuition_fee',
                    'min_weight' => 4
                ),
                array(
                    'title' => "Transport Fee",
                    'nav_menu' => 'administrator',
                    'ui_class' => 'icon-large icon-bus',
                    'tab_id' => 'transport_fee',
                    'min_weight' => 4
                ),
                array(
                    'title' => "Registration",
                    'nav_menu' => 'admission',
                    'ui_class' => 'glyphicon glyphicon-registration-mark',
                    'tab_id' => 'registration',
                    'min_weight' => 4
                )
            )
        );
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        DB::table('menus')->delete();
	}

}
