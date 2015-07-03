(function () {

    "use strict";

    angular.module('metaDigitalApp')
        .controller('HomeController', ['$scope', '$http', '$sce', function ($scope, $http, $sce) {


            $scope.getHtml = function(html){
                return $sce.trustAsHtml(html);
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
                    moskow: 'Moskow',
                    address: '45 olkhovskaya st, bdg 1',
                    contact_us: 'contact us',
                    name: 'Name',
                    email: 'Email Address',
                    feadback_text: 'Your text ...',
                    send_button: 'send'
                },
                ru: {
                    sidebar_top:'кто мы',
                    sidebar_services: 'услуги',
                    sidebar_works: 'работы',
                    sidebar_contacts: 'контакты',
                    webdevelopment: 'WEB - РАЗРАБОТКА',
                    moskow: 'Москва',
                    address: 'ул. Ольховская, 45, ст. 1',
                    contact_us: 'Связаться с нами',
                    name: 'Имя',
                    email: 'Електронный адресс',
                    feadback_text: 'Ваш текст ...',
                    send_button: 'отправить'
                }
            };

            var Alert = new languageBox();
            Alert.render().chooseCallback(function(lang){
                $scope.retriveCategories(lang);

                Alert.close();
            });

            $scope.retriveCategories = function(lang){
                $http.get('/api/service/get_all_categories/?lang=' + lang)
                    .success(function(data){
                        delete data.status;
                        $scope.locale = lang;
                        window.locale = lang;
                        $scope.categories = data;

                        $scope.current_category = $scope.categories[0];
                        $scope.current_post = $scope.current_category.posts[0];
                    })
                    .error(function(){
                    });
            };

            $scope.retriveCategories('ru');
            

            $http.get('/api/gallery/get_all_galleries_localized').success(function(data){

                delete data.status;
                var gallery = new Gallery("#gallery", {
                    albums: data,
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
                                height: Math.ceil(Object.keys(data).length/6)
                            }
                        },
                        {
                            breakpoint: 800,
                            settings: {
                                vertical_double_tiles_count: 1,
                                horizontal_double_tiles_count: 1,
                                width: 4,
                                height: Math.ceil(Object.keys(data).length/4)
                            }
                        },
                        {
                            breakpoint: 550,
                            settings: {
                                vertical_double_tiles_count: 1,
                                horizontal_double_tiles_count: 1,
                                width: 2,
                                height: Math.ceil(Object.keys(data).length/2)
                            }
                        }
                    ]
                });
            });

        }])
}());