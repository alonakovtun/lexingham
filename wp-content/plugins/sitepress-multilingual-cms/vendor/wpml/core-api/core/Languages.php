<?php

namespace WPML\Element\API;

use WPML\Collect\Support\Traits\Macroable;
use WPML\FP\Fns;
use WPML\FP\Logic;
use WPML\FP\Lst;
use WPML\FP\Maybe;
use WPML\FP\Obj;
use WPML\FP\Relation;
use WPML\FP\Str;
use WPML\FP\Nothing;
use WPML\FP\Just;
use WPML\LIB\WP\User;
use function WPML\FP\curryN;
use function WPML\FP\invoke;
use function WPML\FP\pipe;
use WPML\LIB\WP\Option as WPOption;

/**
 * @method static array getActive()
 *
 * It returns an array of the active languages.
 *
 * The returned array is indexed by language code and every element has the following structure:
 * ```
 *  'fr' => [
 *      'code'           => 'fr',
 *      'id'             => 3,
 *      'english_name'   => 'French',
 *      'native_name'    => 'Français',
 *      'major'          => 1,
 *      'default_locale' => 'fr_FR',
 *      'encode_url'     => 0,
 *      'tag'            => 'fr ,
 *      'display_name'   => 'French
 *  ]
 * ```
 * @method static array getSecondaries()
 *
 * It returns an array of the secondary languages.
 *
 * The returned array is indexed by language code and every element has the following structure:
 * ```
 *  'fr' => [
 *      'code'           => 'fr',
 *      'id'             => 3,
 *      'english_name'   => 'French',
 *      'native_name'    => 'Français',
 *      'major'          => 1,
 *      'default_locale' => 'fr_FR',
 *      'encode_url'     => 0,
 *      'tag'            => 'fr ,
 *      'display_name'   => 'French
 *  ]
 * ```
 * @method static array getSecondaryCodes()
 *
 * It returns an array of the secondary language codes.
 *
 * @method static array|callback getLanguageDetails( ...$code ) - Curried :: string->array
 *
 * It returns details of a language.
 *
 * An example output:
 * ```
 * [
 *      'code'           => 'fr',
 *      'id'             => 3,
 *      'english_name'   => 'French',
 *      'native_name'    => 'Français',
 *      'major'          => 1,
 *      'default_locale' => 'fr_FR',
 *      'encode_url'     => 0,
 *      'tag'            => 'fr ,
 *      'display_name'   => 'French
 *  ]
 * ```
 *
 *
 * @method static array getDefault()
 *
 * It returns a default language details.
 *
 * An example output:
 *```
 *[
 *      'code'           => 'fr',
 *      'id'             => 3,
 *      'english_name'   => 'French',
 *      'native_name'    => 'Français',
 *      'major'          => 1,
 *      'default_locale' => 'fr_FR',
 *      'encode_url'     => 0,
 *      'tag'            => 'fr ,
 *      'display_name'   => 'French
 * ]
 *```
 *
 * @method static array getDefaultCode()
 *
 * It returns a default language code.
 *
 * @method static callable|string getFlagUrl( ...$code ) - Curried :: string → string
 *
 * Gets the flag url for the given language code.
 *
 * @method static callable|array withFlags( ...$langs ) - Curried :: [code => lang] → [code => lang]
 *
 * Adds the language flag url to the array of languages.
 *
 * @method static array getAll( $lang = false ) string|false → [lang]
 *
 * It returns an array of the all the languages.
 *
 * The returned array is indexed by language code and every element has the following structure:
 * ```
 *  'fr' => [
 *      'code'           => 'fr',
 *      'id'             => 3,
 *      'english_name'   => 'French',
 *      'native_name'    => 'Français',
 *      'major'          => 1,
 *      'default_locale' => 'fr_FR',
 *      'encode_url'     => 0,
 *      'tag'            => 'fr ,
 *      'display_name'   => 'French
 *  ]
 * ```
 *
 * @method static callable|int|false setLanguageTranslation( ...$langCode, ...$displayLangCode, ...$name ) - Curried :: string->string->string->int|false
 *
 * It sets a language translation.
 *
 * @method static callable|int|false setFlag( ...$langCode, ...$flag, ...$fromTemplate ) - Curried :: string->string->bool->int|false
 *
 * It sets a language flag.
 *
 * @method static callable|string getWPLocale( ...$langDetails ) - Curried :: array->string
 */
class Languages {
	use Macroable;

	const LANGUAGES_MAPPING_OPTION = 'wpml_languages_mapping';

	/**
	 * @return void
	 */
	public static function init() {
		global $sitepress;

		self::macro( 'getActive', [ $sitepress, 'get_active_languages' ] );

		self::macro( 'getLanguageDetails', curryN( 1, [ $sitepress, 'get_language_details' ] ) );

		self::macro( 'getDefault', pipe( [ $sitepress, 'get_default_language' ], self::getLanguageDetails() ) );

		self::macro( 'getDefaultCode', [ $sitepress, 'get_default_language' ] );

		self::macro(
			'getSecondaries',
			pipe( [ self::class, 'getActive' ], Fns::reject( function( $lang ) { return Relation::propEq( 'code', self::getDefaultCode(), $lang ); } ) )
		);

		self::macro( 'getSecondaryCodes', pipe( [ self::class, 'getSecondaries' ], Lst::pluck( 'code' ) ) );

		self::macro( 'getAll', [ $sitepress, 'get_languages' ] );

		self::macro( 'getFlagUrl', curryN( 1, [ $sitepress, 'get_flag_url' ] ) );

		self::macro( 'withFlags', curryN( 1, function ( $langs ) {
			$addFlag = function ( $lang, $code ) {
				$lang['flag_url'] = self::getFlagUrl( $code );

				return $lang;
			};

			return Fns::map( $addFlag, $langs );
		} ) );

		self::macro( 'setLanguageTranslation', curryN( 3, function ( $langCode, $displayLangCode, $name ) {
			global $wpdb;

			$sql = "
				REPLACE INTO {$wpdb->prefix}icl_languages_translations (`language_code`, `display_language_code`, `name`) 
				VALUE (%s, %s, %s) 
			";

			return $wpdb->query( $wpdb->prepare( $sql, $langCode, $displayLangCode, $name ) ) ? $wpdb->insert_id : false;
		} ) );


		self::macro( 'setFlag', curryN( 3, function ( $langCode, $flag, $fromTemplate ) {
			global $wpdb;

			$sql = "
				REPLACE INTO {$wpdb->prefix}icl_flags (`lang_code`, `flag`, `from_template`)
				VALUES (%s, %s, %d)		
			";

			return $wpdb->query( $wpdb->prepare( $sql, $langCode, $flag, $fromTemplate ) ) ? $wpdb->insert_id : false;
		} ) );

		self::macro( 'getWPLocale', curryN( 1, function ( array $langDetails ) {
			if ( ! function_exists( 'wp_download_language_pack' ) ) {
				require_once ABSPATH . 'wp-admin/includes/translation-install.php';
			}

			return Logic::firstSatisfying( Logic::isTruthy(), [
				pipe( Obj::prop( 'default_locale' ), 'wp_download_language_pack' ),
				pipe( Obj::prop( 'tag' ), 'wp_download_language_pack' ),
				pipe( Obj::prop( 'code' ), 'wp_download_language_pack' ),
				Obj::prop( 'default_locale' ),
			], $langDetails );
		} ) );
	}

	/**
	 * Curried :: string → bool
	 * Determine if the language is Right to Left
	 *
	 * @param string|null $code
	 *
	 * @return callable|bool
	 */
	public static function isRtl( $code = null ) {
		$isRtl = function ( $code ) {
			global $sitepress;

			return $sitepress->is_rtl( $code );
		};

		return call_user_func_array( curryN( 1, $isRtl ), func_get_args() );
	}

	/**
	 * Curried :: [code => lang] → [code => lang]
	 *
	 * Adds language direction, right to left, to the languages data
	 *
	 * @param string[] $langs
	 *
	 * @return callable|mixed[]
	 */
	public static function withRtl( $langs = null ) {
		$withRtl = function ( $langs ) {
			$addRtl = function ( $lang, $code ) {
				$lang['rtl'] = self::isRtl( $code );

				return $lang;
			};

			return Fns::map( $addRtl, $langs );
		};

		return call_user_func_array( curryN( 1, $withRtl ), func_get_args() );
	}

	/**
	 * Curried :: string -> string|false
	 *
	 * Returns the language code given a locale
	 *
	 * @param string|null $locale
	 *
	 * @return callable|string|false
	 */
	public static function localeToCode( $locale = null ) {
		$localeToCode = function ( $locale ) {
			$allLangs = Obj::values( self::getAll() );

			$guessedCode = Maybe::of( $locale )
			                    ->map( Str::split( '_' ) )
			                    ->map( Lst::nth( 0 ) )
			                    ->filter( Lst::includes( Fns::__, Lst::pluck( 'code', $allLangs ) ) )
			                    ->getOrElse( false );

			return Obj::pathOr(
				$guessedCode,
				[ $locale, 'code' ],
				Lst::keyBy( 'default_locale', $allLangs )
			);
		};

		return call_user_func_array( curryN( 1, $localeToCode ), func_get_args() );
	}

	/**
	 * @param string $code
	 * @param string $english_name
	 * @param string $default_locale
	 * @param int    $major
	 * @param int    $active
	 * @param int    $encode_url
	 * @param string $tag
	 * @param string $country
	 *
	 * @return bool|int
	 */
	public static function add( $code, $english_name, $default_locale, $major = 0, $active = 0, $encode_url = 0, $tag = '', $country = null ) {
		global $wpdb;

		$existingCodes = Obj::keys( self::getAll() );

		$res = $wpdb->insert(
			$wpdb->prefix . 'icl_languages', [
				'code'           => $code,
				'english_name'   => $english_name,
				'default_locale' => $default_locale,
				'major'          => $major,
				'active'         => $active,
				'encode_url'     => $encode_url,
				'tag'            => $tag,
				'country'        => $country,
			]
		);

		if ( ! $res ) {
			return false;
		}

		$languageId = $wpdb->insert_id;
		$codes      = Lst::concat( $existingCodes, [ $code ] );

		Fns::map( self::setLanguageTranslation( $code, Fns::__, $english_name ), $codes );

		return $languageId;
	}

	/**
	 * @param string $customLanguageCode
	 * @param string $mappedLanguageCode
	 */
	public static function addMapping( $customLanguageCode, $mappedLanguageCode ) {
		$languagesMappings = WPOption::getOr( self::LANGUAGES_MAPPING_OPTION, [] );

		$languagesMappings[ $customLanguageCode ] = $mappedLanguageCode;
		WPOption::updateWithoutAutoLoad( self::LANGUAGES_MAPPING_OPTION, $languagesMappings );
	}

	/**
	 * @param string $customLanguageCode
	 *
	 * @return string|null
	 */
	public static function getMappedLanguage( $customLanguageCode ) {

		return Obj::prop( $customLanguageCode, WPOption::getOr( self::LANGUAGES_MAPPING_OPTION, [] ) );
	}

	/**
	 * @return Just|Nothing
	 */
	public static function getUserLanguageCode() {
		return Maybe::fromNullable( User::getCurrent() )
		            ->map( function ( $user ) {
			            return $user->locale ?: null;
		            } )
		            ->map( self::localeToCode() );
	}
}

Languages::init();
