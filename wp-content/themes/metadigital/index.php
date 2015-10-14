<?php get_header() ?>

    <div class="articles" id="articles">
        <div class="category {{ $parent.current_category != category ? '' : 'active' }}"
             ng-repeat="category in categories"
             ng-click="$parent.current_category = category">
            <div class="item">
                <div class="icon">
                    <img
                        ng-src="{{ category.thumb }}">
                </div>
                <div class="title">{{ category[locale].title[0] }}</div>
            </div>
        </div>
        <div style="clear: left"></div>
    </div>
    <div class="articles-drilldown">
        <div class="articles-content">
            <div class="top-gradient" id="{{current_category.id}}_id"></div>
            <div class="articles-body">
                <div class="articles-header" name="services">
                    {{ current_category[locale].title[0] }}
                </div>
                <div ng-bind-html="getHtml(current_category[locale].description[0])"></div>
            </div>
            <div class="bottom-gradient"></div>
        </div>

    </div>

<?php get_footer() ?>