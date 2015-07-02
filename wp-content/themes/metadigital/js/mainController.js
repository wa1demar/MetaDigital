(function () {

    "use strict";

    angular.module('metaDigitalApp')
        .controller('HomeController', ['$scope', '$http', '$sce', function ($scope, $http, $sce) {


            $scope.getHtml = function(html){

                console.log(html);
                return $sce.trustAsHtml(html);
            };

            $scope.category_images = ["./wp-content/themes/metadigital/images/marketing-icon.png",
            "./wp-content/themes/metadigital/images/device-icon.png",
            "./wp-content/themes/metadigital/images/design-icon.png",
            "./wp-content/themes/metadigital/images/bitrix-icon.png",
            "./wp-content/themes/metadigital/images/applications-icon.png",
            "./wp-content/themes/metadigital/images/outstuffing-icon.png"];

            $scope.locale = 'ru';
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
                        $scope.categories = data;

                        $scope.current_category = $scope.categories[0];
                        $scope.current_post = $scope.current_category.posts[0];
                    })
                    .error(function(){
                    });
            };

            $scope.console = {
              log: function(i){
                  console.log(i);
              }
            };
            $scope.retriveCategories('ru');


            $scope.slides = [
                { 'image': './wp-content/themes/metadigital/images/map2.png' },
                { 'image': './wp-content/themes/metadigital/images/map3.png' }
            ];

            $scope.$slideIndex = 0;

            $scope.next = function() {
                var total = $scope.slides.length;
                if (total > 0) {
                    $scope.$slideIndex = ($scope.$slideIndex == total - 1) ? 0 : $scope.$slideIndex + 1;
                }
            };
// функция play запускает таймер, который переключает слайд и вызывает её же повторно

            $scope.prev = function() {
                var total = $scope.slides.length;
                if (total > 0) {
                    $scope.$slideIndex = ($scope.$slideIndex == 0) ? total-1 : $scope.$slideIndex - 1;
                }
            };
        }])





}());