<?php
namespace App\Http\Controllers;
use Google\Analytics\Data\V1beta\BetaAnalyticsDataClient;
use Google\Analytics\Data\V1beta\DateRange;
use Google\Analytics\Data\V1beta\Dimension;
use Google\Analytics\Data\V1beta\Filter;
use Google\Analytics\Data\V1beta\Filter\StringFilter;
use Google\Analytics\Data\V1beta\FilterExpression;
use Google\Analytics\Data\V1beta\Metric;
use Carbon\Carbon;
class ga4controller{
    public function totaltrafic(string $id,string $startingdate,string $endingdate,string $countryId){
        $property_id = $id;
        $client = new BetaAnalyticsDataClient();
        $reportConfig = [
            'property' => 'properties/' . $property_id,
            'dateRanges' => [
                new DateRange([
                    'start_date' => $startingdate,
                    'end_date' => $endingdate,
                ]),
            ],
            'dimensions' => [
                new Dimension(
                    [
                        'name' => 'sessionMedium',
                    ]
                ),
            ],
            'metrics' => [
                new Metric(
                    [
                        'name' => 'screenPageViews',
                    ],
                ),
                new Metric(
                    [
                        'name' => 'totalUsers',
                    ]
                )
            ],
        ];
        if ($countryId) {
            $filterExpression = new FilterExpression([
                'filter' => new Filter([
                    'field_name' => 'countryId',
                    'string_filter' => new StringFilter([
                        'value' => $countryId,
                    ]),
                ]),
            ]);
            $reportConfig['dimensionFilter'] = $filterExpression;
        }
        $response = $client->runReport($reportConfig);
        $data = [];
        foreach ($response->getRows() as $row) {
            $object =[
                'Medium' => $row->getDimensionValues()[0]->getValue(),
                'Views' => $row->getMetricValues()[0]->getValue(),
                'TotalUsers' => $row->getMetricValues()[1]->getValue(),
            ];
            $data[] = $object;
        };
        return $data;
    }
    public function totaltraficSource(string $id,string $startingdate,string $endingdate,string $countryId){
        $property_id = $id;
        $client = new BetaAnalyticsDataClient();
        $reportConfig = [
            'property' => 'properties/' . $property_id,
            'dateRanges' => [
                new DateRange([
                    'start_date' => $startingdate,
                    'end_date' => $endingdate,
                ]),
            ],
            'dimensions' => [
                new Dimension(
                    [
                        'name' => 'sessionSource',
                    ]
                ),
            ],
            'metrics' => [
                new Metric(
                    [
                        'name' => 'screenPageViews',
                    ],
                ),
                new Metric(
                    [
                        'name' => 'totalUsers',
                    ]
                )
            ],
        ];
        if ($countryId) {
            $filterExpression = new FilterExpression([
                'filter' => new Filter([
                    'field_name' => 'countryId',
                    'string_filter' => new StringFilter([
                        'value' => $countryId,
                    ]),
                ]),
            ]);
            $reportConfig['dimensionFilter'] = $filterExpression;
        }
        $response = $client->runReport($reportConfig);
        $data = [];
        foreach ($response->getRows() as $row) {
            $object =[
                'Source' => $row->getDimensionValues()[0]->getValue(),
                'Views' => $row->getMetricValues()[0]->getValue(),
                'TotalUsers' => $row->getMetricValues()[1]->getValue(),
            ];
            $data[] = $object;
        };
        return $data;
    }
    public function totalTraficSourceGraph(string $id,string $startingdate,string $endingdate,string $countryId){
        $property_id = $id;
        $client = new BetaAnalyticsDataClient();
        $reportConfig = [
            'property' => 'properties/' . $property_id,
            'dateRanges' => [
                new DateRange([
                    'start_date' => $startingdate,
                    'end_date' => $endingdate,
                ]),
            ],
            'dimensions' => [
                new Dimension(
                    [
                        'name' => 'sessionMedium',
                    ]
                ),
            ],
            'metrics' => [
                new Metric(
                    [
                        'name' => 'screenPageViews',
                    ],
                ),
            ],
        ];
        if ($countryId) {
            $filterExpression = new FilterExpression([
                'filter' => new Filter([
                    'field_name' => 'countryId',
                    'string_filter' => new StringFilter([
                        'value' => $countryId,
                    ]),
                ]),
            ]);
            $reportConfig['dimensionFilter'] = $filterExpression;
        }
        $response = $client->runReport($reportConfig);
        $data = [];
        foreach ($response->getRows() as $row) {
            $object =[
                'Medium' => $row->getDimensionValues()[0]->getValue(),
                'Views' => $row->getMetricValues()[0]->getValue(),
            ];
            $data[] = $object;
        };
        return $data;
    }
    public function TopCites(string $id,string $startingdate,string $endingdate,string $countryId){
        $property_id = $id;
        $client = new BetaAnalyticsDataClient();
        $reportConfig = [
            'property' => 'properties/' . $property_id,
            'dateRanges' => [
                new DateRange([
                    'start_date' => $startingdate,
                    'end_date' => $endingdate,
                ]),
            ],
            'dimensions' => [
                new Dimension(
                    [
                        'name' => 'city',
                    ]
                ),
            ],
            'metrics' => [
                new Metric(
                    [
                        'name' => 'totalUsers',
                    ],
                ),
                new Metric(
                    [
                        'name' => 'userEngagementDuration',
                    ],
                )
            ],
        ];
        if ($countryId) {
            $filterExpression = new FilterExpression([
                'filter' => new Filter([
                    'field_name' => 'countryId',
                    'string_filter' => new StringFilter([
                        'value' => $countryId,
                    ]),
                ]),
            ]);
            $reportConfig['dimensionFilter'] = $filterExpression;
        }
        $response = $client->runReport($reportConfig);
        $data = [];
        foreach ($response->getRows() as $row) {
            $Seconds = $row->getMetricValues()[1]->getValue();
            $Seconds = intval($Seconds);
            $time = Carbon::now()->startOfDay()->addSeconds($Seconds);
            $hours = $time->hour;
            $minutes = $time->minute;
            $remainingSeconds = $time->second;
            $object =[
                'City' => $row->getDimensionValues()[0]->getValue(),
                'TotalUsers' => $row->getMetricValues()[0]->getValue(),
                'UserEngagementDuration' => $hours . ':' . $minutes . ':' . $remainingSeconds,
            ];
            $data[] = $object;
        };
        return $data;
    }
    public function NewUserCountry(string $id,string $startingdate,string $endingdate,string $countryId){
        $property_id = $id;
        $client = new BetaAnalyticsDataClient();
        $reportConfig = [
            'property' => 'properties/' . $property_id,
            'dateRanges' => [
                new DateRange([
                    'start_date' => $startingdate,
                    'end_date' => $endingdate,
                ]),
            ],
            'dimensions' => [
                new Dimension(
                    [
                        'name' => 'country',
                    ]
                ),
            ],
            'metrics' => [
                new Metric(
                    [
                        'name' => 'newUsers',
                    ],
                ),
            ],
        ];
        if ($countryId) {
            $filterExpression = new FilterExpression([
                'filter' => new Filter([
                    'field_name' => 'countryId',
                    'string_filter' => new StringFilter([
                        'value' => $countryId,
                    ]),
                ]),
            ]);
            $reportConfig['dimensionFilter'] = $filterExpression;
        }
        $response = $client->runReport($reportConfig);
        $data = [];
        foreach ($response->getRows() as $row) {
            $object =[
                'Country' => $row->getDimensionValues()[0]->getValue(),
                'NewUsers' => $row->getMetricValues()[0]->getValue(),
            ];
            $data[] = $object;
        };
        return $data;
    }
    public function TopSearchEngine(string $id,string $startingdate,string $endingdate,string $countryId){
        $property_id = $id;
        $client = new BetaAnalyticsDataClient();
        $reportConfig = [
            'property' => 'properties/' . $property_id,
            'dateRanges' => [
                new DateRange([
                    'start_date' => $startingdate,
                    'end_date' => $endingdate,
                ]),
            ],
            'dimensions' => [
                new Dimension(
                    [
                        'name' => 'source',
                    ]
                ),
            ],
            'metrics' => [
                new Metric(
                    [
                        'name' => 'totalUsers',
                    ],
                ),
            ],
        ];
        if ($countryId) {
            $filterExpression = new FilterExpression([
                'filter' => new Filter([
                    'field_name' => 'countryId',
                    'string_filter' => new StringFilter([
                        'value' => $countryId,
                    ]),
                ]),
            ]);
            $reportConfig['dimensionFilter'] = $filterExpression;
        }
        $response = $client->runReport($reportConfig);
        $data = [];
        foreach ($response->getRows() as $row) {
            $object =[
                'Source' => $row->getDimensionValues()[0]->getValue(),
                'TotalUsers' => $row->getMetricValues()[0]->getValue(),
            ];
            $data[] = $object;
        };
        return $data;
    }
    public function GoalCompletions(string $id,string $startingdate,string $endingdate,string $countryId){
        $property_id = $id;
        $client = new BetaAnalyticsDataClient();
        $reportConfig = [
            'property' => 'properties/' . $property_id,
            'dateRanges' => [
                new DateRange([
                    'start_date' => $startingdate,
                    'end_date' => $endingdate,
                ]),
            ],
            'dimensions' => [
                new Dimension(
                    [
                        'name' => 'pagePath',
                    ]
                ),
            ],
            'metrics' => [
                new Metric(
                    [
                        'name' => 'conversions',
                    ],
                ),
            ],
        ];
        if ($countryId) {
            $filterExpression = new FilterExpression([
                'filter' => new Filter([
                    'field_name' => 'countryId',
                    'string_filter' => new StringFilter([
                        'value' => $countryId,
                    ]),
                ]),
            ]);
            $reportConfig['dimensionFilter'] = $filterExpression;
        }
        $response = $client->runReport($reportConfig);
        $data = [];
        foreach ($response->getRows() as $row) {
            $object =[
                'PagePath' => $row->getDimensionValues()[0]->getValue(),
                'Conversions' => $row->getMetricValues()[0]->getValue(),
            ];
            $data[] = $object;
        };
        return $data;
    }
    public function TopLandingPages(string $id,string $startingdate,string $endingdate,string $countryId){
        $property_id = $id;
        $client = new BetaAnalyticsDataClient();
        $reportConfig = [
            'property' => 'properties/' . $property_id,
            'dateRanges' => [
                new DateRange([
                    'start_date' => $startingdate,
                    'end_date' => $endingdate,
                ]),
            ],
            'dimensions' => [
                new Dimension(
                    [
                        'name' => 'pagePath',
                    ]
                ),
            ],
            'metrics' => [
                new Metric(
                    [
                        'name' => 'totalUsers',
                    ],
                ),
                new Metric(
                    [
                        'name' => 'userEngagementDuration',
                    ],
                )
            ],
        ];
        if ($countryId) {
            $filterExpression = new FilterExpression([
                'filter' => new Filter([
                    'field_name' => 'countryId',
                    'string_filter' => new StringFilter([
                        'value' => $countryId,
                    ]),
                ]),
            ]);
            $reportConfig['dimensionFilter'] = $filterExpression;
        }
        $response = $client->runReport($reportConfig);
        $data = [];
        foreach ($response->getRows() as $row) {
            $Seconds = $row->getMetricValues()[1]->getValue();
            $Seconds = intval($Seconds);
            $time = Carbon::now()->startOfDay()->addSeconds($Seconds);
            $hours = $time->hour;
            $minutes = $time->minute;
            $remainingSeconds = $time->second;
            $object =[
                'pagePath' => $row->getDimensionValues()[0]->getValue(),
                'TotalUsers' => $row->getMetricValues()[0]->getValue(),
                'UserEngagementDuration' => $hours . ':' . $minutes . ':' . $remainingSeconds,
            ];
            $data[] = $object;
        };
        return $data;
    }
    public function Devices(string $id,string $startingdate,string $endingdate,string $countryId){
        $property_id = $id;
        $client = new BetaAnalyticsDataClient();
        $reportConfig = [
            'property' => 'properties/' . $property_id,
            'dateRanges' => [
                new DateRange([
                    'start_date' => $startingdate,
                    'end_date' => $endingdate,
                ]),
            ],
            'dimensions' => [
                new Dimension(
                    [
                        'name' => 'deviceCategory',
                    ]
                ),
            ],
            'metrics' => [
                new Metric(
                    [
                        'name' => 'totalUsers',
                    ],
                ),
            ],
        ];
        if ($countryId) {
            $filterExpression = new FilterExpression([
                'filter' => new Filter([
                    'field_name' => 'countryId',
                    'string_filter' => new StringFilter([
                        'value' => $countryId,
                    ]),
                ]),
            ]);
            $reportConfig['dimensionFilter'] = $filterExpression;
        }
        $response = $client->runReport($reportConfig);
        $data = [];
        foreach ($response->getRows() as $row) {
            $object =[
                'DeviceCategory' => $row->getDimensionValues()[0]->getValue(),
                'TotalUsers' => $row->getMetricValues()[0]->getValue(),
            ];
            $data[] = $object;
        };
        return $data;
    }
    public function RevenueGraph(string $id,string $startingdate,string $endingdate,string $countryId){
        $property_id = $id;
        $client = new BetaAnalyticsDataClient();
        $reportConfig = [
            'property' => 'properties/' . $property_id,
            'dateRanges' => [
                new DateRange([
                    'start_date' => $startingdate,
                    'end_date' => $endingdate,
                ]),
            ],
            'dimensions' => [
                new Dimension(
                    [
                        'name' => 'date',
                    ]
                ),
            ],
            'metrics' => [
                new Metric(
                    [
                        'name' => 'totalRevenue',
                    ],
                ),
                new Metric(
                    [
                        'name' => 'averagePurchaseRevenue',
                    ],
                ),
            ],
        ];
        if ($countryId) {
            $filterExpression = new FilterExpression([
                'filter' => new Filter([
                    'field_name' => 'countryId',
                    'string_filter' => new StringFilter([
                        'value' => $countryId,
                    ]),
                ]),
            ]);
            $reportConfig['dimensionFilter'] = $filterExpression;
        }
        $response = $client->runReport($reportConfig);
        $data = [];
        foreach ($response->getRows() as $row) {
            $object =[
                'Date' => $row->getDimensionValues()[0]->getValue(),
                'TotalRevenue' => $row->getMetricValues()[0]->getValue(),
                'AveragePurchaseRevenue'=>$row->getMetricValues()[1]->getValue(),
            ];
            $data[] = $object;
        };
        return $data;
    }
    public function Revenue(string $id,string $startingdate,string $endingdate,string $countryId){
        $property_id = $id;
        $client = new BetaAnalyticsDataClient();
        $reportConfig = [
            'property' => 'properties/' . $property_id,
            'dateRanges' => [
                new DateRange([
                    'start_date' => $startingdate,
                    'end_date' => $endingdate,
                ]),
            ],
            'metrics' => [
                new Metric(
                    [
                        'name' => 'totalRevenue',
                    ],
                ),
                new Metric(
                    [
                        'name' => 'averagePurchaseRevenue',
                    ],
                ),
                new Metric(
                    [
                        'name' => 'transactions',
                    ],
                ),
            ],
        ];
        if ($countryId) {
            $filterExpression = new FilterExpression([
                'filter' => new Filter([
                    'field_name' => 'countryId',
                    'string_filter' => new StringFilter([
                        'value' => $countryId,
                    ]),
                ]),
            ]);
            $reportConfig['dimensionFilter'] = $filterExpression;
        }
        $response = $client->runReport($reportConfig);
        $data = [];
        foreach ($response->getRows() as $row) {
            $object =[
                'TotalRevenue' => $row->getMetricValues()[0]->getValue(),
                'AveragePurchaseRevenue'=>$row->getMetricValues()[1]->getValue(),
                'Transaction'=>$row->getMetricValues()[2]->getValue(),
            ];
            $data[] = $object;
        };
        return $data;
    }
    public function ChannelGroup(string $id,string $startingdate,string $endingdate,string $countryId){
        $property_id = $id;
        $client = new BetaAnalyticsDataClient();
        $reportConfig = [
            'property' => 'properties/' . $property_id,
            'dateRanges' => [
                new DateRange([
                    'start_date' => $startingdate,
                    'end_date' => $endingdate,
                ]),
            ],
            'dimensions' => [
                new Dimension(
                    [
                        'name' => 'sessionDefaultChannelGroup',
                    ]
                ),
            ],
            'metrics' => [
                new Metric(
                    [
                        'name' => 'totalRevenue',
                    ],
                ),
            ],
        ];
        if ($countryId) {
            $filterExpression = new FilterExpression([
                'filter' => new Filter([
                    'field_name' => 'countryId',
                    'string_filter' => new StringFilter([
                        'value' => $countryId,
                    ]),
                ]),
            ]);
            $reportConfig['dimensionFilter'] = $filterExpression;
        }
        $response = $client->runReport($reportConfig);
        $data = [];
        foreach ($response->getRows() as $row) {
            $object =[
                'SessionDefaultChannelGroup' => $row->getDimensionValues()[0]->getValue(),
                'TotalRevenue' => $row->getMetricValues()[0]->getValue(),
            ];
            $data[] = $object;
        };
        return $data;
    }
}