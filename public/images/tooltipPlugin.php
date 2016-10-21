<?php
/**
 * @package    tooltipPlugin
 *
 * @author     marcin <your@email.com>
 * @copyright  A copyright
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 * @link       http://your.url.com
 */

defined('_JEXEC') or die;

/**
 * TooltipPlugin plugin.
 *
 * @package  tooltipPlugin
 * @since    1.0
 */
class plgContentTooltipPlugin extends JPlugin
{
    /**
     * Application object
     *
     * @var    JApplicationCms
     * @since  1.0
     */
    protected $app;

    /**
     * Database object
     *
     * @var    JDatabaseDriver
     * @since  1.0
     */
    protected $db;

    /**
     * Affects constructor behavior. If true, language files will be loaded automatically.
     *
     * @var    boolean
     * @since  1.0
     */
    protected $autoloadLanguage = true;

    function onContentPrepare($context, &$article, &$params, $limitstart)
    {
        $regex = '/{tip(?:\s+class\s*=\s*"([a-zA-Z\s]+)")?}([^{]*){\/tip}/';

        $matches = null;
        preg_match_all($regex, $article->text, $matches, PREG_SET_ORDER);

        if (is_array($matches)) {

            foreach ($matches as $match) {

                if (strpos($match, 'class') !== false) {

                    $class = $match[1];
                    $article->text = preg_replace($regex, '<span class="tooltip $class"><i>?</i><em>$2</em></span>', $article->text);
                    if ($class == 'sticked') {
                        echo "jest klasa " . $class;
                    }

                } else {
                    $article->text = preg_replace($regex, '<span class="tooltip $1"><i>?</i><em>$2</em></span>', $article->text);
                }

            }
        }

        return true;
    }

}
