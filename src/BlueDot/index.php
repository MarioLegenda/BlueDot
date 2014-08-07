<?php

require_once '../../vendor/autoload.php';


use BlueDot\BlueDot;

$dot = new BlueDot('text.xml');
$dot->prepare('SELECT [ime, prezime, rodjenje, godina]');
//$dot->prepare('SELECT [ime, prezime, rodjenje, godina] WITH ATTRIBUTE description');
//$dot->prepare('INSERT [colorEyes] INTO osobni VALUES blue');
//$dot->prepare('UPDATE [ime, prezime] VALUES (Mirjana, Škrlec) ');
//$dot->prepare('DELETE [ime, prezime]');
//$dot->prepare('DELETE NODE ime');
//$dot->prepare('DELETE NODE WITH ATTRIBUTE birth');



/**
 * 1. Učitavanje xml fajla i spremanje podataka u Singelton objekt. To je najlakše
 * 2. Validacija Xml fajla iako bih najradije ovo preskočio
 * 3. Provjera sintakse
 *     - mora biti elastična ako želim dodavati još naredbi kasnije
 *     - mora biti jednostavna
 *     - insert, update, select i bilo što drugo mora dijeliti alate
 *     - alat koji bi univerzalno provjeravao sintaksu s obzirom na postavke!!!
 * 4. Pretvaranje podataka u php array pomoću xmlReadera i DOM.
 * 5. Stvaranje objekta kojim će clientski kod pristupati željenim vrijednostima
 *
 */