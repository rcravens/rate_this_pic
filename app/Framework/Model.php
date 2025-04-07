<?php

namespace App\Framework;

/**
 * @template TModel of Model
 */
abstract class Model
{
	protected static ?string $table;

	protected array   $wheres    = [];
	protected ?int    $offset    = null;
	protected ?int    $limit     = null;
	protected ?string $order     = null;
	protected string  $direction = 'ASC';

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
		if ( is_null( $id ) )
		{
			return null;
		}

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

	public static function delete( $id ): bool
	{
		if ( is_null( $id ) )
		{
			return false;
		}
		$sql  = 'DELETE FROM ' . static::table() . ' WHERE id = :id';
		$data = [ 'id' => $id ];
		$db   = Database::instance();

		return $db->execute( $sql, $data );
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

	public static function update( $id, array $data ): int
	{
		$sql = 'UPDATE ' . static::table();

		if ( count( $data ) > 0 )
		{
			$updates = [];
			foreach ( $data as $key => $value )
			{
				$updates[] = $key . ' = :' . $key;
			}

			$sql .= ' SET ' . implode( ', ', $updates );
		}
		$sql .= ' WHERE id = :id';

		$db = Database::instance();

		return $db->execute( $sql, $data );
	}

	/**
	 * @return list<TModel>
	 */
	protected static function hydrate_rows( $rows ): array
	{
		return array_map( [ static::class, 'hydrate' ], $rows );
	}

	/**
	 * @param object $attributes
	 *
	 * @return TModel
	 */
	protected static function hydrate( object $db_row ): static
	{
		$instance = new static();

		foreach ( get_object_vars( $db_row ) as $key => $value )
		{
			$instance->$key = $value;
		}

		return $instance;
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

	public function skip( int $offset ): Model
	{
		$this->offset = $offset;

		return $this;
	}

	public function take( int $limit ): Model
	{
		$this->limit = $limit;

		return $this;
	}

	public function order_by( string $column ): Model
	{
		$this->order     = $column;
		$this->direction = 'ASC';

		return $this;
	}

	public function order_by_desc( string $column ): Model
	{
		$this->order     = $column;
		$this->direction = 'DESC';

		return $this;
	}

	/**
	 * @return list<TModel>
	 */
	public function get(): array
	{
		[ $sql, $params ] = $this->build_query();

		$db = Database::instance();

		$rows = $db->all( $sql, $params );

		return static::hydrate_rows( $rows );
	}

	/**
	 * @param object $attributes
	 *
	 * @return TModel
	 */
	public function first()
	{
		[ $sql, $params ] = $this->build_query();

		$db = Database::instance();

		$row = $db->first( $sql, $params );

		return static::hydrate( $row );
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

		if ( ! is_null( $this->order ) )
		{
			$sql .= ' ORDER BY ' . $this->order . ' ' . $this->direction;
		}

		if ( ! is_null( $this->limit ) && $this->limit > 0 )
		{
			$sql .= ' LIMIT ' . $this->limit;
		}
		if ( ! is_null( $this->offset ) && $this->offset > 0 )
		{
			$sql .= ' OFFSET ' . $this->offset;
		}

		return [ $sql, $params ];
	}
}