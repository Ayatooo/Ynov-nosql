<?php

namespace App\Http\Controllers;

use Predis\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class SchoolController extends Controller
{

    public $redis;
    /**
     * Controller constructor.
     */
    public function __construct()
    {
        $this->redis = new Client([
            'scheme' => 'tcp',
            'host' => 'host.docker.internal',
            'port' => 6379,
        ]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * Display a listing of the resource group by school name.
     */
    public function groupBySchool(Request $request)
    {
        try {
            $cacheKey = 'school-grouped';
            $cachedData = Cache::get($cacheKey);

            if ($cachedData) {
                return response()->json($cachedData);
            }

            $keys = $this->redis->keys('*');

            $groupedData = [];

            foreach ($keys as $key) {
                $keyType = $this->redis->type($key);

                if ($keyType == 'hash') {
                    $schoolData = $this->redis->hgetall($key);
                    $groupedData[$schoolData['title']][] = $schoolData;
                }
            }

            Cache::put($cacheKey, $groupedData, 60);

            return response()->json($groupedData);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
