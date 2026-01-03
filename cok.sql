DELETE FROM `users`; 
DELETE FROM `course`;
DELETE FROM `detail_course`;
DELETE FROM `leaderboard`;
DELETE FROM `roadmap`;
DELETE FROM `roadmap_course`;
DELETE FROM `subcourse`;
DELETE FROM `user_course_history`;
DELETE FROM `user_course_progress`;
DELETE FROM `user_roadmap`;

-- =================================================================================
-- 1. INSERT DATA KE TABEL STANDAR LARAVEL: `users`
-- Data dipindahkan dari tabel 'user' lama (user_id 1, 2, 3)
-- Catatan: ID user harus dimulai dari 1 dan berlanjut.
-- =================================================================================

LOCK TABLES `users` WRITE;
INSERT INTO `users` (`id`, `name`, `email`, `password`, `created_at`, `updated_at`) VALUES 
(1,'HaikalRisnandar','haikal@example.com','$2y$12$ktCEQcG9yBeUno6YlH6PzO/pSk3dJEzNHb.hrdD7DpGYUAEdGLK2W','2025-10-23 22:19:12','2025-10-23 22:19:12'),
(2,'Adam','adamjames@example.com','$2y$12$S1cillSN1CfI2Vuta814DudiJ8M3lt85qbmBD74gC3T7BRS6seEr2','2025-10-30 03:35:18','2025-10-30 03:35:18'),
(3,'Raphael Permana Barus','raphael@email.com','$2y$12$gyq3/T6AwCfgA.bszaoxAefbwTXorgMurFlGjNAvpXDXFf6FiJchi','2025-11-05 23:46:14','2025-11-05 23:46:14');
UNLOCK TABLES;

-- =================================================================================
-- 2. INSERT DATA APLIKASI (Semua Foreign Key merujuk ke users.id)
-- =================================================================================

LOCK TABLES `course` WRITE;
INSERT INTO `course` (`course_id`, `name`, `desc`, `image_path`, `created_at`, `updated_at`, `deleted_at`) VALUES 
(1,'Web Development Fundamentals','Belajar dasar-dasar pengembangan web, mulai dari HTML, CSS, hingga JavaScript.','courses/web_dev.jpg','2025-10-23 06:07:40','2025-10-23 06:07:40',NULL),
(2,'Mobile App Development','Pelajari cara membangun aplikasi mobile menggunakan Flutter dan konsep dasar pemrograman mobile.','courses/app_dev.jpg','2025-10-23 06:07:40','2025-10-23 06:07:40',NULL),
(3,'Data Science Basics','Pahami konsep dasar Data Science, mulai dari pengolahan data, visualisasi, hingga analisis sederhana.','courses/data_science.jpg','2025-10-23 06:07:40','2025-10-23 06:07:40',NULL),
(4,'UI/UX Design Principles','Pelajari prinsip UI/UX untuk menciptakan pengalaman pengguna yang menyenangkan dan desain yang efektif.','courses/UI-UX-implementation.jpg','2025-10-23 06:07:40','2025-10-23 06:07:40',NULL),
(5,'Introduction to Cybersecurity','Pengenalan dunia keamanan siber, memahami ancaman digital, dan cara menjaga keamanan data pribadi.','courses/cyber_security.jpg','2025-10-23 06:07:40','2025-10-23 06:07:40',NULL);
UNLOCK TABLES;

LOCK TABLES `detail_course` WRITE;
INSERT INTO `detail_course` (`detail_course_id`, `name`, `type`, `path`, `subcourse_id`, `created_at`, `updated_at`, `deleted_at`) VALUES 
(1,'HTML & CSS Basics - Materi PDF 1','PDF','courses/datacourse/course_katalog.pdf',1,'2025-10-23 07:14:47','2025-10-23 07:14:47',NULL), (2,'HTML & CSS Basics - Materi PDF 2','PDF','courses/datacourse/course_katalog.pdf',1,'2025-10-23 07:14:47','2025-10-23 07:14:47',NULL), (3,'HTML & CSS Basics - Video Pembelajaran','Video','courses/datacourse/HTML-Introduction-W3Schools.com.mp4',1,'2025-10-23 07:14:47','2025-10-23 07:14:47',NULL), (4,'JavaScript for Beginners - Materi PDF 1','PDF','courses/datacourse/course_katalog.pdf',2,'2025-10-23 07:14:47','2025-10-23 07:14:47',NULL), (5,'JavaScript for Beginners - Materi PDF 2','PDF','courses/datacourse/course_katalog.pdf',2,'2025-10-23 07:14:47','2025-10-23 07:14:47',NULL), (6,'JavaScript for Beginners - Video Pembelajaran','Video','courses/datacourse/HTML-Introduction-W3Schools.com.mp4',2,'2025-10-23 07:14:47','2025-10-23 07:14:47',NULL), (7,'Responsive Design - Materi PDF 1','PDF','courses/datacourse/course_katalog.pdf',3,'2025-10-23 07:14:47','2025-10-23 07:14:47',NULL), (8,'Responsive Design - Materi PDF 2','PDF','courses/datacourse/course_katalog.pdf',3,'2025-10-23 07:14:47','2025-10-23 07:14:47',NULL), (9,'Responsive Design - Video Pembelajaran','Video','courses/datacourse/HTML-Introduction-W3Schools.com.mp4',3,'2025-10-23 07:14:47','2025-10-23 07:14:47',NULL), (10,'Flutter Introduction - Materi PDF 1','PDF','courses/datacourse/course_katalog.pdf',4,'2025-10-23 07:14:47','2025-10-23 07:14:47',NULL), (11,'Flutter Introduction - Materi PDF 2','PDF','courses/datacourse/course_katalog.pdf',4,'2025-10-23 07:14:47','2025-10-23 07:14:47',NULL), (12,'Flutter Introduction - Video Pembelajaran','Video','courses/datacourse/HTML-Introduction-W3Schools.com.mp4',4,'2025-10-23 07:14:47','2025-10-23 07:14:47',NULL), (13,'State Management - Materi PDF 1','PDF','courses/datacourse/course_katalog.pdf',5,'2025-10-23 07:14:47','2025-10-23 07:14:47',NULL), (14,'State Management - Materi PDF 2','PDF','courses/datacourse/course_katalog.pdf',5,'2025-10-23 07:14:47','2025-10-23 07:14:47',NULL), (15,'State Management - Video Pembelajaran','Video','courses/datacourse/HTML-Introduction-W3Schools.com.mp4',5,'2025-10-23 07:14:47','2025-10-23 07:14:47',NULL), (16,'Data Preprocessing - Materi PDF 1','PDF','courses/datacourse/course_katalog.pdf',6,'2025-10-23 07:14:47','2025-10-23 07:14:47',NULL), (17,'Data Preprocessing - Materi PDF 2','PDF','courses/datacourse/course_katalog.pdf',6,'2025-10-23 07:14:47','2025-10-23 07:14:47',NULL), (18,'Data Preprocessing - Video Pembelajaran','Video','courses/datacourse/HTML-Introduction-W3Schools.com.mp4',6,'2025-10-23 07:14:47','2025-10-23 07:14:47',NULL), (19,'Introduction to Python - Materi PDF 1','PDF','courses/datacourse/course_katalog.pdf',7,'2025-10-23 07:14:47','2025-10-23 07:14:47',NULL), (20,'Introduction to Python - Materi PDF 2','PDF','courses/datacourse/course_katalog.pdf',7,'2025-10-23 07:14:47','2025-10-23 07:14:47',NULL), (21,'Introduction to Python - Video Pembelajaran','Video','courses/datacourse/HTML-Introduction-W3Schools.com.mp4',7,'2025-10-23 07:14:47','2025-10-23 07:14:47',NULL), (22,'Figma Basics - Materi PDF 1','PDF','courses/datacourse/course_katalog.pdf',8,'2025-10-23 07:14:47','2025-10-23 07:14:47',NULL), (23,'Figma Basics - Materi PDF 2','PDF','courses/datacourse/course_katalog.pdf',8,'2025-10-23 07:14:47','2025-10-23 07:14:47',NULL), (24,'Figma Basics - Video Pembelajaran','Video','courses/datacourse/HTML-Introduction-W3Schools.com.mp4',8,'2025-10-23 07:14:47','2025-10-23 07:14:47',NULL), (25,'Wireframing & Prototyping - Materi PDF 1','PDF','courses/datacourse/course_katalog.pdf',9,'2025-10-23 07:14:47','2025-10-23 07:14:47',NULL), (26,'Wireframing & Prototyping - Materi PDF 2','PDF','courses/datacourse/course_katalog.pdf',9,'2025-10-23 07:14:47','2025-10-23 07:14:47',NULL), (27,'Wireframing & Prototyping - Video Pembelajaran','Video','courses/datacourse/HTML-Introduction-W3Schools.com.mp4',9,'2025-10-23 07:14:47','2025-10-23 07:14:47',NULL), (28,'Network Fundamentals - Materi PDF 1','PDF','courses/datacourse/course_katalog.pdf',10,'2025-10-23 07:14:47','2025-10-23 07:14:47',NULL), (29,'Network Fundamentals - Materi PDF 2','PDF','courses/datacourse/course_katalog.pdf',10,'2025-10-23 07:14:47','2025-10-23 07:14:47',NULL), (30,'Network Fundamentals - Video Pembelajaran','Video','courses/datacourse/HTML-Introduction-W3Schools.com.mp4',10,'2025-10-23 07:14:47','2025-10-23 07:14:47',NULL), (31,'Ethical Hacking Basics - Materi PDF 1','PDF','courses/datacourse/course_katalog.pdf',11,'2025-10-23 07:14:47','2025-10-23 07:14:47',NULL), (32,'Ethical Hacking Basics - Materi PDF 2','PDF','courses/datacourse/course_katalog.pdf',11,'2025-10-23 07:14:47','2025-10-23 07:14:47',NULL), (33,'Ethical Hacking Basics - Video Pembelajaran','Video','courses/datacourse/HTML-Introduction-W3Schools.com.mp4',11,'2025-10-23 07:14:47','2025-10-23 07:14:47',NULL);
UNLOCK TABLES;

LOCK TABLES `leaderboard` WRITE;
INSERT INTO `leaderboard` (`leaderboard_id`, `urutan`, `user_id`, `created_at`, `updated_at`, `deleted_at`) VALUES 
(1,1,3,'2025-11-06 11:30:00','2025-11-06 11:30:00',NULL);
UNLOCK TABLES;

LOCK TABLES `roadmap` WRITE;
INSERT INTO `roadmap` (`roadmap_id`, `name`, `slug`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES 
(1,'Front-end Developer Path','frontend-developer','Jalur ini mencakup semua dasar Web Development Fundamentals dan UI/UX Design Principles untuk antarmuka yang solid.','2025-10-30 04:59:10','2025-10-30 04:59:10',NULL),
(2,'Multi-Discipline Analyst Path','multi-discipline-analyst','Mempelajari dasar-dasar Data Science, Mobile App Development, dan Cybersecurity, membentuk fondasi analisis yang kuat.','2025-10-30 04:59:45','2025-10-30 04:59:45',NULL);
UNLOCK TABLES;

LOCK TABLES `roadmap_course` WRITE;
INSERT INTO `roadmap_course` (`roadmap_id`, `course_id`) VALUES 
(1,1), (1,4);
UNLOCK TABLES;

LOCK TABLES `subcourse` WRITE;
INSERT INTO `subcourse` (`subcourse_id`, `name`, `image_path`, `course_id`, `created_at`, `updated_at`, `deleted_at`) VALUES 
(1,'HTML & CSS Basics',NULL,1,'2025-10-23 06:08:56','2025-10-23 06:08:56',NULL), (2,'JavaScript for Beginners',NULL,1,'2025-10-23 06:08:56','2025-10-23 06:08:56',NULL), (3,'Responsive Design',NULL,1,'2025-10-23 06:08:56','2025-10-23 06:08:56',NULL), (4,'Flutter Introduction',NULL,2,'2025-10-23 06:08:56','2025-10-23 06:08:56',NULL), (5,'State Management',NULL,2,'2025-10-23 06:08:56','2025-10-23 06:08:56',NULL), (6,'Data Preprocessing',NULL,3,'2025-10-23 06:08:56','2025-10-23 06:08:56',NULL), (7,'Introduction to Python',NULL,3,'2025-10-23 06:08:56','2025-10-23 06:08:56',NULL), (8,'Figma Basics',NULL,4,'2025-10-23 06:08:56','2025-10-23 06:08:56',NULL), (9,'Wireframing & Prototyping',NULL,4,'2025-10-23 06:08:56','2025-10-23 06:08:56',NULL), (10,'Network Fundamentals',NULL,5,'2025-10-23 06:08:56','2025-10-23 06:08:56',NULL), (11,'Ethical Hacking Basics',NULL,5,'2025-10-23 06:08:56','2025-10-23 06:08:56',NULL);
UNLOCK TABLES;

LOCK TABLES `user_course_history` WRITE;
INSERT INTO `user_course_history` (`user_course_history_id`, `last_seen`, `user_id`, `detail_course_id`, `created_at`, `updated_at`, `deleted_at`) VALUES 
(1,'2025-11-06 09:13:38',1,1,'2025-10-24 01:06:15','2025-11-06 02:13:38',NULL), (2,'2025-11-06 08:58:56',1,2,'2025-10-24 01:06:38','2025-11-06 01:58:56',NULL), (3,'2025-11-06 08:58:58',1,3,'2025-10-24 01:07:42','2025-11-06 01:58:58',NULL), (4,'2025-10-24 15:12:19',1,10,'2025-10-24 01:11:05','2025-10-24 01:12:19',NULL), (5,'2025-10-24 15:11:25',1,16,'2025-10-24 01:11:17','2025-10-24 01:11:25',NULL), (6,'2025-10-24 15:11:23',1,17,'2025-10-24 01:11:23','2025-10-24 01:11:23',NULL), (7,'2025-10-24 15:12:16',1,11,'2025-10-24 01:12:16','2025-10-24 01:12:16',NULL), (8,'2025-11-06 18:00:00',3,12,'2025-11-06 11:00:00','2025-11-06 11:00:00',NULL), (9,'2025-11-06 17:30:00',3,11,'2025-11-06 10:30:00','2025-11-06 10:30:00',NULL), (10,'2025-11-06 16:45:00',3,10,'2025-11-06 09:45:00','2025-11-06 09:45:00',NULL);
UNLOCK TABLES;

LOCK TABLES `user_course_progress` WRITE;
INSERT INTO `user_course_progress` (`user_course_progress_id`, `user_id`, `detail_course_id`, `done`, `created_at`, `updated_at`, `deleted_at`) VALUES 
(2,1,1,1,'2025-10-24 00:47:03','2025-10-24 00:47:03',NULL), (3,1,2,1,'2025-10-24 01:08:36','2025-10-24 01:08:36',NULL), (4,3,1,1,'2025-11-06 00:00:00','2025-11-06 00:00:00',NULL), (5,3,2,1,'2025-11-06 01:00:00','2025-11-06 01:00:00',NULL), (6,3,3,1,'2025-11-06 02:00:00','2025-11-06 02:00:00',NULL), (7,3,4,1,'2025-11-06 03:00:00','2025-11-06 03:00:00',NULL), (8,3,5,1,'2025-11-06 04:00:00','2025-11-06 04:00:00',NULL), (9,3,6,1,'2025-11-06 05:00:00','2025-11-06 05:00:00',NULL), (10,3,7,1,'2025-11-06 06:00:00','2025-11-06 06:00:00',NULL), (11,3,8,1,'2025-11-06 07:00:00','2025-11-06 07:00:00',NULL), (12,3,9,1,'2025-11-06 08:00:00','2025-11-06 08:00:00',NULL), (13,3,10,1,'2025-11-06 09:00:00','2025-11-06 09:00:00',NULL), (14,3,11,1,'2025-11-06 10:00:00','2025-11-06 10:00:00',NULL), (15,3,12,1,'2025-11-06 11:00:00','2025-11-06 11:00:00',NULL);
UNLOCK TABLES;

LOCK TABLES `user_roadmap` WRITE;
INSERT INTO `user_roadmap` (`user_roadmap_id`, `lainnya`, `user_id`, `roadmap_id`, `created_at`, `updated_at`, `deleted_at`) VALUES 
(1,NULL,2,1,'2025-10-30 05:14:48','2025-10-30 05:14:48',NULL), (2,NULL,3,1,'2025-11-05 23:50:00','2025-11-05 23:50:00',NULL), (3,NULL,3,2,'2025-11-05 23:55:00','2025-11-05 23:55:00',NULL);
UNLOCK TABLES;
```