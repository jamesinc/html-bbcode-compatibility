<?php if (!defined('APPLICATION')) exit();
$PluginInfo['HtmlBBCodeCompatibility'] = array(
    'Name' => 'HTML + BBCode Compatability',
    'Description' => 'Based on the IPBFormat plugin, but treats all BBCode markup as allowing HTML also.',
    'Version' => '1.3',
    'RequiredApplications' => ['Vanilla' => '>=3.2'],
    'MobileFriendly' => TRUE,
    'HasLocale' => FALSE,
    'Author' => "James Ducker",
    'AuthorEmail' => 'james.ducker@gmail.com',
    'AuthorUrl' => 'https://github.com/jamesinc/html-bbcode-compatibility',
	'License' => 'GPL-3.0'
);

class HtmlBBCodeCompatibilityPlugin extends Gdn_Plugin {

    public function gdn_pluginManager_afterStart_handler( ) {
        include(__DIR__.'/HtmlBBCodeFormat.php');

        Gdn::formatService()
            ->registerFormat(
                Vanilla\Formatting\Formats\BBCodeFormat::FORMAT_KEY,
                Gdn::getContainer()->get(Vanilla\Formatting\Formats\HtmlBBCodeFormat::class)
            );
    }

}

?>
