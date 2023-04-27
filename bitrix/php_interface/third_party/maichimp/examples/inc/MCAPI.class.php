<?php

class MCAPI {
    var $version = "1.3";
    var $errorMessage;
    var $errorCode;
    
    /**
     * Cache the information on the API location on the server
     */
    var $apiUrl;
    
    /**
     * Default to a 300 second timeout on server calls
     */
    var $timeout = 300; 
    
    /**
     * Default to a 8K chunk size
     */
    var $chunkSize = 8192;
    
    /**
     * Cache the user api_key so we only have to log in once per client instantiation
     */
    var $api_key;

    /**
     * Cache the user api_key so we only have to log in once per client instantiation
     */
    var $secure = false;
    
    /**
     * Connect to the MailChimp API for a given list.
     * 
     * @param string $apikey Your MailChimp apikey
     * @param string $secure Whether or not this should use a secure connection
     */
    function MCAPI($apikey, $secure=false) {
        $this->secure = $secure;
        $this->apiUrl = parse_url("http://api.mailchimp.com/" . $this->version . "/?output=php");
        $this->api_key = $apikey;
    }
    function setTimeout($seconds){
        if (is_int($seconds)){
            $this->timeout = $seconds;
            return true;
        }
    }
    function getTimeout(){
        return $this->timeout;
    }
    function useSecure($val){
        if ($val===true){
            $this->secure = true;
        } else {
            $this->secure = false;
        }
    }
    
    /**
     * Unschedule a campaign that is scheduled to be sent in the future
     *
     * @section Campaign  Related
     * @example mcapi_campaignUnschedule.php
     * @example xml-rpc_campaignUnschedule.php
     *
     * @param string $cid the id of the campaign to unschedule
     * @return boolean true on success
     */
    function campaignUnschedule($cid) {
        $params = array();
        $params["cid"] = $cid;
        return $this->callServer("campaignUnschedule", $params);
    }

    /**
     * Schedule a campaign to be sent in the future
     *
     * @section Campaign  Related
     * @example mcapi_campaignSchedule.php
     * @example xml-rpc_campaignSchedule.php
     *
     * @param string $cid the id of the campaign to schedule
     * @param string $schedule_time the time to schedule the campaign. For A/B Split "schedule" campaigns, the time for Group A - in YYYY-MM-DD HH:II:SS format in <strong>GMT</strong>
     * @param string $schedule_time_b optional -the time to schedule Group B of an A/B Split "schedule" campaign - in YYYY-MM-DD HH:II:SS format in <strong>GMT</strong>
     * @return boolean true on success
     */
    function campaignSchedule($cid, $schedule_time, $schedule_time_b=NULL) {
        $params = array();
        $params["cid"] = $cid;
        $params["schedule_time"] = $schedule_time;
        $params["schedule_time_b"] = $schedule_time_b;
        return $this->callServer("campaignSchedule", $params);
    }

    /**
     * Resume sending an AutoResponder or RSS campaign
     *
     * @section Campaign  Related
     *
     * @param string $cid the id of the campaign to pause
     * @return boolean true on success
     */
    function campaignResume($cid) {
        $params = array();
        $params["cid"] = $cid;
        return $this->callServer("campaignResume", $params);
    }

    /**
     * Pause an AutoResponder orRSS campaign from sending
     *
     * @section Campaign  Related
     *
     * @param string $cid the id of the campaign to pause
     * @return boolean true on success
     */
    function campaignPause($cid) {
        $params = array();
        $params["cid"] = $cid;
        return $this->callServer("campaignPause", $params);
    }

    /**
     * Send a given campaign immediately. For RSS campaigns, this will "start" them.
     *
     * @section Campaign  Related
     *
     * @example mcapi_campaignSendNow.php
     * @example xml-rpc_campaignSendNow.php
     *
     * @param string $cid the id of the campaign to send
     * @return boolean true on success
     */
    function campaignSendNow($cid) {
        $params = array();
        $params["cid"] = $cid;
        return $this->callServer("campaignSendNow", $params);
    }

    /**
     * Send a test of this campaign to the provided email address
     *
     * @section Campaign  Related
     *
     * @example mcapi_campaignSendTest.php
     * @example xml-rpc_campaignSendTest.php
     *
     * @param string $cid the id of the campaign to test
     * @param array $test_emails an array of email address to receive the test message
     * @param string $send_type optional by default (null) both formats are sent - "html" or "text" send just that format
     * @return boolean true on success
     */
    function campaignSendTest($cid, $test_emails=array (
), $send_type=NULL) {
        $params = array();
        $params["cid"] = $cid;
        $params["test_emails"] = $test_emails;
        $params["send_type"] = $send_type;
        return $this->callServer("campaignSendTest", $params);
    }

    /**
     * Allows one to test their segmentation rules before creating a campaign using them
     *
     * @section Campaign  Related
     * @example mcapi_campaignSegmentTest.php
     * @example xml-rpc_campaignSegmentTest.php
     *
     * @param string $list_id the list to test segmentation on - get lists using lists()
     * @param array $options with 2 keys:  
             string "match" controls whether to use AND or OR when applying your options - expects "<strong>any</strong>" (for OR) or "<strong>all</strong>" (for AND)
             array "conditions" - up to 10 different criteria to apply while segmenting. Each criteria row must contain 3 keys - "<strong>field</strong>", "<strong>op</strong>", and "<strong>value</strong>" - and possibly a fourth, "<strong>extra</strong>", based on these definitions:
    
            Field = "<strong>date</strong>" : Select based on signup date
                Valid Op(eration): <strong>eq</strong> (is) / <strong>gt</strong> (after) / <strong>lt</strong> (before)
                Valid Values: 
                string last_campaign_sent  uses the date of the last campaign sent
                string campaign_id - uses the send date of the campaign that carriers the Id submitted - see campaigns()
                string YYYY-MM-DD - any date in the form of YYYY-MM-DD - <em>note:</em> anything that appears to start with YYYY will be treated as a date
                          
            Field = "<strong>interests-X</strong>": where X is the Grouping Id from listInterestGroupings()
                Valid Op(erations): <strong>one</strong> / <strong>none</strong> / <strong>all</strong> 
                Valid Values: a comma delimited of interest groups for the list - see listInterestGroupings()
        
            Field = "<strong>aim</strong>"
                Valid Op(erations): <strong>open</strong> / <strong>noopen</strong> / <strong>click</strong> / <strong>noclick</strong>
                Valid Values: "<strong>any</strong>" or a valid AIM-enabled Campaign that has been sent
    
            Field = "<strong>rating</strong>" : allows matching based on list member ratings
                Valid Op(erations):  <strong>eq</strong> (=) / <strong>ne</strong> (!=) / <strong>gt</strong> (&gt;) / <strong>lt</strong> (&lt;)
                Valid Values: a number between 0 and 5
    
            Field = "<strong>ecomm_prod</strong>" or "<strong>ecomm_prod</strong>": allows matching product and category names from purchases
                Valid Op(erations): 
                 <strong>eq</strong> (=) / <strong>ne</strong> (!=) / <strong>gt</strong> (&gt;) / <strong>lt</strong> (&lt;) / <strong>like</strong> (like '%blah%') / <strong>nlike</strong> (not like '%blah%') / <strong>starts</strong> (like 'blah%') / <strong>ends</strong> (like '%blah')
                Valid Values: any string
    
            Field = "<strong>ecomm_spent_one</strong>" or "<strong>ecomm_spent_all</strong>" : allows matching purchase amounts on a single order or all orders
                Valid Op(erations): <strong>gt</strong> (&gt;) / <strong>lt</strong> (&lt;)
                Valid Values: a number
    
            Field = "<strong>ecomm_date</strong>" : allow matching based on order dates
                Valid Op(eration): <strong>eq</strong> (is) / <strong>gt</strong> (after) / <strong>lt</strong> (before)
                Valid Values: 
                string YYYY-MM-DD - any date in the form of YYYY-MM-DD
                
            Field = "<strong>social_gender</strong>" : allows matching against the gender acquired from SocialPro
                Valid Op(eration): <strong>eq</strong> (is) / <strong>ne</strong> (is not)
                Valid Values: male, female
                
            Field = "<strong>social_age</strong>" : allows matching against the age acquired from SocialPro
                Valid Op(erations):  <strong>eq</strong> (=) / <strong>ne</strong> (!=) / <strong>gt</strong> (&gt;) / <strong>lt</strong> (&lt;)
                Valid Values: any number
    
            Field = "<strong>social_influence</strong>" : allows matching against the influence acquired from SocialPro
                Valid Op(erations):  <strong>eq</strong> (=) / <strong>ne</strong> (!=) / <strong>gt</strong> (&gt;) / <strong>lt</strong> (&lt;)
                Valid Values: a number between 0 and 5
    
            Field = "<strong>social_network</strong>" : 
                Valid Op(erations):  <strong>member</strong> (is a member of) / <strong>notmember</strong> (is not a member of)
                Valid Values: twitter, facebook, myspace, linkedin, flickr
    
            Field = "<strong>static_segment</strong>" : 
                Valid Op(eration): <strong>eq</strong> (is in) / <strong>ne</strong> (is not in)
                Valid Values: an int - get from listStaticSegments()
    
            Field = An <strong>Address</strong> Merge Var. Use <strong>Merge0-Merge30</strong> or the <strong>Custom Tag</strong> you've setup for your merge field - see listMergeVars(). Note, Address fields can still be used with the default operations below - this section is broken out solely to highlight the differences in using the geolocation routines.
                Valid Op(erations): <strong>geoin</strong>
                Valid Values: The number of miles an address should be within
                Extra Value: The Zip Code to be used as the center point
        
            Default Field = A Merge Var. Use <strong>Merge0-Merge30</strong> or the <strong>Custom Tag</strong> you've setup for your merge field - see listMergeVars()
                Valid Op(erations): 
                 <strong>eq</strong> (=) / <strong>ne</strong> (!=) / <strong>gt</strong> (&gt;) / <strong>lt</strong> (&lt;) / <strong>like</strong> (like '%blah%') / <strong>nlike</strong> (not like '%blah%') / <strong>starts</strong> (like 'blah%') / <strong>ends</strong> (like '%blah')
                Valid Values: any string
     * @return int total The total number of subscribers matching your segmentation options
     */
    function campaignSegmentTest($list_id, $options) {
        $params = array();
        $params["list_id"] = $list_id;
        $params["options"] = $options;
        return $this->callServer("campaignSegmentTest", $params);
    }

    /**
     * Create a new draft campaign to send. You <strong>can not</strong> have more than 32,000 campaigns in your account.
     *
     * @section Campaign  Related
     * @example mcapi_campaignCreate.php
     * @example xml-rpc_campaignCreate.php
     * @example xml-rpc_campaignCreateABSplit.php
     * @example xml-rpc_campaignCreateRss.php
     *
     * @param string $type the Campaign Type to create - one of "regular", "plaintext", "absplit", "rss", "trans", "auto"
     * @param array $options a hash of the standard options for this campaign :
            string list_id the list to send this campaign to- get lists using lists()
            string subject the subject line for your campaign message
            string from_email the From: email address for your campaign message
            string from_name the From: name for your campaign message (not an email address)
            string to_name the To: name recipients will see (not email address)
            int template_id optional - use this user-created template to generate the HTML content of the campaign (takes precendence over other template options)
            int gallery_template_id optional - use a template from the public gallery to generate the HTML content of the campaign (takes precendence over base template options)
            int base_template_id optional - use this a base/start-from-scratch template to generate the HTML content of the campaign
            int folder_id optional - automatically file the new campaign in the folder_id passed. Get using folders() - note that Campaigns and Autoresponders have separate folder setupsn 
            array tracking optional - set which recipient actions will be tracked, as a struct of boolean values with the following keys: "opens", "html_clicks", and "text_clicks".  By default, opens and HTML clicks will be tracked. Click tracking can not be disabled for Free accounts.
            string title optional - an internal name to use for this campaign.  By default, the campaign subject will be used.
            boolean authenticate optional - set to true to enable SenderID, DomainKeys, and DKIM authentication, defaults to false.
            array analytics optional - if provided, use a struct with "service type" as a key and the "service tag" as a value. For Google, this should be "google"=>"your_google_analytics_key_here". Note that only "google" is currently supported - a Google Analytics tags will be added to all links in the campaign with this string attached. Others may be added in the future
            boolean auto_footer optional Whether or not we should auto-generate the footer for your content. Mostly useful for content from URLs or Imports
            boolean inline_css optional Whether or not css should be automatically inlined when this campaign is sent, defaults to false.
            boolean generate_text optional Whether of not to auto-generate your Text content from the HTML content. Note that this will be ignored if the Text part of the content passed is not empty, defaults to false.
            boolean auto_tweet optional If set, this campaign will be auto-tweeted when it is sent - defaults to false. Note that if a Twitter account isn't linked, this will be silently ignored.
            boolean timewarp optional If set, this campaign must be scheduled 24 hours in advance of sending - default to false. Only valid for "regular" campaigns and "absplit" campaigns that split on schedule_time.
            boolean ecomm360 optional If set, our <a href="http://www.mailchimp.com/blog/ecommerce-tracking-plugin/" target="_blank">Ecommerce360 tracking</a> will be enabled for links in the campaign
    
    * @param array $content the content for this campaign - use a struct with the following keys: 
                string html for pasted HTML content
                string text for the plain-text version
                string url to have us pull in content from a URL. Note, this will override any other content options - for lists with Email Format options, you'll need to turn on generate_text as well
                string archive to send a Base64 encoded archive file for us to import all media from. Note, this will override any other content options - for lists with Email Format options, you'll need to turn on generate_text as well
                string archive_type optional - only necessary for the "archive" option. Supported formats are: zip, tar.gz, tar.bz2, tar, tgz, tbz . If not included, we will default to zip
                
                If you chose a template instead of pasting in your HTML content, then use "html_" followed by the template sections as keys - for example, use a key of "html_MAIN" to fill in the "MAIN" section of a template. Supported template sections include: "html_HEADER", "html_MAIN", "html_SIDECOLUMN", and "html_FOOTER"
    * @param array $segment_opts optional - if you wish to do Segmentation with this campaign this array should contain: see campaignSegmentTest(). It's suggested that you test your options against campa