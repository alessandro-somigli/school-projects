drop database school_mock_exam;
create database school_mock_exam;
use school_mock_exam;

create table Communities (
	name VARCHAR(255) PRIMARY KEY
);

create table Users (
	email VARCHAR(255) PRIMARY KEY,
	
	username VARCHAR(255),
	first_name VARCHAR(255),
	last_name VARCHAR(255),
	password_hash VARCHAR(255)
);

create table Subscriptions (
	community_name VARCHAR(255),
	user_email VARCHAR(255),

	PRIMARY KEY (community_name, user_email),
	FOREIGN KEY (community_name) REFERENCES Communities(name),
	FOREIGN KEY (user_email) REFERENCES Users(email)
);

create table Events (
	id INT PRIMARY KEY auto_increment,
	community_name VARCHAR(255),

	event_name VARCHAR(255),
	event_description VARCHAR(255),
	event_location varchar(255),

	starting_date DATE,

	FOREIGN KEY(community_name) REFERENCES Communities(name)
);

create table Reviews (
	id INT PRIMARY KEY auto_increment,
	event_id INT,
	user_email VARCHAR(255),

	title  VARCHAR(255),
	text VARCHAR(1024),
	rating INT,
	
    FOREIGN KEY (event_id) REFERENCES Events(id),
    FOREIGN KEY (user_email) REFERENCES Users(email)
);



INSERT INTO Communities (name)
VALUES ('Community A'), ('Community B'), ('Community C'), ('Community D'), ('Community E');

-- Add 5 users
INSERT INTO Users (email, username, first_name, last_name, password_hash)
VALUES 
  ('user1@domain.com', 'user1', 'John', 'Doe', '123456'),
  ('user2@domain.com', 'user2', 'Jane', 'Smith', 'abcdef'),
  ('user3@domain.com', 'user3', 'Bob', 'Johnson', 'qwerty'),
  ('user4@domain.com', 'user4', 'Emily', 'Davis', 'asdfg'),
  ('user5@domain.com', 'user5', 'David', 'Lee', 'zxcvb'),
  ('user6@domain.com', 'user6', 'Mario', 'Roshark', 'bibibi');

-- Add 5 subscriptions
INSERT INTO Subscriptions (community_name, user_email)
VALUES 
  ('Community A', 'user1@domain.com'),
  ('Community A', 'user2@domain.com'),
  ('Community A', 'user3@domain.com'),
  ('Community B', 'user2@domain.com'),
  ('Community B', 'user3@domain.com'),
  ('Community B', 'user4@domain.com'),
  ('Community C', 'user3@domain.com'),
  ('Community C', 'user4@domain.com'),
  ('Community C', 'user5@domain.com'),
  ('Community D', 'user4@domain.com'),
  ('Community D', 'user5@domain.com'),
  ('Community D', 'user1@domain.com'),
  ('Community E', 'user5@domain.com'),
  ('Community E', 'user1@domain.com'),
  ('Community E', 'user2@domain.com');

INSERT INTO Events (community_name, event_name, event_description, event_location, starting_date)
VALUES 
	('Community A', 'Event 1', 'This is event 1', 'Location 1', '2023-05-01'),
  ('Community A', 'Event 2', 'This is event 2', 'Location 2', '2023-05-05'),
  ('Community A', 'Event 3', 'This is event 3', 'Location 3', '2023-05-10'),
  ('Community A', 'Event 4', 'This is event 4', 'Location 4', '2023-05-15'),
  ('Community A', 'Event 5', 'This is event 5', 'Location 5', '2023-05-20'),
  ('Community B', 'Event 6', 'This is event 6', 'Location 6', '2023-05-02'),
  ('Community B', 'Event 7', 'This is event 7', 'Location 7', '2023-05-06'),
  ('Community B', 'Event 8', 'This is event 8', 'Location 8', '2023-05-11'),
  ('Community B', 'Event 9', 'This is event 9', 'Location 9', '2023-05-16'),
  ('Community B', 'Event 10', 'This is event 10', 'Location 10', '2023-05-21'),
  ('Community C', 'Event 11', 'This is event 11', 'Location 11', '2023-05-03'),
  ('Community C', 'Event 12', 'This is event 12', 'Location 12', '2023-05-07'),
  ('Community C', 'Event 13', 'This is event 13', 'Location 13', '2023-05-12'),
  ('Community C', 'Event 14', 'This is event 14', 'Location 14', '2023-05-17'),
  ('Community C', 'Event 15', 'This is event 15', 'Location 15', '2023-05-22'),
  ('Community D', 'Event 16', 'This is event 16', 'Location 16', '2023-05-04'),
  ('Community D', 'Event 17', 'This is event 17', 'Location 17', '2023-05-08'),
  ('Community D', 'Event 18', 'This is event 18', 'Location 18', '2023-05-13'),
  ('Community D', 'Event 19', 'This is event 19', 'Location 19', '2023-05-18'),
  ('Community D', 'Event 20', 'This is event 20', 'Location 20', '2023-05-23'),
  ('Community E', 'Event 21', 'This is event 21', 'Location 21', '2023-05-13'),
  ('Community E', 'Event 22', 'This is event 22', 'Location 22', '2023-05-17'),
  ('Community E', 'Event 23', 'This is event 23', 'Location 23', '2023-05-04'),
  ('Community E', 'Event 24', 'This is event 24', 'Location 24', '2023-05-08'),
  ('Community E', 'Event 25', 'This is event 25', 'Location 25', '2023-05-21');

INSERT INTO Reviews (event_id, user_email, title, text, rating)
VALUES 
  (1, 'user1@domain.com', 'Title 1', 'Description 1', 1),
  (1, 'user2@domain.com', 'Title 2', 'Description 2', 2),
  (2, 'user3@domain.com', 'Title 3', 'Description 3', 3),
  (2, 'user4@domain.com', 'Title 4', 'Description 4', 4),
  (3, 'user5@domain.com', 'Title 5', 'Description 5', 5),
  (3, 'user6@domain.com', 'Title 6', 'Description 6', 1),
  (4, 'user1@domain.com', 'Title 7', 'Description 7', 2),
  (4, 'user2@domain.com', 'Title 8', 'Description 8', 3),
  (5, 'user3@domain.com', 'Title 9', 'Description 9', 4),
  (5, 'user4@domain.com', 'Title 10', 'Description 10', 5),
  (6, 'user5@domain.com', 'Title 11', 'Description 11', 1),
  (6, 'user6@domain.com', 'Title 12', 'Description 12', 2),
  (7, 'user1@domain.com', 'Title 13', 'Description 13', 3),
  (7, 'user2@domain.com', 'Title 14', 'Description 14', 4),
  (8, 'user3@domain.com', 'Title 15', 'Description 15', 5),
  (8, 'user4@domain.com', 'Title 16', 'Description 16', 1),
  (9, 'user5@domain.com', 'Title 17', 'Description 17', 2),
  (9, 'user6@domain.com', 'Title 18', 'Description 18', 3),
  (10, 'user1@domain.com', 'Title 19', 'Description 19', 4),
  (10, 'user2@domain.com', 'Title 20', 'Description 20', 5),
  (11, 'user3@domain.com', 'Title 21', 'Description 21', 1),
  (11, 'user4@domain.com', 'Title 22', 'Description 22', 2),
  (12, 'user5@domain.com', 'Title 23', 'Description 23', 3),
  (12, 'user6@domain.com', 'Title 24', 'Description 24', 4),
  (13, 'user1@domain.com', 'Title 25', 'Description 25', 5),
  (13, 'user2@domain.com', 'Title 26', 'Description 26', 1),
  (14, 'user3@domain.com', 'Title 27', 'Description 27', 2),
  (14, 'user4@domain.com', 'Title 28', 'Description 28', 3),
  (15, 'user5@domain.com', 'Title 29', 'Description 29', 4),
  (15, 'user6@domain.com', 'Title 30', 'Description 30', 5),
  (16, 'user1@domain.com', 'Title 31', 'Description 31', 1),
  (16, 'user2@domain.com', 'Title 32', 'Description 32', 2),
  (17, 'user3@domain.com', 'Title 33', 'Description 33', 3),
  (17, 'user4@domain.com', 'Title 34', 'Description 34', 4),
  (18, 'user5@domain.com', 'Title 35', 'Description 35', 5),
  (18, 'user6@domain.com', 'Title 36', 'Description 36', 1),
  (19, 'user1@domain.com', 'Title 37', 'Description 37', 2),
  (19, 'user2@domain.com', 'Title 38', 'Description 38', 3),
  (20, 'user3@domain.com', 'Title 39', 'Description 39', 4),
  (20, 'user4@domain.com', 'Title 40', 'Description 40', 5),
  (21, 'user5@domain.com', 'Title 41', 'Description 41', 1),
  (21, 'user6@domain.com', 'Title 42', 'Description 42', 2),
  (22, 'user1@domain.com', 'Title 43', 'Description 43', 3),
  (22, 'user2@domain.com', 'Title 44', 'Description 44', 4),
  (23, 'user3@domain.com', 'Title 45', 'Description 45', 5),
  (23, 'user4@domain.com', 'Title 46', 'Description 46', 1),
  (24, 'user5@domain.com', 'Title 47', 'Description 47', 2),
  (24, 'user6@domain.com', 'Title 48', 'Description 48', 3),
  (25, 'user1@domain.com', 'Title 49', 'Description 49', 4),
  (25, 'user2@domain.com', 'Title 50', 'Description 50', 5);
