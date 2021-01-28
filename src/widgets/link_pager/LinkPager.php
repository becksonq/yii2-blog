<?php


namespace becksonq\blog\widgets\link_pager;

use yii\bootstrap4\Html;
use yii\helpers\ArrayHelper;

/**
 * Class LinkPager
 * @package becksonq\blog\widgets\link_pager
 */
class LinkPager extends \yii\bootstrap4\LinkPager
{
    /**
     * Executes the widget.
     * This overrides the parent implementation by displaying the generated page buttons.
     */
    public function run()
    {
        if ($this->registerLinkTags) {
            $this->registerLinkTags();
        }
        $options = $this->options;
        $tag = ArrayHelper::remove($options, 'tag', 'nav');
        $html = Html::beginTag($tag, $options);
        $html .= $this->renderPrevButton();
        $html .= $this->renderPageButtons();
        $html .= $this->renderNextButton();
        $html .= Html::endTag($tag);

        return $html;
    }

    /**
     * @return string
     */
    protected function renderPrevButton()
    {
        $pageCount = $this->pagination->getPageCount();
        $buttons = [];
        $currentPage = $this->pagination->getPage();

        // prev page
        if ($this->prevPageLabel !== false) {
            if (($page = $currentPage - 1) < 0) {
                $page = 0;
            }
            $buttons[] = $this->renderPrevNextButton(
                '<i class="czi-arrow-left mr-2"></i>' . \Yii::t('app', 'Назад'),
                $page,
                $this->prevPageCssClass,
                $currentPage <= 0,
                false
            );
        }

        $options = $this->listOptions;
        $tag = ArrayHelper::remove($options, 'tag', 'ul');
        return $pageCount < 2 ? '' : Html::tag($tag, implode("\n", $buttons), $options);
    }

    protected function renderNextButton()
    {
        $pageCount = $this->pagination->getPageCount();
        $buttons = [];
        $currentPage = $this->pagination->getPage();

        // next page
        if ($this->nextPageLabel !== false) {
            if (($page = $currentPage + 1) >= $pageCount - 1) {
                $page = $pageCount - 1;
            }
            $buttons[] = $this->renderPrevNextButton(
                \Yii::t('app', 'Вперед') . '<i class="czi-arrow-right ml-2"></i>',
                $page,
                $this->nextPageCssClass,
                $currentPage >= $pageCount - 1,
                false
            );
        }

        $options = $this->listOptions;
        $tag = ArrayHelper::remove($options, 'tag', 'ul');
        return $pageCount < 2 ? '' : Html::tag($tag, implode("\n", $buttons), $options);
    }

    protected function renderPrevNextButton($label, $page, $class, $disabled, $active)
    {
        $options = $this->linkContainerOptions;
        $linkWrapTag = ArrayHelper::remove($options, 'tag', 'li');
        Html::addCssClass($options, empty($class) ? $this->pageCssClass : $class);

        $linkOptions = $this->linkOptions;
        Html::addCssClass($linkOptions, 'bg-transparent border-0');
        $linkOptions['data-page'] = $page;

        if ($active) {
            Html::addCssClass($options, $this->activePageCssClass);
        }
        if ($disabled) {
            Html::addCssClass($options, $this->disabledPageCssClass);
            $disabledItemOptions = $this->disabledListItemSubTagOptions;
            $linkOptions = ArrayHelper::merge($linkOptions, $disabledItemOptions);
            $linkOptions['tabindex'] = '-1';
        }

        return Html::tag($linkWrapTag, Html::a($label, $this->pagination->createUrl($page), $linkOptions), $options);
    }

    /**
     * Renders the page buttons.
     * @return string the rendering result
     */
    protected function renderPageButtons()
    {
        $pageCount = $this->pagination->getPageCount();
        if ($pageCount < 2 && $this->hideOnSinglePage) {
            return '';
        }

        $buttons = [];
        $currentPage = $this->pagination->getPage();

        // first page
        $firstPageLabel = $this->firstPageLabel === true ? '1' : $this->firstPageLabel;
        if ($firstPageLabel !== false) {
            $buttons[] = $this->renderPageButton(
                $firstPageLabel,
                0,
                $this->firstPageCssClass,
                $currentPage <= 0,
                false
            );
        }

        // for mobile
        $buttons[] = $this->renderMobileButtons($currentPage, $pageCount);

        // internal pages
        list($beginPage, $endPage) = $this->getPageRange();
        for ($i = $beginPage; $i <= $endPage; ++$i) {
            $buttons[] = $this->renderPageButton(
                $i + 1,
                $i,
                'page-item d-none d-sm-block',
                $this->disableCurrentPageButton && $i == $currentPage,
                $i == $currentPage
            );
        }

        // last page
        $lastPageLabel = $this->lastPageLabel === true ? $pageCount : $this->lastPageLabel;
        if ($lastPageLabel !== false) {
            $buttons[] = $this->renderPageButton(
                $lastPageLabel,
                $pageCount - 1,
                $this->lastPageCssClass,
                $currentPage >= $pageCount - 1,
                false
            );
        }

        $options = $this->listOptions;
        $tag = ArrayHelper::remove($options, 'tag', 'ul');
        return Html::tag($tag, implode("\n", $buttons), $options);
    }

    /**
     * @param $page
     * @param $pageCount
     * @return string
     */
    protected function renderMobileButtons($page, $pageCount)
    {
        return Html::tag('li',
            Html::tag('span', $page + 1 . ' / ' . $pageCount, ['class' => 'page-link page-link-static']),
            ['class' => 'page-item d-sm-none']);
    }
}