<?php
/*
	Plugin Name: Карта в заказе
	Plugin URI: http://osc-cms.com/store/plugins/order-map
	Version: 1.0
	Description: Плагин реализует возможность выводить карту на странице заказа
	Author: CartET
	Author URI: http://osc-cms.com
	Plugin Group: Orders
*/

add_filter('tabs_order', 'order_map_tab');
function order_map_tab($value)
{
	global $order;

	$order_id = (int)$_GET['oID'];

	if (isset($order_id) && is_object($order))
	{
		$frame = '<iframe width="100%" height="800px" name="content" src="'._HTTP.'admin/plugins_page.php?page=order_map_frame&o_id='.$order_id.'" frameborder="0"></iframe>';

		$value['values'][] =  array
		(
			'tab_name'		=> 'Карта',
			'tab_content'	=> $frame
		);
	}
	return $value;
}

add_action('page_admin', 'order_map_frame');
function order_map_frame()
{
	include dirname(__FILE__).'/order_map_frame.php';
}

function order_map_install()
{
}

function order_map_remove()
{
}