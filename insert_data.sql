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
('The Forum', 50.7355, -3.5332, 'extra_info'),
('Student Health centre', 50.7354, -3.538, 'extra_info'),
('Streatham Court', 50.735772, -3.530853, 'Streatham Court is home to the Business School Career Zone, and offers high capacity, recently refurbished teaching rooms.'),
('X-Fi Building', 50.736114, -3.529957, 'Xfi building opened its doors in 2005, and is connected to the left of Building:One. Xfi Building is number 30 on the Streatham Campus Map.'),
('Building One', 50.735657, -3.530019, ' Building:One is the newest edition to the Business School Streatham Campus, built in 2011. Building:One is number 84 on the Streatham Campus Map.'),
('Harrison ', 50.7376, -3.5327, 'extra_info'),
('Physics Building', 50.7369, -3.5363, 'extra_info'),
('Newman Building', 50.7362, -3.536, 'extra_info'),
('Amory', 50.7364, -3.5317, 'extra_info'),
('Queens', 50.7343, -3.535, 'extra_info'),
('Newman Building', 50.7362, -3.536, 'extra_info'),
('Living systems institute', 50.7366, -3.535, 'extra_info'),
('Geoffrey Pope building', 50.7366, -3.535, 'extra_info'),
('Hatherly', 50.734, -3.5333, 'extra_info'),
('Institue of Arab and islamic studies', 50.7363, -3.5372, 'extra_info'),
('Knightly Building', 50.7344, -3.5389, 'extra_info'),
('Amory', 50.7364, -3.5317, 'extra_info'),
('Geoffrey Pope building', 50.7366, -3.535, 'extra_info'),
('Hatherly', 50.734, -3.5333, 'extra_info'),
('Living systems institute', 50.7366, -3.535, 'extra_info');


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
(5,3,11),
(1,4,1),
(2,4,2),
(3,4,12),
(4,4,13),
(5,4,14),
(1,5,1),
(2,5,2),
(3,5,15),
(4,5,16),
(5,5,17),
(1,6,1),
(2,6,2),
(3,6,18),
(4,6,19),
(5,6,20);

INSERT INTO `clues`(`building_id`, `clue`)
VALUES
(1,'clue_1'),
(2,'clue_1'),
(3,'clue_1'),
(4,'clue_1'),
(5,'clue_1'),
(6,'clue_1'),
(7,'clue_1'),
(8,'clue_1'),
(9,'clue_1'),
(10,'clue_1'),
(11,'clue_1'),
(12,'clue_1'),
(13,'clue_1'),
(14,'clue_1'),
(15,'clue_1'),
(16,'clue_1'),
(17,'clue_1'),
(18,'clue_1'),
(19,'clue_1'),
(20,'clue_1');

INSERT INTO `answers`(`clue_id`, `answer`, `correct`)
VALUES
(1,'answer_1',0),
(1,'answer_2',1),
(2,'answer_1',0),
(2,'answer_2',1),
(3,'answer_1',1),
(3,'answer_2',0),
(4,'answer_1',1),
(4,'answer_2',0),
(5,'answer_1',1),
(5,'answer_2',0),
(6,'answer_1',1),
(6,'answer_2',0),
(7,'answer_1',1),
(7,'answer_2',0),
(8,'answer_1',1),
(8,'answer_2',0),
(9,'answer_1',1),
(9,'answer_2',0),
(10,'answer_1',1),
(10,'answer_2',0),
(11,'answer_1',1),
(11,'answer_2',0),
(12,'answer_1',1),
(12,'answer_2',0),
(13,'answer_1',1),
(13,'answer_2',0),
(14,'answer_1',1),
(14,'answer_2',0),
(15,'answer_1',1),
(15,'answer_2',0),
(16,'answer_1',1),
(16,'answer_2',0),
(17,'answer_1',1),
(17,'answer_2',0),
(18,'answer_1',1),
(18,'answer_2',0),
(19,'answer_1',1),
(19,'answer_2',0),
(20,'answer_1',1),
(20,'answer_2',0);

INSERT INTO `faq`(`question`, `answer`)
VALUES
('question_1','answer_1'),
('question_2','answer_2');

INSERT INTO `game_keepers`(`username`, `password`)
VALUES
('root', 'root');
