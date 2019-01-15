BEGIN TRANSACTION;

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
	`id`	INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
	`first_name`	TEXT,
	`last_name`	TEXT,
	`username`	TEXT UNIQUE,
	`email`	TEXT UNIQUE,
	`password`	TEXT,
	`created_at`	TEXT,
	`updated_at`	TEXT,
	`avatar`	BLOB DEFAULT '/images/default_profile.jpg',
	`bio`	TEXT
);

DROP TABLE IF EXISTS `posts`;
CREATE TABLE IF NOT EXISTS `posts` (
	`post_id`	INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
	`user_id`	INTEGER,
	`created_at`	TEXT,
	`updated_at`	TEXT,
	`description`	TEXT,
	`image`	BLOB,
	`tags`	TEXT,
	`timestamp`	DATETIME DEFAULT CURRENT_TIMESTAMP,
	`no_likes`	INTEGER DEFAULT 0,
		FOREIGN KEY (user_id)
		REFERENCES users(`id`)
		ON DELETE CASCADE
);

DROP TABLE IF EXISTS `likes`;
CREATE TABLE IF NOT EXISTS `likes` (
	`user_id`	INTEGER,
	`post_id`	INTEGER,
	`created_at`	TEXT,
	`has_liked`	INTEGER,
		FOREIGN KEY (user_id)
		REFERENCES users(`id`)
		ON DELETE CASCADE,
		FOREIGN KEY (post_id)
		REFERENCES posts(`post_id`)
		ON DELETE CASCADE
);

DROP TABLE IF EXISTS `followers`;
CREATE TABLE IF NOT EXISTS `followers` (
	`user_id`	INTEGER,
	`follower_id`	INTEGER,
	`created_at`	TEXT,
		FOREIGN KEY (user_id)
		REFERENCES users(`id`)
		ON DELETE CASCADE
);
DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
	`id`	INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
	`post_id`	INTEGER,
	`user_id`	INTEGER,
	`content`	TEXT,
	`created_at`	TEXT,
	`timestamp`	DATETIME DEFAULT CURRENT_TIMESTAMP,
	`author`	TEXT,
		FOREIGN KEY (user_id)
		REFERENCES users(`id`)
		ON DELETE CASCADE,
		FOREIGN KEY (post_id)
		REFERENCES posts(`post_id`)
		ON DELETE CASCADE
);
COMMIT;