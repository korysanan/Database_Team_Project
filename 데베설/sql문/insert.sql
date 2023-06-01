use `DBDBDIB`;

/*Data for the table `members`(회원) */
insert into `members` values
();

/*Date for the table `contents`(콘텐츠)*/
insert into `contents` values
();

/*Data for the table `reviews`(리뷰) */
insert into `reviews`(`content_id`, `writer`, `review`, `time`, `good`, `bad`) values
();  

/*Date for the table `ratings`(리뷰)*/
insert into `ratings` values
();

/*Date for the table `events`(이벤트)*/
insert into `events`(`name`, `start`, `end`, `condition`, `detail`) values
();

/*Date for the table `platforms`(플랫폼)*/
insert into `platforms` (name, introduction, price, family_price, link, rating)
values
('넷플릭스', '넷플릭스는 실제 4억명 이상의 고객들이 시청하는 플랫폼으로 다양한 장르의 컨텐츠를 어디서나 볼 수 있는 플랫폼이다.', 5500, true, 'https://www.netflix.com/kr/', 1),
('디즈니+', '디즈니가 출시한 OTT 서비스로 다양한 컨텐츠와 오리지널 작품을 제공한다.', 9900, false, 'https://www.disneyplus.com/ko-kr', 2),
('티빙', '국내 온라인 OTT 서비스이며 실시간TV, 다시보기, 오리지널 등 컨텐츠를 제공한다.', 7900, true, 'https://www.tving.com/onboarding', 3),
('웨이브', '국내 지상파 3사와 SK 합작으로 만들어진 OTT서비스로 지상파 실시간, 다시보기가 주요 컨텐츠인 플랫폼이다.', 7900, false, 'https://www.wavve.com/', 4),
('왓챠', '주로 영화 위주의 서비스를 제공하며 웹툰도 합께 제공하고 있다.', 7900, false, 'https://watcha.com/', 4)
('애플tv', 'apple의 OTT 서비스로, 주로 오리지널 컨텐츠를 제공한다.', 6500, false, 'https://tv.apple.com/kr', 5)
('쿠팡플레이', '싱가포르의 OTT 서비스 HOOQ를 인수를 기반으로 출시한 OTT 서비르로 다양한 컨텐츠를 제공한다.', 4990, false, 'https://www.coupangplay.com/', 6);

/*Date for the table `platform_events`(플랫폼 이벤트)*/
insert into `platform_events`(num, platform_name, name, start, end, condition, detail)
values
(1, '디즈니+', '신규회원 할인', '2023-01-01', '2024-01-01', '신규회원', '1개월간 무료'),
(2, '왓챠', '신규회원 할인', '2023-01-01', '2024-01-01', '신규회원', '3개월간 무료'),
(3, '애플tv', '신규회원 할인', '2023-01-01', '2024-01-01', '신규회원', '1개월간 무료'),
(4, '쿠팡플레이', '신규회원 할인', '2023-01-01', '2024-01-01', '신규회원', '2개월간 무료');
