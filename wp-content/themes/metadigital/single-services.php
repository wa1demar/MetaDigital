<?php get_header(); ?>

        <div class="articles-drilldown-full">
            <div class="articles-content-full">
                <div class="articles-body-full">
                    <div class="articles-header-full" name="services">
                        {{ current_post.title }}
                    </div>
                    <div ng-bind-html="getHtml(current_post.content)"></div>
                </div>
            </div>
        </div>

<?php get_footer(); ?>