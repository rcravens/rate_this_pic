-- Insert users
INSERT INTO users (name, email, password)
VALUES ('Alice Johnson', 'alice@example.com', 'hashedpassword1'),
       ('David Lee', 'david@example.com', 'hashedpassword2'),
       ('Charlie Smith', 'charlie@example.com', 'hashedpassword3');

-- Insert photos
-- Alice: 1 photo, David: 2 photos, Charlie: 1 photo
INSERT INTO photos (user_id, url)
VALUES (1, 'https://picsum.photos/id/237/400/300'), -- photo_id = 1
       (2, 'https://picsum.photos/id/10/400/300'),  -- photo_id = 2
       (2, 'https://picsum.photos/id/13/400/300'),  -- photo_id = 3
       (3, 'https://picsum.photos/id/28/400/300');
-- photo_id = 4

-- Insert reviews for photo 1 (Alice)
INSERT INTO reviews (photo_id, name, num_stars, comment)
VALUES (1, 'John', 5, 'Absolutely stunning!'),
       (1, 'Sarah', 4, 'Great composition.');

-- Insert reviews for photo 2 (David)
INSERT INTO reviews (photo_id, name, num_stars, comment)
VALUES (2, NULL, 3, 'It’s okay.'),
       (2, 'Liam', 1, 'Not my style.');

-- Insert reviews for photo 3 (David)
INSERT INTO reviews (photo_id, name, num_stars, comment)
VALUES (3, 'Emma', 5, 'Love the colors!'),
       (3, NULL, 2, 'Could be better.');

-- Insert reviews for photo 4 (Charlie)
INSERT INTO reviews (photo_id, name, num_stars, comment)
VALUES (4, 'Noah', 4, 'Nice shot.'),
       (4, 'Olivia', 3, 'Decent photo.');