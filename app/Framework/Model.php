<?php

namespace App\Framework;

abstract class Model
{
	protected static ?string $table;

	protected array $wheres = [];

	public static function query(): static
	{
		return new static();
	}

	public static function all(): array
	{
		return static::query()->get();
	}

	public static function find( $id )
	{
		return static::query()->where( 'id', '=', $id )->first();
	}

	public static function unique( string $field, mixed $value, int $excluded_id = null ): bool
	{
		$query = self::query()->where( $field, '=', $value );
		if ( ! is_null( $excluded_id ) )
		{
			$query->where( 'id', '!=', $excluded_id );
		}

		return $query->count() === 0;
	}

	public static function insert( array $data ): int
	{
		$sql = 'INSERT INTO ' . static::table();

		if ( count( $data ) > 0 )
		{
			$names         = [];
			$place_holders = [];
			foreach ( $data as $key => $value )
			{
				$names[]         = $key;
				$place_holders[] = ':' . $key;
			}

			$sql .= ' (' . implode( ', ', $names ) . ') VALUES (' . implode( ', ', $place_holders ) . ')';
		}

		$db = Database::instance();

		return $db->execute( $sql, $data );
	}

	private static function table(): string
	{
		if ( is_null( static::$table ) )
		{
			throw new \Exception( static::class . ' does not have a table named `' . static::$table . '`' );
		}

		return static::$table;
	}

	public function where( string $column, string $operator, mixed $value ): Model
	{
		$this->wheres[] = [ $column, $operator, $value ];

		return $this;
	}

	public function get(): array
	{
		[ $sql, $params ] = $this->build_query();

		$db = Database::instance();

		return $db->all( $sql, $params );
	}

	public function first()
	{
		[ $sql, $params ] = $this->build_query();

		$db = Database::instance();

		return $db->first( $sql, $params );
	}

	public function count(): int
	{
		[ $sql, $params ] = $this->build_query( true );
		$db = Database::instance();

		return $db->count( $sql, $params );
	}

	private function build_query( bool $is_count = false ): array
	{
		$params = [];

		$sql = $is_count ?
			'SELECT count(*) FROM ' . static::table() :
			'SELECT * FROM ' . static::table();

		if ( count( $this->wheres ) > 0 )
		{
			$where_clauses = [];
			foreach ( $this->wheres as $w )
			{
				$column   = $w[ 0 ];
				$operator = $w[ 1 ];
				$value    = $w[ 2 ];

				$where_clauses[]   = "$column $operator :$column";
				$params[ $column ] = $value;
			}
			$sql .= ' WHERE ' . implode( ' AND ', $where_clauses );
		}

		return [ $sql, $params ];
	}
}