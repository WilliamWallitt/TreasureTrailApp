-- ;==========================================
-- Title:  Insert Data - MySQL
-- Author: Justin Van Daalen, Edward Soutar, Stefan Kubal
-- Date:   25 Feb 2020
-- ========================================== -->

INSERT INTO `departments`(`department_name`)
VALUES
('The Business School'),
('College of Engineering, Mathematics and Physical Sciences'),
('College of Humanities'),
('College of Life and Environmental Sciences'),
('College of Social Sciences and International Studies'),
('College of Medicine and Health');

INSERT INTO `buildings`(`building_name`, `latitude`, `longitude`, `extra_info`, `narrative`)
VALUES
('The Forum', 50.735398, -3.533774, 'The Forum is a stunning 48 million pound centrepiece at the heart of the Streatham Campus', 'Some of me treasure was left in the forum. It''s the big building at the centre of campus. Ayy I remember the forum, used to go there back in the day. Plenty of places to eat and for an old pirate like me to sit down and study some treasure maps.'),
('Student Health Centre', 50.735916, -3.537931, 'The Student health centre accepts patients who are students of Exeter University, living on or adjacent to the main campus.', 'To the Student Health centre next! Ay, the student health centre has helped me out with scurvy more times than I care to admit. All you have to do is register with them and call whenever ya need an appointment!'),
('Streatham Court', 50.735691, -3.530889, 'Streatham Court is in close proximity to Building:One and Xfi, making the ideal collection of venues for a larger event.', 'Next, to Streatham Court! Ahh I remember this ol'' place. Perfect landscaped gardens to sit down and relax after a hard days pirating the great blue sea'),
('Xfi Building', 50.735905, -3.530047, 'All the rooms are equipped with advanced audio visual systems, and telephone and video conferencing facilities are also available', 'Now, onwards to the Xfi building! This is one high-tec place with specialist IT rooms for all kinds o'' things. So if that''s your thing then you''ll be spending lots of time here. Far too complicated for an old pirate like me. I think I''ll be sticking to the sea...'),
('Xfi Building', 50.735905, -3.530047, 'All the rooms are equipped with advanced audio visual systems, and telephone and video conferencing facilities are also available', 'Now, onwards to the Xfi building! This is one high-tec place with specialist IT rooms for all kinds o'' things. So if that''s your thing then you''ll be spending lots of time here. Far too complicated for an old pirate like me. I think I''ll be sticking to the sea...'),
('Xfi Building', 50.735905, -3.530047, 'All the rooms are equipped with advanced audio visual systems, and telephone and video conferencing facilities are also available', 'Now, onwards to the Xfi building! This is one high-tec place with specialist IT rooms for all kinds o'' things. So if that''s your thing then you’ll be spending lots of time here. Far too complicated for an old pirate like me. I think I''ll be sticking to the sea...'),
('Xfi Building', 50.735905, -3.530047, 'All the rooms are equipped with advanced audio visual systems, and telephone and video conferencing facilities are also available', 'Now, onwards to the Xfi building! This is one high-tec place with specialist IT rooms for all kinds o'' things. So if that''s your thing then you''ll be spending lots of time here. Far too complicated for an old pirate like me. I think I''ll be sticking to the sea...'),
('Building: One', 50.735657, -3.538181, 'Building one contains two lecture theatres, three teaching rooms and three syndicate rooms.', 'We''re off to Building:One next! Ay, for all you budding business magnates, this is the building for you! Recently opened in 2011, there''s lecture theatres to help you become the greatest treasure hunter in all the land, as well as the La Touche Cafe to bite on some tasty nosh while planning your next adventure!'),
('Harrison ', 50.737589, -3.532638, 'Harrison is due to be renovated - improving workshop space, facilities and equipment to support a new Engineering curriculum', 'To Harrison next! Lots of labs and lectures there. The last I heard, they plan to renovate it!'),
('Physics Building', 50.737002, -3.537931, 'Research ranging from quantum behaviour in nanomaterials to the age of stars takes place within.', 'Next, to the physics building! You''ll fit right at home here if you''re a little Newton in the making. Supposedly the highest point on the entire campus; a great landmark for if you''re lost at sea!'),
('Newman Building', 50.736486, -3.5359, 'In 2019, a group of students occupied the Peter Chalk and Newman buildings in support of the UCU strike and barricaded themselves in.', 'Now to Newman! Ay, Newman, with the lecture theatres of all those different colours! Newman Blue reminds me of the great expanse of ocean during me ol'' seafaring days...'),
('Amory', 50.736638, -3.531624, 'A Moot Courtroom is in the heart of the space, allowing students to take part in simulated court proceeding', 'On our next stop, Amory! If ya love ya humanities then this place is for you. And besides, if not, the grub here''s good enough cause to make a trip over in any case!'),
('Queens', 50.734209, -3.535064, 'The Queens Building is built around an attractive lawned garden and can be accessed from three sides.', 'To Queens next! Ah, I''ve always loved Queens! Surrounded by beautiful gardens. I remember back in the day, it used to be a Library.'),
('Living systems institute', 50.737002, -3.534977, 'Work inside the building looks at generating new tools for improving health and treating disease.', 'Now to the Living Systems Institute! I hear they''re making groundbreaking research in biology and medicine using cutting edge technology! I wish I had some of these researchers on me ship when me ol'' mates were catchin'' scurvy'),
('Geoffrey Pope building', 50.736676, -3.535036, 'It is a world-class Aquatic Resources Centre, which incorporates 14 aquaria rooms, preparative and analytical labs and a dedicated Wolfson Foundation-funded imaging unit.', 'Next, to the Geoffrey Pope building: home of the biosciences. Here you''ll find enough biology facilities to make ol'' Darwin proud! Not to mention its recent 25 million pound refurbishment -- aye, it''s a fine time to be a biology student!'),
('Hatherly', 50.73408, -3.533089, 'Inside Hatherly, team are working on how memories and emotions are formed in the brain.', 'Next on the map, Hatherly! This place is run by Professor Andrew Randall and Professor Robert Pawlak, the two brightest swashbucklers you ever did see! Ol'' Randall is researching Alzheimer''s, useful stuff for an ol'' pirate like me.'),
('Institue of Arab and islamic studies', 50.736343, -3.53705, 'The Institute has the strongest REF2014 results of any Middle Eastern and Islamic Studies department in the UK submitted to the Area Studies Panel', 'Next, to the Institute of Arab and Islamic Studies! Ay, if you want somewhere to learn Arabic and Middle Eastern languages, there ain''t no place better! Me skills I got from that ol'' place helped plenty with bargaining over that end of the world...');

INSERT INTO `routes`(`order_id`, `department_id`, `building_id`)
VALUES
(1,1,1),
(2,1,2),
(3,1,3),
(4,1,4),
(5,1,5),
(1,2,1),
(2,2,2),
(3,2,6),
(4,2,7),
(5,2,8),
(1,3,1),
(2,3,2),
(3,3,9),
(4,3,10),
(5,3,8),
(1,4,1),
(2,4,2),
(3,4,11),
(4,4,12),
(5,4,13),
(1,5,1),
(2,5,2),
(3,5,14),
(4,5,9),
(1,6,1),
(2,6,2),
(3,6,12),
(4,6,13),
(5,6,11);

INSERT INTO `clues`(`building_id`, `clue`)
VALUES
(1, 'What time does the student information desk shut on weekdays?'),
(2, 'Which of these people is not a resident doctor at the health centre?'),
(3, 'On what floor can the accounting room be found?'),
(4, 'Outside the building a statue can be seen of two hands holding what?'),
(5, 'What floor can the director of college operations be found?'),
(6, 'Until what time are you not allowed to use the drop box to hand in pieces of work?'),
(7, 'When you walk into the building there is an equation on the wall that states that e is equal to h multiplied by another letter. What is this letter?'),
(8, 'Which of these is not a real room in the Newman building?'),
(9, 'Sitting on top of the info desk there is a large toy or a purple animal. What animal is this?'),
(10, 'In what year was the Queens building opened?'),
(11, 'On the wall you will find somewhere a paper on Ocean Acidifcation. Which one of the follow did not write this paper?'),
(12, 'What position did Geoffrey Pope have when he worked at the university'),
(13, 'How many steps are there up to the main entrence to this building?'),
(14, 'On the painting on the outside of the building, how many sheets of paper can be seen in the bottom left hand corner?');

INSERT INTO `answers`(`clue_id`, `answer`, `correct`)
VALUES
(1,'6:00 PM',1),
(1,'5:30 PM',0),
(1,'4:00 PM',0),
(2,'Dr. Eric Foreman',1),
(2,'Dr. Harpreet Arshi',0),
(2,'Dr. Jo Newmegen',0),
(3,'FEELE',1),
(3,'Babbage',0),
(3,'Lovelace',0),
(4,'The World',1),
(4,'A Dove',0),
(4,'A City',0),
(5,'3',1),
(5,'-1',0),
(5,'-1',0),
(6,'5:00 PM',1),
(6,'6:00 PM',0),
(6,'6:30 PM',0),
(7,'f',1),
(7,'g',0),
(7,'a',0),
(8,'Orange LT',1),
(8,'Blue LT',0),
(8,'Green LT',0),
(9,'Octopus',1),
(9,'Elephant',0),
(9,'Dolphin',0),
(10,'1959',1),
(10,'1976',0),
(10,'1988',0),
(11,'Vice chancellor',1),
(11,'Peter C. Hubbard',0),
(11,'Rod W. Wilson',0),
(12,'Pro Chancellor and chair of the university council',1),
(12,'Deputy vice chancellor',0),
(12,'Vice chancellor',0),
(13,'14',1),
(13,'5',0),
(13,'15',0),
(14,'17',1),
(14,'25',0),
(14,'12',0);

INSERT INTO `faq`(`question`, `answer`)
VALUES
('Do we have a score board?','Coming Soon!'),
('Can I use it all the time?','Of course you can, we wont stop you'),
('I need help, wheres your chatbot!','Working on it');

INSERT INTO `game_keepers`(`username`, `password`)
VALUES
('root', 'root');
