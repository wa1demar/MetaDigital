<?php get_header() ?>

    <div class="articles" id="articles">
        <div class="category {{ $parent.current_category != category ? '' : 'active' }}"
             ng-repeat="category in categories"
             ng-click="$parent.current_category = category; $parent.current_post = $parent.current_category.posts[0];">
            <div class="item">
                <div class="icon">
                    <img
                        ng-src="{{ $parent.current_category != category ? category.icons.default : category.icons.active }}">
                </div>
                <div class="title">{{ category.name }}</div>
            </div>
        </div>
        <div style="clear: left"></div>
    </div>
    <div class="articles-drilldown">
        <div class="articles-list">
            <ul>
                <li ng-repeat="post in current_category.posts" ng-click="setCurrentPost(post)"
                    class="{{ $parent.current_post != post ? '' : 'active' }}"><a href="#{{ post.slug }}">{{ post.title
                        }}</a>
                </li>
            </ul>
        </div>
        <div class="articles-content">
            <div class="top-gradient" id="{{current_post.slug}}_id"></div>
            <div class="articles-body">
                <div class="articles-header" name="services">
                    {{ current_category.name }}
                </div>
                <div ng-bind-html="getHtml(current_post.exerpt)"></div>
                <div class="more"><a href="/services/{{ current_post.slug }}/">{{ t[locale].more }}...</a></div>
            </div>
            <div class="bottom-gradient"></div>
        </div>

    </div>

<?php get_footer() ?>