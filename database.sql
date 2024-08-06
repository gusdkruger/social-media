CREATE DATABASE social_media;
USE social_media;

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
	comment_count INT NOT NULL DEFAULT '0',
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

DELIMITER //

CREATE PROCEDURE fill_users()
BEGIN
	DECLARE i INT DEFAULT 1;
	loop_users: LOOP
		INSERT INTO user (handle, email, password) VALUES (CONCAT('user_id:', i), CONCAT('user', i, '@email.com'), '');
		SET i = i + 1;
		IF i > 25 THEN
			LEAVE loop_users;
		END IF;
	END LOOP loop_users;
END //

CREATE PROCEDURE fill_posts_and_comments()
BEGIN
	DECLARE i INT DEFAULT 1;
	DECLARE j INT;
	DECLARE rand_user_id INT;
	loop_posts: LOOP
		SET rand_user_id = FLOOR(1 + RAND() * 25);
		INSERT INTO post (user_id, text, created, comment_count) VALUES (rand_user_id, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed finibus egestas egestas. Nunc et dignissim ipsum. Pellentesque dictum finibus augue, ac finibus augue pharetra quis. Nulla quis dictum elit, viverra venenatis mauris', '2024-07-31 15:44:00', 20);
		SET j = 1;
		loop_comments: LOOP
			SET rand_user_id = FLOOR(1 + RAND() * 25);
			INSERT INTO comment (user_id, post_id, text, created) VALUES (rand_user_id, i,  'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed finibus egestas egestas. Nunc et dignissim ipsum. Pellentesque dictum finibus augue, ac finibus augue pharetra quis. Nulla quis dictum elit, viverra venenatis mauris.', '2024-07-31 15:46:00');
			SET j = j + 1;
			IF j > 20 THEN
				LEAVE loop_comments;
			END IF;
		END LOOP loop_comments;
		SET i = i + 1;
		IF i > 100 THEN
			LEAVE loop_posts;
		END IF;
	END LOOP loop_posts;
END //

CREATE PROCEDURE fill_posts_likes()
BEGIN
	DECLARE i INT DEFAULT 1;
	DECLARE j INT;
	DECLARE end_loop_likes INT;
	loop_posts: LOOP
		SET j = 1;
		SET end_loop_likes = FLOOR(1 + RAND() * 25);
		loop_likes: LOOP
			INSERT INTO post_liked_by (post_id, user_id) VALUES (i, j);
			SET j = j + 1;
			IF j > end_loop_likes THEN
				LEAVE loop_likes;
			END IF;
		END LOOP loop_likes;
		UPDATE post SET like_count = end_loop_likes WHERE id = i;
		SET i = i + 1;
		IF i > 100 THEN
			LEAVE loop_posts;
		END IF;
	END LOOP loop_posts;
END //

CREATE PROCEDURE fill_comments_likes()
BEGIN
	DECLARE i INT DEFAULT 1;
	DECLARE j INT;
	DECLARE end_loop_likes INT;
	loop_comments: LOOP
		SET j = 1;
		SET end_loop_likes = FLOOR(1 + RAND() * 25);
		loop_likes: LOOP
			INSERT INTO comment_liked_by (comment_id, user_id) VALUES (i, j);
			SET j = j + 1;
			IF j > end_loop_likes THEN
				LEAVE loop_likes;
			END IF;
		END LOOP loop_likes;
		UPDATE comment SET like_count = end_loop_likes WHERE id = i;
		SET i = i + 1;
		IF i > 2000 THEN
			LEAVE loop_comments;
		END IF;
	END LOOP loop_comments;
END //

DELIMITER ;

CALL fill_users();
CALL fill_posts_and_comments();
CALL fill_posts_likes();
CALL fill_comments_likes();
