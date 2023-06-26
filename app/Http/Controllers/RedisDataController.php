<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Predis\Client;

class RedisDataController extends Controller
{
    public function groupBySchool(Request $request)
    {
        $redis = new Client([
            'scheme' => 'tcp',
            'host' => 'host.docker.internal',
            'port' => 6379,
        ]);

        $keys = $redis->keys('*');

        $groupedData = [];

        for ($i = 0; $i < 100; $i++) {
            $keyType = $redis->type($keys[$i]);

            if ($keyType == 'hash') {
                $schoolData = $redis->hgetall($keys[$i]);
                $groupedData[$schoolData['title']][] = $schoolData;
            }
        }
        return view('schools', ['groupedData' => $groupedData]);
    }
}
