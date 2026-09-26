<?php
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

$categories = DB::table('categories')->limit(3)->get();

if ($categories->isEmpty()) {
    echo "No categories found. Please create categories first.\n";
    exit;
}

$catIds = $categories->pluck('id')->toArray();

$products = [
    [
        'category_id' => $catIds[0] ?? 1,
        'name' => 'Cá tầm sống thương phẩm loại 1 (2-3kg/con)',
        'slug' => Str::slug('Cá tầm sống thương phẩm loại 1 (2-3kg/con)'),
        'image' => null,
        'gallery' => '[]',
        'short_description' => 'Cá tầm nguyên con khỏe mạnh, vớt trực tiếp từ bể nuôi lạnh, đảm bảo thịt dai, ngọt và giàu dinh dưỡng.',
        'body_html' => '<p>Cá tầm sống thương phẩm được nuôi trong môi trường nước lạnh chuẩn tự nhiên, thức ăn hữu cơ không chứa chất kích thích tăng trưởng.</p><ul><li>Trọng lượng: 2-3kg/con</li><li>Nguồn gốc: Trang trại Đông Bắc</li><li>Đặc điểm: Thịt săn chắc, sụn giòn, ít mỡ.</li></ul><p>Phù hợp cho các món lẩu, nướng, gỏi, hấp xì dầu, đáp ứng nhu cầu thưởng thức của các thực khách sành ăn.</p>',
        'usage_guide' => '<p>Bảo quản cá sống trong bể oxy hoặc chế biến ngay sau khi mua để giữ trọn vị tươi ngon.</p>',
        'price_text' => 'Liên hệ',
        'action_type' => 'QUOTE',
        'status' => 1,
        'created_at' => now(),
        'updated_at' => now(),
    ],
    [
        'category_id' => $catIds[1] ?? (isset($catIds[0]) ? $catIds[0] : 1),
        'name' => 'Cá tầm sơ chế cắt khúc ép chân không',
        'slug' => Str::slug('Cá tầm sơ chế cắt khúc ép chân không'),
        'image' => null,
        'gallery' => '[]',
        'short_description' => 'Tiện lợi, an toàn vệ sinh thực phẩm. Cá tầm cắt khúc được làm sạch và hút chân không ngay sau khi sơ chế.',
        'body_html' => '<p>Để tiết kiệm thời gian cho khách hàng, chúng tôi cung cấp sản phẩm cá tầm sơ chế cắt khúc. Cá được làm sạch hoàn toàn nhớt, bỏ ruột, giữ lại phần thịt và sụn giòn ngon nhất.</p><p>Sản phẩm được ép chân không và cấp đông sâu giúp giữ được độ tươi ngon tuyệt đối.</p>',
        'usage_guide' => '<p>Bảo quản trong ngăn đông tủ lạnh (-18 độ C). Rã đông tự nhiên hoặc ngâm nguyên túi trong nước mát trước khi chế biến.</p>',
        'price_text' => '350.000 VNĐ / kg',
        'action_type' => 'ORDER',
        'status' => 1,
        'created_at' => now(),
        'updated_at' => now(),
    ],
    [
        'category_id' => $catIds[2] ?? (isset($catIds[0]) ? $catIds[0] : 1),
        'name' => 'Cá tầm giống size 15-20cm (Khỏe, sạch bệnh)',
        'slug' => Str::slug('Cá tầm giống size 15-20cm Khỏe sạch bệnh'),
        'image' => null,
        'gallery' => '[]',
        'short_description' => 'Con giống chất lượng cao, sinh trưởng tốt, đã được kiểm dịch an toàn.',
        'body_html' => '<p>Cá giống được ươm nuôi từ nguồn trứng nhập khẩu chuẩn, tỷ lệ sống cao, đã quen với môi trường nước và thức ăn công nghiệp.</p><p>Hỗ trợ tư vấn kỹ thuật nuôi và thiết kế bể nuôi cho bà con nông dân và đối tác.</p>',
        'usage_guide' => '<p>Thả cá vào sáng sớm hoặc chiều mát. Tuân thủ mật độ và quy trình kiểm soát nhiệt độ nước.</p>',
        'price_text' => 'Liên hệ để nhận báo giá sỉ',
        'action_type' => 'QUOTE',
        'status' => 1,
        'created_at' => now(),
        'updated_at' => now(),
    ]
];

DB::table('products')->insert($products);

echo "Successfully inserted 3 sample products.";
