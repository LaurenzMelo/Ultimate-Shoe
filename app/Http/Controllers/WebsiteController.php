<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WebsiteController extends Controller
{
    public function main() {
        return view('pages.website.landing');
    }

    public function comparison() {
        return view('pages.website.comparison');
    }

    public function inDemand() {
        return view('pages.website.in-demand');
    }

    public function mostSearched() {
        return view('pages.website.most-searched');
    }

    public function mostViewed() {
        return view('pages.website.most-viewed');
    }

    // public function seeMore(Request $request) {
    //     dd($request->all());
    // }

    public function reviews() {
        return view('pages.website.reviews');
    }

    public function storeReviews(Request $request) {
        Review::create([
            'name' => $request->name,
            'rate' => $request->rate,
            'review' => $request->review,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        return ['status' => 200, 'message' => 'success'];
    }

    public function getReviews() {
        $reviews = Review::orderBy('created_at', 'DESC')->get();
        $average = DB::table('reviews')->average('rate');

        return [
            'data' => $reviews,
            'average' => $average,
            'status' => 200,
            'message' => 'success'
        ];
    }
}
