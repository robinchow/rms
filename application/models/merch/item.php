<?php

class Merch_Item extends Eloquent {
	public static $timestamps = true;

	public static function current_merch() 
    {
        return Merch_Item::where('active', '=', 1);
    }
}
