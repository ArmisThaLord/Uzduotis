<?php
namespace App\Models;

class Listing{
    public static function all() {
        return  [
            'listings' => [
                [
                'id' =>1,
                'title' => 'Listing one',
                'description' => 'Description is good'
            ],
            [
                'id' =>2,
                'title' => 'Listing two',
                'description' => 'Description is good'
            ]
            ]
            ];
    }
    public static function find($id){
        $listings = self::all();
        foreach($listings as $listing){
            if($listing['$id'] == $id){
                return $listing;
            }
        }
    }
}