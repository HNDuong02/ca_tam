<?php
use TCG\Voyager\Models\Menu;
use TCG\Voyager\Models\MenuItem;

$menu = Menu::where('name', 'admin')->first();
if (!$menu) {
    echo "Menu 'admin' not found.\n";
    exit;
}

$items = [
    [
        'title' => 'Thành phần dinh dưỡng',
        'route' => 'voyager.nutritional-facts.index',
        'icon_class' => 'voyager-pie-chart',
        'order' => 11
    ],
    [
        'title' => 'Đánh giá khách hàng',
        'route' => 'voyager.product-reviews.index',
        'icon_class' => 'voyager-star',
        'order' => 12
    ]
];

foreach ($items as $data) {
    $item = MenuItem::firstOrNew([
        'menu_id' => $menu->id,
        'title' => $data['title']
    ]);
    
    $item->route = $data['route'];
    $item->icon_class = $data['icon_class'];
    $item->target = '_self';
    $item->order = $data['order'];
    $item->url = '';
    $item->parent_id = null;
    $item->color = null;
    
    $item->save();
}

echo "Menu items updated.";
