<?php
/**
 * NGINAD Project
 *
 * @link http://www.nginad.com
 * @copyright Copyright (c) 2013-2016 NginAd Foundation. All Rights Reserved
 * @license GPLv3
 */

namespace buyrtbheaderbidding\parsers\openrtb\parselets\common;
use \Exception;

class ParseCurrency {
	
	public static function execute(&$Logger, \buyrtbheaderbidding\parsers\openrtb\OpenRTBParser &$Parser, \model\openrtb\RtbBidRequest &$RtbBidRequest) {
	
		/*
		 * Only grab the main (first currency)
		 * Default currency in global.php
		 */
		
		if (isset($Parser->json_post["cur"][0])):
		
			$currency = $Parser->json_post["cur"][0];
		
			$RtbBidRequest->cur = array();
			
			foreach ($Parser->json_post["cur"] as $currency):
				
				$RtbBidRequest->cur[] = strtoupper($currency);
			
			endforeach;
			
			if ($RtbBidRequest->cur[0] != $Parser->config['settings']['rtb']['auction_currency']):
			 
				throw new Exception($Parser->expeption_missing_min_bid_request_params . ": cur: system only accepts USD currency at this time");
			 
			endif;
			
		else:
		
			throw new Exception($Parser->expeption_missing_min_bid_request_params . ": at least 1 cur object");
		
		endif;
		
	}
}
