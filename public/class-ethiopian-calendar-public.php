<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://askual.com
 * @since      1.0.0
 *
 * @package    Ethiopian_Calendar
 * @subpackage Ethiopian_Calendar/public
 */

 use Geezify\Geezify;
 use Andegna\Calender;

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Ethiopian_Calendar
 * @subpackage Ethiopian_Calendar/public
 * @author     Askual Tech <info@askual.com>
 */
class Ethiopian_Calendar_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;


	private $months_in_english = [
			'መስከረም' => 'Meskerem', 'ጥቅምት' => 'Tikimt', 'ኅዳር' => 'Hidar',
			'ታኅሣሥ' => 'Tahsas', 'ጥር' => 'Tir', 'የካቲት' => 'Yekatit',
			'መጋቢት' => 'Megabit', 'ሚያዝያ' => 'Miyazia', 'ግንቦት' => 'Ginbot',
			'ሰኔ' =>'Sene', 'ሐምሌ' => 'Hamle', 'ነሐሴ' => 'Nehase', 'ጳጉሜን' => 'Pagumen',
	];


	private $date_formats = [
		'0' => [
			// 'am'=> '', 'en' => ''
		],
		'1'=> [
			'am'=> 'F j ቀን Y አ.ም', 'en' => [
				'dth','M','y','A.D'
			]
		],
		'2'=> [
			'am'=> 'F j ቀን Y', 'en' => [
				'dth','M','y'
			]
		],
		'3'=> [
			'am'=> 'j/m/Y አ.ም', 'en' => 'j/m/Y \A.\D'
		],
		'4'=> [
			'am'=> 'j/m/Y', 'en' => 'j/m/Y'
		],
	];

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Ethiopian_Calendar_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Ethiopian_Calendar_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/ethiopian-calendar-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Ethiopian_Calendar_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Ethiopian_Calendar_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/ethiopian-calendar-public.js', array( 'jquery' ), $this->version, false );

	}

	function to_andegna_calendar($date){
		$options = get_option($this->plugin_name);
    $language = $options['language'];
    $format = $options['format'];

		$geez = Geezify::create();
		$datetime = new \DateTime($date);
		$ethiopic = \Andegna\DateTimeFactory::fromDateTime($datetime);

		$formatted = $this->ethiopian_date_formatter($ethiopic,$format,$language);
		return $formatted;

		// return $thetime->format('Y-m-d')->format(Andegna\Constants::DATE_ETHIOPIAN);
		// $options = get_option($this->plugin_name);
    //     // $orthodox = $options['orthodox'];
    // $normal = $options['normal'];
    // if ($normal == 2)
		// 	return $thetime->getYear();
		// 	// return $thetime->format(Andegna\Constants::DATE_ETHIOPIAN);
		// if ($normal == 1)
		// 	return $thetime->format(Andegna\Constants::DATE_GEEZ_ORTHODOX);
	}

	// Provides: You should eat pizza, beer, and ice cream every day
	// $phrase  = "You should eat fruits, vegetables, and fiber every day.";
	// $healthy = array("fruits", "vegetables", "fiber");
	// $yummy   = array("pizza", "beer", "ice cream");


	private function ordinal($number) {
      $ends = array('th','st','nd','rd','th','th','th','th','th','th');
      if ((($number % 100) >= 11) && (($number%100) <= 13))
          return $number. 'th';
      else
          return $number. $ends[$number % 10];
  }

	private function ethiopian_date_formatter( $ethipic, $format,$lang="en")
	{
		switch ($lang) {
			case 'am':
				return $ethipic->format($this->date_formats[$format][$lang]);
				break;

			case 'en':
				if (is_array($this->date_formats[$format][$lang])) {
					$arr = [
						'M'=> array_values($this->months_in_english)[$ethipic->getMonth()],
						'dth'=> $this->ordinal($ethipic->getDay()),
						'y' => $ethipic->getYear()
					];
					$ans='';
					foreach ($this->date_formats[$format][$lang] as $command) {
						if (null == isset($arr[$command])) {
							$ans .= $command." ";
						}else{
							$ans .= $arr[$command]." ";
						}
					}
					return 	$ans;
				}else{
					return $ethipic->format($this->date_formats[$format][$lang]);
				}
				break;
			default:
				break;
		}
	}

}
