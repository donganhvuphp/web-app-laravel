<?php

use App\Models\ShoppingSession;

if (!function_exists('shopping_session')) {

    /**
     * Get shopping session id or shopping session total by user id login
     * @return mixed
     */
    function shopping_session($get = 'id')
    {
        return $get == 'id' ? ShoppingSession::where('user_id', auth()->user()->id)->first()->id : ShoppingSession::where('user_id', auth()->user()->id)->first()->total;
    }
}
