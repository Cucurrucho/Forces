<?php 
include('code/php/Db.php');
$forces = new Db('localhost', 'Adam', 'queseyo', 'forces');
$forces->table('players')->select('*')->get();
$forces->table('players')->where('Name','=',"'Adam'")->andWhere('Attack', '=', '4')->update('Stamina=5');