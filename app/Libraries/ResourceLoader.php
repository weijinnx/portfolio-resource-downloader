<?php

namespace App\Libraries;

use Storage;
use App\Jobs\DownloadResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Models\Resource;

class ResourceLoader
{

    /**
     * Undocumented function
     *
     * @param string $url Resource URL
     * 
     * @return void|JsonResponse
     */
    public function dispatchJob(string $url)
    {
        DB::beginTransaction();
        try {
            $resource = Resource::create(['url' => $url]);
            dispatch((new DownloadResource($resource)));

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            return $e->getMessage();
        }
    }

    /**
     * Download resource
     *
     * @param string $url Resource URL
     * 
     * @return void
     */
    public static function download(string $url)
    {
        try {
            $contents = file_get_contents($url);
            $name = substr($url, strrpos($url, '/') + 1);
            Storage::put($name, $contents);

            return $name;
        } catch (\Exception $e) {
            return false;
        }
    }

}