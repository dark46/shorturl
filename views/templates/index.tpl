{include file='index_layout_top.tpl'}    
    
<div align="center">
    <div id="main">
        <div id="error">
        </div>
        <div id="short_url">
            <div class="col-xs-12">    
                <a id="short_url_link" href=""></a>
            </div>
            <div class="col-xs-12">    
                <button class="btn btn-default" type="button" id="copy_to_clipboard">Скопировать в буфер обмена</button>
            </div>
            <div class="col-xs-12">    
                Страница статистики <a target="_blank" id="stat_link" href=""></a>
            </div>
        </div>


        <form id="shortUrlForm" class="form-horizontal">
            <div class="form-group">
                <div class="col-xs-12">
                    <div class="input-group">
                        <input type="text" name="url" placeholder="Введите адрес который хотите уменьшить" class="form-control">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="submit">УМЕНЬШИТЬ</button>
                        </span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-12">
                    <a style="cursor:pointer" id="showExpiredDate">Я хочу указать дату окончания доступности ссылки</a>
                </div>
            </div>
            <div id="expiredDate">
                <input type="hidden" id="useExpiredDate" name="expiredDate[use]" value="0">
                <div class="inline">
                    <div class="col-xs-3" style="padding-left:0px">
                        <select id="year" name="expiredDate[year]" class="form-control input-sm">
                        </select>
                    </div>
                </div>
                <div class="inline">
                    <div class="col-xs-3">
                        <select id="month" name="expiredDate[month]" class="form-control input-sm">
                        </select>
                    </div>
                </div>
                <div class="inline">
                    <div class="col-xs-2">
                        <select id="day" name="expiredDate[day]" class="form-control input-sm">
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-12">
                    <a style="cursor:pointer;" id="showCustomShortUrl">Я хочу указать собственный адрес короткой ссылки</a>
                </div>
            </div>
            <div id="customShortUrl">
                <div class="form-group">
                    <div class="col-xs-5">
                        <input type="text" name="custom_short_url" class="form-control input-sm" placeholder="Введите адрес короткой ссылки">
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
<script type="text/javascript" src="/assets/js/index.js"></script>
{include file='index_layout_bottom.tpl'}