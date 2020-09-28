<?php
    if (!function_exists('active_class')) {
        /**
         * Set a class of active based on the page.
         *
         * @param $path
         *
         * @return string
         */
        function active_class($path)
        {
            return request()->is($path) ? 'active' : '';
        }
    }
    
if ( ! function_exists('toolbar_link')) {
    /**
     * @param $route
     * @param $icon
     * @param $tooltip
     *
     * @return string
     */
    function toolbar_link($route, $icon, $tooltip)
    {
        if (is_array($route)) {
            $href = route($route[0], [$route[1]]);
        } else {
            $href = route($route);
        }

        return '<a href="' . $href . '" class="btn btn-alt btn-sm btn-default" data-toggle="tooltip" title="' . $tooltip . '"><i class="fa ' . $icon . '"></i></a>';
    }

}

if ( ! function_exists('defaultProductImage')) {
    /**
     * @param        $product
     * @param string $size
     * @param null   $page
     *
     * @return string
     */
    function defaultProductImage($product, $size = 'category_page', $page = null)
    {
        if ($product->getMedia('products')->count() > 0) {
            $defaultItem = $product->getMedia('products')->reject(function ($item) {
                return array_get($item->custom_properties, 'default') == false;
            });

            if ($defaultItem->count() > 0) {
                return '<div class="product-image"><img src="' . url('/') . $defaultItem->first()->getUrl($size) . '" class="img-responsive product-img" alt="' . $product->name . '"/>' . wetDry($product,
                    $page) . '</div>';
            } elseif ($product->getMedia('products')->count() > 0) {
                return '<div class="product-image"><img src="' . url('/') . $product->getMedia('products')->first()->getUrl($size) . '" class="img-responsive product-img" alt="' . $product->name . '"/>' . wetDry($product,
                    $page) . '</div>';
            }
        }
    }
}
if ( ! function_exists('wetDry')) {
    /**
     * @param $product
     * @param $page
     *
     * @return string
     */
    function wetDry($product, $page)
    {
        if ($product->season && ($page != 'admin')) {
            return '<img class="badge-overlay" src="' . url('/') . '/images/' . $product->season . '_badge.png" alt="' . $product->name . '"/>';
        }

        return '';
    }
}


