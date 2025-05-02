USE skripsi_rekomers;

INSERT INTO program_studies VALUES('P001', "REKAYASA PERANGKAT LUNAK");
INSERT INTO classrooms VALUES("K001", "P001", "XIRPLD");

SELECT 
	id, program_study_name,
    (SELECT COUNT(*) FROM classrooms 
    WHERE program_study_id = program_studies.id) as jml_kelas
 FROM program_studies;
 
SELECT 
	id, classname,
    (SELECT program_study_name FROM program_studies WHERE id = classrooms.program_study_id) as nama_jurusan,
    (SELECT COUNT(*) FROM students WHERE classroom_id = id) as jml_siswa
FROM classrooms;

-- dihalaman nilai

SELECT 
	(SELECT courses.classroom_id FROM courses WHERE courses.id = grades.course_id) as id_kels,
	grades.course_id as id_mapel,
	(SELECT course_name FROM courses WHERE courses.id = grades.course_id) AS nama_mapel,
    grades.year as tahun,
	(SELECT academic_year FROM years WHERE years.year = grades.year) as tahun_ajar,
	semester
FROM grades
GROUP BY 
	id_kelas,
	course_id, 
    year, 
    semester
;


-- di halaman nilai siswa 
SELECT 
	(SELECT course_name FROM courses WHERE courses.id = grades.course_id) AS nama_mapel,
                (SELECT academic_year FROM years WHERE years.year = grades.year) as tahun,
                (SELECT name FROM students WHERE students.id = grades.student_id) as nama_siswa,
                semester,
                assignment,
                project,
                exams,
                attendance_presence
FROM grades;

-- insert mata pelajaran
SELECT 
	courses.id as course_id,
	years.year as year,
    students.id as student_id,
    semesters.semester as semester
FROM 
	courses, years, students, semesters
WHERE 
	students.classroom_id = 'K001' -- ini dari form 
EXCEPT
select 
	grades.course_id,
	grades.year,
    grades.student_id,
    grades.semester
FROM 
	grades
WHERE 
	grades.course_id = 'C003' AND -- ini dari form
    grades.year = 2025 AND -- ini dari form
    grades.semester = 'GANJIL' -- ini dari form 
;
