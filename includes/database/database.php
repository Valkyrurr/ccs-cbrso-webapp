<?php
class Database {
	private static $dbh = NULL;
	private function __construct($file = "settings.ini") {
		if (! $settings = parse_ini_file ( $file, TRUE ))
			throw new exception ( "Unable to open " . $file . "." );
		$dsn = $settings ['database'] ['driver'] . ":host=" . $settings ['database'] ['host'] . ((! empty ( $settings ['database'] ['port'] )) ? (";port=" . $settings ['database'] ['port']) : "") . ";dbname=" . $settings ['database'] ['schema'] . ";charset=" . $settings ['database'] ['charset'];
		
		try {
			self::$dbh = new PDO ( $dsn, $settings ['database'] ['username'], $settings ['database'] ['password'] );
			self::$dbh->setAttribute ( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
			self::$dbh->setAttribute ( PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC );
			// echo "Connection to database is a success!";
		} catch ( PDOException $e ) {
			echo $e->getMessage ();
		}
	}
	public static function getInstance() {
		if(self::$dbh === NULL){
			new self();
		}
		return self::$dbh;
	}
	public static function destroyInstance() {
		self::$dbh = NULL;
	}
}
?>