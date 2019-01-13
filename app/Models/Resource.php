<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Resource extends Model
{

    const STATUS_PENDING = 0;
    const STATUS_DOWNLOADING = 2;
    const STATUS_COMPLETE = 1;
    const STATUS_ERROR = -1;

    /**
     * Fillable attributes
     *
     * @var array
     */
    protected $fillable = [
        'url', 'filename', 'status'
    ];

    /**
     * Collection to Array
     *
     * @return array
     */
    public function toArray()
    {
        $array = parent::toArray();
        $array['status'] = $this->getStatusAsText();
        $array['link'] = route('resource.download', $this->id);
        return $array;
    }

    /**
     * Get status as text
     *
     * @return string
     */
    public function getStatusAsText()
    {
        switch ($this->status) {
            case 0:
                return 'Pending';
            case 1:
                return 'Complete';
            case 2:
                return 'Downloading';
            case 3:
                return 'Error';
        }
    }

}
