<?php

class GeocoderModule extends CWebModule
{
	static private $url = "http://maps.google.com/maps/api/geocode/json?sensor=false&address=";
	static private $_mapTypeControl 	= 'false';
	static private $_panControl 		= 'false';
	static private $_zoomControl 		= 'true';
	static private $_zoomControlOptions = array(
		'style' => 'google.maps.ZoomControlStyle.LARGE',
		'position' => 'google.maps.ControlPosition.LEFT_TOP'
	);
	static private $_zoom 				= '7';
	static private $_center 			= '4.631179,-74.07312';
	static private $_mapTypeId 			= 'google.maps.MapTypeId.ROADMAP';
	static private $_targetTagId		= 'map_canvas';
	static private $_markerIcon			= 'http://google-maps-icons.googlecode.com/files/casino.png';
	
	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		$this->setImport(array(
			'Geocoder.models.*',
			'Geocoder.components.*',
		));
	}

	public function beforeControllerAction($controller, $action)
	{
		if(parent::beforeControllerAction($controller, $action))
		{
			// this method is called before any module controller action is performed
			// you may place customized code here
			return true;
		}
		else
			return false;
	}
	
	static public function getLocation($address){
		$url = self::$url.urlencode($address);
	
		$resp_json = self::curl_file_get_contents($url);
		$resp = json_decode($resp_json, true);
	
		if($resp['status']='OK'){
			return $resp['results'][0]['geometry']['location'];
		}else{
			return false;
		}
	}
	
	static public function renderMap($options = array(), $locations = array()){
		self::setOptions($options);
		
		$cs = Yii::app()->getClientScript();
		
		$ltLn = explode(',', self::$_center);
		$script = '
			var locations = [
		';
			$cn = count($locations);
			if($cn > 0){
				for($i=0; $i<$cn; $i++){
					$location =& $locations[$i];
					$script .= '["'.$location['htmlData'].'", '.$location['place']["lat"].', '.$location['place']["lng"].', '.($i+1).'],';
				}
			}else{
				$script .= '["Coljuegos", '.$ltLn[0].', '.$ltLn[1].', 1]';
			}
		$script .=	'
			];
		';
		if($cn == 1){
			$script .= 'var myLatlng = new google.maps.LatLng('.$locations[0]['place']["lat"].', '.$locations[0]['place']["lng"].');';
		}else{
			$script .= 'var myLatlng = new google.maps.LatLng('.$ltLn[0].', '.$ltLn[1].');';
		}
		$script .= '
			var myOptions = {
					mapTypeControl: '. self::$_mapTypeControl .',
					panControl: '. self::$_panControl .',
					zoomControl: '. self::$_zoomControl .',
					zoomControlOptions: {
						style: '. self::$_zoomControlOptions['style'] .',
						position: '. self::$_zoomControlOptions['position'] .'
			},
					zoom: '. self::$_zoom .',
					center: myLatlng,
					mapTypeId: '. self::$_mapTypeId .'
			};
 			    
			var map = new google.maps.Map(document.getElementById("'. self::$_targetTagId .'"), myOptions);
			var infowindow = new google.maps.InfoWindow();
			var marker, i;
			var markers = [];
 			    
			for (i = 0; i < locations.length; i++){
				marker = new google.maps.Marker({
					position: new google.maps.LatLng(locations[i][1], locations[i][2]), 
					map: map,
					icon: "'. self::$_markerIcon .'"
				});
				markers.push(marker);

				google.maps.event.addListener(marker, "click", (function(marker, i) {
					return function() {
						infowindow.setContent(locations[i][0]);
						infowindow.open(map, marker);
					}
				})(marker, i));
			}
			var markerCluster = new MarkerClusterer(map, markers);
 		';
		$cs->registerScript('geo_coder', $script);
	}
	
	static private function curl_file_get_contents($URL){
		$c = curl_init();
		curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($c, CURLOPT_URL, $URL);
		$contents = curl_exec($c);
		curl_close($c);
	
		if ($contents) return $contents;
		else return FALSE;
	}
	
	static private function setOptions( $options ){
		self::$_mapTypeControl 		= isset($options['mapTypeControl']) ? $options['mapTypeControl'] : self::$_mapTypeControl;
		self::$_panControl 			= isset($options['panControl']) ? $options['panControl'] : self::$_panControl;
		self::$_zoomControl 		= isset($options['zoomControl']) ? $options['zoomControl'] : self::$_zoomControl;
		self::$_zoomControlOptions 	= isset($options['zoomControlOptions']) ? $options['zoomControlOptions'] : self::$_zoomControlOptions;
		self::$_zoom 				= isset($options['zoom']) ? $options['zoom'] : self::$_zoom;
		self::$_center 				= isset($options['center']) ? $options['center'] : self::$_center;
		self::$_mapTypeId 			= isset($options['mapTypeId']) ? $options['mapTypeId'] : self::$_mapTypeId;
		self::$_targetTagId			= isset($options['targetTagId']) ? $options['targetTagId'] : self::$_targetTagId;
		self::$_markerIcon			= isset($options['markerIcon']) ? $options['markerIcon'] : self::$_markerIcon;
	}
}
