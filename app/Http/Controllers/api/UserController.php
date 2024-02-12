<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function index()
    {
        $doctors = Profile::with('user', 'typologies')
            ->withAvg('stars', 'vote')
            ->withCount('stars')
            ->withCount('reviews')
            ->orderBy('created_at')
            ->get();

        return response($doctors, 200);
    }


    //
    public function search(Request $request)
    {

        //*** FILTERS DATA ***//
        $filters = $request->all();


        //*** GET DOCTORS WITH FILTERS ***//
        $query = Profile::with('user', 'typologies')
            ->withAvg('stars', 'vote')
            ->withCount('stars')
            ->withCount('reviews');


        // Typologies filter
        if (isset($filters['typologies'])) {
            foreach ($filters['typologies'] as $typology_id) {
                $query->whereRelation('typologies', 'id', $typology_id);
            }
        }

        // Avg votes filter
        if (isset($filters['min_vote'])) {
            $query->having('stars_avg_vote', '>=', $filters['min_vote']);
        }

        // Reviews count filter
        if (isset($filters['min_reviews'])) {
            $query->having('reviews_count', '>=', $filters['min_reviews']);
        }


        // Ordering
        $query->orderBy('created_at');

        // Apply query and get apartments
        $doctors = $query->get();

        return response($doctors, 200);
    }
}
