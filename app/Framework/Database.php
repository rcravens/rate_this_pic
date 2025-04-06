<?php

namespace App\Framework;

use PDO;

class Database
{
	private static $instance = null;
	private PDO    $pdo;

	public function __construct( string $host, int $port, string $db_name, string $username, string $password, string $charset = 'utf8mb4' )
	{
		$dsn = "mysql:host=$host;port=$port;dbname=$db_name;charset=$charset";

		$options = [
			PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
			PDO::ATTR_EMULATE_PREPARES   => false,
		];

		$this->pdo = new PDO( $dsn, $username, $password, $options );
	}

	public static function instance(): ?Database
	{
		if ( ! is_null( self::$instance ) )
		{
			return self::$instance;
		}

		$host     = config( 'database.host' );
		$port     = config( 'database.port' );
		$db_name  = config( 'database.db_name' );
		$username = config( 'database.username' );
		$password = config( 'database.password' );
		$charset  = config( 'database.charset' );

		self::$instance = new Database( $host, $port, $db_name, $username, $password, $charset );

		return self::$instance;
	}

	public function migrate(): void
	{
		$migrate_sql = file_get_contents( ROOT_PATH . "database/migrate.sql" );

		$db = Database::instance();

		$db->exec( $migrate_sql );
	}

	public function seed(): void
	{
		$migrate_sql = file_get_contents( ROOT_PATH . "database/seed.sql" );

		$db = Database::instance();

		$db->exec( $migrate_sql );
	}

	public function exec( string $sql ): int
	{
		return $this->pdo->exec( $sql );
	}

	public function first( string $sql, array $params = [] )
	{
		$statement = $this->pdo->prepare( $sql );
		$statement->execute( $params );

		$result = $statement->fetch();

		return $result === false ? null : $result;
	}

	public function all( string $sql, array $params = [] )
	{
		$statement = $this->pdo->prepare( $sql );
		$statement->execute( $params );

		return $statement->fetchAll();
	}
}