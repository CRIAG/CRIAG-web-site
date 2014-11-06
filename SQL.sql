declare
cursor emp_cursor is select * from emp;
empl emp_cursor%rowtype;

begin
open emp_cursor;
loop
fetch emp_cursor into empl;
exit when emp_cursor%notfound;

if empl.sexe='M' then
if   TRUNC(MONTHS_BETWEEN(sysdate, empl.date_naissance)/12)>=60 then
 if empl.anciente>=14 and empl.anciente<25 then
empl.salaire:=empl.salaire-(empl.salaire*0.25);
else
empl.salaire:=empl.salaire-(empl.salaire*0.5);
end if;
insert into retraite values (empl.matricule,empl.nom,empl.prenom,empl.salaire);
delete from emp where matricule=empl.matricule;
update dept set nbr_salaries=nbr_salaries-1 where num_dep=empl.num_dep;
end if;
else
if   TRUNC(MONTHS_BETWEEN(sysdate, empl.date_naissance)/12)>=55 then
 if empl.anciente>=14 and empl.anciente<25 then
empl.salaire:=empl.salaire-(empl.salaire*0.25);
else
empl.salaire:=empl.salaire-(empl.salaire*0.5);
end if;
insert into retraite values (empl.matricule,empl.nom,empl.prenom,empl.salaire);
delete from emp where matricule=empl.matricule;
update dept set nbr_salaries=nbr_salaries-1 where num_dep=empl.num_dep;
end if;
end if;

end loop;
end;
/




ALTER TABLE emp
ADD CONSTRAINT pk_emp
primary key (matricule)

ALTER TABLE dept
ADD CONSTRAINT pk_dept
primary key (num_dep)

ALTER TABLE emp
ADD CONSTRAINT fk_dept
FOREIGN KEY (num_dep)
REFERENCES dept(num_dep)



