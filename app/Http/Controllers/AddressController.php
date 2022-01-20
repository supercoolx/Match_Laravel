<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    //
    static function getAddresses() {
        $ids = Address::pluck('parent_id');
        $addresses = Address::whereNotIn('id', $ids)->get();
        return $addresses;
    }
}
