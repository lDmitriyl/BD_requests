<?php

//написать запрос, отражающий все транзакции, где передача денег осуществлялась между представителями одного города

$query = "SELECT * FROM transactions as t WHERE  (
    (SELECT p.city_id FROM persons as p WHERE p.id = t.from_person_id) = (SELECT p.city_id FROM persons as p WHERE p.id = t.to_person_id))";

// написать запрос, который бы выводил имя человека, который участвовал в передаче денег наибольшее количество раз

$query = "SELECT persons.name FROM (
(SELECT from_person_id AS id FROM transactions)
UNION ALL
(SELECT to_person_id AS id FROM transactions)
) man  JOIN persons ON man.id = persons.id GROUP BY man.id ORDER BY count(*) DESC LIMIT 1";

// написать запрос, который бы выводил полное имя и баланс человека на данный момент

$query = "SELECT p.name, ((SELECT SUM(t.amount) FROM transactions as t WHERE t.to_person_id = '1') - 
                     (SELECT SUM(t.amount) FROM transactions as t WHERE t.from_person_id = '1') + p.money) as sum 
          FROM persons as p WHERE p.id = '1'";
