<?php

namespace App\Observers;

use App\Models\ProductCategory;

class ProductCategoryObservers
{
    public function forceDeleted(ProductCategory $productCategory): void
    {
        //remove all product base con product category
       //  $products = Product::where('product_category_id', $productCategory->id)->get();
       //  foreach($products as $product){
       //      $product->forceDelete();
       //  }

       $productCategory->products()->forceDelete();
   }
}
