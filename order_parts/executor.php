<?php get_header('profile')?>
<main class="main">
    <section class="page-title-section">
        <div class="container">
            <h1 class="section-title">Поиск исполнителя</h1>
        </div>
    </section>
    <section class="page-content-section">
        <div class="container-wide">
            <div class="page-content">
                <div class="side-menu">
                    <?php get_sidebar('profile')?>
                </div>
                <div class="main-content">
                    <div class="archive-filter">
                        <form>
                            <div class="filter-columns">
                                <div class="filter-column-3">
                                    <div class="filter-row">
                                        <label class="filter-label" for="">Срок выполнения услуги:</label>
                                        <input class="filter-field" type="date">
                                    </div>
                                    <div class="filter-row">
                                        <label class="filter-label" for="">Цена</label>
                                        <div class="filter-range">
                                            <div class="filter-range-column">
                                                <label class="filter-label" for="">от</label>
                                                <input class="filter-field" type="text">
                                            </div>
                                            <div class="filter-range-column">
                                                <label class="filter-label" for="">до</label>
                                                <input class="filter-field" type="text">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="filter-row">
                                        <label class="filter-label" for="">Условия оплаты</label>
                                        <select class="filter-select">
                                            <option value=""></option>
                                            <option value="">Условие оплаты</option>
                                            <option value="">Условие оплаты</option>
                                            <option value="">Условие оплаты</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="filter-column-3">
                                    <div class="filter-row">
                                        <label class="filter-label" for="">Количество завершенных проектов</label>
                                        <input class="filter-field filter-field-count" type="text">
                                    </div>
                                    <div class="filter-row">
                                        <label class="filter-label" for="">Количество выиграных тендеров</label>
                                        <input class="filter-field filter-field-count" type="text">
                                    </div>
                                    <div class="filter-row">
                                        <label class="filter-label" for="">Количество выиграных тендеров</label>
                                        <input class="filter-field filter-field-count" type="text">
                                    </div>
                                </div>
                                <div class="filter-column-3">
                                    <div class="filter-row">
                                        <label class="filter-label" for="">Количество лет на рынке</label>
                                        <div class="filter-range">
                                            <div class="filter-range-column">
                                                <label class="filter-label" for="">от</label>
                                                <input class="filter-field" type="text">
                                            </div>
                                            <div class="filter-range-column">
                                                <label class="filter-label" for="">до</label>
                                                <input class="filter-field" type="text">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="filter-row">
                                        <label class="filter-label" for="">Коэффициент доверия</label>
                                        <input class="filter-field filter-field-count" type="text">
                                    </div>
                                    <div class="filter-row">
                                        <label class="custom-checkbox">
                                            <input type="checkbox">
                                            <div class="custom-checkbox-image2"></div>
                                            <span class="custom-checkbox-text">Отзовы других заказчиков</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="button button-invert"><span>Поиск</span></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<?php get_footer('profile')?>