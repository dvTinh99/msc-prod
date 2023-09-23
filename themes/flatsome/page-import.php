<?php
/*
* Template Name: import
*/
$all_file = getAllFile();
foreach ($all_file as $single) {
    readSingleFile($single);
}

function my_featured_image($image_url, $post_id)
{
    $upload_dir = wp_upload_dir();
    $image_data = file_get_contents($image_url);
    $filename = strtok($image_url, '?');
    $filename = basename($filename);
    if (wp_mkdir_p($upload_dir["path"])) {
        $file = $upload_dir["path"] . "/" . $filename;
    } else {
        $file = $upload_dir["basedir"] . "/" . $filename;
    }
    file_put_contents($file, $image_data);
    $wp_filetype = wp_check_filetype($filename, null);
    $post_author = get_post_field("post_author", $post_id);
    $attachment = array(
        "post_author" => $post_author,
        "post_mime_type" => $wp_filetype["type"],
        "post_title" => sanitize_file_name($filename),
        "post_content" => "",
        "post_status" => "inherit"
    );
    $attach_id = wp_insert_attachment($attachment, $file, $post_id);
    require_once(ABSPATH . "wp-admin/includes/image.php");
    $res2 = set_post_thumbnail($post_id, $attach_id);

    return $res2;
}

// đệ quy lấy all file in dir
function getAllFile()
{

    $folder = (read_dir(dirname(__FILE__)  . '/msc-shop-crawl/'));
    $arr = [];
    foreach ($folder as $f) {
        $child = read_dir(dirname(__FILE__) . '/msc-shop-crawl/' . $f);

        foreach ($child as $ch) {
            $path = (dirname(__FILE__) . '/msc-shop-crawl/' . $f . '/' . $ch);
            // die();
            array_push($arr, $path);
        }
    }
    return $arr;
}
// $all_file =  ;
function read_dir($dir, $type = 'both', $extra = false)
{

    $dh = opendir($dir);
    $infod = array();
    $infof = array();

    while ($name = readdir($dh)) {
        if (
            $name == "." || $name == ".." || $name == '.git' || $name == 'public' || $name == 'app.js'
            || $name == 'leech.js' || $name == 'package-lock.json' || $name == 'package.json'
        ) continue;
        if (is_dir("$dir/$name") && ($type == 'dir' || $type == 'both')) {
            if ($extra) {

                $tinfo['name'] = $name;

                $tinfo['path'] = $dir . '/' . $name;

                $tinfo['size'] = 'NA';

                $tinfo['created'] = filectime("$dir/$name");

                $tinfo['type'] = 'Folder';

                $infod[] = $tinfo;
            } else $infod[] = $name;
        }

        if (is_file("$dir/$name") && ($type == 'file' || $type == 'both')) {

            if ($extra) {

                $tinfo['name'] = $name;

                $tinfo['path'] = $dir . '/' . $name;

                $tinfo['size'] = filesize("$dir/$name");

                $tinfo['created'] = filectime("$dir/$name");

                $tinfo['type'] = 'File';

                $infof[] = $tinfo;
            } else $infof[] = $name;
        }
    }

    $info = array_merge($infod, $infof);

    return $info;
}



function readSingleFile($url)
{
    echo ($url);
    $myfile = fopen($url, "r")
        or die("Unable to open file!");
    $line = '';
    while (!feof($myfile)) {
        $line .= fgets($myfile);
    }
    fclose($myfile);

    $arr_obj = json_decode($line);
    foreach ($arr_obj as $ob) {
        create_sigle($ob);
    }
}


function create_sigle($ob)
{

    $image_path = dirname(__FILE__) . '/msc-shop-crawl/' . $ob->avatar;
    if (!(int) $ob->price > 1000000)
        $ob->price = ($ob->price . '.000');

        //$args['status'] : 'draft'
    $product_id = create_product(array(
        'status'             => 'draft',
        'type'               => '', // Simple product by default
        'name'               => __($ob->name, "woocommerce"),
        'description'        => __($ob->content, "woocommerce"),
        'short_description'  => __("short des demo", "woocommerce"),
        'regular_price'      => ($ob->price . '.1000'), // product price
        'sale_price'         => ($ob->oldPrice  . '.1000'),
        //   'category_ids'       => $rand_cate,
        'reviews_allowed'    => true,
        'attributes'         => $arr_attr,
        'tech'         => $ob->tech,
    ));

    // Displaying the created product ID
    my_featured_image($image_path, $product_id);
    // wp_set_object_terms($product_id, 'bo-mach-chu', 'build-pc', true );
    echo $product_id;
}

// Custom function for product creation (For Woocommerce 3+ only)
function create_product($args)
{

    if (!function_exists('wc_get_product_object_type') && !function_exists('wc_prepare_product_attributes'))
        return false;

    // Get an empty instance of the product object (defining it's type)
    $product = wc_get_product_object_type($args['type']);
    if (!$product)
        return false;

    // Product name (Title) and slug
    $product->set_name($args['name']); // Name (title).
    if (isset($args['slug']))
        $product->set_name($args['slug']);

    // Description and short description:
    $product->set_description($args['description']);
    $product->set_short_description($args['short_description']);

    // Status ('publish', 'pending', 'draft' or 'trash')
    $product->set_status(isset($args['status']) ? $args['status'] : 'draft');

    // Visibility ('hidden', 'visible', 'search' or 'catalog')
    $product->set_catalog_visibility(isset($args['visibility']) ? $args['visibility'] : 'visible');

    // Featured (boolean)
    $product->set_featured(isset($args['featured']) ? $args['featured'] : false);

    // Virtual (boolean)
    $product->set_virtual(isset($args['virtual']) ? $args['virtual'] : false);

    // Prices
    $product->set_regular_price($args['regular_price']);
    $product->set_sale_price(isset($args['sale_price']) ? $args['sale_price'] : '');
    $product->set_price(isset($args['sale_price']) ? $args['sale_price'] :  $args['regular_price']);
    if (isset($args['sale_price'])) {
        $product->set_date_on_sale_from(isset($args['sale_from']) ? $args['sale_from'] : '');
        $product->set_date_on_sale_to(isset($args['sale_to']) ? $args['sale_to'] : '');
    }

    // Downloadable (boolean)
    $product->set_downloadable(isset($args['downloadable']) ? $args['downloadable'] : false);
    if (isset($args['downloadable']) && $args['downloadable']) {
        $product->set_downloads(isset($args['downloads']) ? $args['downloads'] : array());
        $product->set_download_limit(isset($args['download_limit']) ? $args['download_limit'] : '-1');
        $product->set_download_expiry(isset($args['download_expiry']) ? $args['download_expiry'] : '-1');
    }

    // Taxes
    if (get_option('woocommerce_calc_taxes') === 'yes') {
        $product->set_tax_status(isset($args['tax_status']) ? $args['tax_status'] : 'taxable');
        $product->set_tax_class(isset($args['tax_class']) ? $args['tax_class'] : '');
    }

    // SKU and Stock (Not a virtual product)
    if (isset($args['virtual']) && !$args['virtual']) {
        $product->set_sku(isset($args['sku']) ? $args['sku'] : '');
        $product->set_manage_stock(isset($args['manage_stock']) ? $args['manage_stock'] : false);
        $product->set_stock_status(isset($args['stock_status']) ? $args['stock_status'] : 'instock');
        if (isset($args['manage_stock']) && $args['manage_stock']) {
            $product->set_stock_status($args['stock_qty']);
            $product->set_backorders(isset($args['backorders']) ? $args['backorders'] : 'no'); // 'yes', 'no' or 'notify'
        }
    }

    // Sold Individually
    $product->set_sold_individually(isset($args['sold_individually']) ? $args['sold_individually'] : false);

    // Weight, dimensions and shipping class
    $product->set_weight(isset($args['weight']) ? $args['weight'] : '');
    $product->set_length(isset($args['length']) ? $args['length'] : '');
    $product->set_width(isset($args['width']) ?  $args['width']  : '');
    $product->set_height(isset($args['height']) ? $args['height'] : '');
    if (isset($args['shipping_class_id']))
        $product->set_shipping_class_id($args['shipping_class_id']);

    // Upsell and Cross sell (IDs)
    $product->set_upsell_ids(isset($args['upsells']) ? $args['upsells'] : '');
    $product->set_cross_sell_ids(isset($args['cross_sells']) ? $args['upsells'] : '');

    // Attributes et default attributes
    if (isset($args['attributes'])) {
        // Attributes et default attributes
        foreach ($args['attributes'] as $key => $att) {
            $oAttribute = new WC_Product_Attribute();
            $oAttribute->set_id(0);
            $oAttribute->set_name($key);
            $oAttribute->set_position(0);
            $oAttribute->set_visible(true);
            $oAttribute->set_variation(false);

            $oAttribute->set_options($att['term_names']);
            $aAttributes[$key] = $oAttribute;
            $product->set_attributes($aAttributes);
        }
    }
    if (isset($args['default_attributes']))
        $product->set_default_attributes($args['default_attributes']); // Needs a special formatting

    // Reviews, purchase note and menu order
    $product->set_reviews_allowed(isset($args['reviews']) ? $args['reviews'] : false);
    $product->set_purchase_note(isset($args['note']) ? $args['note'] : '');
    if (isset($args['menu_order']))
        $product->set_menu_order($args['menu_order']);

    // Product categories and Tags
    if (isset($args['category_ids']))
        $product->set_category_ids($args['category_ids']);
    if (isset($args['tag_ids']))
        $product->set_tag_ids($args['tag_ids']);


    // Images and Gallery
    $product->set_image_id(isset($args['image_id']) ? $args['image_id'] : "");
    $product->set_gallery_image_ids(isset($args['gallery_ids']) ? $args['gallery_ids'] : array());

    ## --- SAVE PRODUCT --- ##
    $product_id = $product->save();

    // Append the new term in the product
    if (isset($args['build'])) {
        $obs = $args['build'];
        foreach ($obs as $ob) {
            if (!has_term($ob['title'], 'build-pc', $product_id))
                wp_set_object_terms($product_id, $ob['title'], 'build-pc', true);
        }
        // if( ! has_term( $args['build']->title, 'build-pc', $product_id ))
        //   wp_set_object_terms($product_id, 'bo-mach-chu', 'build-pc', true );
    }
    update_post_meta($product_id, 'thong_so_ky_thuat', $args['tech']);

    return $product_id;
}



// Utility function that returns the correct product object instance
function wc_get_product_object_type($type)
{
    // Get an instance of the WC_Product object (depending on his type)
    if (isset($args['type']) && $args['type'] === 'variable') {
        $product = new WC_Product_Variable();
    } elseif (isset($args['type']) && $args['type'] === 'grouped') {
        $product = new WC_Product_Grouped();
    } elseif (isset($args['type']) && $args['type'] === 'external') {
        $product = new WC_Product_External();
    } else {
        $product = new WC_Product_Simple(); // "simple" By default
    }

    if (!is_a($product, 'WC_Product'))
        return false;
    else
        return $product;
}

// Utility function that prepare product attributes before saving
function wc_prepare_product_attributes($attributes)
{
    global $woocommerce;

    $data = array();
    $position = 0;

    foreach ($attributes as $taxonomy => $values) {
        if (!taxonomy_exists($taxonomy))
            continue;

        // Get an instance of the WC_Product_Attribute Object
        $attribute = new WC_Product_Attribute();

        $term_ids = array();

        // Loop through the term names
        foreach ($values['term_names'] as $term_name) {
            if (term_exists($term_name, $taxonomy))
                // Get and set the term ID in the array from the term name
                $term_ids[] = get_term_by('name', $term_name, $taxonomy)->term_id;
            else
                continue;
        }

        $taxonomy_id = wc_attribute_taxonomy_id_by_name($taxonomy); // Get taxonomy ID

        $attribute->set_id($taxonomy_id);
        $attribute->set_name($taxonomy);
        $attribute->set_options($term_ids);
        $attribute->set_position($position);
        $attribute->set_visible($values['is_visible']);
        $attribute->set_variation($values['for_variation']);

        $data[$taxonomy] = $attribute; // Set in an array

        $position++; // Increase position
    }
    return $data;
}
