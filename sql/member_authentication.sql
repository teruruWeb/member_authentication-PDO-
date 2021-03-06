/**
 member_authentication.sql
 */
/* mysqlでid連番を詰める */
SET @i := 0;
UPDATE `members` SET id = (@i := @i +1);
/* 次のid番号を設定する */
ALTER TABLE `members` auto_increment = 1;
/* create databases */
CREATE DATABASE member_authentication;
/* create table */
DROP TABLE IF EXISTS members;
CREATE TABLE members(
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  user_name VARCHAR(100),
  read_name VARCHAR(100),
  email VARCHAR(200),
  password VARCHAR(100),
  gender VARCHAR(10),
  age VARCHAR(10),
  birthday DATE,
  prefecture VARCHAR(10)
);
/* option column */
created_at DATETIME CURRENT_TIMESTAMP,
updated_at TIMESTAMP CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
/* table data */
INSERT INTO members(user_name,read_name,email,password,gender,age,birthday,prefecture)
VALUES('山田　花子','ヤマダ　ハナコ','XXXX@gmail.com','password','男性','20歳','2000-01-01','東京都');
/* gender column */
DROP TABLE IF EXISTS genders;
CREATE TABLE genders(
  gender1 VARCHAR(10),
  gender2 VARCHAR(10)
);
INSERT INTO genders(gender1,gender2) VALUES('男性','女性');
/* ages column */
DROP TABLE IF EXISTS ages;
CREATE TABLE ages(
  age0 VARCHAR(10),
  age6 VARCHAR(10),
  age7 VARCHAR(10),
  age8 VARCHAR(10),
  age9 VARCHAR(10),
  age10 VARCHAR(10),
  age11 VARCHAR(10),
  age12 VARCHAR(10),
  age13 VARCHAR(10),
  age14 VARCHAR(10),
  age15 VARCHAR(10),
  age16 VARCHAR(10),
  age17 VARCHAR(10),
  age18 VARCHAR(10),
  age19 VARCHAR(10),
  age20 VARCHAR(10),
  age21 VARCHAR(10),
  age22 VARCHAR(10),
  age23 VARCHAR(10),
  age24 VARCHAR(10),
  age25 VARCHAR(10),
  age26 VARCHAR(10),
  age27 VARCHAR(10),
  age28 VARCHAR(10),
  age29 VARCHAR(10),
  age30 VARCHAR(10),
  age31 VARCHAR(10),
  age32 VARCHAR(10),
  age33 VARCHAR(10),
  age34 VARCHAR(10),
  age35 VARCHAR(10),
  age36 VARCHAR(10),
  age37 VARCHAR(10),
  age38 VARCHAR(10),
  age39 VARCHAR(10),
  age40 VARCHAR(10),
  age41 VARCHAR(10),
  age42 VARCHAR(10),
  age43 VARCHAR(10),
  age44 VARCHAR(10),
  age45 VARCHAR(10),
  age46 VARCHAR(10),
  age47 VARCHAR(10),
  age48 VARCHAR(10),
  age49 VARCHAR(10),
  age50 VARCHAR(10),
  age51 VARCHAR(10),
  age52 VARCHAR(10),
  age53 VARCHAR(10),
  age54 VARCHAR(10),
  age55 VARCHAR(10),
  age56 VARCHAR(10),
  age57 VARCHAR(10),
  age58 VARCHAR(10),
  age59 VARCHAR(10),
  age60 VARCHAR(10),
  age61 VARCHAR(10),
  age62 VARCHAR(10),
  age63 VARCHAR(10),
  age64 VARCHAR(10),
  age65 VARCHAR(10),
  age66 VARCHAR(10),
  age67 VARCHAR(10),
  age68 VARCHAR(10),
  age69 VARCHAR(10),
  age70 VARCHAR(10),
  age71 VARCHAR(10),
  age72 VARCHAR(10),
  age73 VARCHAR(10),
  age74 VARCHAR(10),
  age75 VARCHAR(10),
  age76 VARCHAR(10),
  age77 VARCHAR(10),
  age78 VARCHAR(10),
  age79 VARCHAR(10),
  age80 VARCHAR(10),
  age81 VARCHAR(10),
  age82 VARCHAR(10),
  age83 VARCHAR(10),
  age84 VARCHAR(10),
  age85 VARCHAR(10),
  age86 VARCHAR(10),
  age87 VARCHAR(10),
  age88 VARCHAR(10),
  age89 VARCHAR(10),
  age90 VARCHAR(10),
  age91 VARCHAR(10),
  age92 VARCHAR(10),
  age93 VARCHAR(10),
  age94 VARCHAR(10),
  age95 VARCHAR(10),
  age96 VARCHAR(10),
  age97 VARCHAR(10),
  age98 VARCHAR(10),
  age99 VARCHAR(10),
  age100 VARCHAR(10)
);
INSERT INTO ages(
  age0,age6,age7,age8,age9,
  age10,age11,age12,age13,age14,age15,age16,age17,age18,age19,
  age20,age21,age22,age23,age24,age25,age26,age27,age28,age29,
  age30,age31,age32,age33,age34,age35,age36,age37,age38,age39,
  age40,age41,age42,age43,age44,age45,age46,age47,age48,age49,
  age50,age51,age52,age53,age54,age55,age56,age57,age58,age59,
  age60,age61,age62,age63,age64,age65,age66,age67,age68,age69,
  age70,age71,age72,age73,age74,age75,age76,age77,age78,age79,
  age80,age81,age82,age83,age84,age85,age86,age87,age88,age89,
  age90,age91,age92,age93,age94,age95,age96,age97,age98,age99,
  age100
)
VALUES(
  '選択してください',
  '6歳','7歳','8歳','9歳',
  '10歳','11歳','12歳','13歳','14歳','15歳','16歳','17歳','18歳','19歳',
  '20歳','21歳','22歳','23歳','24歳','25歳','26歳','27歳','28歳','29歳',
  '30歳','31歳','32歳','33歳','34歳','35歳','36歳','37歳','38歳','39歳',
  '40歳','41歳','42歳','43歳','44歳','45歳','46歳','47歳','48歳','49歳',
  '50歳','51歳','52歳','53歳','54歳','55歳','56歳','57歳','58歳','59歳',
  '60歳','61歳','62歳','63歳','64歳','65歳','66歳','67歳','68歳','69歳',
  '70歳','71歳','72歳','73歳','74歳','75歳','76歳','77歳','78歳','79歳',
  '80歳','81歳','82歳','83歳','84歳','85歳','86歳','87歳','88歳','89歳',
  '90歳','91歳','92歳','93歳','94歳','95歳','96歳','97歳','98歳','99歳',
  '100歳'
);
/* prefectures column */
DROP TABLE IF EXISTS prefectures;
CREATE TABLE prefectures(
  prefecture0 VARCHAR(10),
  prefecture1 VARCHAR(10),
  prefecture2 VARCHAR(10),
  prefecture3 VARCHAR(10),
  prefecture4 VARCHAR(10),
  prefecture5 VARCHAR(10),
  prefecture6 VARCHAR(10),
  prefecture7 VARCHAR(10),
  prefecture8 VARCHAR(10),
  prefecture9 VARCHAR(10),
  prefecture10 VARCHAR(10),
  prefecture11 VARCHAR(10),
  prefecture12 VARCHAR(10),
  prefecture13 VARCHAR(10),
  prefecture14 VARCHAR(10),
  prefecture15 VARCHAR(10),
  prefecture16 VARCHAR(10),
  prefecture17 VARCHAR(10),
  prefecture18 VARCHAR(10),
  prefecture19 VARCHAR(10),
  prefecture20 VARCHAR(10),
  prefecture21 VARCHAR(10),
  prefecture22 VARCHAR(10),
  prefecture23 VARCHAR(10),
  prefecture24 VARCHAR(10),
  prefecture25 VARCHAR(10),
  prefecture26 VARCHAR(10),
  prefecture27 VARCHAR(10),
  prefecture28 VARCHAR(10),
  prefecture29 VARCHAR(10),
  prefecture30 VARCHAR(10),
  prefecture31 VARCHAR(10),
  prefecture32 VARCHAR(10),
  prefecture33 VARCHAR(10),
  prefecture34 VARCHAR(10),
  prefecture35 VARCHAR(10),
  prefecture36 VARCHAR(10),
  prefecture37 VARCHAR(10),
  prefecture38 VARCHAR(10),
  prefecture39 VARCHAR(10),
  prefecture40 VARCHAR(10),
  prefecture41 VARCHAR(10),
  prefecture42 VARCHAR(10),
  prefecture43 VARCHAR(10),
  prefecture44 VARCHAR(10),
  prefecture45 VARCHAR(10),
  prefecture46 VARCHAR(10),
  prefecture47 VARCHAR(10)
);
INSERT INTO prefectures(
  prefecture0,
  prefecture1,
  prefecture2,
  prefecture3,
  prefecture4,
  prefecture5,
  prefecture6,
  prefecture7,
  prefecture8,
  prefecture9,
  prefecture10,
  prefecture11,
  prefecture12,
  prefecture13,
  prefecture14,
  prefecture15,
  prefecture16,
  prefecture17,
  prefecture18,
  prefecture19,
  prefecture20,
  prefecture21,
  prefecture22,
  prefecture23,
  prefecture24,
  prefecture25,
  prefecture26,
  prefecture27,
  prefecture28,
  prefecture29,
  prefecture30,
  prefecture31,
  prefecture32,
  prefecture33,
  prefecture34,
  prefecture35,
  prefecture36,
  prefecture37,
  prefecture38,
  prefecture39,
  prefecture40,
  prefecture41,
  prefecture42,
  prefecture43,
  prefecture44,
  prefecture45,
  prefecture46,
  prefecture47
)
VALUES(
  '選択してください',
  '北海道',
  '青森県',
  '岩手県',
  '宮城県',
  '秋田県',
  '山形県',
  '福島県',
  '茨城県',
  '栃木県',
  '群馬県',
  '埼玉県',
  '千葉県',
  '東京都',
  '神奈川県',
  '新潟県',
  '富山県',
  '石川県',
  '福井県',
  '山梨県',
  '長野県',
  '岐阜県',
  '静岡県',
  '愛知県',
  '三重県',
  '滋賀県',
  '京都府',
  '大阪府',
  '兵庫県',
  '奈良県',
  '和歌山県',
  '鳥取県',
  '島根県',
  '岡山県',
  '広島県',
  '山口県',
  '徳島県',
  '香川県',
  '愛媛県',
  '高知県',
  '福岡県',
  '佐賀県',
  '長崎県',
  '熊本県',
  '大分県',
  '宮崎県',
  '鹿児島県',
  '沖縄県'
);
/* years column */
DROP TABLE IF EXISTS years;
CREATE TABLE years(
  year0 VARCHAR(10),
  year1 VARCHAR(10),
  year2 VARCHAR(10),
  year3 VARCHAR(10),
  year4 VARCHAR(10),
  year5 VARCHAR(10),
  year6 VARCHAR(10),
  year7 VARCHAR(10),
  year8 VARCHAR(10),
  year9 VARCHAR(10),
  year10 VARCHAR(10),
  year11 VARCHAR(10),
  year12 VARCHAR(10),
  year13 VARCHAR(10),
  year14 VARCHAR(10),
  year15 VARCHAR(10),
  year16 VARCHAR(10),
  year17 VARCHAR(10),
  year18 VARCHAR(10),
  year19 VARCHAR(10),
  year20 VARCHAR(10),
  year21 VARCHAR(10),
  year22 VARCHAR(10),
  year23 VARCHAR(10),
  year24 VARCHAR(10),
  year25 VARCHAR(10),
  year26 VARCHAR(10),
  year27 VARCHAR(10),
  year28 VARCHAR(10),
  year29 VARCHAR(10),
  year30 VARCHAR(10),
  year31 VARCHAR(10),
  year32 VARCHAR(10),
  year33 VARCHAR(10),
  year34 VARCHAR(10),
  year35 VARCHAR(10),
  year36 VARCHAR(10),
  year37 VARCHAR(10),
  year38 VARCHAR(10),
  year39 VARCHAR(10),
  year40 VARCHAR(10),
  year41 VARCHAR(10),
  year42 VARCHAR(10),
  year43 VARCHAR(10),
  year44 VARCHAR(10),
  year45 VARCHAR(10),
  year46 VARCHAR(10),
  year47 VARCHAR(10),
  year48 VARCHAR(10),
  year49 VARCHAR(10),
  year50 VARCHAR(10),
  year51 VARCHAR(10),
  year52 VARCHAR(10),
  year53 VARCHAR(10),
  year54 VARCHAR(10),
  year55 VARCHAR(10),
  year56 VARCHAR(10),
  year57 VARCHAR(10),
  year58 VARCHAR(10),
  year59 VARCHAR(10),
  year60 VARCHAR(10),
  year61 VARCHAR(10),
  year62 VARCHAR(10),
  year63 VARCHAR(10),
  year64 VARCHAR(10),
  year65 VARCHAR(10),
  year66 VARCHAR(10),
  year67 VARCHAR(10),
  year68 VARCHAR(10),
  year69 VARCHAR(10),
  year70 VARCHAR(10),
  year71 VARCHAR(10),
  year72 VARCHAR(10),
  year73 VARCHAR(10),
  year74 VARCHAR(10),
  year75 VARCHAR(10),
  year76 VARCHAR(10),
  year77 VARCHAR(10),
  year78 VARCHAR(10),
  year79 VARCHAR(10),
  year80 VARCHAR(10),
  year81 VARCHAR(10),
  year82 VARCHAR(10),
  year83 VARCHAR(10),
  year84 VARCHAR(10),
  year85 VARCHAR(10),
  year86 VARCHAR(10),
  year87 VARCHAR(10),
  year88 VARCHAR(10),
  year89 VARCHAR(10),
  year90 VARCHAR(10),
  year91 VARCHAR(10),
  year92 VARCHAR(10),
  year93 VARCHAR(10),
  year94 VARCHAR(10),
  year95 VARCHAR(10),
  year96 VARCHAR(10),
  year97 VARCHAR(10),
  year98 VARCHAR(10),
  year99 VARCHAR(10),
  year100 VARCHAR(10)
);
INSERT INTO years(
  year0,year1,year2,year3,year4,year5,year6,year7,year8,year9,
  year10,year11,year12,year13,year14,year15,year16,year17,year18,year19,
  year20,year21,year22,year23,year24,year25,year26,year27,year28,year29,
  year30,year31,year32,year33,year34,year35,year36,year37,year38,year39,
  year40,year41,year42,year43,year44,year45,year46,year47,year48,year49,
  year50,year51,year52,year53,year54,year55,year56,year57,year58,year59,
  year60,year61,year62,year63,year64,year65,year66,year67,year68,year69,
  year70,year71,year72,year73,year74,year75,year76,year77,year78,year79,
  year80,year81,year82,year83,year84,year85,year86,year87,year88,year89,
  year90,year91,year92,year93,year94,year95,year96,year97,year98,year99,
  year100,
)
VALUES(
  '選択してください',
  '1922年','1923年','1924年','1925年','1926年','1927年','1928年','1929年',
  '1930年','1931年','1932年','1933年','1934年','1935年','1936年','1937年','1938年','1939年',
  '1940年','1941年','1941年','1943年','1944年','1945年','1946年','1947年','1948年','1949年',
  '1950年','1951年','1952年','1953年','1954年','1955年','1956年','1957年','1958年','1959年',
  '1960年','1961年','1962年','1963年','1964年','1965年','1966年','1967年','1968年','1969年',
  '1970年','1971年','1972年','1973年','1974年','1975年','1976年','1977年','1978年','1979年',
  '1980年','1981年','1982年','1983年','1984年','1985年','1986年','1987年','1988年','1989年',
  '1990年','1991年','1992年','1993年','1994年','1995年','1996年','1997年','1998年','1999年',
  '2000年','2001年','2002年','2003年','2004年','2005年','2006年','2007年','2008年','2009年',
  '2010年','2011年','2012年','2013年','2014年','2015年','2016年','2017年','2018年','2019年',
  '2020年','2021年','2022年'
);
/* months column */
DROP TABLE IF EXISTS months;
CREATE TABLE months (
  month0 VARCHAR(10),
  month1 VARCHAR(10),
  month2 VARCHAR(10),
  month3 VARCHAR(10),
  month4 VARCHAR(10),
  month5 VARCHAR(10),
  month6 VARCHAR(10),
  month7 VARCHAR(10),
  month8 VARCHAR(10),
  month9 VARCHAR(10),
  month10 VARCHAR(10),
  month11 VARCHAR(10),
  month12 VARCHAR(10)
);
INSERT INTO months(
  month0,month1,month2,month3,month4,month5,month6,month7,month8,month9,
  month10,month11,month12
)
VALUES(
  '選択してください',
  '1月','2月','3月','4月','5月','6月','7月','8月','9月',
  '10月','11月','12月'
);
/* days column */
DROP TABLE IF EXISTS days;
CREATE TABLE days (
  day0 VARCHAR(10),
  day1 VARCHAR(10),
  day2 VARCHAR(10),
  day3 VARCHAR(10),
  day4 VARCHAR(10),
  day5 VARCHAR(10),
  day6 VARCHAR(10),
  day7 VARCHAR(10),
  day8 VARCHAR(10),
  day9 VARCHAR(10),
  day10 VARCHAR(10),
  day11 VARCHAR(10),
  day12 VARCHAR(10),
  day13 VARCHAR(10),
  day14 VARCHAR(10),
  day15 VARCHAR(10),
  day16 VARCHAR(10),
  day17 VARCHAR(10),
  day18 VARCHAR(10),
  day19 VARCHAR(10),
  day20 VARCHAR(10),
  day21 VARCHAR(10),
  day22 VARCHAR(10),
  day23 VARCHAR(10),
  day24 VARCHAR(10),
  day25 VARCHAR(10),
  day26 VARCHAR(10),
  day27 VARCHAR(10),
  day28 VARCHAR(10),
  day29 VARCHAR(10),
  day30 VARCHAR(10),
  day31 VARCHAR(10)
);
INSERT INTO days(
  day0,day1,day2,day3,day4,day5,day6,day7,day8,day9,
  day10,day11,day12,day13,day14,day15,day16,day17,day18,day19,
  day20,day21,day22,day23,day24,day25,day26,day27,day28,day29,
  day30,day31
)
VALUES(
  '選択してください',
  '1日','2日','3日','4日','5日','6日','7日','8日','9日',
  '10日','11日','12日','13日','14日','15日','16日','17日','18日','19日',
  '20日','21日','22日','23日','24日','25日','26日','27日','28日','29日',
  '30日','31日'
);