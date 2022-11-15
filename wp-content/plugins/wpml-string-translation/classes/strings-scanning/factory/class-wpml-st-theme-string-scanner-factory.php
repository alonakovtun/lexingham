<?php

class WPML_ST_Theme_String_Scanner_Factory {

	/** @return WPML_Theme_String_Scanner */
	public function create() {
		$file_hashing = new WPML_ST_File_Hashing();
		return new WPML_Theme_String_Scanner( wpml_get_filesystem_direct(), $file_hashing );
	}
}
