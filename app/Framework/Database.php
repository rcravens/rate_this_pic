<?php

namespace App\Framework;

use PDO;

class Database
{
	private static ?self $instance = null;
	private PDO          $pdo;

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

	public static function migrate(): void
	{
		$migrate_sql = file_get_contents( path()->root( "database/migrate.sql" ) );

		$db = Database::instance();

		$db->raw( $migrate_sql );
	}

	public static function seed(): void
	{
		$migrate_sql = file_get_contents( path()->root( "database/seed.sql" ) );

		$db = Database::instance();

		$db->raw( $migrate_sql );
	}

	public function raw( string $sql ): int
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

	public function all( string $sql, array $params = [] ): array
	{
		$statement = $this->pdo->prepare( $sql );
		$statement->execute( $params );

		return $statement->fetchAll();
	}

	public function count( string $sql, array $params = [] )
	{
		$statement = $this->pdo->prepare( $sql );
		$statement->execute( $params );

		return $statement->fetchColumn();
	}

	public function execute( string $sql, array $params = [] ): int
	{
		$statement = $this->pdo->prepare( $sql );
		$statement->execute( $params );

		return $statement->rowCount();
	}
}