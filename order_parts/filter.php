<?php get_header('profile')?>
<main class="main">
    <section class="page-title-section">
        <div class="container">
            <h1 class="section-title">Фильтр</h1>
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
                                <div class="filter-column-2">
                                    <div class="filter-row">
                                        <label class="filter-label" for="">Вид услуги</label>
                                        <select class="filter-select">
                                            <option value=""></option>
                                            <option value="">Вид услуги</option>
                                            <option value="">Вид услуги</option>
                                            <option value="">Вид услуги</option>
                                        </select>
                                    </div>
                                    <div class="filter-row">
                                        <label class="filter-label" for="">Адрес</label>
                                        <select class="filter-select">
                                            <option value=""></option>
                                            <option value="">м.Запорожье ул. Леваневского, 4</option>
                                            <option value="">м.Запорожье ул. Леваневского, 4</option>
                                            <option value="">м.Запорожье ул. Леваневского, 4</option>
                                        </select>
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
                                </div>
                                <div class="filter-column-2">
                                    <div class="filter-row">
                                        <label class="filter-label" for="">Стадия выполнения</label>
                                        <select class="filter-select">
                                            <option value=""></option>
                                            <option value="">Выполнено</option>
                                            <option value="">Выполнено</option>
                                            <option value="">Выполнено</option>
                                        </select>
                                    </div>
                                    <div class="filter-row">
                                        <label class="filter-label" for="">Срок выполнения услуги:</label>
                                        <input class="filter-field" type="date">
                                    </div>
                                </div>
                            </div>
                            <div class="filter-row-wide">
                                <label class="custom-checkbox">
                                    <span class="custom-checkbox-text">Договоры из архива</span>
                                    <input type="checkbox">
                                    <div class="custom-checkbox-image2"></div>
                                </label>
                                <label class="custom-checkbox">
                                    <span class="custom-checkbox-text">Черновики</span>
                                    <input type="checkbox">
                                    <div class="custom-checkbox-image2"></div>
                                </label>
                                <label class="custom-checkbox">
                                    <span class="custom-checkbox-text">Помеченные договоры</span>
                                    <input type="checkbox">
                                    <div class="custom-checkbox-image2"></div>
                                </label>
                            </div>
                            <button type="submit" class="button button-invert"><span>Применить фильтр</span></button>
                        </form>
                    </div>
                    <div class="archive-content">
                        <div class="content-table">
                            <table>
                                <tr>
                                    <th>N<br> договора</th>
                                    <th>Вид работы</th>
                                    <th>Стадии</th>
                                    <th>Адрес объекта</th>
                                    <th>Дата окончания<br> работ</th>
                                </tr>
                                <tr>
                                    <td>1211</td>
                                    <td>ТД по установлению границ участка в натуре</td>
                                    <td>выполнено</td>
                                    <td>м.Запорожье ул. Леваневского, 4</td>
                                    <td>12.01.2017</td>
                                </tr>
                                <tr>
                                    <td>1211</td>
                                    <td>ТД по установлению границ участка в натуре</td>
                                    <td>выполнено</td>
                                    <td>м.Запорожье ул. Леваневского, 4</td>
                                    <td>12.01.2017</td>
                                </tr>
                                <tr>
                                    <td>1211</td>
                                    <td>ТД по установлению границ участка в натуре</td>
                                    <td>выполнено</td>
                                    <td>м.Запорожье ул. Леваневского, 4</td>
                                    <td>12.01.2017</td>
                                </tr>
                                <tr>
                                    <td>1211</td>
                                    <td>ТД по установлению границ участка в натуре</td>
                                    <td>выполнено</td>
                                    <td>м.Запорожье ул. Леваневского, 4</td>
                                    <td>12.01.2017</td>
                                </tr>
                                <tr>
                                    <td>1211</td>
                                    <td>ТД по установлению границ участка в натуре</td>
                                    <td>выполнено</td>
                                    <td>м.Запорожье ул. Леваневского, 4</td>
                                    <td>12.01.2017</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<?php get_footer('profile')?>