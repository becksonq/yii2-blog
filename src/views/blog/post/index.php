<?php

/* @var $this yii\web\View
 * @var $dataProvider yii\data\DataProviderInterface
 * @var $category \shop\models\category\Category
 */

use frontend\themes\createx_grocery_store\assets\AppAsset;

$bundle = AppAsset::register($this);

$this->title = 'Blog';
$this->params['breadcrumbs'][] = $this->title;
?>

<main class="sidebar-fixed-enabled" style="padding-top: 5rem;">
    <section class="px-lg-3 pt-4">
        <div class="px-3 pt-2">
            <!-- Page title + breadcrumb-->
            <!-- Content-->
            <div class="container pb-5 mb-2 mb-md-4">
                <!-- Featured posts carousel-->
                <div class="featured-posts-carousel cz-carousel pt-5">
                    <div class="cz-carousel-inner"
                         data-carousel-options="{&quot;items&quot;: 2, &quot;nav&quot;: false, &quot;autoHeight&quot;: true, &quot;responsive&quot;: {&quot;0&quot;:{&quot;items&quot;:1},&quot;750&quot;:{&quot;items&quot;:2, &quot;gutter&quot;: 20},&quot;991&quot;:{&quot;items&quot;:2, &quot;gutter&quot;: 30}}}">
                        <article><a class="blog-entry-thumb mb-3" href="blog-single-sidebar.html"><span
                                        class="blog-entry-meta-label font-size-sm"><i class="czi-time"></i>Sep 10</span><img
                                        src="<?= $bundle->baseUrl ?>/img/blog/featured/01.jpg" alt="Featured post"></a>
                            <div class="d-flex justify-content-between mb-2 pt-1">
                                <h2 class="h5 blog-entry-title mb-0"><a href="blog-single-sidebar.html">Healthy Food -
                                        New Way of Living</a></h2><a
                                        class="blog-entry-meta-link font-size-sm text-nowrap ml-3 pt-1"
                                        href="blog-single-sidebar.html#comments"><i class="czi-message"></i>13</a>
                            </div>
                            <div class="d-flex align-items-center font-size-sm"><a class="blog-entry-meta-link"
                                                                                   href="#">
                                    <div class="blog-entry-author-ava"><img src="img/blog/meta/04.jpg"
                                                                            alt="Olivia Reyes"></div>
                                    Olivia Reyes</a><span class="blog-entry-meta-divider"></span>
                                <div class="font-size-sm text-muted">in <a href='#' class='blog-entry-meta-link'>Lifestyle</a>,
                                    <a href='#' class='blog-entry-meta-link'>Nutrition</a></div>
                            </div>
                        </article>
                        <article><a class="blog-entry-thumb mb-3" href="blog-single-sidebar.html"><span
                                        class="blog-entry-meta-label font-size-sm"><i class="czi-time"></i>Aug 27</span><img
                                        src="<?= $bundle->baseUrl ?>/img/blog/featured/02.jpg" alt="Featured post"></a>
                            <div class="d-flex justify-content-between mb-2 pt-1">
                                <h2 class="h5 blog-entry-title mb-0"><a href="blog-single-sidebar.html">Online Payment
                                        Security Tips for Shoppers</a></h2><a
                                        class="blog-entry-meta-link font-size-sm text-nowrap ml-3 pt-1"
                                        href="blog-single-sidebar.html#comments"><i class="czi-message"></i>9</a>
                            </div>
                            <div class="d-flex align-items-center font-size-sm"><a class="blog-entry-meta-link"
                                                                                   href="#">
                                    <div class="blog-entry-author-ava"><img src="img/blog/meta/05.jpg"
                                                                            alt="Rafael Marquez"></div>
                                    Rafael Marquez</a><span class="blog-entry-meta-divider"></span>
                                <div class="font-size-sm text-muted">in <a href='#' class='blog-entry-meta-link'>Online
                                        shpopping</a></div>
                            </div>
                        </article>
                        <article><a class="blog-entry-thumb mb-3" href="blog-single-sidebar.html"><span
                                        class="blog-entry-meta-label font-size-sm"><i class="czi-time"></i>Aug 16</span><img
                                        src="<?= $bundle->baseUrl ?>/img/blog/featured/03.jpg" alt="Featured post"></a>
                            <div class="d-flex justify-content-between mb-2 pt-1">
                                <h2 class="h5 blog-entry-title mb-0"><a href="blog-single-sidebar.html">We Launched New
                                        Store in San Francisco!</a></h2><a
                                        class="blog-entry-meta-link font-size-sm text-nowrap ml-3 pt-1"
                                        href="blog-single-sidebar.html#comments"><i class="czi-message"></i>23</a>
                            </div>
                            <div class="d-flex align-items-center font-size-sm"><a class="blog-entry-meta-link"
                                                                                   href="#">
                                    <div class="blog-entry-author-ava"><img src="img/blog/meta/03.jpg"
                                                                            alt="Paul Woodred"></div>
                                    Paul Woodred</a><span class="blog-entry-meta-divider"></span>
                                <div class="font-size-sm text-muted">in <a href='#' class='blog-entry-meta-link'>Cartzilla
                                        news</a></div>
                            </div>
                        </article>
                    </div>
                </div>
                <hr class="mt-5">
                <div class="row pt-5 mt-2">
                    <!-- Entries list-->
                    <section class="col-lg-8">
                        <!-- Entry-->
                        <article class="blog-list border-bottom pb-4 mb-5">
                            <div class="left-column">
                                <div class="d-flex align-items-center font-size-sm pb-2 mb-1"><a
                                            class="blog-entry-meta-link" href="#">
                                        <div class="blog-entry-author-ava"><img
                                                    src="<?= $bundle->baseUrl ?>/img/blog/meta/01.jpg"
                                                    alt="Emma Gallaher"></div>
                                        Emma Gallaher</a><span class="blog-entry-meta-divider"></span><a
                                            class="blog-entry-meta-link" href="#">Aug 15</a></div>
                                <h2 class="h5 blog-entry-title"><a href="blog-single-sidebar.html">Global Travel and
                                        Vacations on a Tight Budget</a></h2>
                            </div>
                            <div class="right-column">
                                <div class="d-flex justify-content-between mb-1">
                                    <div class="font-size-sm text-muted pr-2 mb-2">in <a href='#'
                                                                                         class='blog-entry-meta-link'>Travel</a>,
                                        <a href='#' class='blog-entry-meta-link'>Personal finance</a></div>
                                    <div class="font-size-sm mb-2"><a class="blog-entry-meta-link text-nowrap"
                                                                      href="blog-single-sidebar.html#comments"><i
                                                    class="czi-message"></i>8</a></div>
                                </div>
                                <p class="font-size-sm">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                                    eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea com consequat. Duis
                                    aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat
                                    nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui
                                    officia deserunt… <a href='blog-single-sidebar.html'
                                                         class='blog-entry-meta-link font-weight-medium'>[Read more]</a>
                                </p>
                            </div>
                        </article>
                        <!-- Entry-->
                        <article class="blog-list border-bottom pb-4 mb-5">
                            <div class="left-column">
                                <div class="d-flex align-items-center font-size-sm pb-2 mb-1"><a
                                            class="blog-entry-meta-link" href="#">
                                        <div class="blog-entry-author-ava"><img
                                                    src="<?= $bundle->baseUrl ?>/img/blog/meta/02.jpg"
                                                    alt="Cynthia Gomez"></div>
                                        Cynthia Gomez</a><span class="blog-entry-meta-divider"></span><a
                                            class="blog-entry-meta-link" href="#">Jul 23</a></div>
                                <h2 class="h5 blog-entry-title"><a href="blog-single-sidebar.html">Top New Trends in
                                        Suburban High Fashion</a></h2>
                            </div>
                            <div class="right-column"><a class="blog-entry-thumb mb-3"
                                                         href="blog-single-sidebar.html"><img
                                            src="<?= $bundle->baseUrl ?>/img/blog/01.jpg" alt="Post"></a>
                                <div class="d-flex justify-content-between mb-1">
                                    <div class="font-size-sm text-muted pr-2 mb-2">in <a href='#'
                                                                                         class='blog-entry-meta-link'>Shopping</a>,
                                        <a href='#' class='blog-entry-meta-link'>Fashion</a></div>
                                    <div class="font-size-sm mb-2"><a class="blog-entry-meta-link text-nowrap"
                                                                      href="blog-single-sidebar.html#comments"><i
                                                    class="czi-message"></i>19</a></div>
                                </div>
                                <p class="font-size-sm">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                                    eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                    quis nostrud exercitation… <a href='blog-single-sidebar.html'
                                                                  class='blog-entry-meta-link font-weight-medium'>[Read
                                        more]</a></p>
                            </div>
                        </article>
                        <!-- Entry-->
                        <article class="blog-list border-bottom pb-4 mb-5">
                            <div class="left-column">
                                <div class="d-flex align-items-center font-size-sm pb-2 mb-1"><a
                                            class="blog-entry-meta-link" href="#">
                                        <div class="blog-entry-author-ava"><img
                                                    src="<?= $bundle->baseUrl ?>/img/blog/meta/03.jpg"
                                                    alt="Paul Woodred"></div>
                                        Paul Woodred</a><span class="blog-entry-meta-divider"></span><a
                                            class="blog-entry-meta-link" href="#">Jul 6</a></div>
                                <h2 class="h5 blog-entry-title"><a href="blog-single-sidebar.html">Shopping Tips. Places
                                        Where to Buy Cheap</a></h2>
                            </div>
                            <div class="right-column"><a class="blog-entry-thumb mb-3"
                                                         href="blog-single-sidebar.html"><img
                                            src="<?= $bundle->baseUrl ?>/img/blog/02.jpg" alt="Post"></a>
                                <div class="d-flex justify-content-between mb-1">
                                    <div class="font-size-sm text-muted pr-2 mb-2">in <a href='#'
                                                                                         class='blog-entry-meta-link'>Shopping</a>,
                                        <a href='#' class='blog-entry-meta-link'>Personal finance</a></div>
                                    <div class="font-size-sm mb-2"><a class="blog-entry-meta-link text-nowrap"
                                                                      href="blog-single-sidebar.html#comments"><i
                                                    class="czi-message"></i>15</a></div>
                                </div>
                                <p class="font-size-sm">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                                    eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                    quis nostrud exercitation… <a href='blog-single-sidebar.html'
                                                                  class='blog-entry-meta-link font-weight-medium'>[Read
                                        more]</a></p>
                            </div>
                        </article>
                        <!-- Entry-->
                        <article class="blog-list border-bottom pb-4 mb-4">
                            <div class="left-column">
                                <div class="d-flex align-items-center font-size-sm pb-2 mb-1"><a
                                            class="blog-entry-meta-link" href="#">
                                        <div class="blog-entry-author-ava"><img
                                                    src="<?= $bundle->baseUrl ?>/img/blog/meta/04.jpg"
                                                    alt="Olivia Reyes"></div>
                                        Olivia Reyes</a><span class="blog-entry-meta-divider"></span><a
                                            class="blog-entry-meta-link" href="#">Jun 12</a></div>
                                <h2 class="h5 blog-entry-title"><a href="blog-single-sidebar.html">Google Pay is Now
                                        Available in All Outlets</a></h2>
                            </div>
                            <div class="right-column">
                                <div class="d-flex justify-content-between mb-1">
                                    <div class="font-size-sm text-muted pr-2 mb-2">in <a href='#'
                                                                                         class='blog-entry-meta-link'>Cartzilla
                                            news</a></div>
                                    <div class="font-size-sm mb-2"><a class="blog-entry-meta-link text-nowrap"
                                                                      href="blog-single-sidebar.html#comments"><i
                                                    class="czi-message"></i>7</a></div>
                                </div>
                                <p class="font-size-sm">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                                    eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea com consequat. Duis
                                    aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat
                                    nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui
                                    officia deserunt… <a href='blog-single-sidebar.html'
                                                         class='blog-entry-meta-link font-weight-medium'>[Read more]</a>
                                </p>
                            </div>
                        </article>
                        <!-- Entry-->
                        <article class="blog-list border-bottom pb-4 mb-5">
                            <div class="left-column">
                                <div class="d-flex align-items-center font-size-sm pb-2 mb-1"><a
                                            class="blog-entry-meta-link" href="#">
                                        <div class="blog-entry-author-ava"><img
                                                    src="<?= $bundle->baseUrl ?>/img/blog/meta/05.jpg"
                                                    alt="Rafael Marquez"></div>
                                        Rafael Marquez</a><span class="blog-entry-meta-divider"></span><a
                                            class="blog-entry-meta-link" href="#">May 29</a></div>
                                <h2 class="h5 blog-entry-title"><a href="blog-single-sidebar.html">We Launched Regular
                                        Drone Delivery in California. Watch Demo Video</a></h2>
                            </div>
                            <div class="right-column cz-gallery"><a
                                        class="blog-entry-thumb gallery-item video-item mb-3"
                                        href="https://www.youtube.com/watch?v=TedKIlo0c04"><span
                                            class="blog-entry-meta-label font-size-sm"><i class="czi-video"></i><span
                                                class="font-size-ms">Watch video</span></span><img src="<?= $bundle->baseUrl ?>/img/blog/03.jpg"
                                                                                                   alt="Post"></a>
                                <div class="d-flex justify-content-between mb-1">
                                    <div class="font-size-sm text-muted pr-2 mb-2">in <a href='#'
                                                                                         class='blog-entry-meta-link'>Cartzilla
                                            news</a></div>
                                    <div class="font-size-sm mb-2"><a class="blog-entry-meta-link text-nowrap"
                                                                      href="blog-single-sidebar.html#comments"><i
                                                    class="czi-message"></i>31</a></div>
                                </div>
                                <p class="font-size-sm">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                                    eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                    quis nostrud exercitation… <a href='blog-single-sidebar.html'
                                                                  class='blog-entry-meta-link font-weight-medium'>[Read
                                        more]</a></p>
                            </div>
                        </article>
                        <!-- Pagination-->
                        <nav class="d-flex justify-content-between pt-2" aria-label="Page navigation">
                            <ul class="pagination">
                                <li class="page-item"><a class="page-link" href="#"><i class="czi-arrow-left mr-2"></i>Prev</a>
                                </li>
                            </ul>
                            <ul class="pagination">
                                <li class="page-item d-sm-none"><span class="page-link page-link-static">1 / 5</span>
                                </li>
                                <li class="page-item active d-none d-sm-block" aria-current="page"><span
                                            class="page-link">1<span class="sr-only">(current)</span></span></li>
                                <li class="page-item d-none d-sm-block"><a class="page-link" href="#">2</a></li>
                                <li class="page-item d-none d-sm-block"><a class="page-link" href="#">3</a></li>
                                <li class="page-item d-none d-sm-block"><a class="page-link" href="#">4</a></li>
                                <li class="page-item d-none d-sm-block"><a class="page-link" href="#">5</a></li>
                            </ul>
                            <ul class="pagination">
                                <li class="page-item"><a class="page-link" href="#" aria-label="Next">Next<i
                                                class="czi-arrow-right ml-2"></i></a></li>
                            </ul>
                        </nav>
                    </section>
                    <aside class="col-lg-4">
                        <!-- Sidebar-->
                        <div class="cz-sidebar border-left ml-lg-auto" id="blog-sidebar">
                            <div class="cz-sidebar-header box-shadow-sm">
                                <button class="close ml-auto" type="button" data-dismiss="sidebar" aria-label="Close">
                                    <span class="d-inline-block font-size-xs font-weight-normal align-middle">Close sidebar</span><span
                                            class="d-inline-block align-middle ml-2" aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="cz-sidebar-body py-lg-1" data-simplebar data-simplebar-auto-hide="true">
                                <!-- Categories-->
                                <div class="widget widget-links mb-grid-gutter pb-grid-gutter border-bottom">
                                    <h3 class="widget-title">Blog categories</h3>
                                    <ul class="widget-list">
                                        <li class="widget-list-item"><a
                                                    class="widget-list-link d-flex justify-content-between align-items-center"
                                                    href="#"><span>Online shopping</span><span
                                                        class="font-size-xs text-muted ml-3">18</span></a></li>
                                        <li class="widget-list-item"><a
                                                    class="widget-list-link d-flex justify-content-between align-items-center"
                                                    href="#"><span>Fashion</span><span
                                                        class="font-size-xs text-muted ml-3">25</span></a></li>
                                        <li class="widget-list-item"><a
                                                    class="widget-list-link d-flex justify-content-between align-items-center"
                                                    href="#"><span>Personal finance</span><span
                                                        class="font-size-xs text-muted ml-3">13</span></a></li>
                                        <li class="widget-list-item"><a
                                                    class="widget-list-link d-flex justify-content-between align-items-center"
                                                    href="#"><span>Travel &amp; vacation</span><span
                                                        class="font-size-xs text-muted ml-3">7</span></a></li>
                                        <li class="widget-list-item"><a
                                                    class="widget-list-link d-flex justify-content-between align-items-center"
                                                    href="#"><span>Lifestyle</span><span
                                                        class="font-size-xs text-muted ml-3">34</span></a></li>
                                        <li class="widget-list-item"><a
                                                    class="widget-list-link d-flex justify-content-between align-items-center"
                                                    href="#"><span>Technology</span><span
                                                        class="font-size-xs text-muted ml-3">6</span></a></li>
                                    </ul>
                                </div>
                                <!-- Trending posts-->
                                <div class="widget mb-grid-gutter pb-grid-gutter border-bottom">
                                    <h3 class="widget-title">Trending posts</h3>
                                    <div class="media align-items-center mb-3"><a href="blog-single.html"><img
                                                    class="rounded" src="<?= $bundle->baseUrl ?>/img/blog/widget/01.jpg"
                                                    width="64" alt="Post image"></a>
                                        <div class="media-body pl-3">
                                            <h6 class="blog-entry-title font-size-sm mb-0"><a href="blog-single.html">Retro
                                                    Cameras are Trending. Why so Popular?</a></h6><span
                                                    class="font-size-ms text-muted">by <a href='#'
                                                                                          class='blog-entry-meta-link'>Andy Williams</a></span>
                                        </div>
                                    </div>
                                    <div class="media align-items-center mb-3"><a href="blog-single.html"><img
                                                    class="rounded" src="<?= $bundle->baseUrl ?>/img/blog/widget/02.jpg"
                                                    width="64" alt="Post image"></a>
                                        <div class="media-body pl-3">
                                            <h6 class="blog-entry-title font-size-sm mb-0"><a href="blog-single.html">New
                                                    Trends in Suburban Fashion</a></h6><span
                                                    class="font-size-ms text-muted">by <a href='#'
                                                                                          class='blog-entry-meta-link'>Susan Mayer</a></span>
                                        </div>
                                    </div>
                                    <div class="media align-items-center"><a href="blog-single.html"><img
                                                    class="rounded" src="<?= $bundle->baseUrl ?>/img/blog/widget/03.jpg"
                                                    width="64" alt="Post image"></a>
                                        <div class="media-body pl-3">
                                            <h6 class="blog-entry-title font-size-sm mb-0"><a href="blog-single.html">Augmented
                                                    Reality - Game Changing Technology</a></h6><span
                                                    class="font-size-ms text-muted">by <a href='#'
                                                                                          class='blog-entry-meta-link'>John Doe</a></span>
                                        </div>
                                    </div>
                                </div>
                                <!-- Popular tags-->
                                <div class="widget mb-grid-gutter">
                                    <h3 class="widget-title">Popular tags</h3><a class="btn-tag mr-2 mb-2" href="#">#fashion</a><a
                                            class="btn-tag mr-2 mb-2" href="#">#gadgets</a><a class="btn-tag mr-2 mb-2"
                                                                                              href="#">#online
                                        shopping</a><a class="btn-tag mr-2 mb-2" href="#">#top brands</a><a
                                            class="btn-tag mr-2 mb-2" href="#">#travel</a><a class="btn-tag mr-2 mb-2"
                                                                                             href="#">#cartzilla
                                        news</a><a class="btn-tag mr-2 mb-2" href="#">#personal finance</a><a
                                            class="btn-tag mr-2 mb-2" href="#">#tips &amp; tricks</a>
                                </div>
                                <!-- Promo banner-->
                                <div class="bg-size-cover bg-position-center rounded-lg py-5"
                                     style="background-image: url(img/blog/banner-bg.jpg);">
                                    <div class="py-5 px-4 text-center">
                                        <h5 class="mb-2">Your Add Banner Here</h5>
                                        <p class="font-size-sm text-muted">Hurry up to reserve your spot</p><a
                                                class="btn btn-primary btn-shadow btn-sm" href="#">Contact us</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </aside>
                </div>
            </div>
            <? /*= $this->render('_list', [
                'dataProvider' => $dataProvider
            ]) */ ?>
            <div class="pb-4"></div>
        </div>
    </section>
    <?= $this->render('@frontend/themes/createx_grocery_store/views/layouts/_footer', ['bundle' => $bundle]) ?>
</main>
