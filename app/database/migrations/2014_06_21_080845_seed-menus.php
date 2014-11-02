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
                    'title' => "Student",
                    'nav_menu' => 'admission',
                    'ui_class' => 'glyphicon glyphicon-user',
                    'tab_id' => 'student',
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
                    'title' => "Income",
                    'nav_menu' => 'account',
                    'ui_class' => 'glyphicon glyphicon-import',
                    'tab_id' => 'income',
                    'min_weight' => 1
                ),
                array(
                    'title' => "Expense",
                    'nav_menu' => 'account',
                    'ui_class' => 'glyphicon glyphicon-export',
                    'tab_id' => 'expense',
                    'min_weight' => 1
                ),
                array(
                    'title' => "Tuition Fee",
                    'nav_menu' => 'account',
                    'ui_class' => 'icon-large icon-calendar',
                    'tab_id' => 'tuition_fee',
                    'min_weight' => 4
                ),
                array(
                    'title' => "Transport Fee",
                    'nav_menu' => 'account',
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
                ),
                array(
                    'title' => "Beneficiary",
                    'nav_menu' => 'payroll',
                    'ui_class' => 'icon-large icon-old-man',
                    'tab_id' => 'beneficiary',
                    'min_weight' => 4
                ),
                array(
                    'title' => "Salary",
                    'nav_menu' => 'payroll',
                    'ui_class' => 'icon-large icon-pie-chart',
                    'tab_id' => 'salary',
                    'min_weight' => 4
                ),
                array(
                    'title' => "Loan Given",
                    'nav_menu' => 'payroll',
                    'ui_class' => 'icon-large icon-credit',
                    'tab_id' => 'loan',
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
