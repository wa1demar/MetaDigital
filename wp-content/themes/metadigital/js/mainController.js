(function () {

    "use strict";

    angular.module('metaDigitalApp')
        .controller('HomeController', ['$scope', '$http', '$sce', function ($scope, $http, $sce) {


            $scope.getHtml = function (html) {
                return $sce.trustAsHtml(html);
            };

            $scope.setCurrentPost = function (post) {

                $scope.current_post = post;

                //$('html, body').animate({
                //    scrollTop: $("#" + post.slug + "_id").offset().top + 'px'
                //}, 'slow');

            };

            $scope.locale = 'ru';
            window.locale = 'ru';
            $scope.t = {
                en: {
                    sidebar_top: 'who we are',
                    sidebar_services: 'services',
                    sidebar_works: 'works',
                    sidebar_contacts: 'contact us',
                    webdevelopment: 'WEB - DEVELOPMENT',
                    moskow: 'Moscow',
                    address: '45 olkhovskaya st, bdg 1',
                    contact_us: 'contact us',
                    name: 'Name',
                    email: 'Email Address',
                    feadback_text: 'Your text..',
                    send_button: 'send',
                    next_text: 'Next Project',
                    about_text: 'About Project',
                    more: 'More',
                    server_error: 'Server Connect Error'
                },
                ru: {
                    sidebar_top: 'кто мы',
                    sidebar_services: 'услуги',
                    sidebar_works: 'работы',
                    sidebar_contacts: 'контакты',
                    webdevelopment: 'WEB - РАЗРАБОТКА',
                    moskow: 'Москва',
                    address: 'ул. Ольховская, 45, ст. 1',
                    contact_us: 'Связаться с нами',
                    name: 'Имя',
                    email: 'Электронный адрес',
                    feadback_text: 'Ваш текст..',
                    send_button: 'отправить',
                    next_text: 'Следующий Проект',
                    about_text: 'О Проекте',
                    more: 'Подробнее',
                    server_error: 'Ошибка связи с сервером'
                }
            };

            if ($.cookie('language')) {
                setTimeout(function () {
                    $scope.$apply(function () {
                        $scope.retrieveCategories($.cookie('language'));
                    });
                }, 0);


            } else {
                var Alert = new LanguageBox();
                Alert.render().chooseCallback(function (lang) {
                    $scope.retrieveCategories(lang);

                    Alert.close();
                });
            }

            $scope.findCategory = function (data, slugName) {
                console.log("start");
                var res = null;
                $.each(data, function (i, category) {
                    $.each(category.posts, function (j, post) {
                        if (post.slug === slugName) {
                            res = {
                                cat: category,
                                post: post
                            };
                            console.log(res);
                            return;
                        }

                    });

                });
                return res;

            };

            $scope.retrieveCategories = function (lang) {
                $http.get('/api/service/get_all_categories/?lang=' + lang)
                    .success(function (data) {
                        delete data.status;
                        $scope.locale = lang;
                        window.locale = lang;
                        $scope.categories = data;
                        var cur = "";
                        if (window.location.pathname.split("/")[1] == "services") {
                            cur = window.location.pathname.split("/")[2];
                        } else if (window.location.hash.substr(1)) {
                            cur = window.location.hash.substr(1);
                        }

                        if (cur != "") {
                            var result = $scope.findCategory($scope.categories, cur);
                            console.log(result);
                            if (result == null) {
                                $scope.current_category = $scope.categories[0];
                                $scope.current_post = $scope.current_category.posts[0];
                            } else {
                                $scope.current_category = result.cat;
                                $scope.current_post = result.post;
                            }

                        } else {
                            $scope.current_category = $scope.categories[0];
                            $scope.current_post = $scope.current_category.posts[0];
                        }

                    })
                    .error(function () {
                        $scope.messages.errors = $scope.t[$scope.locale].server_error;

                        $('.alert-overlay .alert-message').css("background-image", "url(\"./wp-content/themes/metadigital/images/error-icon.png\")");


                        new messageBox();
                    });
            };


            //$scope.retrieveCategories('ru');


            $http.get('/api/gallery/get_all_galleries_localized').success(function (data) {
                delete data.status;
                var galleries = data;
                var gallery = new Gallery("#gallery", {
                    albums: galleries,
                    responsive: [
                        {
                            breakpoint: 20000,
                            settings: {
                                vertical_double_tiles_count: 2,
                                horizontal_double_tiles_count: 3,
                                width: 8,
                                height: 2
                            }
                        },
                        {
                            breakpoint: 1300,
                            settings: {
                                vertical_double_tiles_count: 1,
                                horizontal_double_tiles_count: 2,
                                width: 6,
                                height: Math.ceil((Object.keys(galleries).length + 3) / 6)
                            }
                        },
                        {
                            breakpoint: 800,
                            settings: {
                                vertical_double_tiles_count: 1,
                                horizontal_double_tiles_count: 1,
                                width: 4,
                                height: Math.ceil((Object.keys(galleries).length + 2) / 4)
                            }
                        },
                        {
                            breakpoint: 550,
                            settings: {
                                vertical_double_tiles_count: 1,
                                horizontal_double_tiles_count: 1,
                                width: 2,
                                height: Math.ceil((Object.keys(galleries).length + 2) / 2)
                            }
                        }
                    ]
                }).tileClick(function (index) {

                        $scope.$apply(function () {
                            $scope.lightbox_title = galleries[index][$scope.locale].title;
                            $scope.lightbox_description = galleries[index][$scope.locale].description;
                        });

                        var lightbox = new Lightbox();
                        lightbox.setImages(galleries[index].images).render().nextProject(function () {


                            index++;
                            if (index > Object.keys(galleries).length - 1) {
                                index = 0;
                            }

                            var current_index = index;
                            $scope.$apply(function () {
                                $scope.lightbox_title = galleries[current_index][$scope.locale].title;
                                $scope.lightbox_description = galleries[current_index][$scope.locale].description;
                            });

                            lightbox.setImages(galleries[index].images).render();
                        });
                    });
            });

            $scope.getSiteInfo = function () {
                $http.get('/api/general/get_site_info/?lang=' + $scope.locale).success(function (data) {
                    $('.main .description').data('type', data[0].description);
                });
            };

            $scope.$watch('locale', function () {
                $scope.getSiteInfo();
            });

            $scope.messages = {};
            $scope.contactUs = function () {

                var fd = new FormData();
                fd.append('lang', $scope.locale);
                fd.append('username', $scope.username);
                fd.append('useremail', $scope.useremail);
                fd.append('usertext', $scope.usertext);

                return $http.post('/api/general/contact_us', fd, {
                    transformRequest: angular.identity,
                    headers: {'Content-Type': undefined}
                }).success(function (data) {
                    $scope.messages.errors = data.errors;
                    $scope.messages.success = data.success;


                    if (data.success) {
                        $('.alert-overlay .alert-message').css("background-image", "url(\"./wp-content/themes/metadigital/images/success-icon.png\")");
                    }
                    else {
                        $('.alert-overlay .alert-message').css("background-image", "url(\"./wp-content/themes/metadigital/images/error-icon.png\")");
                    }

                    new messageBox();

                })
            }

        }])
}());