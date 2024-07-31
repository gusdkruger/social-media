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

DELIMITER //

CREATE PROCEDURE fill_users()
BEGIN
	DECLARE i INT DEFAULT 1;
	loop_users: LOOP
		INSERT INTO user (handle, email, password) VALUES (CONCAT('user_id:', i), CONCAT('user', i, '@wither.com'), '123');
		SET i = i + 1;
		IF i > 25 THEN
			LEAVE loop_users;
		END IF;
	END LOOP loop_users;
END //

CREATE PROCEDURE fill_posts()
BEGIN
	DECLARE i INT DEFAULT 1;
	DECLARE j INT;
	DECLARE rand_user_id INT;
	loop_posts: LOOP
		SET rand_user_id = FLOOR(1 + RAND() * 25);
		INSERT INTO post (user_id, text, created) VALUES (rand_user_id, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed finibus egestas egestas. Nunc et dignissim ipsum. Pellentesque dictum finibus augue, ac finibus augue pharetra quis. Nulla quis dictum elit, viverra venenatis mauris', '2024-07-31 15:44:00');
		SET j = 1;
		loop_comments: LOOP
			SET rand_user_id = FLOOR(1 + RAND() * 25);
			INSERT INTO comment (user_id, post_id, text, created) VALUES (rand_user_id, i,  'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed finibus egestas egestas. Nunc et dignissim ipsum. Pellentesque dictum finibus augue, ac finibus augue pharetra quis. Nulla quis dictum elit, viverra venenatis mauris.', '2024-07-31 15:46:00');
			SET j = j + 1;
			IF j > 50 THEN
				LEAVE loop_comments;
			END IF;
		END LOOP loop_comments;
		SET i = i + 1;
		IF i > 200 THEN
			LEAVE loop_posts;
		END IF;
	END LOOP loop_posts;
END //

DELIMITER ;

CALL fill_users();
CALL fill_posts();
