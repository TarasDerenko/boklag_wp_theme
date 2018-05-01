<?php get_header('profile')?>
<main class="main">
    <section class="page-title-section">
        <div class="container">
            <h1 class="section-title">Новый заказ</h1>
        </div>
        <?php if(isset($_GET['order']) && $_GET['order'] == 'send'): ?>
            <div class="edit-blok-info">
                <p>
                    Ваш заказ успешно одправлен!
                </p>
            </div>
        <?php elseif (!empty($error_message['new-order'])):?>
            <div class="edit-blok-info">
                <p>
                    <?= $error_message['new-order']; ?>
                </p>
            </div>
        <?php endif;?>
    </section>
    <section class="page-content-section">
        <div class="container-wide">
            <div class="page-content">
                <div class="side-menu">
                    <?php get_sidebar('profile');?>
                </div>
                <div class="main-content">
                    <div class="order-content">
                        <form method="post" enctype="multipart/form-data" id="order-form">
                            <div class="new-order-about">
                                <div class="new-order-type">
                                    <label for="">Вид услуги:</label>
                                    <input type="text" placeholder="Приватизация земельного участка" name="title">
                                </div>
                                <div class="new-order-description">
                                    <label for="">Описание улсуги:</label>
                                    <textarea name="description"></textarea>
                                </div>
                            </div>
                            <div class="new-order-time">
                                <label for="">Срок выполнения услуги:</label>
                                <div class="order-time-row">
                                    <input type="text" name="date_end" id="order-date-end" placeholder="дд/мм/гггг">
                                    <a href="#" class="button button-invert"><span>Интересные варианты</span></a>
                                </div>
                                <div class="order-time-row">
                                    <select>
                                        <option value="">Январь</option>
                                        <option value="">Февраль</option>
                                        <option value="">Март</option>
                                        <option value="">Апрель</option>
                                        <option value="">Май</option>
                                        <option value="">Июнь</option>
                                        <option value="">Июль</option>
                                        <option value="">Август</option>
                                        <option value="">Сентябрь</option>
                                        <option value="">Октябрь</option>
                                        <option value="">Ноябрь</option>
                                        <option value="">Декабрь</option>
                                    </select>
                                </div>
                            </div>
                            <div class="new-order-diagram">
                                <div class="diagram-list">
                                    <div class="diagram-item">
                                        <span class="diagram-day">8 ноября</span>
                                        <div class="diagram-value" style="height: 61px;"></div>
                                        <span class="diagram-cost">1200 грн</span>
                                    </div>
                                    <div class="diagram-item">
                                        <span class="diagram-day">9 ноября</span>
                                        <div class="diagram-value" style="height: 70px;"></div>
                                        <span class="diagram-cost">1400 грн</span>
                                    </div>
                                    <div class="diagram-item">
                                        <span class="diagram-day">10 ноября</span>
                                        <div class="diagram-value blue" style="height: 175px;"></div>
                                        <span class="diagram-cost">3400 грн</span>
                                    </div>
                                    <div class="diagram-item">
                                        <span class="diagram-day">11 ноября</span>
                                        <div class="diagram-value" style="height: 50px;"></div>
                                        <span class="diagram-cost">1100 грн</span>
                                    </div>
                                    <div class="diagram-item">
                                        <span class="diagram-day">12 ноября</span>
                                        <div class="diagram-value red" style="height: 35px;"></div>
                                        <span class="diagram-cost">1010 грн</span>
                                    </div>
                                    <div class="diagram-item">
                                        <span class="diagram-day">13 ноября</span>
                                        <div class="diagram-value" style="height: 151px;"></div>
                                        <span class="diagram-cost">3000 грн</span>
                                    </div>
                                    <div class="diagram-item">
                                        <span class="diagram-day">14 ноября</span>
                                        <div class="diagram-value" style="height: 61px;"></div>
                                        <span class="diagram-cost">1300 грн</span>
                                    </div>
                                    <div class="diagram-item">
                                        <span class="diagram-day">15 ноября</span>
                                        <div class="diagram-value" style="height: 70px;"></div>
                                        <span class="diagram-cost">1500 грн</span>
                                    </div>
                                    <div class="diagram-item">
                                        <span class="diagram-day">16 ноября</span>
                                        <div class="diagram-value" style="height: 125px;"></div>
                                        <span class="diagram-cost">2300 грн</span>
                                    </div>
                                    <div class="diagram-item">
                                        <span class="diagram-day">17 ноября</span>
                                        <div class="diagram-value" style="height: 50px;"></div>
                                        <span class="diagram-cost">11100 грн</span>
                                    </div>
                                    <div class="diagram-item">
                                        <span class="diagram-day">18 ноября</span>
                                        <div class="diagram-value" style="height: 104px;"></div>
                                        <span class="diagram-cost">2000 грн</span>
                                    </div>
                                </div>
                            </div>
                            <div class="new-order-location">
                                <div class="order-location-form">
                                    <div class="location-form-row">
                                        <label for="">Область</label>
                                        <input type="text" name="region">
                                    </div>
                                    <div class="location-form-row">
                                        <label for="">Населенный пункт:</label>
                                        <input type="text" name="settlement" disabled>
                                    </div>
                                    <div class="location-form-row">
                                        <div class="location-street-house">
                                            <div class="location-street">
                                                <label for="">Улица:</label>
                                                <input type="text" name="street" disabled>
                                            </div>
                                            <div class="location-house">
                                                <label for="">Дом:</label>
                                                <input type="text" name="house" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="location-form-row">
                                        <label for="">Площадь кв.м.:</label>
                                        <input type="text" name="area">
                                    </div>
                                    <div class="location-form-row">
                                        <label for="">Местоположение:</label>
                                        <select name="location">
                                            <option value="1">Киев</option>
                                            <option value="2">Винница</option>
                                            <option value="3">Львов</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="order-location-map">
                                    <div class="location-map" id="map"></div>
                                    <input class="location-map-input" type="text">
                                    <input type="hidden" id="map-lat" name="lat" value="0">
                                    <input type="hidden" id="map-lng" name="lng" value="0">
                                    <input type="hidden" id="map-rang" name="rang" value="0">
                                    <input type="hidden" id="map-lat-1" value="0">
                                    <input type="hidden" id="map-lat-2" value="0">
                                    <input type="hidden" id="map-lng-1" value="0">
                                    <input type="hidden" id="map-lng-2" value="0">
                                </div>
                            </div>
                            <div class="new-order-documents">
                                <h3 class="documents-title">Список документов:</h3>
                                <ul class="documents-list">
                                    <li>Копия паспорта</li>
                                    <li>Копия идентификационного номера</li>
                                    <li>Акт согласования границ (бланк акта)</li>
                                    <li>Копия документов прав собственности на объекты недвижимости</li>
                                    <li>Копия документов БТИ</li>
                                </ul>
                                <div class="documents-attach">
                                    <label class="button button-invert documents-attach-button">
                                        <span>Прикрепить документ</span>
                                        <input type="file" name="order_file[]" multiple>
                                    </label>
                                    <div class="attach-button-description">*Максимальньный размер файла <?php echo round(wp_max_upload_size()/1024/1024,2);?> МБ</div>
                                </div>
                            </div>
                            <div class="new-order-buttons">
                                <button type="button" class="button button-blue new-order-cancel" name="cancel-order"><span>Отмена</span></button>
                                <button type="submit" class="button new-order-submit" name="new-order"><span>Заключить договор</span></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<?php get_footer('profile');?>