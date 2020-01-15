
CREATE TABLE admin(
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
username VARCHAR(50) NOT NULL,
password VARCHAR(20) NOT NULL,
creationDate DATETIME ,
updationDate DATETIME
)ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO admin ( `username`, `password`,creationDate) VALUES
( 'admin', '123456',"2019/12/23 12:00:00");

CREATE TABLE users(
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
fullname VARCHAR(50) NOT NULL,
username VARCHAR(50) NOT NULL,
password VARCHAR(50) NOT NULL,
email VARCHAR(100),
address VARCHAR(255),
phone VARCHAR(12)
)ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO users(fullname,username,password,email,address,phone)
VALUES
('Mai Thi My Van', 'van.mai','van123456','myvan.maits@gmail.com','99 To Hien Thanh, Da Nang', '0377920586') ;

CREATE TABLE categories(
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
categoryName VARCHAR(255) NOT NULL);

INSERT INTO categories(categoryName)
VALUES
('Sandal'),
('Giày thể thao'),
('Giày cao gót'),
('Giày búp bê');
drop table if exists products;
create table products(
id INT NOT NULL AUTO_INCREMENT NOT NULL PRIMARY KEY,
name VARCHAR(255) NOT NULL,
category_id INT NOT NULL,
image VARCHAR(255) DEFAULT NULL,
decription TEXT DEFAULT NULL,
price FLOAT NOT NULL,
created DATE NULL DEFAULT CURRENT_TIMESTAMP,
quantity INT NOT NULL
);

INSERT INTO products( name, category_id,image,decription, price,created,quantity  )
VALUES
( 'Sandal nữ nhựa không thấm nước',1,'Nhua.jpg',' ',99000,'2019-12-24',17),
( 'Sandal nữ quai chéo Latoma',1,'quai-cheo-Latoma.jpg',' ',168000,'2019-12-24',16),
( 'Sandal nữ đế bằng da thật',1,'de-bang-da-that.jpg',' ',142000,'2019-12-24',15),
( 'Sandal nữ vải DSY',1,'vai-DSY.jpg',' ',145000,'2019-12-24',14),
( 'Sandal nữ NU824',1,'nu-824.jpg',' ',189000,'2019-12-24',1),
( 'Sandal nữ MCV',1,'mwc-nusd.jpg',' ',111000,'2019-12-24',3),
( 'Sandal nữ ưu thích',1,'uu-thich.jpg',' ',102000,'2019-12-24',7),
( 'Giày búp bê GBB-0398 xám',4,'gbb-0398-xam.jpg',' ',112000,'2019-12-24',7),
( 'Giày búp bê thời trang rẻ đẹp',4,'thoi-trang-re-ben.jpg',' ',59000,'2019-12-24',1),
( 'Giày búp bê BBN01',4,'bbn01.jpg',' ',145000,'2019-12-24',10),
( 'Giày búp bê đế vuông quai ngang',4,'de-vuong-quai-ngang.jpg',' ',111000,'2019-12-24',15),
( 'Giày búp bê cao cấp Latoma',4,'cao-cap-Latoma.jpg',' ',160000,'2019-12-24',14),
( 'Giày búp bê nơ nữ điệu đà',4,'no-nu-dieu-da.jpg',' ',150000,'2019-12-24',5),
( 'Giày búp bê NINE WEST',4,'nine-west.jpg',' ',123000,'2019-12-24',6),
( 'Giày búp bê panda cute',4,'panda.jpg',' ',90000,'2019-12-24',7),
( 'Giày thể thao FINE trắng',2,'fine-trang.jpg',' ',150000,'2019-12-24',17),
('Giày thể thao gót mèo',2,'got-meo.jpg',' ',132000,'2019-12-24',1),
('Giày thể thao MWC trắng',2,'mwc-trang.jpg',' ',165000,'2019-12-24',7),
('Giày thể thao SPORT trắng',2,'sport-trang.jpg',' ',123000,'2019-12-24',5),
('Giày thể thao sneaker Passo',2,'giay-sneaker-Passo.jpg',' ',100000,'2019-12-24',15),
('Giày thể thao Passo',2,'giay-Passo.jpg',' ',69000,'2019-12-24',457),
('Giày thể thao VAHS',2,'giay-VAHS.jpg',' ',160000,'2019-12-24',53),
('Giày thể thao LK11 hồng',2,'giay-the-thao-nu-Lk11-hong.jpg',' ',150000,'2019-12-24',2),
( 'Giày cao gót quai ngang',3,'quai-ngang.jpg',' ',381000,'2019-12-24',56),
('Giày cao gót đính đá vip',3,'dinh-da-vip.jpg',' ',286000,'2019-12-24',57),
('Giày cao gót mũi nhọn đính đá lấp lánh',3,'mui-nhon-dinh-da-lap-lanh.jpg',' ',254000,'2019-12-24',78),
('Giày cao gót thủy tinh lọ lem',3,'thuy-tinh.jpg',' ',199000,'2019-12-24',3),
('Giày cao gót butterfly sang trọng',3,'butterfly-sang-trong.jpg',' ',59000,'2019-12-24',1),
('Giày cao gót đế vuông',3,'de-vuong.jpg',' ',158000,'2019-12-24',78),
('Giày cao gót cindydrella',3,'cindydrella.jpg',' ',186000,'2019-12-24',566),
('Giày cao gót quai mảnh chữ',3,'quai-manh-chu.jpg',' ',386000,'2019-12-24',17);


CREATE TABLE orders(
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
total FLOAT NOT NULL,
date_order DATE DEFAULT CURRENT_TIMESTAMP,
status TEXT DEFAULT NULL,
customerName VARCHAR(100) NOT NULL,
phoneNumber VARCHAR(15) NOT NULL,
address VARCHAR(500) NOT NULL,
email VARCHAR(100),
payMent VARCHAR(100) NOT NULL,
userName INT);

CREATE TABLE order_details(
order_id INT NOT NULL ,
product_id INT NOT NULL ,
quantity INT NOT NULL,
PRIMARY KEY(order_id,product_id)
);

CREATE TABLE wishlist(
id_wishlist INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
user_id INT,
product_id INT,
posting_date DATE DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE userLog(
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
userId INT DEFAULT NULL,
username VARCHAR(50),
userIp VARCHAR(255),
action VARCHAR(255)
);

ALTER TABLE products  
ADD FULLTEXT(name);

