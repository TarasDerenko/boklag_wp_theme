<?php
global $order;
$count_comments = isset($order->comments) && is_array($order->comments) ? sizeof($order->comments) : 0;

?>
<td colspan="5">
<div class="order-detailed">
    <div class="order-detailed-summery">
        <div class="order-detailed-info">
            <div class="detailed-info-row">
                <div class="detailed-info-label">
                    Целевое использование:
                </div>
                <div class="detailed-info-value">
                    <?=$order->title;?>
                </div>
            </div>
            <div class="detailed-info-row">
                <div class="detailed-info-label">
                    Краткое описание:
                </div>
                <div class="detailed-info-value">
                    <?=$order->description;?>
                </div>
            </div>
            <div class="detailed-info-row">
                <div class="detailed-info-label">
                    Площадь:
                </div>
                <div class="detailed-info-value">
                   <?= $order->area ?>
                </div>
            </div>
            <div class="detailed-info-row">
                <div class="detailed-info-label">
                    Стоимость работы:
                </div>
                <div class="detailed-info-value">
                    <?= $order->price ?> грн.
                </div>
            </div>
            <div class="detailed-info-row">
                <div class="detailed-info-label">
                    Оплата работ:
                </div>
                <div class="detailed-info-value">
                    10.10.2017
                </div>
            </div>
            <div class="detailed-info-row">
                <div class="detailed-info-label">
                    Стадии работ:
                </div>
                <div class="detailed-info-value">
                    <?= $order->status ?>
                </div>
            </div>
        </div>
        <div class="order-detailed-map">
            <div id="map-<?= $order->id ?>" data-lat="<?= $order->lat ?>" data-lng="<?= $order->lng ?>" data-rang="<?= $order->rang ?>" class="location-map"></div>
        </div>
        <button class="executer-answers-show" type="button">Ответов (<?=$count_comments?>)<span class="arrow"></span></button>
    </div>

    <div class="order-detailed-answer">
        <div class="order-answer-table">
            <table>
                <tbody>
                <tr class="header-order-executer">
                    <th></th>
                    <th>Комментарий</th>
                    <!--<th>Вибрать</th>-->
                </tr>
                <?php if($count_comments):?>
                    <?php foreach ($order->comments as $comment): ?>
                        <tr class="order-executer">
                            <td><?=$comment->display_name ?></td>
                            <td><?=$comment->comment?></td>
                            <!--<td><button class="button button-invert" type="button"><span>Выбрать</span></button></td>-->
                        </tr>
                    <?php endforeach; ?>
                <?php endif;?>
                <tr class="">
                    <td colspan="4">
                        <div class="order-executer-info">
                            <div class="order-executer-message">
                                <div class="order-executer-avatar">
                                    <img src="img/executer-avatar.jpg" alt="">
                                </div>
                                <form>
                                    <div class="order-executer-form">
                                        <input type="text" placeholder="Написать сообщение" name="answer-text">
                                        <input type="hidden" name="order-id" value="<?= $order->id ?>">
                                        <button type="button" name="parent-id" class="button button-invert" value=""><span>Отправить</span></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    <button class="order-detailed-close" type="button"></button>
</div>
</td>
