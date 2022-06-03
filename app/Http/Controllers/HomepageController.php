<?php

namespace App\Http\Controllers;

use App\Models\EventImage;
use Illuminate\Http\Request;

class HomepageController extends BaseController
{
    protected $title = 'Homepage';

    private $baseView = 'pages.';

    public function index()
    {
        return view(
            $this->baseView . 'homepage',
            $this->getData([
                'images' => $this->getImages(),
            ])
        );
    }

    private function getImages()
    {
        $images = EventImage::latest()->limit(5)->get();

        if (count($images) > 0) {
            return $images;
        } else {
            return [
                [
                    'image' => 'https://dummyimage.com/1200x600/ccc/fff.png'
                ],
                [
                    'image' => 'https://dummyimage.com/1200x600/ccc/fff.png'
                ],
            ];
        }
    }
}
