drop table appuser cascade;

create table appuser (
	userid varchar(50) primary key,
	password varchar(50),
	email varchar(50),
	gender varchar(50),
	colour varchar(50),
	ggwin int,
	rpswin int,
	rpsloss int,
	rpsdraw int,
	frogwin int
);


insert into appuser values('auser', 'apassword', 'aemail@hotmail.com', 'agender', 'acolour', 0, 0, 0, 0, 0);

