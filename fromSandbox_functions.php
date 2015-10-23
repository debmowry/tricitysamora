<?php

define(CALENDAR_ID,"3citysamoraseller@gmail.com");
define(KEY, "AIzaSyBcSX2QJtx4Bf1InL0r5d4ekoMt0WJ6pAs");
define(MAX_RESULTS,15);

add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
}

// Custom Function to Include
function favicon_link() {
    echo '<link rel="Shortcut Icon" type="image/x-icon" href="'.get_bloginfo('stylesheet_directory').'/favicon.ico" />' . "\n";
}

add_action( 'wp_head', 'favicon_link' );

function displayDayCalendar(){
	$today = date("Ymd");
	$tomorrow  = date('Ymd', strtotime('+24 hours'));
	
	$calendar_url = "https://www.google.com/calendar/embed?mode=DAY&amp;dates=".$today."%2F".$tomorrow."&amp;height=600&amp;wkst=1&amp;bgcolor=%23FFFFFF&amp;src=3citysamoraseller%40gmail.com&amp;color=%231B887A&amp;ctz=America%2FChicago;";
	return 	$calendar_url;

}
add_shortcode('displayDayCalendar', 'displayDayCalendar');


$clientLibraryPath = '/home3/staceyr1/public_html/imagineart/google-api-php-client/src';
$oldPath = set_include_path(get_include_path() . PATH_SEPARATOR . $clientLibraryPath);

// use this when debugging
//echo get_include_path();
//error_reporting(E_ALL ^ E_NOTICE);
//ini_set('display_errors', 1);
//echo "<br>";
require 'Google/autoload.php';


function displayListFormat_func(){
 $client = new Google_Client();
 $client->setDeveloperKey(KEY);
  
  $gdataCal = new Google_Service_Calendar($client);
    
 
  $optParams = array(
    'maxResults' => MAX_RESULTS,
    'orderBy' => 'startTime',
    'singleEvents' => TRUE,
    'timeMin' => date('c'),
  );
  $results = $gdataCal->events->listEvents(CALENDAR_ID, $optParams);


        $displayHTML = "";
  if (count($results->getItems()) == 0) {
            $displayHTML .= "No upcoming events found.";
    } //end if count
  else {
    foreach ($results->getItems() as $event) {
      $start = $event->start->dateTime;
      $end = $event->end->dateTime;
      if (empty($start)) 
        $start = $event->start->date;
      if (empty($end)) 
        $end = $event->end->date;

      $start = new DateTime($start);
      $end = new DateTime($end);

            $displayHTML .= "Date: ". date_format($start,'l jS F Y')."<br>";
            $displayHTML .= date_format($start,'H:i')." to ".date_format($start,'H:i')."<br>";
            $displayHTML .= "<a href=\"" .$event->getHtmlLink()."\">";
            $displayHTML .= $event->getSummary(). "</a><br>";
    }
  }//end else echo

return $displayHTML;
}//end of function

add_shortcode('displayListFormat_func', 'displayListFormat_func');

function displayOneDay_func(){
 $client = new Google_Client();
 $client->setDeveloperKey(KEY);
 
  $today = date('c');
  $tomorrow  = date('c', strtotime('+24 hours'));

  $gdataCal = new Google_Service_Calendar($client);
    
 
  $optParams = array(
    'orderBy' => 'startTime',
    'singleEvents' => TRUE,
    'timeMin' => $today,
    'timeMax' => $tomorrow,
  );
  $results = $gdataCal->events->listEvents(CALENDAR_ID, $optParams);
      $displayHTML = "";

  
  if (count($results->getItems()) == 0) {
            $displayHTML .= "No upcoming events found.";
    } //end if count
  else {
    foreach ($results->getItems() as $event) {
      $start = $event->start->dateTime;
      $end = $event->end->dateTime;
      if (empty($start)) 
        $start = $event->start->date;
      if (empty($end)) 
        $end = $event->end->date;

      $start = new DateTime($start);
      $end = new DateTime($end);

            $displayHTML .= "Date: ". date_format($start,'l jS F Y')."<br>";
            $displayHTML .= date_format($start,'H:i')." to ".date_format($start,'H:i')."<br>";
            $displayHTML .= "<a href=\"" .$event->getHtmlLink()."\">";
            $displayHTML .= $event->getSummary(). "</a><br>";
    }
  }//end else echo
return $displayHTML;
}//end of function


add_shortcode('displayOneDay_func', 'displayOneDay_func');

function displayOneWeek_func(){
$client = new Google_Client();
 $client->setDeveloperKey(KEY);
 
  $today = date('c');
  $tomorrow  = date('c', strtotime('+7 days'));

  $gdataCal = new Google_Service_Calendar($client);
    
 
  $optParams = array(
    'orderBy' => 'startTime',
    'singleEvents' => TRUE,
    'timeMin' => $today,
    'timeMax' => $tomorrow,
  );
  $results = $gdataCal->events->listEvents(CALENDAR_ID, $optParams);


  $displayHTML = "";

  if (count($results->getItems()) == 0) {
      $displayHTML .= "No upcoming events found.";
    } //end if count
  else {
    foreach ($results->getItems() as $event) {
      $start = $event->start->dateTime;
      $end = $event->end->dateTime;
      if (empty($start)) 
        $start = $event->start->date;
      if (empty($end)) 
        $end = $event->end->date;

      $start = new DateTime($start);
      $end = new DateTime($end);

      $displayHTML .= "Date: ". date_format($start,'l jS F Y')."<br>";
      $displayHTML .= date_format($start,'H:i')." to ".date_format($start,'H:i')."<br>";
      $displayHTML .= "<a href=\"" .$event->getHtmlLink()."\">";
      $displayHTML .= $event->getSummary(). "</a><br>";
    }
  }//end else echo
return $displayHTML;
}//end of function




add_shortcode('displayOneWeek_func', 'displayOneWeek_func');

