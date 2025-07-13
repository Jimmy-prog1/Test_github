1-CREATE OR REPLACE VIEW v_departements AS
SELECT d.dept_name FROM departments d;

2-CREATE OR REPLACE VIEW v_departements_manager AS
SELECT d.dept_name, e.first_name, e.last_name
FROM departments d 
JOIN dept_manager dpt ON d.dept_no = dpt.dept_no
JOIN employees e ON dpt.emp_no = e.emp_no
WHERE dpt.to_date = '9999-01-01';

3-CREATE OR REPLACE VIEW v_employes_par_departement AS
SELECT d.dept_name, e.emp_no, e.first_name, e.last_name, e.hire_date
FROM employees e
JOIN dept_emp de ON e.emp_no = de.emp_no
JOIN departments d ON de.dept_no = d.dept_no
WHERE de.to_date = '9999-01-01';

4-CREATE OR REPLACE VIEW v_fiche_employe AS
SELECT emp_no, first_name, last_name, birth_date, gender, hire_date
FROM employees;

5-CREATE OR REPLACE VIEW v_salaire_employe AS
SELECT emp_no, salary, from_date, to_date
FROM salaries;

6-CREATE OR REPLACE VIEW v_emplois_employe AS
SELECT de.emp_no, d.dept_name, de.from_date, de.to_date
FROM dept_emp de
JOIN departments d ON de.dept_no = d.dept_no;

7-CREATE OR REPLACE VIEW v_departements_manager_employes AS
SELECT 
  d.dept_no,
  d.dept_name,
  e.first_name,
  e.last_name,
  COUNT(de.emp_no) AS nombre_employes
FROM departments d
LEFT JOIN dept_manager dm ON d.dept_no = dm.dept_no AND dm.to_date = '9999-01-01'
LEFT JOIN employees e ON dm.emp_no = e.emp_no
LEFT JOIN dept_emp de ON d.dept_no = de.dept_no AND de.to_date = '9999-01-01'
GROUP BY d.dept_no, d.dept_name, e.first_name, e.last_name;

8-CREATE OR REPLACE VIEW v_emplois_stats AS
SELECT 
  t.title,
  SUM(IF(e.gender = 'M', 1, 0)) AS nb_hommes,
  SUM(IF(e.gender = 'F', 1, 0)) AS nb_femmes,
  AVG(s.salary) AS salaire_moyen
FROM employees e
JOIN titles t ON e.emp_no = t.emp_no AND t.to_date = '9999-01-01'
JOIN salaries s ON e.emp_no = s.emp_no AND s.to_date = '9999-01-01'
GROUP BY t.title
ORDER BY t.title;




