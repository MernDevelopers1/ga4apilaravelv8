<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\ga4controller;
class ga4api extends Controller
{
   public function show($id,$startingdate="7daysAgo",$endingdate="today",$countryId="")
    {
        // dd(getcwd());
        $ga4apicontroller = new ga4controller();
        $totalTrafic = $ga4apicontroller->totaltrafic($id,$startingdate,$endingdate,$countryId);
        $totalTraficSource = $ga4apicontroller->totaltraficSource($id,$startingdate,$endingdate,$countryId);
        $totalTraficSourceGraph = $ga4apicontroller->totalTraficSourceGraph($id,$startingdate,$endingdate,$countryId);
        $TopCites = $ga4apicontroller->TopCites($id,$startingdate,$endingdate,$countryId);
        $NewUserCountry = $ga4apicontroller->NewUserCountry($id,$startingdate,$endingdate,$countryId);
        $TopSearchEngine = $ga4apicontroller->TopSearchEngine($id,$startingdate,$endingdate,$countryId);
        $GoalCompletions = $ga4apicontroller->GoalCompletions($id,$startingdate,$endingdate,$countryId);
        $TopLandingPages = $ga4apicontroller->TopLandingPages($id,$startingdate,$endingdate,$countryId);
        $Devices = $ga4apicontroller->Devices($id,$startingdate,$endingdate,$countryId);
        $RevenueGraph = $ga4apicontroller->RevenueGraph($id,$startingdate,$endingdate,$countryId);
        $Revenue = $ga4apicontroller->Revenue($id,$startingdate,$endingdate,$countryId);
        $ChannelGroup = $ga4apicontroller->ChannelGroup($id,$startingdate,$endingdate,$countryId);
        $data = [
            'TotalTrafic' => $totalTrafic,
            'TotalTraficSource' => $totalTraficSource,
            'TotalTraficSourceGraph'=> $totalTraficSourceGraph,
            'TopCites'=> $TopCites,
            'NewUserCountry'=> $NewUserCountry,
            'TopSearchEngine'=> $TopSearchEngine,
            'GoalCompletions'=> $GoalCompletions,
            'TopLandingPages'=> $TopLandingPages,
            'Devices'=> $Devices,
            'RevenueGraph'=> $RevenueGraph,
            'Revenue'=> $Revenue,
            'ChannelGroup'=> $ChannelGroup,
        ];
        // dd($data);
        return response()->json([
            'status' => 200,
            'response' => $data
        ]);
    }
}
