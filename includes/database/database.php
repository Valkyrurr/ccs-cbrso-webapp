<?php
class Database extends PDO {
	public function __construct($file = "settings.ini") {
		if (! $settings = parse_ini_file ( $file, TRUE ))
			throw new exception ( "Unable to open " . $file . "." );
		$dsn = $settings ['database'] ['driver'] . ":host=" . $settings ['database'] ['host'] . ((! empty ( $settings ['database'] ['port'] )) ? (";port=" . $settings ['database'] ['port']) : "") . ";dbname=" . $settings ['database'] ['schema'] . ";charset=" . $settings ['database'] ['charset'];
		
		try {
			parent::__construct( $dsn, $settings ['database'] ['username'], $settings ['database'] ['password'] );
			parent::setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			parent::setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
			//echo "Connection to database is a success!";
		} catch ( PDOException $e ) {
			echo $e->getMessage ();
		}
	}
}