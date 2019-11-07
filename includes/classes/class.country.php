<?php
class Country
{
    public $config = array();
    /**
     * The URL of the country list package (default package is umpirsky/country-list)
     *
     * @var   string
     */
    protected $dataDir;


    /**
     * The name of the country list file
     *
     * @var   string
     */
    protected $filename = 'country.php';

    /**
     * Variable holding the country list
     *
     * @var   array
     */
    protected $countries = [];

    public function __construct($dataDir = null)
    {
        if (isset($dataDir)) {
            if (!is_dir($dataDir)) {
                die(sprintf('Unable to locate the country data directory at "%s"', $dataDir));
            }
            $this->dataDir = $dataDir;
        } else {
            $this->dataDir = 'includes/database/country';
        }
    }

    /**
     * Returns one country.
     *
     * @param string $countryCode The country
     * @param string $locale The locale (default: en)
     * @param string $source Data source: "icu" or "cldr"
     * @return string
     * @throws CountryNotFoundException  If the country code doesn't match any country.
     */
    public function get($countryCode, $locale = null, $source = null)
    {
        $countryCode = mb_strtoupper($countryCode);

        if (!$this->has($countryCode, $locale, $source)) {
            return null;
        }
        return $this->countries[$countryCode];
    }

    /**
     * Returns a list of countries.
     *
     * @param string $format
     * @param string $locale
     * @param string $source
     * @return array
     */
    public function all($format = 'php', $locale = null, $source = null)
    {
        return $this->loadData($format, $locale, $source);
    }

    /**
     * This function is used as a quick way for
     * the user to return an array with countries
     * and their corresponding ISO codes in a
     * specific language.
     *
     * @param string $format The format (default: php)
     * @param string $locale The locale (default: en)
     * @param null $source Data source: "icu" or "cldr"
     * @return array
     */
    public function loadData($format = 'php', $locale = null, $source = null)
    {
        // Language Code
        if (empty($locale)) {
            $locale = get_current_lang_code();
        }

        $source = (!empty($source)) ? mb_strtolower($source) . '/' : '';

        if (!empty($source) && !in_array($source, $this->dataSources)) {
            return [];
        }

        $file = $this->dataDir . '/' . $source . $locale . '/' . $this->filename;
        if (!file_exists($file)) {
            return [];
        }
        $this->countries = ($format == 'php') ? require($file) : file_get_contents($file);
        if (!is_array($this->countries)) {
            return [];
        }

        return $this->sortData($locale, $this->countries);
    }

    /**
     * Sorts the data array for a given locale, using the locale translations.
     * It is UTF-8 aware if the Collator class is available (requires the intl
     * extension).
     *
     * @param string $locale The locale whose collation rules should be used.
     * @param array $data Array of strings to sort.
     * @return array          The $data array, sorted.
     */
    protected function sortData($locale, $data)
{
    if (is_array($data)) {
        if (class_exists('Collator')) {
            $collator = new \Collator($locale);
            $collator->asort($data);
        } else {
            asort($data);
        }
    }

    return $data;
}

    /**
     * Indicates whether or not a given $country_code matches a country.
     *
     * @param string $countryCode A 2-letter country code
     * @param string $locale The locale (default: en)
     * @param string $source Data source: "icu" or "cldr"
     * @return bool                <code>true</code> if a match was found, <code>false</code> otherwise
     */
    public function has($countryCode, $locale = null, $source = null)
    {
        // Language Code
        if (empty($locale)) {
            $locale = get_current_lang_code();
        }

        $countries = $this->all('php', $locale, $source);

        if (count($countries) <= 0) {
            return false;
        }
        $checker = isset($countries[mb_strtoupper($countryCode)]);

        return $checker;
    }


    /**
     * @param $countries
     * @param null $locale
     * @param null $source
     * @return Collection|static
     */
    public static function transAll($countries, $locale = null, $source = null)
    {
        // Language Code
        if (empty($locale)) {
            $locale = get_current_lang_code();
        }

        // Load translated file
        $countryLang = new self();

        $tab = [];
        foreach ($countries as $code => $country) {
            $tab[$code] = $country;
            if ($name = $countryLang->get($tab[$code]['code'], $locale, $source)) {
                $tab[$code]['name'] = $name;
            }
        }

        return $tab;
    }

    /**
     * @param Collection $country
     * @param string $locale
     * @param string $source
     * @return Collection|static
     */
    public static function trans($country, $locale = null, $source = null)
    {
        //$locale = 'en'; // debug
        $countryLang = new Country();
        if ($name = $countryLang->get($country['code'], $locale, $source)) {
            return $name;
        } else {
            return $country;
        }
    }
}