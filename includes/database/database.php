<?php
class Database {
	/**
	 * $dbh: Database Handle
	 * @var object
	 */
	private static $dbh = NULL;

	/**
	 * Class constructor
	 * @param string $file
	 */
	private function __construct($file = "settings.ini") {
		if (! $settings = parse_ini_file ( $file, TRUE ))
			throw new exception ( "Unable to open " . $file . "." );
		$dsn = $settings ['database'] ['driver'] . ":host=" . $settings ['database'] ['host'] . ((! empty ( $settings ['database'] ['port'] )) ? (";port=" . $settings ['database'] ['port']) : "") . ";dbname=" . $settings ['database'] ['schema'] . ";charset=" . $settings ['database'] ['charset'];

		try {
			self::$dbh = new PDO ( $dsn, $settings ['database'] ['username'], $settings ['database'] ['password'] );
			self::$dbh->setAttribute ( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
			self::$dbh->setAttribute ( PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC );
		} catch ( PDOException $e ) {
			echo $e->getMessage ();
		}
	}

	/**
	 * getInstance object
	 * @return object
	 */
	public static function getInstance() {
		if(self::$dbh === NULL){
			new self();
		}
		return self::$dbh;
	}

	/**
	 * destroyInstance object
	 * @return void
	 */
	public static function destroyInstance() {
		self::$dbh = NULL;
	}
}
?>
