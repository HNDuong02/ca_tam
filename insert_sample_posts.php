<?php
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

$posts = [
    [
        'title' => 'Cá tầm Đông Bắc - Lựa chọn số 1 cho sức khỏe gia đình',
        'slug' => Str::slug('Ca tam Dong Bac Lua chon so 1 cho suc khoe gia dinh'),
        'image' => null,
        'content' => '<p>Cá tầm từ lâu đã được biết đến là một loại thực phẩm giàu dinh dưỡng, đặc biệt chứa hàm lượng cao Omega-3, DHA, EPA rất tốt cho tim mạch và phát triển trí não.</p>
                      <p>Tại trang trại Đông Bắc, cá tầm được nuôi dưỡng trong môi trường nước lạnh tinh khiết tự nhiên, thức ăn được kiểm soát nghiêm ngặt không chứa kháng sinh hay chất tạo nạc. Thịt cá săn chắc, sụn giòn, không hề có vị tanh bùn như cá nuôi ở vùng nước tĩnh.</p>
                      <h3>Cách chế biến</h3>
                      <p>Bạn có thể chế biến vô số món ngon từ cá tầm như: lẩu măng chua cá tầm, cá tầm nướng muối ớt, cá tầm hấp xì dầu... Mỗi món đều mang một hương vị thơm ngon khó cưỡng.</p>',
        'meta_title' => 'Cá tầm Đông Bắc - Lựa chọn số 1 cho sức khỏe',
        'meta_description' => 'Khám phá giá trị dinh dưỡng tuyệt vời từ cá tầm Đông Bắc. Nguồn thực phẩm sạch, an toàn cho mọi gia đình.',
        'is_featured' => 1,
        'status' => 'PUBLISHED',
        'created_at' => now(),
        'updated_at' => now(),
    ],
    [
        'title' => 'Quy trình nuôi cá tầm sạch chuẩn VietGAP tại Đông Bắc',
        'slug' => Str::slug('Quy trinh nuoi ca tam sach chuan VietGAP tai Dong Bac'),
        'image' => null,
        'content' => '<p>Đông Bắc tự hào sở hữu trang trại nuôi cá tầm quy mô lớn với quy trình khép kín chuẩn VietGAP.</p>
                      <p><strong>Nguồn nước:</strong> Nước được dẫn trực tiếp từ suối tự nhiên với nhiệt độ quanh năm duy trì ở mức 18-22 độ C, là điều kiện sinh trưởng lý tưởng nhất cho cá tầm.</p>
                      <p><strong>Con giống:</strong> Nhập khẩu 100% từ châu Âu, có giấy tờ kiểm dịch rõ ràng, đảm bảo gen tốt, sinh trưởng khỏe mạnh.</p>
                      <p><strong>Thức ăn:</strong> Sử dụng cám cá tầm chuyên dụng, kết hợp bổ sung vitamin và khoáng chất. Chúng tôi nói "KHÔNG" với các chất kích thích tăng trưởng.</p>',
        'meta_title' => 'Quy trình nuôi cá tầm sạch tại Đông Bắc',
        'meta_description' => 'Tìm hiểu quy trình nuôi cá tầm sạch, tiêu chuẩn VietGAP, đảm bảo chất lượng từ trang trại đến bàn ăn.',
        'is_featured' => 1,
        'status' => 'PUBLISHED',
        'created_at' => now(),
        'updated_at' => now(),
    ],
    [
        'title' => 'Mẹo chọn cá tầm tươi ngon cho bữa tiệc cuối tuần',
        'slug' => Str::slug('Meo chon ca tam tuoi ngon cho bua tiec cuoi tuan'),
        'image' => null,
        'content' => '<p>Để có một món ăn ngon, khâu chọn nguyên liệu là quan trọng nhất. Dưới đây là một số mẹo giúp bạn chọn được những con cá tầm tươi ngon nhất:</p>
                      <ul>
                        <li><strong>Quan sát mắt cá:</strong> Mắt cá tươi phải trong, lồi nhẹ, không bị đục hay nhăn nheo.</li>
                        <li><strong>Kiểm tra mang:</strong> Mang cá có màu đỏ tươi, không có mùi hôi hay dịch nhớt bất thường.</li>
                        <li><strong>Độ đàn hồi của thịt:</strong> Dùng tay ấn nhẹ vào thân cá, nếu thịt nảy lên ngay và không để lại vết lõm là cá tươi.</li>
                        <li><strong>Màu da:</strong> Da cá tầm khỏe mạnh thường có độ bóng, màu sắc rõ rệt, không bị trầy xước nhiều.</li>
                      </ul>
                      <p>Đơn giản nhất, hãy đặt mua cá sống nguyên con tại Đông Bắc. Chúng tôi giao cá còn bơi tận nhà, đảm bảo 100% tươi sống.</p>',
        'meta_title' => 'Bí quyết chọn cá tầm tươi sống ngon nhất',
        'meta_description' => 'Hướng dẫn chi tiết cách nhận biết và chọn mua cá tầm tươi ngon, chắc thịt cho các món lẩu nướng.',
        'is_featured' => 0,
        'status' => 'PUBLISHED',
        'created_at' => now(),
        'updated_at' => now(),
    ]
];

DB::table('posts')->insert($posts);

echo "Successfully inserted 3 sample posts.";
