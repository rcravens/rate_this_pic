-- Disable foreign key checks to drop tables safely
SET FOREIGN_KEY_CHECKS = 0;

-- Drop tables in reverse dependency order
DROP TABLE IF EXISTS reviews;
DROP TABLE IF EXISTS photos;
DROP TABLE IF EXISTS users;

-- Re-enable foreign key checks
SET FOREIGN_KEY_CHECKS = 1;

-- Create `users` table
CREATE TABLE users
(
    id       INT AUTO_INCREMENT PRIMARY KEY,
    name     VARCHAR(100) NOT NULL,
    email    VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

-- Create `photos` table
CREATE TABLE photos
(
    id      INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT          NOT NULL,
    url     VARCHAR(500) NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE
);

-- Create `reviews` table
CREATE TABLE reviews
(
    id        INT AUTO_INCREMENT PRIMARY KEY,
    photo_id  INT              NOT NULL,
    name      VARCHAR(100),
    num_stars TINYINT UNSIGNED NOT NULL CHECK (num_stars BETWEEN 0 AND 5),
    comment   TEXT,
    FOREIGN KEY (photo_id) REFERENCES photos (id) ON DELETE CASCADE
);