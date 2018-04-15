<?php

namespace Colorcube\Shredder;

use TYPO3\CMS\Frontend\Controller\TypoScriptFrontendController;

/**
 * Magic
 *
 * @author Rene Fritz <r.fritz@colorcube.de>
 */
class Shredder
{
    /**
     * Hook: contentPostProc-output
     *
     * @param $params
     */
    public function contentPostProcess(&$params)
    {
        /** @var TypoScriptFrontendController $feobj */
        $feobj = &$params['pObj'];

        if (isset($feobj->tmpl->setup['shredder']) && !$feobj->tmpl->setup['shredder']) {
            return;
        }

        $feobj->set_no_cache('just for fun');

        $feobj->content = $this->magic($feobj->content);
    }

    /**
     * stdWrap.postUserFunc
     *
     * @param string          When custom methods are used for data processing (like in stdWrap functions), the $content variable will hold the value to be processed. When methods are meant to just return some generated content (like in USER and USER_INT objects), this variable is empty.
     * @param array           TypoScript properties passed to this method.
     * @return        string
     */
    public function postUserFunc($content, $conf = [])
    {
        $GLOBALS['TSFE']->set_no_cache('just for fun');

        return $this->magic($content);
    }

    protected function magic($content)
    {
        $tagList = ['img', 'p', 'span', 'div', 'h1', 'h2', 'h3', 'h4', 'h5', 'table'];

        foreach ($tagList as $tag) {

            $htmlCode = preg_split('/<' . $tag . '/i', $content);

            if (count($htmlCode) > 1) {
                foreach ($htmlCode as $key => $value) {
                    if ($key) {
                        $htmlCode[$key] = '<' . $tag . ' style="' . $this->getStyle($tag) . '"' . $value;
                    }
                }
            }

            $content = implode('', $htmlCode);
        }

        return $content;
    }

    private function getStyle($tag)
    {
        switch ($tag) {
            case 'img':
                return 'position:absolute; top:' . rand(1, 90) . '%; left:' . rand(1, 90) . '%; width:' . rand(300, 800) . 'px; height:' . rand(150, 600) . 'px;';
                break;
            case 'p':
                return 'position:absolute; top:' . rand(1, 300) . 'px; left:' . rand(-30, 900) . 'px; width:' . rand(100, 500) . 'px; font-size:' . rand(8, 60) . 'px;';
                break;
            case 'div':
                return 'position: relative;	display: inline-block; margin-top:' . rand(-200, 10) . 'px; min-width:20rem; min-height:10rem; ';
            case 'span':
                return 'display:inline-block; margin-top:' . rand(-200, 500) . 'px; margin-left:' . rand(-20, 50) . 'px; margin-right:' . rand(-20, 50) . 'px; font-size:' . rand(10, 60) . 'px; overflow:visible; padding:0; min-width:10rem; min-height:2rem;';
                break;
            default:
                return 'margin-top:' . rand(-200, 500) . 'px; margin-left:' . rand(-20, 200) . 'px; margin-right:' . rand(-20, 200) . 'px; width:' . rand(100, 500) . 'px; font-size:' . rand(10, 60) . 'px; overflow:visible; padding:0;';
                break;
        }
    }
}
