CREATE DATABASE wither;
USE wither;

CREATE TABLE user (
	id INT PRIMARY KEY AUTO_INCREMENT,
	handle VARCHAR(15) NOT NULL UNIQUE,
	email VARCHAR(255) NOT NULL UNIQUE,
	password varchar(255) NOT NULL,
	followers_count INT NOT NULL DEFAULT '0',
	following_count INT NOT NULL DEFAULT '0'
);

CREATE TABLE user_is_following (
	user_id INT NOT NULL,
	following_id INT NOT NULL,
	PRIMARY KEY (user_id, following_id),
	FOREIGN KEY (user_id) REFERENCES user (id),
	FOREIGN KEY (following_id) REFERENCES user (id)
);

CREATE TABLE post (
	id INT PRIMARY KEY AUTO_INCREMENT,
	user_id INT NOT NULL,
	text VARCHAR(255) NOT NULL,
	created DATETIME NOT NULL,
	like_count INT NOT NULL DEFAULT '0',
	FOREIGN KEY (user_id) REFERENCES user (id)
);

CREATE TABLE post_liked_by (
	post_id INT NOT NULL,
	user_id INT NOT NULL,
	PRIMARY KEY (post_id, user_id),
	FOREIGN KEY (post_id) REFERENCES post (id),
	FOREIGN KEY (user_id) REFERENCES user (id)
);

CREATE TABLE comment (
	id INT PRIMARY KEY AUTO_INCREMENT,
	user_id INT NOT NULL,
	post_id INT NOT NULL,
	text VARCHAR(255) NOT NULL,
	created DATETIME NOT NULL,
	like_count INT NOT NULL DEFAULT '0',
	FOREIGN KEY (user_id) REFERENCES user (id),
	FOREIGN KEY (post_id) REFERENCES post (id)
);

CREATE TABLE comment_liked_by (
	comment_id INT NOT NULL,
	user_id INT NOT NULL,
	PRIMARY KEY (comment_id, user_id),
	FOREIGN KEY (comment_id) REFERENCES comment (id),
	FOREIGN KEY (user_id) REFERENCES user (id)
);

INSERT INTO user (handle, email, password) VALUES ('User1', 'user1@email.com', '123');
INSERT INTO user (handle, email, password) VALUES ('User2', 'user2@email.com', '123');
INSERT INTO user (handle, email, password) VALUES ('User3', 'user3@email.com', '123');
INSERT INTO user (handle, email, password) VALUES ('User4', 'user4@email.com', '123');
INSERT INTO user (handle, email, password) VALUES ('User5', 'user5@email.com', '123');
INSERT INTO user (handle, email, password) VALUES ('User6', 'user6@email.com', '123');

INSERT INTO post (user_id, text, created) VALUES (2, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', '2025-01-01 12:00:00');
INSERT INTO post (user_id, text, created) VALUES (6, 'Maecenas iaculis mauris id ipsum imperdiet egestas.', '2025-01-01 12:01:00');
INSERT INTO post (user_id, text, created) VALUES (4, 'Donec malesuada a ligula in euismod.', '2025-01-01 12:02:00');
INSERT INTO post (user_id, text, created) VALUES (2, 'Integer semper pulvinar porta.', '2025-01-01 12:03:00');
INSERT INTO post (user_id, text, created) VALUES (4, 'Nunc eu dui ornare, iaculis ipsum condimentum, egestas nunc.', '2025-01-01 12:04:00');
INSERT INTO post (user_id, text, created) VALUES (2, 'Duis molestie efficitur augue convallis ultrices.', '2025-01-01 12:05:00');
INSERT INTO post (user_id, text, created) VALUES (1, 'Morbi leo ante, porta non nulla a, rhoncus sagittis orci.', '2025-01-01 12:06:00');
INSERT INTO post (user_id, text, created) VALUES (4, 'Sed elit elit, porta et orci a, maximus consequat odio.', '2025-01-01 12:07:00');
INSERT INTO post (user_id, text, created) VALUES (5, 'Integer lacinia eu dolor quis vulputate.', '2025-01-01 12:08:00');
INSERT INTO post (user_id, text, created) VALUES (6, 'Quisque sodales lacus eget justo gravida, ac pharetra urna scelerisque.', '2025-01-01 12:09:00');
INSERT INTO post (user_id, text, created) VALUES (6, 'Phasellus hendrerit nulla mollis suscipit molestie.', '2025-01-01 12:10:00');
INSERT INTO post (user_id, text, created) VALUES (1, ' Morbi eu rutrum ligula. Vestibulum purus ex, sollicitudin ac enim sed, fringilla feugiat nisl.', '2025-01-01 12:00:00');
INSERT INTO post (user_id, text, created) VALUES (5, 'Integer ac nunc nisl. In nec lacinia eros. Nam scelerisque lectus nisl, vel cursus est faucibus nec. Praesent nec convallis arcu, vitae eleifend enim. In quis purus sit amet nisl tempus pharetra.', '2025-01-01 12:11:00');
INSERT INTO post (user_id, text, created) VALUES (2, 'In faucibus nibh eu fermentum pellentesque. Praesent dui justo, porta ut dignissim non, elementum eget orci. Curabitur rutrum iaculis tellus, quis volutpat turpis auctor ut. Integer tristique eu ipsum eget aliquet.', '2025-01-01 12:12:00');
INSERT INTO post (user_id, text, created) VALUES (5, 'Duis purus metus, mattis mollis erat sed, rhoncus efficitur leo.', '2025-01-01 12:13:00');
INSERT INTO post (user_id, text, created) VALUES (3, 'Integer in tortor tellus. Nulla sagittis magna non ante venenatis, id sollicitudin ex sagittis. Vestibulum eros libero, mollis nec efficitur id, ultrices ac nulla.', '2025-01-01 12:14:00');
INSERT INTO post (user_id, text, created) VALUES (4, 'Proin vel elit nec enim mattis suscipit. Nunc gravida nec mi vitae viverra. Suspendisse sit amet auctor velit, sed vehicula ligula. Fusce posuere et mauris eu convallis.', '2025-01-01 12:15:00');
INSERT INTO post (user_id, text, created) VALUES (1, 'Donec augue velit, cursus id semper eget, molestie id elit. Sed pulvinar justo ultrices, malesuada ligula et, facilisis nisi. Etiam sagittis efficitur tortor, sit amet semper purus. Nullam vel est sem.', '2025-01-01 12:16:00');
