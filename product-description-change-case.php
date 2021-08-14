<?php
/**
 * Woocommerce Product Description case changer
 *
 * Plugin Name:  Product Description Case Change
 * Description:  Woocommerce Product Description case change
 * Version:      1.0.0
 * Author:       Hamza Siddique
 * Author URI:   https://www.upwork.com/freelancers/~01d452dc67bce01a15
 * Text Domain:  Product Description case change
 */

defined('ABSPATH') || exit;

// define the woocommerce_short_description callback
function filter_woocommerce_short_description($post_post_excerpt) {

	include plugin_dir_path(__FILE__) . 'countries_brands.php';

	$des = '';
	$des = strtolower($post_post_excerpt);
	$des = trim($des, " ");
	$post_post_excerpt = '';

	$sentences = explode(".", $des);

	foreach ($sentences as $key => $sentence) {
		$sentence = trim($sentence, " ");
		$sentence = ucfirst($sentence);
		$post_post_excerpt .= $sentence . ". ";
	}

	foreach ($brands as $key => $brand) {
		$brand = strtolower($brand);
		$b_count += 1;
		//echo "<br>";
		$post_post_excerpt = str_ireplace($brand, ucwords($brand), $post_post_excerpt, $i);

		// if ($i > 0) {
		// 	$chance += 1;
		// 	echo "Counter: " . $b_count;
		// 	echo $brand;
		// 	echo "  Replacements: $i";
		// 	echo "<br>";
		// 	if ($chance > 2) {
		// 		die();
		// 	}

		// }

	}

	foreach ($countries as $key => $country) {
		foreach ($country as $key => $inner_country) {

			$country = strtolower($inner_country);
			$post_post_excerpt = str_replace($country, ucwords($country), $post_post_excerpt);
		}
	}

	return $post_post_excerpt;

};

add_filter('woocommerce_short_description', 'filter_woocommerce_short_description');

function filter_woocommerce_description($content) {

	global $post;

	if ($post->post_type == 'product') {

		include plugin_dir_path(__FILE__) . 'countries_brands.php';

		$des = '';
		$des = strtolower($content);
		$des = trim($des, " ");
		$content = '';

		$sentences = explode(".", $des);

		foreach ($sentences as $key => $sentence) {
			$sentence = trim($sentence, " ");
			$sentence = ucfirst($sentence);
			$content .= $sentence . ". ";
		}

		foreach ($brands as $key => $brand) {
			$brand = strtolower($brand);
			$b_count += 1;
			//echo "<br>";
			$content = str_ireplace($brand, ucwords($brand), $content, $i);

		}

		foreach ($countries as $key => $country) {
			foreach ($country as $key => $inner_country) {

				$country = strtolower($inner_country);
				$content = str_replace($country, ucwords($country), $content);
			}
		}
	}

	return $content;
}
add_filter('the_content', 'filter_woocommerce_description');
