<?php if(!isset($_COOKIE['current-place'])): ?>
<div class="location active">
    <form method="post" class="select-city">
        <div class="location-wrapper">
            <div class="location-current">
                <div class="location-current-text">Вы из г. Винница?</div>
                <input type="hidden" name="current-place" value="1">
                <input type="hidden" name="city-current" value="vinytsa">
                <label class="location-current-option">
                    Да
                    <input type="radio" name="location-current" value="1">
                </label>
                <label class="location-current-option">
                    Нет
                    <input type="radio" name="location-current" value="0">
                </label>
            </div>
            <div class="location-another">
                <label for="">Выбрать другой город:</label>
                <div class="location-another-select">
                    <select name="my-city">
                        <option value="kyiv">г. Киев</option>
                        <option value="lviv">г. Львов</option>
                        <option value="dnepr">г. Днепр</option>
                    </select>
                </div>
            </div>
            <button type="button" class="location-close">&times;</button>
        </div>
    </form>
</div>
<?php endif; ?>