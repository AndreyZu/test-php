<?php
	require('MyLogger.php');
	require('PDOAdapter.php');

	const HOST = 'localhost';
	const BD_NAME = 'inline';
	const USER_NAME = 'test_user';
	const PWD = '123';

	function searchMaxAge($connection){
		$maxAge = $connection->execute('selectAll', 'SELECT MAX(age) AS age FROM person');
		return $maxAge[0]->age;
	}

	$logger = new MyLogger('log.txt');
	$connection = new PDOAdapter('mysql:host='.HOST.';dbname='.BD_NAME, USER_NAME, PWD, $logger);

	$maxAge = searchMaxAge($connection);
	
?>


<!DOCTYPE html>
<html lang="ru-RU">
<head>
	<meta charset="UTF-8">
	<title>Список персон максимального возраста <?php echo $maxAge?></title>

	<meta name='viewport', content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
	<meta name="description", content="Описание страницы">
	<meta name="keywords", content="Ключевые слова">

	<style>
		body {
			font-family: Arial, Helvetica, sans-serif;
			margin: 20px;
		}
		table {
			border-collapse: collapse;
    		border: 2px solid #ccc;
		}
		td,
		th {
		    border: 1px solid #bbb;
		    padding: 7px 5px;
		}
	</style>
</head>


<body>
	<h1>Тест</h1>

	<h2>1. Максимальный возраст</h2>
	<?php echo '<p>Максимальный возраст: ', $maxAge, '</p>';?>
		

	<h2>2. Записи с пустым mother_id и возрастом меньше максимального</h2>
	<?php
		$noMotherId = $connection->execute('selectAll', 'SELECT * FROM person WHERE mother_id IS NULL AND age <' .$maxAge);
		echo '<ul>';
		foreach ($noMotherId as &$value) {
		    echo '<li>', $value->lastname, ' ', $value->firstname, '</li>';
		}
		echo '</ul>';
	?>

	<h2>3. Меняем возраст, например у 2-ой записи из предыдущего задания.</h2>
	<?php
		echo '<p>Возраст у ', $noMotherId[1]->lastname, ' ', $noMotherId[1]->firstname, ' = ', $noMotherId[1]->age, '</p>';
		$noMotherId[1]->age = $maxAge;
		echo '<p>Теперь возраст ', $noMotherId[1]->lastname, ' ', $noMotherId[1]->firstname, ' = ', $noMotherId[1]->age, '. (id='.$noMotherId[1]->id.')</p>';
		
		// Запись в БД максимального возраста для id=4
		// $connection->execute('execute', 'UPDATE person SET age = ' .$maxAge. ' WHERE id = 4');

		// Возвращаем, как было. Возраст 32 для id=4. 
		// $connection->execute('execute', 'UPDATE person SET age = 32 WHERE id = 4');
	?>

	<h2>4. Список записей с максимальным возрастом.</h2>
	<?php
		$list = $connection->execute('selectAll', 'SELECT lastname, firstname  FROM person WHERE age =' .searchMaxAge($connection));
		echo '<ul>';
		foreach ($list as &$value) {
		    echo '<li>', $value->lastname, ' ', $value->firstname, '</li>';
		}
		echo '</ul>';
	?>

	<h2>5. Сформировать и отобразить HTML-страницу.</h2>
	<p>Страница есть, выведу сюда таблицу.</p>
	<?php
		echo '<table> <caption>Список записей из БД</caption>';
		echo '<tr><th>Фамилия</th> <th>Имя</th> <th>Возраст</th></tr>';
		$table = $connection->execute('selectAll', 'SELECT lastname, firstname, age  FROM person ORDER BY lastname, firstname');
		foreach ($table as &$value) {
		    echo '<tr><td>', $value->lastname, '</td><td>', $value->firstname, '</td><td>', $value->age, '</td></tr>';
		}
		echo '</table>';

		unset($logger, $connection);
	?>

</body>
</html>