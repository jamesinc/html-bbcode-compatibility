<?php if (!defined('APPLICATION')) exit();
$PluginInfo['HtmlBBCodeCompatibility'] = array(
    'Name' => 'HTML + BBCode Compatability',
    'Description' => 'Based on the IPBFormat plugin, but treats all BBCode markup as allowing HTML also.',
    'Version' => '1.3',
    'RequiredApplications' => ['Vanilla' => '>=2.3'],
    'MobileFriendly' => TRUE,
    'HasLocale' => FALSE,
    'Author' => "James Ducker",
    'AuthorEmail' => 'james.ducker@gmail.com',
    'AuthorUrl' => 'https://github.com/jamesinc',
	'License' => 'GPL-3.0'
);

class HtmlBBCodeCompatibilityPlugin extends Gdn_Plugin {

    public function gdn_pluginManager_afterStart_handler( ) {
        $tmp = Gdn::factoryOverwrite( true );

        // This overrides the default BBCode formatter with this plugin
        Gdn::FactoryInstall('BBCodeFormatter', 'HtmlBBCodeCompatibilityPlugin', __FILE__, Gdn::FactorySingleton);
        Gdn::FactoryInstall('ActualBBCodeFormatter', 'BBCode', null, Gdn::FactorySingleton);

        Gdn::factoryOverwrite( $tmp );
        unset( $tmp );

    }

    public function format( $mixed ) {

        // Get a reference to the default BBCode formatter
        $BBCodeFormatter = Gdn::factory('ActualBBCodeFormatter');

        if ( is_object($BBCodeFormatter) ) {
            // Ignore HTML tags
            $BBCodeFormatter->nbbc()->setEscapeContent( false );
            // DO handle line breaks
            $BBCodeFormatter->nbbc()->setIgnoreNewlines( false );
            // Parse BBCode
            $mixed = $BBCodeFormatter->format( $mixed );
        }

        return $mixed;

    }
}

?>