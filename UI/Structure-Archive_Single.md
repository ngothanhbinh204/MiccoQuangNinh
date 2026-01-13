Bạn đang đóng vai trò là Senior WordPress Architect (10+ năm kinh nghiệm).

NHIỆM VỤ:
1. Phân tích toàn bộ các file HTML tôi cung cấp.
2. Xác định rõ:
   - Trang nào là trang DANH SÁCH của một Custom Post Type (có pagination).
   - Trang nào là trang CHI TIẾT của Custom Post Type đó.
3. Kiểm tra xem trang danh sách hiện tại:
   - Có cấu trúc pagination hay không.
   - Có phù hợp để triển khai bằng archive-{posttype}.php hay không.

YÊU CẦU KIẾN TRÚC (BẮT BUỘC TUÂN THỦ):
- TUYỆT ĐỐI KHÔNG dùng Page Template để query danh sách post.
- Trang danh sách PHẢI sử dụng:
  - archive-{posttype}.php
  - WordPress main query (have_posts, the_post, the_posts_pagination).
- Trang chi tiết PHẢI sử dụng:
  - single-{posttype}.php

KIẾN TRÚC TRIỂN KHAI BẮT BUỘC (Cách 3):
- Sử dụng 1 Page có slug trùng với slug archive (ví dụ: /dich-vu)
  - Page này CHỈ dùng để:
    - Nhập dữ liệu ACF (banner, title, description, filter UI).
    - KHÔNG được query danh sách post.
- File archive-{posttype}.php:
  - Render layout giống Page HTML tôi cung cấp.
  - Lấy dữ liệu ACF từ Page (get_page_by_path).
  - Render danh sách post bằng WordPress main query để đảm bảo pagination chuẩn SEO.
- File single-{posttype}.php:
  - Dùng HTML chi tiết tôi cung cấp, mapping sang dữ liệu post + ACF.

OUTPUT MONG MUỐN:
1. Sơ đồ luồng kiến trúc (Admin → Page → Archive → Pagination → Single).
2. Danh sách file cần tạo:
   - archive-{posttype}.php
   - taxonomy-{taxonomy}.php
   - single-{posttype}.php
   - template-parts (nếu cần).
3. Code mẫu:
   - Cách lấy ACF từ Page trong archive.
   - Loop chuẩn WordPress + pagination.
4. Giải thích ngắn gọn:
   - Vì sao kiến trúc này đảm bảo pagination hoạt động đúng.
   - Vì sao chuẩn SEO hơn Page Template.

RÀNG BUỘC:
- Không dùng query_posts().
- Không fake pagination.
- Không rewrite URL thủ công nếu không cần thiết.
- Ưu tiên kiến trúc bền vững, dễ maintain.

BẮT ĐẦU PHÂN TÍCH NGAY KHI TÔI CUNG CẤP FILE HTML.
