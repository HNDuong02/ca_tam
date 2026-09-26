<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function productStory()
    {
        return view('pages.product-story');
    }

    public function companyIntro()
    {
        return view('pages.company-intro');
    }

    public function policy($type)
    {
        $settingKey = 'site.policy_' . $type;
        $content = setting($settingKey);
        
        if (!$content) {
            abort(404);
        }
        
        $titles = [
            'terms' => 'Chính sách & Điều khoản',
            'privacy' => 'Chính sách bảo mật',
            'shipping' => 'Chính sách giao hàng',
        ];
        
        $title = $titles[$type] ?? 'Chính sách';
        
        return view('pages.policy', compact('content', 'title'));
    }
}
