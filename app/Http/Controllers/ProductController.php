<?php

namespace App\Http\Controllers;
use App\Models\prodTag;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Show the form for view list of products.
     *
     */
    public function viewProducts()
    {
    $sql = 'SELECT  products.id, products.name, GROUP_CONCAT(tags.tags) as taglist FROM products LEFT JOIN prod_tags ON products.id = prod_tags.prod_id LEFT JOIN tags ON prod_tags.tag_id = tags.id GROUP BY products.name, products.id';
      return DB::select(DB::raw($sql));
    }
    /**
     * Show the form for creating a new product.
     *
     */
    public function createProduct(Request $request)
    {
        if($request->name == '') {
            return  array(['result' => 'Product Name is empty']);
        }
        $product_id = $this->checkIfUnique($request->name,'product', 0);
        if($product_id == 0) {
            $products = new Product;
            $products->name = $request->name;
            $products->save();
            $product_id = $products->id;
            $prodtags = explode(',', $request->tags);
            $this->addTags($product_id ,$prodtags);
                
        } else {
            $prodtags = explode(',', $request->tags);
            $this->addTags($product_id ,$prodtags);
            return array(['result' => 'Product Already Exists']);
        }
        return array(['result' => 'Product Created']);
    }
    /**
     * Show the form for delete a product.
     *
     */
    public function deleteProduct(Request $request)
    {
        $products = Product::find($request->id);
        $products->delete();

        prodTag::select('prod_id')->where('prod_id', $request->id)->delete();
    
        return array(['result' => 'Product Deleted']);
    }

    private function addTags($product_id, $prodtags) {
        
        foreach ($prodtags as $value) {
            
            $tag_id = $this->checkIfUnique($value,'tags', 0);
            $tags = new Tag;
            $tags->tags = $value;
            
            if($tag_id == 0) {
                $tags->save();
                $tag_id = $tags->id;
            }

            $prodtagsids = new prodTag;
            $prodtagsids->prod_id = $product_id;
            $prodtagsids->tag_id = $tag_id;
            
            $prodtag_id = $this->checkIfUnique($tag_id,'prodtags', $product_id);
            if($prodtag_id == 0) {
                $prodtagsids->save();
            }

        }
    }

    private function checkIfUnique($name, $table, $prod_id = 0) {
        if($table == 'product') {
            $result = Product::select('id','name')->where('name', '=', $name)->get();
            if(!$result->isEmpty()){
                return $result[0]->id;
            }
            return 0;
        } else if($table == 'tags') {
            $result =  Tag::select('id','tags')->where('tags', '=', $name)->get();
            if(!$result->isEmpty()){
                return $result[0]->id;
            }
            return 0;
        } else {
            $result =  prodTag::select('id','tag_id','prod_id')
                                    ->where('tag_id', '=', $name)
                                    ->where('prod_id', '=', $prod_id)->get();
            if(!$result->isEmpty()){
                return $result[0]->id;
            }
            return 0;
        }
        
    }
}
