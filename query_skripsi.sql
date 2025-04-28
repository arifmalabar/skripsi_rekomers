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


SELECT 
	courses.id,
	years.year,
    students.id,
    semesters.semester
FROM 
	courses, years, students, semesters
WHERE 
	students.classroom_id = 'K002' -- ini dari form 
EXCEPT
select 
	grades.course_id,
	grades.year,
    grades.student_id,
    grades.semester
FROM 
	grades
WHERE 
	grades.course_id = 'C001' AND -- ini dari form
    grades.year = 2025 AND -- ini dari form
    grades.semester = 'GANJIL' -- ini dari form
;
