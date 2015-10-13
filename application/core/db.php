<?php
class DB_Mysql
{
				private static $user   =  DB_USER;
				private static $pass   =  DB_PASS;
				private static $dbhost =  DB_HOST;
				private static $dbname =  DB_NAME;
				private static $dbh;
			
				public function __construct()
				{
				}
				protected function __clone(){
				}
				
				protected function connect()
				{
								self::$dbh = mysql_pconnect( self::$dbhost, self::$user, self::$pass );
								if ( !is_resource( self::$dbh ) ) {
												throw new Exception;
								} //!is_resource( $this->dbh )
								if ( !mysql_select_db( self::$dbname, self::$dbh ) ) {
												throw new Exception;
								} //!mysql_select_db( $this->dbname, $this->dbh )
				}
				public function execute( $query )
				{
								if ( !self::$dbh ) {
												self::connect();
								} //!$this->dbh
								$ret = mysql_query( $query, self::$dbh );
								if ( !$ret ) {
												throw new Exception;
								} //!$ret
								else if ( !is_resource(  $ret ) ) {
												return TRUE;
								} //!is_resource( $ret )
								else {
												$stmt         = new DB_MysqlStatement( self::$dbh, $query );
												$stmt->result = $ret;
												return $stmt;
								}
				}
}
class DB_MysqlStatement
{
				public $result;
				public $query;
				protected $dbh;
				public function __construct( $dbh, $query )
				{
								$this->query = $query;
								$this->dbh   = $dbh;
								if ( !is_resource( $dbh ) ) {
												throw new Exception( "Некорректное соединение с базой данных" );
								} //!is_resource( $dbh )
				}
				public function fetch_row( )
				{
								if ( !$this->result ) {
												throw new Exception( "Запрос не выполнен" );
								} //!$this->result
								return mysql_fetch_row( $this->result );
				}
				public function num_rows( )
				{
								if ( !$this->result ) {
												throw new Exception( "Запрос не выполнен" );
								} //!$this->result
								return mysql_num_rows( $this->result );
				}
				public function fetch_assoc( )
				{
								return mysql_fetch_assoc( $this->result );
				}
				public function fetchall_assoc( )
				{
								$retval = array( );
								while ( $row = $this->fetch_assoc() ) {
												$retval[ ] = $row; 
								} //$row = $this->fetch_assoc()
								return $retval;
				}
}
?>
