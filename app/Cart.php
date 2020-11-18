<?php

    namespace App;

    class Cart
    {
        public $items=null;
        public $totalQty=0;
        public $totalPrice=0;

        public function __construct($oldCart)
        {

            if($oldCart)
            {
                $this->items = $oldCart->items;
                $this->totalQty = $oldCart->totalQty;
                $this->totalPrice = $oldCart->totalPrice;
            }
            
        }

        public function add($item,$product_id)
        {
            $storedItem=['qty'=>0,'product_id'=>0,'product_name'=>$item->product_name,'product_price'=>$item->product_price,'product_image'=>$item->product_image,'item'=>$item];   

            if($this->items)
            {
                if(array_key_exists($product_id,$this->items))
                {
                    $storedItem=$this->items[$product_id];
                }
            }

            $storedItem['qty']++;
            $storedItem['product_id']=$product_id;
            $storedItem['product_name']=$item->product_name;
            $storedItem['product_image']=$item->product_image;
            $storedItem['product_price']=$item->product_price;

            $this->totalQty++;
            $this->totalPrice+=$item->product_price;
            $this->items[$product_id]=$storedItem;
        }

        public function updateQty($id,$qty)
        {
            $this->totalQty-=$this->items[$id]['qty'];
            $this->totalPrice-=$this->items[$id]['product_price'];
            $this->items[$id]['qty']=$qty;
            $this->totalQty+=$qty;
            $this->totalPrice+=$this->items[$id]['product_price']*$qty;
        }

        public function removeItem($id)
        {
            $this->totalQty-=$this->items[$id]['qty'];
            $this->totalPrice-=$this->items[$id]['product_price'];
            unset($this->items[$id]);
        }
    }
?>