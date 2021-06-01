CREATE TABLE articles
(
    id SERIAL PRIMARY KEY,
    title VARCHAR(500),
    content TEXT,
    publish_date DATETIME
);

CREATE TABLE users
(
    id SERIAL PRIMARY KEY,
    login VARCHAR(100) UNIQUE,
    hpasswd VARCHAR(32),
    token VARCHAR(32),
    isAdmin BOOL
);