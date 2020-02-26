INSERT INTO `departments`(`department_name`)
VALUES
('The Business School'),
('College of Engineering, Mathematics and Physical Sciences'),
('College of Humanities'),
('College of Life and Environmental Sciences'),
('College of Social Sciences and International Studies'),
('College of Medicine and Health');

INSERT INTO `buildings`(`building_name`, `latitude`, `longitude`, `extra_info`)
VALUES
('The Forum', 50.735398, -3.533774, 'The Forum is a stunning 48 million pound centrepiece at the heart of the Streatham Campus'),
('Student Health Centre', 50.735916, -3.537931, 'The Student health centre accepts patients who are students of Exeter University, living on or adjacent to the main campus.'),
('Streatham Court', 50.735691, -3.530889, 'Streatham Court is in close proximity to Building:One and Xfi, making the ideal collection of venues for a larger event.'),
('Xfi Building', 50.735905, -3.530047, 'All the rooms are equipped with advanced audio visual systems, and telephone and video conferencing facilities are also available'),
('Building: One', 50.735657, -3.538181, 'Building one contains two lecture theatres, three teaching rooms and three syndicate rooms.'),
('Harrison ', 50.737589, -3.532638, 'Harrison is due to be renovated - improving workshop space, facilities and equipment to support a new Engineering curriculum'),
('Physics Building', 50.737002, -3.537931, 'Research ranging from quantum behaviour in nanomaterials to the age of stars takes place within.'),
('Newman Building', 50.736486, -3.5359, 'In 2019, a group of students occupied the Peter Chalk and Newman buildings in support of the UCU strike and barricaded themselves in.'),
('Amory', 50.736638, -3.531624, 'A Moot Courtroom is in the heart of the space, allowing students to take part in simulated court proceeding'),
('Queens', 50.734209, -3.535064, 'The Queens Building is built around an attractive lawned garden and can be accessed from three sides.'),
('Living systems institute', 50.737002, -3.534977, 'Work inside the building looks at generating new tools for improving health and treating disease.'),
('Geoffrey Pope building', 50.736676, -3.535036, 'It is a world-class Aquatic Resources Centre, which incorporates 14 aquaria rooms, preparative and analytical labs and a dedicated Wolfson Foundation-funded imaging unit.'),
('Hatherly', 50.73408, -3.533089, 'Inside Hatherly, team are working on how memories and emotions are formed in the brain.'),
('Institue of Arab and islamic studies', 50.736343, -3.53705, 'The Institute has the strongest REF2014 results of any Middle Eastern and Islamic Studies department in the UK submitted to the Area Studies Panel');

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