<?php

namespace App\Data\Enums;

enum CacheKey:string
{
    case PRODUCT_LIST = 'product_list';
    case PRODUCT_LIST_TAG = 'product_list_tag';
}
