<?php

use PhpMyAdmin\SqlParser\Parser;

class WPML_DB_Chunk {
	/**
	 * @var wpdb
	 */
	private $wpdb;

	/**
	 * @var int
	 */
	private $chunk_size;

	/**
	 * @param wpdb $wpdb
	 * @param int  $chunk_size
	 */
	public function __construct( wpdb $wpdb, $chunk_size = 1000 ) {
		$this->wpdb       = $wpdb;
		$this->chunk_size = $chunk_size;
	}

	/**
	 * @param string $query
	 * @param array  $args
	 * @param int    $elements_num
	 *
	 * @return array
	 *
	 * @throws \InvalidArgumentException
	 */
	public function retrieve( $query, $args, $elements_num ) {
		$this->validate_query( $query );
		$result = array();

		$offset = 0;
		while ( $offset < $elements_num ) {
			$new_query = $query . sprintf( ' LIMIT %d OFFSET %s', $this->chunk_size, $offset );
			$new_query = $this->wpdb->prepare( $new_query, $args );
			$rowset    = $this->wpdb->get_results( $new_query, ARRAY_A );

			if ( is_array( $rowset ) && count( $rowset ) ) {
				$result = array_merge( $result, $rowset );
			}

			$offset += $this->chunk_size;
		}

		return $result;
	}

	/**
	 * @param string $query
	 */
	private function validate_query( $query ) {
		$parser = new Parser( $query );

		if ( isset( $parser->statements ) ) {
			wpml_collect( $parser->statements )->each(
				function( $statement ) {
					if ( ! empty( $statement->limit ) ) {
						throw new InvalidArgumentException( "Query can't contain OFFSET or LIMIT keyword" );
					}
				}
			);
		}
	}
}
