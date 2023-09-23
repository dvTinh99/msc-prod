<?php

class all_terms
{

    public function __construct()
    {

        $version = '3';
        $namespace = 'wp/v' . $version;
        $base = 'all-terms';
        register_rest_route($namespace, '/' . $base, array(
            'methods' => 'GET',
            'callback' => array($this, 'get_all_terms'),
        ));
        register_rest_route($namespace, '/' . 'cus-product', array(
            'methods' => 'GET',
            'callback' => array($this, 'getListBuild'),
        ));
        register_rest_route($namespace, '/' . 'get-product', array(
            'methods' => 'GET',
            'callback' => array($this, 'buildPCGetProduct'),
        ));
        register_rest_route($namespace, '/' . 'save-build', array(
            'methods' => 'POST',
            'callback' => array($this, 'saveBuildPC'),
        ));
        register_rest_route($namespace, '/' . 'all-product', array(
            'methods' => 'get',
            'callback' => array($this, 'getAllProduct1'),
        ));
        register_rest_route($namespace, '/' . 'all-taxonomy', array(
            'methods' => 'get',
            'callback' => array($this, 'getAllProduct'),
        ));
        register_rest_route($namespace, '/' . 'filter-product', array(
            'methods' => 'get',
            'callback' => array($this, 'filterProduct'),
        ));
        register_rest_route($namespace, '/' . 'download', array(
            'methods' => 'POST',
            'callback' => array($this, 'download'),
        ));
    }

    public function filterProduct($request)
    {
        $rq = explode(",", $request['categories']);
        if (isset($rq[1]) && is_numeric($rq[1])) {
            $id_slud = get_term_by('slug', $rq[0], 'build-pc');
            $args = array(
                'post_type' => 'product',
                'posts_per_page' => -1,
                'tax_query' => array(
                    array(
                        'taxonomy' => 'build-pc',
                        'field'    => 'tag_ID',
                        'terms'    => array_slice($rq, 1),
                        'operator'  => 'AND'
                    ),
                ),
            );
            $arr_products = [];
            $products = wc_get_products($args);
            $arr_taxonomies_id = [];
            foreach ($products as $product) {
                $list_taxonomies = $this->getTermSingleProduct($product->get_id());
                // if(in_array(813,$list_taxonomies)){
                //     var_dump($product);
                //     die();
                // }
                array_push($arr_taxonomies_id, $list_taxonomies);
                $obj = (object)[];
                $image_id  = $product->image_id;
                $image_url = wp_get_attachment_image_url($image_id, 'full');

                $obj->key = $id_slud->term_id;
                $obj->id = $product->id;
                $obj->slug = $product->slug;
                $obj->image = $image_url;
                $obj->name = $product->name;
                $obj->price = (int)($product->price);
                array_push($arr_products, $obj);
            }
            array_unique($arr_taxonomies_id);
            $arr_taxonomies = [];
            foreach ($arr_taxonomies_id as $taxonomy) {
                foreach ($taxonomy as $taxonomy_id) {
                    array_push($arr_taxonomies, $taxonomy_id);
                }
            }
            $is_product_null = count($products) > 0 ? false : true;
            $all_taxonomy = $this->getAllTaxonomies($rq[0], $arr_taxonomies, $rq, $is_product_null);
            return new WP_REST_Response(
                [
                    "filters" => $all_taxonomy,
                    "products"  => $arr_products
                ],
                200
            );
        }
        $id_slud = get_term_by('slug', $rq[0], 'build-pc');
        $args = array(
            'post_type' => 'product',
            'posts_per_page' => -1,
            'tax_query' => array(
                array(
                    'taxonomy' => 'build-pc',
                    'field'    => 'slug',
                    'terms'    => $rq[0],
                ),
            ),
        );
        $arr_products = [];
        $products = wc_get_products($args);
        foreach ($products as $product) {

            $obj = (object)[];
            $image_id  = $product->image_id;
            $image_url = wp_get_attachment_image_url($image_id, 'full');


            $obj->key = $id_slud->term_id;
            $obj->id = $product->id;
            $obj->slug = $product->slug;
            $obj->image = $image_url;
            $obj->name = $product->name;
            $obj->price = (int)($product->price);
            array_push($arr_products, $obj);
        }
        $all_taxonomy = $this->getAllTaxonomies($rq[0]);
        return new WP_REST_Response(
            [
                "filters" => $all_taxonomy,
                "products"  => $arr_products
            ],
            200
        );
    }

    public function getTermSingleProduct($id)
    {
        return wp_get_post_terms(
            $id,
            'build-pc',
            array(
                'fields' => 'ids',
                'orderby' => 'id',
                'order' => 'ASC',
            )
        );
    }

    public function get_all_terms($object)
    {
        $return = array();
        $args = array(
            'public' => true,
            '_builtin' => false,
            // 'parent' => 1
        );
        $output = 'names'; // or objects
        $operator = 'and'; // 'and' or 'or'
        $taxonomies = get_taxonomies($args, $output, $operator);
        foreach ($taxonomies as $key => $taxonomy_name) {
            if ($taxonomy_name = $_GET['term']) {
                $rs = get_terms(array(
                    'taxonomy' => $taxonomy_name,
                    'hide_empty' => false,
                    'orderby' => 'term_taxonomy_id',
                    'order' => 'ASC',
                ));
            }
        }
        return new WP_REST_Response($rs, 200);
    }

    public function getListBuild()
    {
        $terms = get_terms([
            'taxonomy' => 'build-pc',
            'hide_empty' => false,
            'orderby' => 'term_id',
            'parent' => 0,
            'order' => 'ASC',
        ]);
        $re = [];
        foreach ($terms as $term) {
            // $category = get_term_by('slug', $term->slug, 'product_cat');
            $id = $term->term_id;
            $title = $term->name;
            $key = $term->slug;
            $ob = [
                'id' => $id,
                'title' => $title,
                'key' => $key,
            ];
            array_push($re, $ob);
        }
        return new WP_REST_Response($re, 200);
    }

    public function buildPCGetProduct($request)
    {
        $args = array(
            'post_type' => 'product',
            'tax_query' => array(
                array(
                    'taxonomy' => 'build-pc',
                    'field'    => 'slug',
                    'terms'    => $request['category'],
                ),
            ),
        );
        $query = new WP_Query($args);
        $posts = $query->posts;

        foreach ($posts as $post) {
            // Do your stuff, e.g.
            // echo $post->post_name;
            var_dump(get_the_title($post->ID));
            // die();
        }
    }

    public function getListBuild1()
    {
        $terms = get_terms([
            'taxonomy' => 'build-pc',
            'hide_empty' => false,
        ]);
        $re = [];
        foreach ($terms as $term) {
            $category = get_term_by('slug', $term->slug, 'product_cat');
            $id = $category->term_id;
            $title = $category->name;
            $key = $category->slug;
            $ob = [
                'id' => $id,
                'title' => $title,
                'key' => $key,
            ];
            array_push($re, $ob);
        }
        return new WP_REST_Response($re, 200);
    }

    public function download($request)
    {
        $d = DateTime::createFromFormat('d-m-Y H:i:s', '22-09-2008 00:00:00');
        $tt = $d->getTimestamp();
        // $queryParams = $request->get_query_params();
        $queryParams = $request['partPC'];

        $objExcel = new PHPExcel;
        $objExcel->setActiveSheetIndex(0);
        $sheet = $objExcel->getActiveSheet()->setTitle("10");
        $sheet->getColumnDimension("B")->setAutoSize(true);

        $rowCount = 1;
        $index = 1;
        foreach ($queryParams as $key => $data) {
            $_key = $key;
            $_data = $data;
            $sheet->setCellValue('A' . $rowCount, (string)$data['key']);
            $sheet->setCellValue('B' . $rowCount, (string)"Tên : " . $data['name']);
            $rowCount++;
            $sheet->setCellValue('B' . $rowCount, (string)"Giá : " . $data['price']);
            $rowCount++;
            $sheet->setCellValue('B' . $rowCount, (string)"Số lượng : " . $data['quantity']);
            $sheet->mergeCells('A' . $index . ':A' . $rowCount);
            $rowCount++;
            $index = $rowCount;
        }
        $sheet->setCellValue('A' . $rowCount, "Tổng");
        $sheet->setCellValue('B' . $rowCount, $request['totalPrice']);

        $sheet->getStyle('A1:A' . $rowCount)->getFill()->setFillType(\PHPExcel_Style_Fill::FILL_SOLID)
            ->getStartColor()->setARGB('00ffff00');
        $sheet->getStyle('A1:A' . $rowCount)
            ->getAlignment()
            ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $styleArray = array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                )
            )
        );

        $sheet->getStyle('A1:B' . $rowCount)->applyFromArray($styleArray);

        $objWriter = new PHPExcel_Writer_Excel2007($objExcel);

        $filename = $tt . '.xlsx';
        $objWriter->save($filename);

        header("Content-Disposition: attachment;filename={$filename}");
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/vnd.openxmlformatsofficedocument.spreadsheetml.sheet");
        header("Content-Length: :" . filesize($filename));
        header("Content-Tranfer-Encoding: binary");
        header("Cache-Control: must-revalidate");
        header("Pragma: no-cache");

        readfile($filename);
        return;
    }

    public function saveBuildPC($request)
    {
        $data = ($request['partPC']);
        $userInfo = $request['user_info'];

        $customer_post = array(
            'post_title'   => "ok",
            'post_status'  => 'private',
            'post_type'    => 'build_pc',
            'meta_input' => $data,
        );
        $rs  = wp_insert_post($customer_post);

        $message_mail = '';
        foreach ($data as $key => $dt) {

            $message_mail .= 'Linh kiện : ' . $dt['key'] . '<br>';
            $message_mail .=  'Tên : ' . $dt['name'] . '<br>';
            $message_mail .= 'Giá : ' . $dt['price'] . '<br><hr>';
        }
        $message_mail .= 'Tổng :' . $request['totalPrice'];
        $message_mail .= '<br><hr><br>';
        $message_mail .= 'Thông tin khách  hàng :' . '<br>';
        $message_mail .= 'Tên  : ' . $userInfo['fullname'] . '<br>';
        $message_mail .= 'Email  : ' . $userInfo['email'] . '<br>';
        $message_mail .= 'Điện thoại  : ' . $userInfo['phone'] . '<br>';
        $message_mail .= 'Địa chỉ  : ' . $userInfo['address'] . '<br>';

        $to = 'minhsangcomputer2022@gmail.com';
        $subject = "Test email MSCshop";
        $header  =  "From:dvtinh.it@gmail.com \r\n";
        $header .= "MIME-Version: 1.0\r\n";
        $header .= "Content-type: text/html\r\n";

        $to_admin = wp_mail($to, $subject, $message_mail, $header);
        $to_client = wp_mail($userInfo['email'], $subject, $message_mail, $header);

        return $rs;
    }

    public function getAllProduct1($request)
    {
        // args = array(
        //     'post_type' => 'product',
        //     'tax_query' => array(
        //         array(
        //             'taxonomy' => 'build-pc',
        //             'field'    => 'slug',
        //             'terms'    => $request['category'],
        //         ),
        //     ),
        // );
        // $query = new WP_Query( $args );
        // $posts = $query->posts;
        // $args = array(
        //     'limit'  => -1,
        //     'status' => 'publish',
        //     'category' => $request['category']
        // );
        $args = array(
            'post_type' => 'product',
            'tax_query' => array(
                array(
                    'taxonomy' => 'build-pc',
                    'field'    => 'slug',
                    'terms'    => $request['category'],
                ),
            ),
        );
        $rs =  [];
        $attr = [];
        $t = (object)[];
        $products = wc_get_products($args);
        foreach ($products as $product) {
            // var_dump(get_post_thumbnail_id($product->_thumbnail_id));

            $image_id  = $product->image_id;
            $image_url = wp_get_attachment_image_url($image_id, 'full');

            $ob = [
                'id' => $product->id,
                'key' => $request['category'],
                'name' => $product->name,
                'price' => (int)($product->price),
                'slug' => $product->slug,
                'attr' => (object)[],
                'image' => $image_url,
            ];
            $ob_atribute = (object)[];
            $attributes = $product->attributes;

            foreach ($attributes as $attribute) {
                $target_name = explode(':',  $attribute['name'])[1];
                $attribute['name'] = explode(':',  $attribute['name'])[0];

                $name = $attribute['name'];
                $value = $attribute['value'];

                $target_value = $value;

                $ob_atribute->$name = $target_value;

                if (count($attr) > 0) {
                    $flag = true;
                    foreach ($attr as $key => $value) {
                        if ($value->key == $name) {
                            array_push($value->items, $target_value);
                            $flag = false;
                            break;
                        }
                    }
                    $t->items = array_unique($t->items);
                    if ($flag) {
                        $t = (object)[
                            'key' => $name,
                            'name' => $target_name,
                            'items' => []
                        ];
                        array_push($t->items, $target_value);
                        $t->items = array_unique($t->items);
                        array_push($attr,  $t);
                    }
                } else {
                    $t = (object)[
                        'key' => $name,
                        'name' => $target_name,
                        'items' => []
                    ];
                    array_push($t->items, $target_value);
                    $t->items = array_unique($t->items);
                    array_push($attr,  $t);
                }
            }

            $ob['attr'] =  $ob_atribute;

            array_push($rs, $ob);
        }
        return new WP_REST_Response(
            [
                "filter" => $attr,
                "products"  => $rs
            ],
            200
        );
    }

    public function getAllProduct($request)
    {
        $all_product = $this->getProductBySlug($request['category']);
        $all_taxonomy = $this->getAllTaxonomies($request['category']);
        return new WP_REST_Response(
            [
                "filter" => $all_taxonomy,
                "products"  => $all_product
            ],
            200
        );
    }

    public function getAllTaxonomies($slug, $arr_taxonomies = [], $rq = [], $is_product_null = false)
    {
        $all_categories = [];
        if (count($arr_taxonomies) == 0) {
            $category = get_term_by('slug', $slug, 'build-pc');
            // var_dump($category->term_id);
            // die();
            $terms = get_terms([
                'taxonomy' => 'build-pc',
                'hide_empty' => false,
                'parent' => $category->term_id,
                'orderby' => 'id',
                'order' => 'ASC',
            ]);

            foreach ($terms as $term) {
                $obj = (object)[];
                // var_dump($term);
                // die();
                $obj->key = $term->term_id;
                $obj->name = $term->name;
                $arr_child = $this->getChild($term->slug, $arr_taxonomies, $rq, $is_product_null);
                $obj->items = $arr_child;
                array_push($all_categories, $obj);
            }
        } else {
            $category = get_term_by('slug', $slug, 'build-pc');
            $terms = get_terms([
                'taxonomy' => 'build-pc',
                'hide_empty' => false,
                'parent' => $category->term_id,
                'orderby' => 'id',
                'order' => 'ASC',
            ]);

            foreach ($terms as $term) {
                $obj = (object)[];
                // var_dump($term);
                // die();
                $obj->key = $term->term_id;
                $obj->name = $term->name;
                $arr_child = $this->getChild($term->slug, $arr_taxonomies, $rq, $is_product_null);
                $obj->items = $arr_child;
                array_push($all_categories, $obj);
            }
        }
        return $all_categories;
    }

    public function getProductBySlug($slug)
    {
        $id_slud = get_term_by('slug', $slug, 'build-pc');
        $args = array(
            'post_type' => 'product',
            'posts_per_page' => -1,
            'tax_query' => array(
                array(
                    'taxonomy' => 'build-pc',
                    'field'    => 'slug',
                    'terms'    => $slug,
                ),
            ),
        );
        $products = wc_get_products($args);
        $arr_products = array();
        foreach ($products as $product) {
            $image_id  = $product->image_id;
            $image_url = wp_get_attachment_image_url($image_id, 'full');

            $obj = (object)[];
            $obj->key = $id_slud->term_id;
            $obj->id = $product->id;
            $obj->name = $product->name;
            $obj->price = (int)($product->price);
            $obj->slug = $product->slug;
            $obj->image = $image_url;
            // var_dump($product);
            // die();
            array_push($arr_products, $obj);
        }

        return $arr_products;
    }

    public function getChild($slug, $arr_taxonomies = [], $rq = [], $is_product_null = false)
    {
        $arr = [];
        if (count($arr_taxonomies) == 0) {
            $child = get_term_by('slug', $slug, 'build-pc');
            $terms = get_terms([
                'taxonomy' => 'build-pc',
                'hide_empty' => false,
                'parent' => $child->term_id,
                'orderby' => 'id',
                'order' => 'ASC',
            ]);
            foreach ($terms as $term) {
                $obj = (object)[];
                $obj->key = $term->term_id;
                $obj->name = $term->name;
                $obj->count = $term->count;
                if ($is_product_null) {
                    if (in_array($term->term_id, $rq)) {
                        array_push($arr, $obj);
                    }
                } else {
                    array_push($arr, $obj);
                }
            }
        } else {
            $child = get_term_by('slug', $slug, 'build-pc');
            $terms = get_terms([
                'taxonomy' => 'build-pc',
                'hide_empty' => false,
                'parent' => $child->term_id,
                'orderby' => 'id',
                'order' => 'ASC',
            ]);
            foreach ($terms as $term) {
                if (in_array($term->term_id, $arr_taxonomies)) {
                    $obj = (object)[];
                    $obj->key = $term->term_id;
                    $obj->name = $term->name;
                    $obj->count = $term->count;
                    if (in_array($term->term_id, $rq)) {
                        $obj->active = true;
                    } else {
                        $obj->active = false;
                    }
                    array_push($arr, $obj);
                }
            }
        }
        return $arr;
    }
}
